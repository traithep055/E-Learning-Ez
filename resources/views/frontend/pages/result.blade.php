@extends('frontend.layouts.master')

@section('content')
<div class="container mt-8">
    <h2>ผลการทำแบบทดสอบ</h2>
    <p>คะแนนของคุณ: {{ $scorePercentage }}%</p>
    
    @if ($scorePercentage < 80)
        <h3>คำตอบที่ผิด</h3>
        @foreach ($incorrectQuestions as $question)
            <div class="mb-4">
                <p><strong>คำถาม:</strong> {{ $question['question'] }}</p>
                <p><strong>คำตอบที่ถูกต้อง:</strong> {{ $question['correct_answer'] }}. {{ $question['options'][$question['correct_answer']] }}</p>
                <p><strong>คำตอบของคุณ:</strong> {{ $question['user_answer'] }}. {{ $question['options'][$question['user_answer']] ?? 'ไม่ได้เลือก' }}</p>
            </div>
        @endforeach
        <div class="mt-4 d-flex justify-content-between">
            <a href="{{ route('user.mycourse') }}" class="btn btn-warning">เรียนใหม่</a>
        </div>
    @endif

    <div class="mt-4">
        @if ($scorePercentage >= 80)
            <a href="{{ route('user.certificate.download', ['course_id' => $test->course->id]) }}" target="_blank" class="btn btn-success">รับใบประกาศณียบัตร</a>
        @endif
    </div>
</div>
@endsection
