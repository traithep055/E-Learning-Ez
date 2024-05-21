@extends('frontend.layouts.master')

@section('content')

<div class="container" style="margin-left: 5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style="margin-top: 30px; padding: 1%;">

                    {{-- Start ตัวกรอง --}}
                        <div class="menu" style="width: 25%; margin-left: 40px">
                            <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                <h4>Teacher</h4>
                            </div>
                            <div class="divider" style="width: 90%;"></div>
                        </div>
                    {{-- End ตัวกรอง --}}

                    <div class="col-md-8" style="margin-left: 55px">
                        <div class="row">
                            @foreach ($teachers as $teacher)
                                <div class="col-md-4 mb-5 d-flex align-items-stretch">
                                    <div class="card card-hover" style="width: 100%;">
                                        @if ($teacher->image == null)
                                            <a href="{{route('teacher-detail', ['id' => $teacher->id])}}">
                                                <img src="{{ $teacher->user->image }}" alt="" class="card-img-top">
                                            </a>
                                        @else
                                            <a href="{{route('teacher-detail', ['id' => $teacher->id])}}">
                                                <img src="{{ $teacher->image }}" alt="" class="card-img-top">
                                            </a>
                                        @endif
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="{{route('teacher-detail', ['id' => $teacher->id])}}">
                                                    {{$teacher->firstname}} {{$teacher->lastname}}
                                                </a>
                                            </h5>
                                            <span>จำนวน {{ $teacher->course ? $teacher->course->count() : 0 }} คอร์ส</span><br>
                                            {{-- <a href="#" class="btn btn-primary">ตะกร้า</a>
                                            <a href="#" class="btn btn-primary">ชื้อคอร์ส</a> --}}
                                            <a href=""><i class="fa fa-brands fa-instagram" style="font-size: 20px; margin-right:8px"></i></a>
                                            <a href=""><i class="fa fa-brands fa-facebook" style="font-size: 18px; margin-right:8px"></i></a>
                                            <a href=""><i class="fa fa-brands fa-youtube" style="font-size: 18px; margin-right:8px"></i></a>
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

@endsection
