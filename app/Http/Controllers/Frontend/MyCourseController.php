<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\CoursePurchaes;
use App\Models\Course;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MyCourseController extends Controller
{
    public function index() 
    {
        $user = Auth::user();
        $mycourses = $user->purchasedCourses()->with('lessons', 'teacher', 'purchasedCourses')->get();

        // ดึงผลการทดสอบที่มีคะแนน >= 80%
        $passedTests = TestResult::where('user_id', $user->id)
            ->where('score', '>=', 80)
            ->with('test') // Make sure to load the test relationship
            ->get();

        return view('frontend.dashboard.mycourse', compact('mycourses', 'passedTests'));
    }
}
