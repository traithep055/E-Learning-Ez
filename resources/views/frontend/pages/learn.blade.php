@extends('frontend.layouts.master')

@section('content')
    <div class="container mt-8">
        <div class="row">
            <div class="col-md-12">
                <div class="card-header">
                    {{-- <span>ยินดีต้อนรับเข้าสู่คอร์สเรียน</span> --}}
                    <h3 class="mb-4 ">
                        {{ $course->name }}
                    </h3>
                    <h3 class="mb-4" style="font-size: 20px;font-weight: 100;margin-top: -2%;">
                        <span>สอนโดย อาจารย์ </span>
                        <a href="#">{{ $course->teacher->firstname }}</a>
                    </h3>
                </div>
                <h4 style="font-size: 20px;font-weight: 100;margin-top: 10%;">{{ $lesson->lesson_name }}</h4>
                <div class="descript">
                    <p>{!! $lesson->description !!}</p>
                </div>
                <div class="document">
                    @if ($lesson->file_doc)
                        <p>
                            <i style="color: red; font-size: 20px" class="fas fa-solid fa-file-pdf"></i> <a
                                href="{{ asset($lesson->file_doc) }}" target="_blank">ดาวน์โหลดเอกสาร</a></p>
                    @endif
                    @if ($lesson->video_url)
                        <div class="video" style="margin-top: 2%">
                            <iframe width="100%" height="600" src="{{ $lesson->video_url }}" frameborder="0"
                                allowfullscreen></iframe>
                        </div>
                    @elseif($lesson->video_path)
                        <div class="video">
                            <video width="100%" height="400" controls>
                                <source src="{{ asset($lesson->video_path) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    @endif
                </div>
                <div class="tab " style="margin-top: 5%; margin-bottom: 15%;">
                    <div class="card-body">
                        <div class="lesson">
                            <div class="mt-4 d-flex justify-content-between">
                                @if ($previousLesson)
                                    <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $previousLesson->slug]) }}"
                                        class="btn btn-primary">บทเรียนก่อนหน้า</a>
                                @else
                                    <p>บทเรียนแรกของคอร์สนี้</p>
                                @endif

                                @if ($nextLesson)
                                    <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $nextLesson->slug]) }}"
                                        class="btn btn-primary" >บทเรียนถัดไป</a>
                                @else
                                    <p class="mt-2" style="color: rgb(255, 0, 0)">คุณได้เรียนจบบทเรียนทั้งหมดแล้ว! ทำแบบทดสอบเพื่อรับใบประกาศเลย!</p>
                                    @if ($hasPassedTest)
                                        <a href="{{ route('user.certificate.download', ['course_id' => $course->id]) }}"
                                            target="_blank" class="btn btn-primary">รับใบประกาศณียบัตร</a>
                                    @else
                                        <a href="{{ route('user.tests.take', ['course' => $course->id]) }}"
                                            class="btn btn-primary">ทำแบบทดสอบ</a>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
