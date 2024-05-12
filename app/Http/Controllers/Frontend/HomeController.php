<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        // ดึงข้อมูลคอร์สที่มีสถานะเป็น "active"
        $courses = Course::where('status', true)->get();
        
        return view('frontend.home.home', compact('courses'));   
    }

    public function showcourseDetail(string $id) 
    {
        $course = Course::findOrFail($id);

        return view('frontend.pages.course_detail', compact('course'));
    }
}
