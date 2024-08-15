<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use App\Models\Course;
use App\Models\Review;
use App\Models\CourseReviewSummary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function myCoursesReview() 
    {
        $user = Auth::user();
        $mycourses = $user->purchasedCourses()->with('lessons', 'teacher', 'purchasedCourses')->get();  
        
        return view('frontend.dashboard.courses_review', compact('mycourses'));
    }

    public function storeReview(Request $request, $courseId)
    {
        $request->validate([
            'rating' => 'required|integer|between:1,5',
            'comment' => 'required|string|max:1000',
        ]);

        $user = Auth::user();
        
        // ตรวจสอบว่าผู้ใช้ได้ทำการรีวิวคอร์สนี้แล้วหรือยัง
        $existingReview = Review::where('course_id', $courseId)
                                 ->where('user_id', $user->id)
                                 ->first();
        
        if ($existingReview) {
            return redirect()->back()->with('error', 'คุณได้ทำการรีวิวคอร์สนี้แล้ว');
        }
        
        // สร้างรีวิวใหม่
        Review::create([
            'course_id' => $courseId,
            'user_id' => $user->id,
            'rating' => $request->input('rating'),
            'comment' => $request->input('comment'),
        ]);
    
        // คำนวณสรุปรีวิว
        $course = Course::find($courseId);
        $totalReviews = $course->reviews->count();
        $averageRating = $totalReviews > 0
            ? $course->reviews->pluck('rating')->average()
            : 0;
    
        // อัปเดตหรือสร้างสรุปรีวิว
        CourseReviewSummary::updateOrCreate(
            ['course_id' => $courseId],
            [
                'total_reviews' => $totalReviews,
                'average_rating' => round($averageRating, 2)
            ]
        );

        return redirect()->back()->with('success', 'รีวิวเรียบร้อย');
    }
}
