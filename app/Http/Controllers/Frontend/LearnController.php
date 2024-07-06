<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;

class LearnController extends Controller
{
    public function index(Request $request) 
    {
        return view('frontend.pages.learn');
    }

    public function learn($courseId, $lessonSlug)
    {
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

        return view('frontend.pages.learn', compact('course', 'lesson', 'previousLesson', 'nextLesson'));
    }
}
