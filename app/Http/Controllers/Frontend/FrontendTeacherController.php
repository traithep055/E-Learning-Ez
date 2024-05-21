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
}
