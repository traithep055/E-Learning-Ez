@extends('frontend.layouts.master')

@section('content')

<div class="container mt-5">
    <div class="col">
        <div class="content d-flex flex-column">
            <div class="mt-4">

                {{-- Start ตัวกรอง --}}
                @if ($courses->isNotEmpty())
                    <div class="menu mb-4" style="width: 30%; margin-left: 40px">
                        <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                            <h4>{{ $courses->first()->category->name }}</h4>
                        </div>
                        <div class="divider" style="width: 100%;"></div>
                        @if(request()->has('subcategory') && $courses->first()->subcategory)
                            <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                <h5>{{ $courses->first()->subcategory->name }}</h5>
                            </div>
                        @endif
                    </div>
                @endif
                {{-- End ตัวกรอง --}}

                {{-- Start Card Grid --}}
                <div class="card-corse">
                    <div class="row">
                        @forelse ($courses as $course)
                            <div class="col-lg-4 col-md-4 mb-4 d-flex align-items-stretch"> <!-- เพิ่มขนาดการ์ดเป็น col-lg-4 -->
                                <div class="card card-hover h-100 shadow-lg" style="border-radius: 15px; overflow: hidden; width: 100%; height: 500px;"> <!-- ปรับความสูงให้สูงขึ้น -->
                                    <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                        <img src="{{ $course->image }}" class="card-img-top" alt="Course Image" style="object-fit: cover; height: 250px;"> <!-- ปรับความสูงของรูปภาพ -->
                                    </a>
                                    <div class="card-body d-flex flex-column" style="padding: 1.5rem;">
                                        <h5 class="card-title" style="font-weight: bold; font-size: 1.3rem;"> <!-- เพิ่มขนาดตัวอักษร -->
                                            <a href="{{ route('course-detail', ['id' => $course->id]) }}" style="text-decoration: none; color: #333;">{{ $course->name }}</a>
                                        </h5>
                                        <p class="card-text flex-grow-1" style="margin-bottom: 1.5rem;"> <!-- ปรับช่องว่างด้านล่าง -->
                                            <span><a href="#" style="color: #007bff; text-decoration: none;">{{ $course->teacher->firstname }}</a></span>
                                            <span>เรียน {{$course->purchasedCourses->count()}} คน</span><br>
                                            <span>เวลา {{$course->hours}} ชม.</span>
                                            <span>คะแนน {{ $course->reviewSummary ? $course->reviewSummary->average_rating : '-' }}</span><br>
                                            <span>ระดับ {{ $course->level }}</span><br>
                                            <span><b>ราคา {{ number_format($course->price, 2) }} บาท</b></span>
                                        </p>
                                        @auth
                                            @if($user->purchasedCourses->contains($course->id))
                                                <a href="{{ route('user.learn_course.lesson', ['course' => $course->id, 'lesson' => $course->lessons->first()->slug]) }}" class="btn btn-success mt-auto" style="border-radius: 30px; padding: 10px 20px;">เริ่มเรียน</a> <!-- ขยายปุ่ม -->
                                            @else
                                                <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary mt-auto" style="border-radius: 30px; padding: 10px 20px;">ซื้อคอร์ส</a> <!-- ขยายปุ่ม -->
                                            @endif
                                        @else
                                            <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary mt-auto" style="border-radius: 30px; padding: 10px 20px;">ซื้อคอร์ส</a> <!-- ขยายปุ่ม -->
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p class="text-center">ไม่พบคอร์สเรียน</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                {{-- End Card Grid --}}

            </div>
        </div>
    </div>
</div>

@endsection
