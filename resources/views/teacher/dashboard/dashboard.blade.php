@extends('teacher.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
     @include('teacher.layouts.sidebar')
      <div class="row" style="margin-left: 15%">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('teacher.courses.index')}}">
                    <i class="far fa-address-book"></i>
                    <p>คอร์สของฉัน</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="{{ route('teacher.course-students') }}">
                    <i class="fas fa-solid fa-user"></i>
                    <p>ข้อมูลผู้เรียน</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="{{route('teacher.course-payment')}}">
                    <i class="fas fa-solid fa-receipt"></i>
                    <p>ข้อมูลชำระเงิน</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="{{route('teacher.course-certificate')}}">
                    <i class="fas fa-solid fa-passport"></i>
                    <p>ประกาศนียบัตร</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('teacher.profile')}}">
                    <i class="fas fa-user-shield"></i>
                    <p>โปรไฟล์</p>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
