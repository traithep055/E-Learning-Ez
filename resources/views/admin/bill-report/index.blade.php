@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>รายงานการซื้อคอร์สทั้งหมด</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>รายการซื้อคอร์ส</h4>
                            <div class="card-header-action">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#printReportModal">
                                    <i class="fas fa-solid fa-print"></i> พิมพ์รายงาน
                                </button>
                            </div>

                            <form action="{{ route('admin.bill-report') }}" method="GET" class="form-inline">
                                <div class="form-group">
                                    <label for="start_month">เดือนเริ่มต้น:</label>
                                    <select name="start_month" id="start_month" class="form-control">
                                        <option value="">--เลือกเดือนเริ่มต้น--</option>
                                        @foreach ($thaiMonths as $key => $month)
                                            <option value="{{ $key }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div class="form-group">
                                    <label for="end_month">เดือนสิ้นสุด:</label>
                                    <select name="end_month" id="end_month" class="form-control">
                                        <option value="">--เลือกเดือนสิ้นสุด--</option>
                                        @foreach ($thaiMonths as $key => $month)
                                            <option value="{{ $key }}">{{ $month }}</option>
                                        @endforeach
                                    </select>
                                </div>
                        
                                <div class="form-group">
                                    <label for="year">ปี:</label>
                                    <select name="year" id="year" class="form-control">
                                        <option value="">--เลือกปี--</option>
                                        @for ($i = date('Y'); $i >= 2000; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                        
                                <button type="submit" class="btn btn-primary">กรองรายงาน</button>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">หมายเลขใบเสร็จ</th>
                                        <th scope="col">ชื่อคอร์ส</th>
                                        <th scope="col">ราคาคอร์ส</th>
                                        <th scope="col">ส่วนลด</th>
                                        <th scope="col">ราคาหลังหักส่วนลด</th>
                                        <th scope="col">ยืนยันการโอน</th>
                                        <th scope="col">วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill)
                                        <tr>
                                            <td>{{ $bill->order_number }}</td>
                                            <td>{{ $bill->course->name }}</td>
                                            <td>{{ $bill->price }} บาท</td>
                                            <td>{{ $bill->price - $bill->final_price }} บาท</td>
                                            <td>{{ $bill->final_price }} บาท</td>
                                            <td>
                                                <a href="{{ $bill->slip_image }}" data-lightbox="slip-image" data-title="{{ $bill->course->name }}">
                                                    <img src="{{ $bill->slip_image }}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                                                </a>
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($bill->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$bills->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Modal สำหรับการเลือกช่วงเดือนและปี -->
    <div class="modal fade" id="printReportModal" tabindex="-1" role="dialog" aria-labelledby="printReportModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('admin.bill-report.pdf') }}" method="GET" target="_blank">
                    <div class="modal-header">
                        <h5 class="modal-title" id="printReportModalLabel">เลือกช่วงเดือน และ ปี สำหรับพิมพ์รายงาน</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="start_month">เดือนเริ่มต้น:</label>
                            <select name="start_month" id="start_month" class="form-control">
                                <option value="">--เลือกเดือนเริ่มต้น--</option>
                                @foreach ($thaiMonths as $key => $month)
                                    <option value="{{ $key }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="end_month">เดือนสิ้นสุด:</label>
                            <select name="end_month" id="end_month" class="form-control">
                                <option value="">--เลือกเดือนสิ้นสุด--</option>
                                @foreach ($thaiMonths as $key => $month)
                                    <option value="{{ $key }}">{{ $month }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="year">ปี:</label>
                            <select name="year" id="year" class="form-control">
                                <option value="">--เลือกปี--</option>
                                @for ($i = date('Y'); $i >= 2000; $i--)
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                        <button type="submit" class="btn btn-primary">พิมพ์รายงาน</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
