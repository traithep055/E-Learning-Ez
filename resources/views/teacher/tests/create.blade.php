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
          <h3><i class="far fa-solid fa-book"></i> สร้างแบบทดสอบ</h3>
          <h4>สำหรับคอร์ส: {{ $course->name }}</h4>
          <div class="wsus__dashboard_profile mt-4">
            <div class="wsus__dash_pro_area">
              <form action="{{route('teacher.tests.store', ['course' => $course->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                  <label for="name" class="form-label">ชื่อแบบทดสอบ</label>
                  <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                  <label for="description" class="form-label">คำอธิบาย</label>
                  <textarea name="description" id="description" class="form-control summernote">{{ old('description') }}</textarea>
                </div>

                <h4>คำถาม</h4>
                <div id="questions">
                  <div class="question mb-4 border p-3 rounded">
                    <label for="question_0" class="form-label">คำถาม 1</label>
                    <input type="text" name="questions[0][question]" id="question_0" class="form-control" required>

                    <div class="mt-3">
                      <label for="option_a_0" class="form-label">ตัวเลือก A</label>
                      <input type="text" name="questions[0][option_a]" id="option_a_0" class="form-control" required>
                    </div>

                    <div class="mt-3">
                      <label for="option_b_0" class="form-label">ตัวเลือก B</label>
                      <input type="text" name="questions[0][option_b]" id="option_b_0" class="form-control" required>
                    </div>

                    <div class="mt-3">
                      <label for="option_c_0" class="form-label">ตัวเลือก C</label>
                      <input type="text" name="questions[0][option_c]" id="option_c_0" class="form-control" required>
                    </div>

                    <div class="mt-3">
                      <label for="option_d_0" class="form-label">ตัวเลือก D</label>
                      <input type="text" name="questions[0][option_d]" id="option_d_0" class="form-control" required>
                    </div>

                    <div class="mt-3">
                      <label for="correct_option_0" class="form-label">ตัวเลือกที่ถูกต้อง</label>
                      <select name="questions[0][correct_option]" id="correct_option_0" class="form-select" required>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="C">C</option>
                        <option value="D">D</option>
                      </select>
                    </div>
                  </div>
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

      <div class="mt-3">
        <label for="option_a_${questionCount}" class="form-label">ตัวเลือก A</label>
        <input type="text" name="questions[${questionCount}][option_a]" id="option_a_${questionCount}" class="form-control" required>
      </div>

      <div class="mt-3">
        <label for="option_b_${questionCount}" class="form-label">ตัวเลือก B</label>
        <input type="text" name="questions[${questionCount}][option_b]" id="option_b_${questionCount}" class="form-control" required>
      </div>

      <div class="mt-3">
        <label for="option_c_${questionCount}" class="form-label">ตัวเลือก C</label>
        <input type="text" name="questions[${questionCount}][option_c]" id="option_c_${questionCount}" class="form-control" required>
      </div>

      <div class="mt-3">
        <label for="option_d_${questionCount}" class="form-label">ตัวเลือก D</label>
        <input type="text" name="questions[${questionCount}][option_d]" id="option_d_${questionCount}" class="form-control" required>
      </div>

      <div class="mt-3">
        <label for="correct_option_${questionCount}" class="form-label">ตัวเลือกที่ถูกต้อง</label>
        <select name="questions[${questionCount}][correct_option]" id="correct_option_${questionCount}" class="form-select" required>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
        </select>
      </div>
    `;
    document.getElementById('questions').appendChild(newQuestion);
  });
</script>
@endpush
