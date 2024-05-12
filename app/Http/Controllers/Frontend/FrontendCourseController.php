<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use Illuminate\Http\Request;

class FrontendCourseController extends Controller
{
    public function coursesIndex(Request $request) 
    {
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $courses = Course::where([
                'category_id' => $category->id,
                'status' => true,
            ])->paginate(12);
        } else {
            $courses = Course::where('status', true)->paginate(12);
        }

        return view('frontend.pages.course', compact('courses'));
    }
}
