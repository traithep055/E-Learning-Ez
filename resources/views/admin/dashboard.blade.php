@extends('admin.layouts.master')

@section('content')

<section class="section">
    <div class="section-header">
      <h1>หน้าหลักแอดมิน</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="far fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4 style="font-size: 17px; font-weight: 100;">จำนวนแอดมิน</h4>
            </div>
            <div class="card-body">
              {{ $adminCount }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class='fas fa-chalkboard-teacher'></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4 style="font-size: 17px;font-weight: 100;">จำนวนผู้สอน</h4>
            </div>
            <div class="card-body">
              {{ $teacherCount }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="fas fa-solid fa-graduation-cap"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4 style="font-size: 17px;font-weight: 100;">จำนวนผู้เรียน</h4>
            </div>
            <div class="card-body">
              {{ $studentCount }}
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-solid fa-book"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4 style="font-size: 17px;font-weight: 100;">จำนวนคอร์ส</h4>
            </div>
            <div class="card-body">
              {{ $courseCount }}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container mt-4">
      <!-- Pie Chart Container -->
      <div id="piechart" style="width: 100%; height: 500px;"></div>
      <!-- Bar Chart Container -->
      <div id="barchart" style="width: 100%; height: 500px;"></div>
  </div>
</section>
@endsection
@push('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
        google.charts.load('current', {'packages':['corechart']});
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
                ['ทั้งหมด', {{ $totalCourses }}]
            ]);

            var barOptions = {
                title: 'จำนวนคอร์สแยกตามหมวดหมู่',
                chartArea: {width: '50%'},
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
