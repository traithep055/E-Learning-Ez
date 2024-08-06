<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CeReportController extends Controller
{
    public function CertReport(Request $request) 
    {
        // ดึงข้อมูลคอร์สทั้งหมดที่ผู้สอนที่ล็อกอินอยู่สร้างขึ้น
        $courses = Course::where('teacher_id', Auth::user()->teacher->id)->get(); 
        $courseId = $request->input('course_id'); // รับค่าคอร์สที่เลือกจาก dropdown

        $students = collect();
        $selectedCourse = null;
        if ($courseId) {
            $selectedCourse = Course::where('id', $courseId)->where('teacher_id', Auth::user()->teacher->id)->first(); // ตรวจสอบว่าเป็นคอร์สของผู้สอนที่ล็อกอินอยู่
            if ($selectedCourse) {
                // ดึงข้อมูลการทำข้อสอบทั้งหมด
                $testResults = TestResult::whereHas('test', function ($query) use ($courseId) {
                    $query->where('course_id', $courseId);
                })
                ->with('user')
                ->get();

                // Group ตาม user_id และคำนวณจำนวนครั้งที่ทำข้อสอบ
                $students = $testResults->groupBy('user_id')->map(function ($testResults) {
                    $user = $testResults->first()->user;
                    return [
                        'user' => $user,
                        'count' => $testResults->count(), // นับจำนวนครั้งที่ทำข้อสอบ
                        'highest_score' => $testResults->max('score'), // หาคะแนนสูงสุด
                        'certificate_date' => $testResults->filter(function ($result) {
                            return $result->score >= 80;
                        })->sortByDesc('created_at')->first()->created_at ?? null,
                    ];
                });
            }
        }

        return view('teacher.report.certificate.cert-report', compact('courses', 'students', 'selectedCourse'));
    }

}
