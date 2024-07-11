<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function index() 
    {
        $mycourses = Auth::user()->purchasedCourses()->with('lessons', 'teacher', 'purchasedCourses')->get();
        return view('frontend.dashboard.mycourse', compact('mycourses'));
    }
}