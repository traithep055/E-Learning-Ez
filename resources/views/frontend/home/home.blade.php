@extends('frontend.layouts.master')

@section('content')
<div class="container" style=" margin-left:0%, width:90vh">
    <div class="row">
        <div class="col mt-3">
            <div class="card-search" style="margin-top:25px; margin-left:34%">
                <form action="{{route('courses.index')}}" class="search-body" method="GET"
                    id="search-form">
                    <div class="input-group">
                        <input type="text" class="form-control" name="searchcard" id="search-body"
                            placeholder="ค้นหาคอร์สเรียน">
                        <button type="submit" class="btn-search">
                            <i class='bx bx-search'
                                style="color: rgb(0, 0, 0); font-size: 25px; position: absolute; top: 60%; transform: translateY(-50%);">
                            </i>
                        </button>
                    </div>
                </form>
            </div>
            {{-- End search --}}
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style=" margin-top:20px; padding: 1%; ">

                    {{--start ตัวกรอง --}}
                        @include('frontend.home.sidebar')
                    {{--end ตัวกรอง --}}

                    <div class="card-corse col-md-9 justify-content-center"
                        style=" margin-left:15px">
                        <div class="corse-search " style="padding:10px;">
                            <div class="row">
                                <div class="text-search col-md-8 my-3" style="margin-left: 6%">
                                    <h4>คอร์สเรียนทั้งหมด</h4>
                                    <h6>ผลลัพธ์ที่ค้นพบ</h6>
                                </div>
                                <div class="drop-search col-md-2 my-3 "  style="margin-left: 10%">
                                    <div class="dropdown">
                                        <button class="btn dropdown-toggle btn-outline-dark" type="button" id="dropdownMenuButton1" aria-expanded="false">
                                            ทั้งหมด
                                        </button>
                                        <ul class="dropdown-menu" style="margin-left: 10%" aria-labelledby="dropdownMenuButton1">
                                            <li><a class="dropdown-item" href="#">ล่าสุด</a></li>
                                            <li><a class="dropdown-item" href="#">เก่าสุด</a></li>
                                            <li><a class="dropdown-item" href="#">ทั้งหมด</a></li>
                                        </ul>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="course">
                            <div class="row ">
                                @foreach ($courses as $course)
                                    <div class="card-all col-md-2" style="width: 250px;">
                                        <!-- คอลัมน์ที่ 1 -->
                                        <div class="card mt-3 mb-2" style="width: 100%;,height:10px">
                                            <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                                <img src="{{$course->image}}" class="card-img-top"
                                                alt="...">
                                            </a>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a href="{{ route('course-detail', ['id' => $course->id]) }}">{{$course->name}}</a>
                                                </h5>
                                                <span><a href="{{route('teacher-detail', ['id' => $course->teacher->id])}}">{{$course->teacher->firstname}}</a></span>
                                                <span>เรียน {{$course->purchasedCourses->count()}} คน</span><br>
                                                <span>เวลา 10 ชม.</span>
                                                <span>ระดับ {{$course->level}} </span><br>
                                                <span><b>ราคา {{$course->price}} บาท</b></span><br>
                                                <a href="{{route('user.course_purchase', ['course' => $course->id])}}" class="btn btn-primary mt-3">ชื้อคอร์ส</a>
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
