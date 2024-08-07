@extends('frontend.dashboard.layouts.master')

@section('content')

<style>
  .card-hover:hover {
    transform: translateY(-10px);
    transition: transform 0.3s;
  }

  .card-title a {
    color: #333;
    text-decoration: none;
  }

  .card-title a:hover {
    color: #007bff;
  }

  .wsus__dashboard_profile .card {
    border: 1px solid #ddd;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }

  .wsus__dashboard_profile .card-body {
    padding: 1rem;
  }

  .card-img-top {
    height: 200px;
    object-fit: cover;
    width: 100%;
  }
</style>

<section id="wsus__dashboard" class="py-5">
  <div class="container-fluid">
    @include('frontend.dashboard.layouts.sidebar')

    <div class="row">
      <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
        <div class="dashboard_content mt-2 mt-md-0">
          <h3 class="mb-4"><i class="fas fa-graduation-cap"></i> การเรียนรู้ของฉัน</h3>
          <div class="wsus__dashboard_profile">
            <div class="wsus__dash_pro_area">
              <div class="course">
                <div class="row">
                  @foreach ($mycourses as $mycourse)
                    <div class="col-md-4 mb-5 d-flex align-items-stretch">
                      <div class="card card-hover h-100" style="width: 100%;">
                        <a href="{{ route('course-detail', ['id' => $mycourse->id]) }}">
                          <img src="{{ $mycourse->image }}" class="card-img-top" alt="{{ $mycourse->name }}">
                        </a>
                        <div class="card-body d-flex flex-column">
                          <h5 class="card-title">
                            <a href="{{ route('course-detail', ['id' => $mycourse->id]) }}">{{ $mycourse->name }}</a>
                          </h5>
                          <p class="card-text">
                            @if ($mycourse->teacher)
                              <span>โดย <a href="{{ route('teacher-detail', ['id' => $mycourse->teacher->id]) }}">{{ $mycourse->teacher->firstname }}</a></span><br>
                            @else
                              <span>โดย <span class="text-muted">ข้อมูลผู้สอนไม่มี</span></span><br>
                            @endif
                            <span><i class="fas fa-users"></i> {{ $mycourse->purchasedCourses->count() }}</span><br>
                            <span><i class="fas fa-clock"></i> เวลา {{ $mycourse->hours }} ชม.</span><br>
                            <span><i class="fas fa-layer-group"></i> ระดับ {{ $mycourse->level }}</span>
                          </p>
                          @if ($mycourse->lessons->isNotEmpty())
                            <a href="{{ route('user.learn_course.lesson', ['course' => $mycourse->id, 'lesson' => $mycourse->lessons->first()->slug]) }}" class="btn btn-primary mt-auto">เรียน</a>
                          @else
                            <span class="text-muted">ไม่มีบทเรียน</span>
                          @endif

                          <!-- ตรวจสอบว่าผู้ใช้ผ่านการทดสอบใด ๆ ของคอร์สนี้หรือไม่ -->
                          @foreach ($passedTests as $test)
                            @if ($test->test && $test->test->course_id == $mycourse->id)
                              @if ($test->test->course)
                                <a href="{{ route('user.certificate.download', ['course_id' => $test->test->course->id]) }}" target="_blank" class="btn btn-success mt-2">รับใบประกาศณียบัตร</a>
                              @else
                                <span class="text-muted">ไม่สามารถรับใบประกาศณียบัตรได้</span>
                              @endif
                              @break
                            @endif
                          @endforeach
                        </div>
                      </div>
                    </div> 
                  @endforeach
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
