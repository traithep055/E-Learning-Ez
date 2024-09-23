<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\AllCourseDataTable;
use App\Models\Course;
use App\Models\CoursePurchaes;
use App\Models\User;
use PDF;
use View;
use Illuminate\Http\Request;

class AllCourseController extends Controller
{
    public function index() 
    {
        $courses = Course::paginate(10);
        return view('admin.course-report.index', compact('courses'));
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
}
