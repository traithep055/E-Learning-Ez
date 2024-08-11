    <link rel="stylesheet" href="{{ asset('frontend/css/packet.css') }}">

    @extends('frontend.layouts.master')

    @section('content')
        <div class="container mt-8" style="margin-left: 5%, bachground-color: #55f5f5">
            {{-- Start ตัวกรอง --}}
            <div class="menu" style="width: 25%; margin-left: 40px">
                <div class="price mt-3 mb-3" style="display: flex; align-items: center;">
                    <h4>แพ็คเกจทั้งหมด</h4>
                </div>
                <di-v class="divider" style="width: 90%;"></di-v>
            </div>
            {{-- End ตัวกรอง --}}
            <div class="col-md-8" style="margin-left: 55px">
                <div class="row">
                    @forelse ($packages as $package)
                        <div class="col-md-4 mb-5 d-flex align-items-stretch">
                            <div class="card-package">
                                {{-- <a href="{{ route('course-detail', ['id' => $course->id]) }}">
                                            <img src="{{ $course->image }}" class="card-img-top" alt="...">
                                        </a> --}}
                                <div class="card-body-package">
                                    <h5 class="title-package">
                                        <p href="">{{ $package->name }}</p>
                                    </h5>
                                    <h5 class="percent">
                                        <p> 50 %</p>
                                        <span>/ คอร์ส </span>
                                    </h5>
                                    <span>
                                        <p>{{ $package->description }}</p>
                                    </span>
                                    <div class="line"></div>
                                    <p class="card-text-package">
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
                                    <p class="card-text-package" style="color: #ffffff; font-size: 18px;"><strong>ราคา:
                                            {{ $package->price }} บาท</strong></p>
                                    <a href="{{ route('user.package_purchase', ['package' => $package->id]) }}"
                                        class="btn-package">ชื้อแพ็คเกจ</a>
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
        @endsection
