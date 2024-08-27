@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>ผู้ที่ได้รับใบประกาศณียบัตรทั้งหมด</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ผู้ที่ได้รับใบประกาศณียบัตร</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.cert-report.pdf')}}" class="btn btn-primary" target="_blank"><i class="fas fa-solid fa-print"></i> พิมพ์รายงาน</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">อีเมลล์</th>
                                        <th scope="col">คอร์ส</th>
                                        <th scope="col">จำนวนการทำข้อสอบ (ครั้ง)</th>
                                        <th scope="col">คะแนนสูงสุด</th>
                                        <th scope="col">วันที่ได้รับใบประกาศณียบัตร</th>
                                        <th scope="col">ดูใบประกาศณียบัตร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student['user']->firstname }} {{ $student['user']->lastname }}</td>
                                            <td>{{ $student['user']->email }}</td>
                                            <td>{{ $student['course'] }}</td> <!-- Display course name -->
                                            <td>{{ $student['count'] }} ครั้ง</td>
                                            <td>{{ $student['highest_score'] }}</td>
                                            <td>{{ date('d-m-Y', strtotime($student['certificate_date'])) }}</td>
                                            <td>
                                                @if(isset($student['user_id']) && isset($student['course_id']))
                                                    <a href="{{ route('admin.certificate.download', ['course_id' => $student['course_id'], 'user_id' => $student['user_id']]) }}" class="btn btn-primary" target="_blank">
                                                        ดูใบประกาศณียบัตร
                                                    </a>
                                                @else
                                                    <span>ไม่สามารถดูใบประกาศณียบัตรได้</span>
                                                @endif
                                            </td>
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
