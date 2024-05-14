@extends('frontend.layouts.master')

@section('content')

<div class="container" style="margin-left: 5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style="margin-top: 30px; padding: 1%; ">

                    {{-- Start ตัวกรอง --}}
                    <div class="menu" style="width: 25%; margin-left: 40px">
                        <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                            <h4>{{ $courses->first()->category->name }}</h4>
                        </div>
                        <div class="divider" style="width: 90%;"></div>
                        @if(request()->has('subcategory') && $courses->isNotEmpty() && $courses->first()->subcategory)
                            <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                <h5>{{ $courses->first()->subcategory->name }}</h5>
                            </div>
                        @endif
                    </div>
                    {{-- End ตัวกรอง --}}



                    <div class="card-corse col-md-8 justify-content-center" style="margin-left: 55px">
                        <div class="course d-flex">
                            <div class="row ">
                                <div class="container mb-5">
                                    <div class="row">
                                        @foreach ($courses as $course)
                                            <div class="col-md-4 mb-5 justify-content-center">
                                                <div class="card card-hover" style="width: 16rem;">
                                                    <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                                        <img src="{{ $course->image }}" class="card-img-top" alt="...">
                                                    </a>
                                                    <div class="card-body">
                                                        <h5 class="card-title">
                                                            <a href="{{ route('course-detail', ['id' => $course->id]) }}">{{ $course->name }}</a>
                                                        </h5>
                                                        <span><a href="#">{{ $course->teacher->firstname }}</a></span>
                                                        <span>เรียน 10 คน</span><br>
                                                        <span>เวลา 10 ชม.</span>
                                                        <span>ระดับ {{ $course->level }} </span><br>
                                                        <span><b>ราคา {{ $course->price }} บาท</b></span><br>
                                                        <a href="#" class="btn btn-primary">ตะกร้า</a>
                                                        <a href="#" class="btn btn-primary">ชื้อคอร์ส</a>
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
    </div>
</div>

@endsection