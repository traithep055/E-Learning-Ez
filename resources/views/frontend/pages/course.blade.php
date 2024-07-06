@extends('frontend.layouts.master')

@section('content')

<div class="container mt-8" style="margin-left: 5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style="margin-top: 30px; padding: 1%;">

                    {{-- Start ตัวกรอง --}}
                    @if ($courses->isNotEmpty())
                        <div class="menu" style="width: 25%; margin-left: 40px">
                            <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                <h4>{{ $courses->first()->category->name }}</h4>
                            </div>
                            <div class="divider" style="width: 90%;"></div>
                            @if(request()->has('subcategory') && $courses->first()->subcategory)
                                <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                    <h5>{{ $courses->first()->subcategory->name }}</h5>
                                </div>
                            @endif
                        </div>
                    @endif
                    {{-- End ตัวกรอง --}}
                    <div class="col-md-8" style="margin-left: 55px">
                        <div class="row">
                            @forelse ($courses as $course)
                                <div class="col-md-4 mb-5 d-flex align-items-stretch">
                                    <div class="card card-hover">
                                        <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                            <img src="{{ $course->image }}" class="card-img-top" alt="...">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{ route('course-detail', ['id' => $course->id]) }}">{{ $course->name }}</a>
                                            </h5>
                                            <span><a href="#">{{ $course->teacher->firstname }}</a></span>
                                            <span>เรียน {{$course->purchasedCourses->count()}} คน</span><br>
                                            <span>เวลา 10 ชม.</span>
                                            <span>ระดับ {{ $course->level }} </span><br>
                                            <span><b>ราคา {{ $course->price }} บาท</b></span><br>
                                            @auth
                                                @if($user->purchasedCourses->contains($course->id))
                                                    <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $course->lessons->first()->slug]) }}" class="btn btn-primary">เริ่มเรียน</a>
                                                @else
                                                    <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary">ชื้อคอร์ส</a>
                                                @endif
                                            @else
                                                <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary">ชื้อคอร์ส</a>
                                            @endauth
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>No courses found.</p>
                            @endforelse
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
