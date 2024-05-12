@extends('frontend.layouts.master')

@section('content')


<div class="container" style=" margin-left:5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style=" margin-top:30px; padding: 1%; ">

                    {{--start ตัวกรอง --}}
                    <div class="menu" style=" width:25%; margin-left:40px">
                        <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                            <img src="{{$course->teacher->image}}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                            <a href=""><h5>{{$course->teacher->firstname}} {{$course->teacher->lastname}}</h5></a>
                            
                        </div>
                    
                       
                        <div class="divider" style="width: 90%;"></div>
                        <a href="#" class="btn btn-primary">ชื้อคอร์ส</a>
                    </div>
                    {{--end ตัวกรอง --}}

                    <div class="card-corse col-md-8 justify-content-center"
                        style=" margin-left:55px">
                        <div class="corse-search " style="padding:10px;">
                            <div class="row">
                                <div class="text-search col-md-9 my-3">
                                    <img src="{{$course->image}}" alt="" width="100px">
                                    <h5 class="mt-2">{{$course->name}}</h5>
                                    <h6>จำนวน {{$course->lesson->count()}} บทเรียน ระดับ {{$course->level}} เวลา 10 ชม.</h6>
                                </div>
                                <div class=" col-md-3 my-4 ">
                                    <div style="margin-left: 45%">
                                        <h4>{{$course->price}} บาท</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="course d-flex">
                            <div class="row ">
                                {!! $course->content !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection