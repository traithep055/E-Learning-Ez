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
            ])->get();
        } elseif ($request->has('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->firstOrFail();
            $courses = Course::where([
                'sub_category_id' => $subcategory->id,
                'status' => true,
            ])->get();
        } elseif ($request->has('searchcard')) {
            $courses = Course::where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->searchcard.'%')
                    ->orWhere('content', 'like', '%'.$request->searchcard.'%');
            })
            ->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->searchcard.'%')
                    ->orWhere('content', 'like', '%'.$request->searchcard.'%');
            })
            ->get();
        } else {
            $courses = Course::where('status', true)->get();
        }
        
        return view('frontend.pages.course', compact('courses'));
    }
}
