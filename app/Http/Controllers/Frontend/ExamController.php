<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Test;
use App\Models\TestResult;
use App\Models\ScoreCriteria;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ExamController extends Controller
{
    public function take($courseId)
    {
        $course = Course::findOrFail($courseId);
        $test = $course->test; // ตรวจสอบว่าคอร์สนี้มีแบบทดสอบหรือไม่

        if (!$test) {
            return view('frontend.pages.no_test', compact('course'));
        }

        return view('frontend.pages.take', compact('test', 'course'));
    }

    public function submit(Request $request, Test $test)
    {
        // $scorecriteria = ScoreCriteria::findOrFail(1);
        // $criteria = $scorecriteria->criteria;

        $userAnswers = $request->input('answers');
        $correctAnswers = $test->questions->pluck('correct_option', 'id')->toArray();
        $score = 0;
        $incorrectQuestions = [];

        foreach ($correctAnswers as $questionId => $correctAnswer) {
            $question = $test->questions->find($questionId);
            if (isset($userAnswers[$questionId]) && $userAnswers[$questionId] === $correctAnswer) {
                $score++;
            } else {
                $incorrectQuestions[] = [
                    'question' => $question->question,
                    'correct_answer' => $correctAnswer,
                    'user_answer' => $userAnswers[$questionId] ?? null,
                    'options' => [
                        'A' => $question->option_a,
                        'B' => $question->option_b,
                        'C' => $question->option_c,
                        'D' => $question->option_d,
                    ]
                ];
            }
        }

        $totalQuestions = count($correctAnswers);
        $scorePercentage = ($score / $totalQuestions) * 100;

        $testResult = new TestResult();
        $testResult->user_id = Auth::id(); // ใช้ Auth::id() เพื่อดึง user_id ของผู้ใช้ที่ล็อกอินอยู่
        $testResult->test_id = $test->id;
        $testResult->score = $scorePercentage;
        $testResult->answers = json_encode($userAnswers); // เก็บคำตอบเป็น JSON
        $testResult->save();

        return view('frontend.pages.result', compact('scorePercentage', 'incorrectQuestions', 'test', 'testResult'));
    }
}
