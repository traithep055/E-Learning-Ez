<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CoursePurchaes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PaymentReportController extends Controller
{
    public function PaymentReport(Request $request) 
    {
        // ดึงข้อมูลคอร์สทั้งหมดที่ผู้สอนที่ล็อกอินอยู่สร้างขึ้น
        $courses = Course::where('teacher_id', Auth::user()->teacher->id)->get(); 
        $courseId = $request->input('course_id'); // รับค่าคอร์สที่เลือกจาก dropdown

        $students = [];
        $selectedCourse = null;
        if ($courseId) {
            $selectedCourse = Course::where('id', $courseId)->where('teacher_id', Auth::user()->teacher->id)->first(); // ตรวจสอบว่าเป็นคอร์สของผู้สอนที่ล็อกอินอยู่
            if ($selectedCourse) {
                $students = CoursePurchaes::where('course_id', $courseId)->with('user')->get();
            }
        }

        return view('teacher.report.payment-report.payment', compact('courses', 'students', 'selectedCourse'));
    }
}
