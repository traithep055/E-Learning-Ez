<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\TestResult;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function index(Request $request) 
    {
        return view('frontend.pages.learn');
    }

    public function learn($courseId, $lessonSlug)
    {
        $user = Auth::user();
        $course = Course::findOrFail($courseId);
        $lesson = Lesson::where('course_id', $courseId)->where('slug', $lessonSlug)->firstOrFail();

        // Find previous lesson
        $previousLesson = Lesson::where('course_id', $courseId)
                                ->where('id', '<', $lesson->id)
                                ->orderByDesc('id')
                                ->first();

        $nextLesson = Lesson::where('course_id', $courseId)
                            ->where('id', '>', $lesson->id)
                            ->orderBy('id')
                            ->first();

        // Check if user has passed the test with a score greater than 80%
        $hasPassedTest = TestResult::where('user_id', $user->id)
                                   ->whereHas('test.course', function($query) use ($courseId) {
                                       $query->where('id', $courseId);
                                   })
                                   ->where('score', '>=', 80)
                                   ->exists();

        return view('frontend.pages.learn', compact('course', 'lesson', 'previousLesson', 'nextLesson', 'hasPassedTest'));
    }
}
