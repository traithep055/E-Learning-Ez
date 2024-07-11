@extends('teacher.layouts.master')

{{-- @section('title')
{{$settings->site_name}} || Product
@endsection --}}

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('teacher.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-solid fa-book"></i> แบบทดสอบ</h3>
            <p>ชื่อคอร์ส: {{$course->name}}</p>
            <div class="create_button">
                <a href="{{ route('teacher.tests.create', ['course' => $course->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> สร้างแบบทดสอบ</a>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{ $dataTable->table() }}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

@endpush
