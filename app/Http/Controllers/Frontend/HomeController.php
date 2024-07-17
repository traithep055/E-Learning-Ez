<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index() 
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        $user = Auth::user();

        if ($user) {
            // รับ IDs ของคอร์สที่ผู้ใช้ได้ซื้อไปแล้ว
            $purchasedCourseIds = $user->purchasedCourses->pluck('id')->toArray();

            // ดึงข้อมูลคอร์สที่มีสถานะเป็น "active" ยกเว้นคอร์สที่ผู้ใช้ได้ซื้อไปแล้ว
            $courses = Course::where('status', true)
                            ->whereNotIn('id', $purchasedCourseIds)
                            ->get();
        } else {
            // ดึงข้อมูลคอร์สที่มีสถานะเป็น "active" ทั้งหมด
            $courses = Course::where('status', true)->get();
        }

        return view('frontend.home.home', compact('courses'));   
    }

    public function showcourseDetail(string $id) 
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();

        $hasPurchased = false;
        if ($user) {
            $hasPurchased = $user->purchasedCourses->contains($course->id);
        }

        return view('frontend.pages.course_detail', compact('course', 'hasPurchased'));
    }
}
