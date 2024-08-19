@extends('teacher.layouts.master')

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
                    <h3><i class="far fa-solid fa-book"></i> ผู้เรียน</h3>
                    <div class="wsus__dashboard_profile p-3 bg-white rounded shadow-sm">
                        <div class="wsus__dash_pro_area">
                            <form method="GET" action="{{ route('teacher.course-students') }}">
                                <div class="form-group mb-3">
                                    <label for="course_id" class="form-label">เลือกคอร์ส</label>
                                    <select name="course_id" id="course_id" class="form-select" onchange="this.form.submit()">
                                        <option value="">-- เลือก --</option>
                                        @foreach($courses as $course)
                                            <option value="{{ $course->id }}" {{ request('course_id') == $course->id ? 'selected' : '' }}>
                                                {{ $course->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>

                            @if($selectedCourse)
                                <h2 class="mt-4 mb-3">ผู้เรียนในคอร์ส {{ $selectedCourse->name }}</h2>
                                <table class="table table-bordered table-hover">
                                    <thead class="table-dark">
                                        <tr>
                                            <th>ชื่อ-นามสกุล</th>
                                            <th>อีเมลล์</th>
                                            <th>วันที่ซื้อคอร์ส</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($students as $purchase)
                                            <tr>
                                                <td>{{ $purchase->user->firstname }} {{ $purchase->user->lastname }}</td>
                                                <td>{{ $purchase->user->email }}</td>
                                                <td>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="mt-4">กรุณาเลือกคอร์สเพื่อดูข้อมูลผู้เรียน</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD END
  ==============================-->
@endsection
