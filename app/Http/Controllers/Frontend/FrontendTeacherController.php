<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Illuminate\Http\Request;

class FrontendTeacherController extends Controller
{
    public function index() 
    {
        $teachers = Teacher::get();
        
        return view('frontend.pages.teacher', compact('teachers'));
    }

    public function teacherDetail(string $id) 
    {
        $teacher = Teacher::with('course.purchasedCourses')->findOrFail($id);
        $user = auth()->user();
        
        return view('frontend.pages.teacher_detail', compact('teacher', 'user'));
    }
}
