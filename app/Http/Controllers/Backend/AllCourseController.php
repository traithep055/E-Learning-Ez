<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\AllCourseDataTable;
use App\Models\Course;
use App\Models\CoursePurchaes;
use App\Models\User;
use App\Models\Category;
use App\Models\SubCategory;
use PDF;
use View;
use Illuminate\Http\Request;

class AllCourseController extends Controller
{
    public function index(Request $request)
    {
        // เริ่มสร้าง query สำหรับคอร์ส
        $query = Course::query();

        // ถ้ามีการเลือก category_id แต่ไม่มีการเลือก sub_category_id
        if ($request->filled('category_id') && !$request->filled('sub_category_id')) {
            $query->where('category_id', $request->category_id);
        }

        // ถ้ามีการเลือก sub_category_id ก็จะแสดงเฉพาะคอร์สใน subcategory นั้น
        if ($request->filled('sub_category_id')) {
            $query->where('sub_category_id', $request->sub_category_id);
        }

        // ดึงข้อมูลคอร์ส
        $courses = $query->paginate(10);

        // ดึงข้อมูล categories และ subcategories สำหรับ dropdown
        $categories = Category::all();
        
        return view('admin.course-report.index', compact('courses', 'categories'));
    }


    public function ReportCoursePDF() 
    {
        $courses = Course::get();

        $pdf = PDF::loadView('admin.course-report.course-pdf', compact('courses'));
        return $pdf->stream('course-pdf.pdf');
    }

    public function ReportStdCoursePDF($id)
    {
        // ดึงข้อมูลคอร์สพร้อมกับรายละเอียดการซื้อรวมถึงผู้ใช้
        $course = Course::with(['purchasedCoursesDetails.user'])->findOrFail($id);

        // สร้าง PDF รายงานข้อมูลผู้เรียน
        $pdf = PDF::loadView('admin.course-report.students-report-pdf', compact('course'));
        return $pdf->stream('students-report.pdf');
    }

    /**
     * Get all course sub category.
     */
    public function getSubCategories(Request $request) 
    {
        $subCategoeris = SubCategory::where('category_id',$request->id)->get();   
        return $subCategoeris;  
    }
}
