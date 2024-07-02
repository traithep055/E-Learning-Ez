<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendCourseController extends Controller
{
    public function coursesIndex(Request $request) 
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
        $user = Auth::user();
        
        if ($user) {
            // รับ IDs ของคอร์สที่ผู้ใช้ได้ซื้อไปแล้ว
            $purchasedCourseIds = $user->purchasedCourses->pluck('id')->toArray();
        } else {
            $purchasedCourseIds = [];
        }

        // ดึงข้อมูลคอร์สตามเงื่อนไขที่กำหนด
        if ($request->has('category')) {
            $category = Category::where('slug', $request->category)->firstOrFail();
            $courses = Course::where('category_id', $category->id)
                ->where('status', true)
                ->whereNotIn('id', $purchasedCourseIds)
                ->get();
        } elseif ($request->has('subcategory')) {
            $subcategory = SubCategory::where('slug', $request->subcategory)->firstOrFail();
            $courses = Course::where('sub_category_id', $subcategory->id)
                ->where('status', true)
                ->whereNotIn('id', $purchasedCourseIds)
                ->get();
        } elseif ($request->has('searchcard')) {
            $courses = Course::where(function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->searchcard.'%')
                    ->orWhere('content', 'like', '%'.$request->searchcard.'%');
            })
            ->orWhereHas('category', function ($query) use ($request) {
                $query->where('name', 'like', '%'.$request->searchcard.'%')
                    ->orWhere('content', 'like', '%'.$request->searchcard.'%');
            })
            ->whereNotIn('id', $purchasedCourseIds)
            ->get();
        } else {
            $courses = Course::where('status', true)
                ->whereNotIn('id', $purchasedCourseIds)
                ->get();
        }
        
        return view('frontend.pages.course', compact('courses', 'user'));
    }
}
