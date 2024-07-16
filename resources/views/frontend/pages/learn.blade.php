@extends('frontend.layouts.master')

@section('content')
<div class="container mt-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-4"><i class="fas fa-graduation-cap"></i> เรียน {{ $course->name }}</h3>
                </div>
                <div class="card-body">
                    <div class="lesson">
                        <h4>{{ $lesson->lesson_name }}</h4>
                        <p>{!! $lesson->description !!}</p>
                        @if($lesson->file_doc)
                          <p><i style="color: red; font-size: 20px" class="fas fa-solid fa-file-pdf"></i> <a href="{{ asset($lesson->file_doc) }}" target="_blank">ดาวน์โหลดเอกสาร</a></p>
                        @endif
                        @if($lesson->video_url)
                          <div class="video">
                            <iframe width="100%" height="400" src="{{ $lesson->video_url }}" frameborder="0" allowfullscreen></iframe>
                          </div>
                        @elseif($lesson->video_path)
                          <div class="video">
                            <video width="100%" height="400" controls>
                              <source src="{{ asset($lesson->video_path) }}" type="video/mp4">
                              Your browser does not support the video tag.
                            </video>
                          </div>
                        @endif
                          
                        <div class="mt-4 d-flex justify-content-between">
                            @if ($previousLesson)
                                <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $previousLesson->slug]) }}" class="btn btn-primary">บทเรียนก่อนหน้า</a>
                            @else
                                <p>นี่คือบทเรียนแรกของคอร์สนี้</p>
                            @endif

                            @if ($nextLesson)
                                <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $nextLesson->slug]) }}" class="btn btn-primary">บทเรียนถัดไป</a>
                            @else
                                <p class="mt-2">คุณได้เรียนจบบทเรียนทั้งหมดแล้ว!</p>
                                <a href="{{ route('user.tests.take', ['course' => $course->id]) }}" class="btn btn-primary">ทำแบบทดสอบ</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
