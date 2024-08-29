@extends('frontend.layouts.master')

@section('content')

<div class="container mt-6" style="margin-left:5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column" style="padding: 2%;">
                <div class="row mt-3" style="margin-top:30px; padding: 1%;">

                    {{--start ตัวกรอง --}}
                    <div class="menu" style="width:25%; margin-left:40px">
                        <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                            @if ($teacher->image == null)
                                <a href="{{ $teacher->user->image }}" data-lightbox="teacher-image" data-title="{{$teacher->firstname}} {{$teacher->lastname}}">
                                    <img src="{{ $teacher->user->image }}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                                </a>
                            @else
                                <a href="{{$teacher->image}}" data-lightbox="teacher-image" data-title="{{$teacher->firstname}} {{$teacher->lastname}}">
                                    <img src="{{$teacher->image}}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                                </a>
                            @endif
                            <h5>{{$teacher->firstname}} {{$teacher->lastname}}</h5>
                        </div>

                        <div class="divider" style="width: 90%;"></div>
                        <a href=""><i class="fa fa-brands fa-instagram" style="font-size: 20px; margin-right:8px"></i></a>
                        <a href=""><i class="fa fa-brands fa-facebook" style="font-size: 18px; margin-right:8px"></i></a>
                        <a href=""><i class="fa fa-brands fa-youtube" style="font-size: 18px; margin-right:8px"></i></a>
                    </div>
                    {{--end ตัวกรอง --}}

                    <div class="card-corse col-md-8 justify-content-center" style="margin-left:55px">
                        <div class="corse-search" style="padding:10px;">
                            <div class="row">
                                <div class="text-search col-md-9 my-3">
                                    <h6>จำนวน {{$teacher->course->count()}} บทเรียน </h6>
                                </div>
                            </div>
                        </div>
                        <div class="course d-flex">
                            <div class="row">
                                {!! $teacher->education !!}
                                <h6>คอร์สของ {{$teacher->firstname}} {{$teacher->lastname}}</h6>
                                @foreach ($teacher->course as $course)
                                    <div class="col-md-4 mb-5 d-flex align-items-stretch">
                                        <div class="card card-hover" style="width: 80%;">
                                            <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                                <img src="{{ $course->image }}" class="card-img-top w-100" alt="...">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('course-detail', ['id' => $course->id]) }}">{{ $course->name }}</a>
                                                </h5>
                                                <span><a href="#">{{ $course->teacher->firstname }}</a></span>
                                                <span>เรียน {{$course->purchasedCourses->count()}} คน</span><br>
                                                <span>เวลา {{$course->hours}} ชม.</span>
                                                <span>ระดับ {{ $course->level }} </span><br>
                                                <span><b>ราคา {{ $course->price }} บาท</b></span><br>
                                                @if ($user && $course->purchasedCourses->contains('id', $user->id))
                                                <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $course->lessons->first()->slug]) }}" class="btn btn-primary">เรียน</a>
                                                @else
                                                    <a href="{{ route('user.course_purchase', ['course' => $course->id]) }}" class="btn btn-primary mt-5" style="font-size: 15px; font-weight: 100">ซื้อคอร์ส</a>
                                                @endif
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

@endsection
