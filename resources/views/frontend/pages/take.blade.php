@extends('frontend.layouts.master')

@section('content')
<div class="container mt-8">
    <h2>{{ $test->name }}</h2>
    {!! $test->description !!}
    <form id="testForm" action="{{ route('user.tests.submit', $test->id) }}" method="POST">
        @csrf
        @foreach ($test->questions as $index => $question)
            <div class="question mb-3 border p-3 rounded">
                <div class="row">
                    <div class="col-auto">
                        <label for="question_{{ $index }}" class="form-label">{{ $index + 1 }}. {{ $question->question }}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $question->id }}]" value="A" id="answer_{{ $question->id }}_A" class="form-check-input" required>
                            <label class="form-check-label" for="answer_{{ $question->id }}_A">A. {{ $question->option_a }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $question->id }}]" value="B" id="answer_{{ $question->id }}_B" class="form-check-input" required>
                            <label class="form-check-label" for="answer_{{ $question->id }}_B">B. {{ $question->option_b }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $question->id }}]" value="C" id="answer_{{ $question->id }}_C" class="form-check-input" required>
                            <label class="form-check-label" for="answer_{{ $question->id }}_C">C. {{ $question->option_c }}</label>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-check">
                            <input type="radio" name="answers[{{ $question->id }}]" value="D" id="answer_{{ $question->id }}_D" class="form-check-input" required>
                            <label class="form-check-label" for="answer_{{ $question->id }}_D">D. {{ $question->option_d }}</label>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-primary" onclick="submitTestForm()">ส่งคำตอบ</button>
        <button type="button" class="btn btn-warning" onclick="clearAnswers()">ล้างคำตอบ</button>
    </form>
</div>
@endsection

@push('scripts')
    <script>
        function clearAnswers() {
            const radios = document.querySelectorAll('input[type="radio"]');
            radios.forEach(radio => {
                radio.checked = false;
            });
        }

        function submitTestForm() {
            const questions = document.querySelectorAll('.question');
            let allAnswered = true;

            questions.forEach(question => {
                const radios = question.querySelectorAll('input[type="radio"]');
                let answered = false;
                radios.forEach(radio => {
                    if (radio.checked) {
                        answered = true;
                    }
                });
                if (!answered) {
                    allAnswered = false;
                    question.classList.add('border-danger');
                } else {
                    question.classList.remove('border-danger');
                }
            });

            if (allAnswered) {
                document.getElementById('testForm').submit();
            } else {
                alert('กรุณาทำแบบทดสอบให้ครบทุกข้อก่อนที่จะส่งคำตอบ');
            }
        }
    </script>
@endpush
