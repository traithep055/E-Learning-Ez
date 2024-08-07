@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>ผู้ที่ได้รับใบประกาศณียบัตรทั้งหมด</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ผู้ที่ได้รับใบประกาศณียบัตร</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">อีเมลล์</th>
                                        <th scope="col">จำนวนการทำข้อสอบ (ครั้ง)</th>
                                        <th scope="col">คะแนนสูงสุด</th>
                                        <th scope="col">วันที่ได้รับใบประกาศณียบัตร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student['user']->firstname }} {{ $student['user']->lastname }}</td>
                                            <td>{{ $student['user']->email }}</td>
                                            <td>{{ $student['count'] }}</td>
                                            <td>{{ $student['highest_score'] }}</td>
                                            <td>{{ date('d-m-Y', strtotime($student['certificate_date'])) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $students->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
