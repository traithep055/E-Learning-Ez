<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(Request $request) 
    {
        // ตรวจสอบว่ามีการเลือกตัวกรอง "คอร์สใหม่" หรือไม่
        $sortBy = $request->get('sort', 'latest');

        $user = Auth::user();
        $purchasedCourseIds = $user ? $user->purchasedCourses->pluck('id')->toArray() : [];

        $query = Course::where('status', true)
                        ->whereNotIn('id', $purchasedCourseIds);

        if ($sortBy === 'popular') {
            $courses = $query->withCount('purchasedCourses')
                             ->orderBy('purchased_courses_count', 'desc')
                             ->get();
        } elseif ($sortBy === 'latest') {
            $courses = $query->orderBy('created_at', 'desc') // หรือใช้ 'updated_at' ขึ้นอยู่กับว่าคุณต้องการเรียงลำดับตามวันที่สร้างหรือวันที่อัปเดต
                             ->get();
        } else {
            $courses = $query->get();
        }

        $rolesCount = User::select('role', \DB::raw('count(*) as count'))
                          ->groupBy('role')
                          ->pluck('count', 'role')
                          ->toArray();
        
        $categories = Category::withCount('courses')->get();
        $totalCourses = Course::count();

        return view('frontend.home.home', compact('courses', 'rolesCount', 'categories', 'totalCourses'));
    }

    public function showcourseDetail(string $id) 
    {
        $course = Course::findOrFail($id);
        $user = Auth::user();

        $hasPurchased = false;
        if ($user) {
            $hasPurchased = $user->purchasedCourses->contains($course->id);
        }

        // Get the first 3 reviews
        $reviews = $course->reviews()->take(3)->get();
        $totalReviews = $course->reviews->count();

        return view('frontend.pages.course_detail', compact('course', 'hasPurchased', 'reviews', 'totalReviews'));
    }

    public function loadMoreReviews(Request $request, $id)
    {
        $course = Course::findOrFail($id);

        // Get reviews starting from the 4th review
        $reviews = $course->reviews()->skip(3)->take(10)->get(); // Adjust number of reviews per page as needed

        $hasMore = $course->reviews()->count() > 3 + $reviews->count();

        $response = $reviews->map(function ($review) {
            return [
                'user_image' => $review->user->image ?? asset('images/user-profile.jpg'),
                'user_name' => $review->user->name,
                'rating' => $review->rating,
                'comment' => $review->comment,
                'created_at' => $review->created_at->format('d/m/Y'),
            ];
        });

        return response()->json(['reviews' => $response, 'hasMore' => $hasMore]);
    }

}
