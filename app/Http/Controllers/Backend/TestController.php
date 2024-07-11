<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\DataTables\TestDataTable;
use App\Models\Course;
use App\Models\Test;
use App\Models\TestQuestion;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TestDataTable $dataTable)
    {
        $course = Course::findOrfail($request->course);
        return $dataTable->render('teacher.tests.index', compact('course'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $course = Course::findOrFail($request->course);
        return view('teacher.tests.create', compact('course'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $course = Course::findOrFail($request->course);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'questions.*.question' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_option' => 'required|in:A,B,C,D',
        ]);

        $test = new Test();
        $test->course_id = $request->course;
        $test->name = $request->name;
        $test->description = $request->description;
        $test->save();

        // บันทึกคำถามแต่ละข้อ
        foreach ($validatedData['questions'] as $questionData) {
            $testQuestion = new TestQuestion();
            $testQuestion->test_id = $test->id;
            $testQuestion->question = $questionData['question'];
            $testQuestion->option_a = $questionData['option_a'];
            $testQuestion->option_b = $questionData['option_b'];
            $testQuestion->option_c = $questionData['option_c'];
            $testQuestion->option_d = $questionData['option_d'];
            $testQuestion->correct_option = $questionData['correct_option'];
            $testQuestion->save();
        }

        toastr()->success('สร้างแบบทดสอบแล้ว');
        
        return redirect()->route('teacher.tests.index', ['course' => $course->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $course = Course::findOrFail($request->course);
        $test = Test::findOrfail($id);
        return view('teacher.tests.edit', compact('test', 'course'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $course = Course::findOrFail($request->course);
        $test = Test::findOrFail($id);

        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'nullable|string',
            'questions.*.id' => 'nullable|integer|exists:test_questions,id',
            'questions.*.question' => 'required|string',
            'questions.*.option_a' => 'required|string',
            'questions.*.option_b' => 'required|string',
            'questions.*.option_c' => 'required|string',
            'questions.*.option_d' => 'required|string',
            'questions.*.correct_option' => 'required|in:A,B,C,D',
        ]);

        $test->name = $request->name;
        $test->description = $request->description;
        $test->save();

        $questionIds = [];
        foreach ($validatedData['questions'] as $questionData) {
            if (isset($questionData['id'])) {
                $testQuestion = TestQuestion::findOrFail($questionData['id']);
            } else {
                $testQuestion = new TestQuestion();
                $testQuestion->test_id = $test->id;
            }

            $testQuestion->question = $questionData['question'];
            $testQuestion->option_a = $questionData['option_a'];
            $testQuestion->option_b = $questionData['option_b'];
            $testQuestion->option_c = $questionData['option_c'];
            $testQuestion->option_d = $questionData['option_d'];
            $testQuestion->correct_option = $questionData['correct_option'];
            $testQuestion->save();

            $questionIds[] = $testQuestion->id;
        }

        // ลบคำถามที่ไม่ได้อยู่ในรายการ
        $test->questions()->whereNotIn('id', $questionIds)->delete();

        toastr()->success('แก้ไขแบบทดสอบเรียบร้อยแล้ว');

        return redirect()->route('teacher.tests.index', ['course' => $course->id]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
