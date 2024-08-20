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
</section>
@endsection
