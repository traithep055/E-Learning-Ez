@extends('frontend.layouts.master')

@section('content')


<div class="container mb-9" style="display: flex; justify-content: center; " >
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style=" padding: 1%; width:250%;display: flex; display: flex; justify-content: center">

                    {{-- Start ตัวกรอง --}}
                        <div class="teacher">
                            <div class="price mt-3 " style="display: flex; display: flex; justify-content: center">
                                <h4>ครูผู้สอนทั้งหมด</h4>
                            </div>
                        </div>
                    {{-- End ตัวกรอง --}}

                    <div class="col-md-8" style=" margin-top: 20px;">
                        <div class="row" style="display: flex; display: flex; justify-content: center">
                            @foreach ($teachers as $teacher)
                                <div class="col-md-3 mb-9 mt-4 d-flex align-items-stretch"  style="width: 100%;height:100%;">
                                    <div class="card card-hover" >
                                        @if ($teacher->image == null)
                                            <a href="{{route('teacher-detail', ['id' => $teacher->id])}}">
                                                <img src="{{ $teacher->user->image }}" alt="" class="card-img-top">
                                            </a>
                                        @else
                                            <a href="{{route('teacher-detail', ['id' => $teacher->id])}}">
                                                <img src="{{ $teacher->image }}" alt="" class="card-img-top">
                                            </a>
                                        @endif
                                        <div class="card-body" >
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
