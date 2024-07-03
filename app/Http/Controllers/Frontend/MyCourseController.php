<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function index() 
    {
        $mycourses = CoursePurchaes::where('user_id', auth()->id())->get();

        return view('frontend.dashboard.mycourse', compact('mycourses'));
    }
}
