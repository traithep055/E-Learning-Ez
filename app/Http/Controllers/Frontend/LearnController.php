<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\TestResult;
use App\Models\ScoreCriteria;
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
        // $scorecriteria = ScoreCriteria::findOrFail(1);
        // $criteria = $scorecriteria->criteria;

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
                                   ->where('score', '>=', 80) // ใส่ $criteria แทน 80 ได้
                                   ->exists();

        return view('frontend.pages.learn', compact('course', 'lesson', 'previousLesson', 'nextLesson', 'hasPassedTest'));
    }
}
