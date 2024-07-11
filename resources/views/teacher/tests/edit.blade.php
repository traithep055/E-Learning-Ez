@extends('teacher.layouts.master')

@section('content')
<!--=============================
  DASHBOARD START
==============================-->
<section id="wsus__dashboard">
  <div class="container-fluid">
    @include('teacher.layouts.sidebar')

    <div class="row">
      <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
          <h3><i class="far fa-solid fa-book"></i> แก้ไขแบบทดสอบ</h3>
          <h4>สำหรับคอร์ส: {{ $course->name }}</h4>
          <div class="wsus__dashboard_profile mt-4">
            <div class="wsus__dash_pro_area">
              <form action="{{ route('teacher.tests.update', ['test' => $test->id, 'course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-3">
                  <label for="name" class="form-label">ชื่อแบบทดสอบ</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ $test->name }}" required>
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">คำอธิบาย</label>
                  <textarea name="description" id="description" class="form-control summernote">{{ $test->description }}</textarea>
                </div>

                <h4>คำถาม</h4>
                <div id="questions">
                    @foreach ($test->questions as $index => $question)
                    <div class="question mb-4 border p-3 rounded" data-question-id="{{ $question->id }}">
                        <input type="hidden" name="questions[{{ $index }}][id]" value="{{ $question->id }}">
                        <label for="question_{{ $index }}" class="form-label">คำถาม {{ $index + 1 }}</label>
                        <input type="text" name="questions[{{ $index }}][question]" id="question_{{ $index }}" class="form-control" value="{{ $question->question }}" required>

                        <label for="option_a_{{ $index }}" class="form-label">ตัวเลือก A</label>
                        <input type="text" name="questions[{{ $index }}][option_a]" id="option_a_{{ $index }}" class="form-control" value="{{ $question->option_a }}" required>

                        <label for="option_b_{{ $index }}" class="form-label">ตัวเลือก B</label>
                        <input type="text" name="questions[{{ $index }}][option_b]" id="option_b_{{ $index }}" class="form-control" value="{{ $question->option_b }}" required>

                        <label for="option_c_{{ $index }}" class="form-label">ตัวเลือก C</label>
                        <input type="text" name="questions[{{ $index }}][option_c]" id="option_c_{{ $index }}" class="form-control" value="{{ $question->option_c }}" required>

                        <label for="option_d_{{ $index }}" class="form-label">ตัวเลือก D</label>
                        <input type="text" name="questions[{{ $index }}][option_d]" id="option_d_{{ $index }}" class="form-control" value="{{ $question->option_d }}" required>

                        <label for="correct_option_{{ $index }}" class="form-label">ตัวเลือกที่ถูกต้อง</label>
                        <select name="questions[{{ $index }}][correct_option]" id="correct_option_{{ $index }}" class="form-select" required>
                            <option value="A" {{ $question->correct_option == 'A' ? 'selected' : '' }}>A</option>
                            <option value="B" {{ $question->correct_option == 'B' ? 'selected' : '' }}>B</option>
                            <option value="C" {{ $question->correct_option == 'C' ? 'selected' : '' }}>C</option>
                            <option value="D" {{ $question->correct_option == 'D' ? 'selected' : '' }}>D</option>
                        </select>

                        <button type="button" class="btn btn-danger remove-question mt-3">ลบคำถาม</button>
                    </div>
                    @endforeach
                </div>

                <div class="mb-3">
                  <button type="button" id="addQuestion" class="btn btn-secondary">เพิ่มคำถาม</button>
                </div>

                <div class="mb-3">
                  <button type="submit" class="btn btn-primary">บันทึก</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--=============================
  DASHBOARD END
==============================-->
@endsection

@push('scripts')
<script>
    document.getElementById('addQuestion').addEventListener('click', function() {
        const questionCount = document.querySelectorAll('#questions .question').length;
        const newQuestion = document.createElement('div');
        newQuestion.classList.add('question', 'mb-4', 'border', 'p-3', 'rounded');
        newQuestion.innerHTML = `
            <label for="question_${questionCount}" class="form-label">คำถาม ${questionCount + 1}</label>
            <input type="text" name="questions[${questionCount}][question]" id="question_${questionCount}" class="form-control" required>

            <label for="option_a_${questionCount}" class="form-label">ตัวเลือก A</label>
            <input type="text" name="questions[${questionCount}][option_a]" id="option_a_${questionCount}" class="form-control" required>

            <label for="option_b_${questionCount}" class="form-label">ตัวเลือก B</label>
            <input type="text" name="questions[${questionCount}][option_b]" id="option_b_${questionCount}" class="form-control" required>

            <label for="option_c_${questionCount}" class="form-label">ตัวเลือก C</label>
            <input type="text" name="questions[${questionCount}][option_c]" id="option_c_${questionCount}" class="form-control" required>

            <label for="option_d_${questionCount}" class="form-label">ตัวเลือก D</label>
            <input type="text" name="questions[${questionCount}][option_d]" id="option_d_${questionCount}" class="form-control" required>

            <label for="correct_option_${questionCount}" class="form-label">ตัวเลือกที่ถูกต้อง</label>
            <select name="questions[${questionCount}][correct_option]" id="correct_option_${questionCount}" class="form-select" required>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="C">C</option>
                <option value="D">D</option>
            </select>

            <button type="button" class="btn btn-danger remove-question mt-3">ลบคำถาม</button>
        `;
        document.getElementById('questions').appendChild(newQuestion);
    });

    document.addEventListener('click', function(e) {
        if (e.target && e.target.classList.contains('remove-question')) {
            e.target.closest('.question').remove();
        }
    });
</script>
@endpush
