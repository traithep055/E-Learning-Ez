<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
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

    public function CertReportAdmin(Request $request)
    {
        $courses = Course::all(); // Get all courses
        $students = collect();

        foreach ($courses as $course) {
            $testResults = TestResult::whereHas('test', function ($query) use ($course) {
                $query->where('course_id', $course->id);
            })
            ->with(['user', 'test.course']) // Eager load the test and course relationships
            ->get();

            $courseStudents = $testResults->groupBy('user_id')->map(function ($testResults) use ($course) {
                $user = $testResults->first()->user;
                return [
                    'user' => $user,
                    'user_id' => $user->id, // Include the user ID
                    'course_id' => $course->id, // Include the course ID
                    'course' => $course->name, // Include the course name
                    'count' => $testResults->count(),
                    'highest_score' => $testResults->max('score'),
                    'certificate_date' => $testResults->filter(function ($result) {
                        return $result->score >= 80;
                    })->sortByDesc('created_at')->first()->created_at ?? null,
                ];
            });

            $students = $students->merge($courseStudents);
        }

        // Paginate the students collection
        $students = $this->paginate($students, $request->page, 5);

        return view('admin.cert-report.index', compact('courses', 'students'));
    }

    protected function paginate($items, $page = 1, $perPage = 5, $options = [])
    {
        $items = $items instanceof Collection ? $items : Collection::make($items);
        $total = $items->count();
        $results = $items->forPage($page, $perPage);
        return new LengthAwarePaginator($results, $total, $perPage, $page, $options);
    }
}
