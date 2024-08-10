<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@extends('frontend.layouts.master')
@section('content')
    <div class="container" style=" margin-left:0%, width:90vh">
        <div class="row">

            <div class="col mt-3">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <video width="640" height="360" controls autoplay loop muted>
                            <source src="{{ asset('images/EZ Academy.mp4') }}" type="video/mp4">
                        </video>
                    </div>
                </div>
                {{-- End search --}}
                <div class="content d-flex flex-column " style="padding: 2%;">
                    <div class="row mt-3" style=" margin-top:20px; padding: 1%; ">

                        {{-- start ตัวกรอง --}}
                        @include('frontend.home.sidebar')
                        {{-- end ตัวกรอง --}}

                        <div class="card-corse col-md-9 justify-content-center" style=" margin-left:15px">
                            <div class="corse-search " style="padding:10px;">
                                <div class="row">
                                    {{-- <div class="text-search col-md-8 my-3" style="margin-left: 6%">
                                        <h4>คอร์สเรียนทั้งหมด</h4>
                                        <h6>ผลลัพธ์ที่ค้นพบ</h6>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="course">
                                <div class="row ">
                                    @foreach ($courses as $course)
                                        <div class="card-all col-md-2" style="width: 250px;">
                                            <!-- คอลัมน์ที่ 1 -->
                                            <div class="card mt-3 mb-2" style="width: 100%;,height:10px">
                                                <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                                    <img src="{{ $course->image }}" class="card-img-top" alt="...">
                                                </a>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a
                                                            href="{{ route('course-detail', ['id' => $course->id]) }}">{{ $course->name }}</a>
                                                    </h5>
                                                    <span><a href="{{ route('teacher-detail', ['id' => $course->teacher->id]) }}"
                                                            class="teacher">{{ $course->teacher->firstname }}</a></span>
                                                    <span>เรียน {{ $course->purchasedCourses->count() }} คน</span><br>
                                                    <span>เวลา {{ $course->hours }} ชม.</span>
                                                    <span>ระดับ {{ $course->level }} </span><br>
                                                    <span><b>ราคา {{ $course->price }} บาท</b></span><br>
                                                    <a href="{{ route('user.course_purchase', ['course' => $course->id]) }}"
                                                        class="btn mt-3">ซื้อคอร์ส</a>
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

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var dropdownMenu = document.querySelector('.dropdown-menu');
            var dropdownToggle = document.querySelector('.dropdown-toggle');

            dropdownToggle.addEventListener('click', function() {
                dropdownMenu.classList.toggle('show');
            });

            document.addEventListener('click', function(e) {
                if (!dropdownToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        });
    </script>
@endpush
