<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\CoursePurchaes;
use App\Models\Coupon;

class CoursePurchaseController extends Controller
{
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course);
        return view('frontend.pages.course_purchases', compact('course'));
    }

    public function store(Request $request)
    {
        dd($request->all());    
    }
}
