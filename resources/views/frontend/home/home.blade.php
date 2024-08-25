<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
@extends('frontend.layouts.master')
@section('content')
    <div class="container" style=" margin-left:0%, width:90vh">
        <div class="row">
            <div class="col mt-3">
                <div id="carouselExampleFade" class="carousel slide carousel-fade" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <video width="1301" height="360" controls autoplay loop muted>
                            <source src="{{ asset('images/EZ Academy.mp4') }}" type="video/mp4">
                        </video>
                        {{-- <div class="container mt-4">
                            <!-- Pie Chart Container -->
                            <div id="piechart" style="width: 80%; height: 100px;"></div>
                            <!-- Bar Chart Container -->
                            <div id="barchart" style="width: 80%; height: 100px;"></div>
                        </div> --}}
                    </div>
                    {{-- <div class="carousel-inner">
                        <button><a href="{{ route('user.show_package') }}">ดูรายละเอียด</a></button>
                        <img src="{{ asset('images/Paket 1.jpg') }} " width="640" height="360">
                    </div> --}}
                </div>
                {{-- End search --}}
            </div>
        </div>
    </div>
    <div class="content d-flex mt-8" style="padding: 1%;">
        {{-- <div class="slide-nav"> --}}
            {{-- start ตัวกรอง --}}
            {{-- @include('frontend.home.sidebar') --}}
            {{-- end ตัวกรอง --}}
        {{-- </div> --}}
        <div class="card-corse col-md-12">
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
                                    <span>เรทติ้ง
                                        {{ $course->reviewSummary ? $course->reviewSummary->average_rating : '-' }}</span><br>
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
@endsection

@push('scripts')
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

        google.charts.load('current', {
            'packages': ['corechart']
        });
        google.charts.setOnLoadCallback(drawCharts);

        function drawCharts() {
            var pieData = google.visualization.arrayToDataTable([
                ['Role', 'จำนวนผู้ใช้ทั้งหมด'],
                ['ผู้เรียน', {{ $rolesCount['user'] ?? 0 }}],
                ['ผู้สอน', {{ $rolesCount['teacher'] ?? 0 }}],
                ['แอดมิน', {{ $rolesCount['admin'] ?? 0 }}]
            ]);

            var pieOptions = {
                title: 'จำนวนผู้ใช้ทั้งหมด',
                pieHole: 0.4,
            };

            var pieChart = new google.visualization.PieChart(document.getElementById('piechart'));
            pieChart.draw(pieData, pieOptions);

            var barData = google.visualization.arrayToDataTable([
                ['Category', 'จำนวนคอร์ส'],
                @foreach ($categories as $category)
                    ['{{ $category->name }}', {{ $category->courses_count }}],
                @endforeach
            ]);

            var barOptions = {
                title: 'จำนวนคอร์สแยกตามหมวกหมู่',
                chartArea: {
                    width: '50%'
                },
                hAxis: {
                    title: 'จำนวนคอร์ส',
                    minValue: 0
                },
                vAxis: {
                    title: 'หมวดหมู่'
                }
            };

            var barChart = new google.visualization.BarChart(document.getElementById('barchart'));
            barChart.draw(barData, barOptions);
        }
    </script>
@endpush
