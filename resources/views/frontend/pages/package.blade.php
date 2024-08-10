@extends('frontend.layouts.master')

@section('content')

<div class="container mt-8" style="margin-left: 5%">
    <div class="row">
        <div class="col mt-3">
            <div class="content d-flex flex-column " style="padding: 2%;">
                <div class="row mt-3" style="margin-top: 30px; padding: 1%;">

                    {{-- Start ตัวกรอง --}}
                        <div class="menu" style="width: 25%; margin-left: 40px">
                            <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                                <h4>แพ็คเกจทั้งหมด</h4>
                            </div>
                            <div class="divider" style="width: 90%;"></div>
                        </div>
                    {{-- End ตัวกรอง --}}
                    <div class="col-md-8" style="margin-left: 55px">
                        <div class="row">
                            @forelse ($packages as $package)
                                <div class="col-md-4 mb-5 d-flex align-items-stretch">
                                    <div class="card card-hover">
                                        {{-- <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                            <img src="{{ $course->image }}" class="card-img-top" alt="...">
                                        </a> --}}
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="">{{ $package->name }}</a>
                                            </h5>
                                            <span><a href="#">{{ $package->description }}</a></span>
                                            <p class="card-text">
                                                <strong>ระยะเวลา:</strong>
                                                @switch($package->duration)
                                                    @case('1_year')
                                                        1 ปี
                                                        @break
                                                    @case('2_years')
                                                        2 ปี
                                                        @break
                                                    @case('3_years')
                                                        3 ปี
                                                        @break
                                                    @default
                                                        ไม่ระบุ
                                                @endswitch
                                            </p>
                                            <p class="card-text" style="color: #FF6347; font-size: 18px;"><strong>ราคา: {{ $package->price }} บาท</strong></p>
                                            <a href="{{ route('user.package_purchase', ['package' => $package->id]) }}" class="btn btn-primary">ชื้อแพ็คเกจ</a>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                    <div class="col-12">
                                        <p>ไม่มีแพ็คเกจที่พร้อมให้บริการในขณะนี้</p>
                                    </div>
                                @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
