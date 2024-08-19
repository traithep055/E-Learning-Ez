@extends('frontend.layouts.master')

@section('content')
    <style>
        .table {
            width: 100%;
            margin-bottom: 1rem;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 2px solid #dee2e6;
        }

        /* Header Styles */
        .table thead th {
            background-color: #003f7d;
            /* Darker background for headers */
            color: #ffffff;
            /* White text for headers */
        }

        /* Zebra Stripes */
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(255, 255, 255, 0.05);
            color: black;
            /* Light gray for odd rows */
        }

        /* Table Borders */
        .table-bordered {
            border: 1px solid #dee2e6;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #dee2e6;
        }

        .table-bordered thead th,
        .table-bordered thead td {
            border-bottom-width: 2px;
        }

        /* Button Alignment */
        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .btn-primary {
            background-color: #ffffff;
            color: #003f7d;
            font-size: 18px;
        }

        .btn-primary:hover {
            background-color: #ffffff;
            color: #003f7d;
            text-shadow: 2px 3px 4px rgb(162, 182, 230);
        }
    </style>
    <div class="container mt-8">
        <div class="card-header">
            <h2>รายละเอียดใบเสร็จคำสั่งซื้อ</h2>
        </div>
        <div class="row">
            <div class="col-md-12 mt-6">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>หมายเลขใบเสร็จ</th>
                                <th>ชื่อคอร์ส</th>
                                <th>ราคาปกติ</th>
                                <th>ราคาหลังหักส่วนลด</th>
                                <th>วันที่</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="font-weight: bold;color: #000000">{{ $coursepurchae->order_number }}</td>
                                <td style="font-weight: bold;color: #000000">{{ $coursepurchae->course->name }}</td>
                                <td style="font-weight: bold;color: #000000">{{ $coursepurchae->price }}</td>
                                <td style="font-weight: bold;color: #000000">{{ $coursepurchae->final_price }}</td>
                                <td style="font-weight: bold;color: #000000">
                                    {{ date('d-m-Y', strtotime($coursepurchae->created_at)) }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <a href="{{ route('user.course_bill.downloadPDF', ['order_number' => $coursepurchae->order_number]) }}"
            class="btn btn-primary btn-sm">พิมพ์ใบเสร็จ</a>
    </div>
    <div class="button-group mt-9 mb-9 m-9">
        <a href="{{ route('home') }}" class="btn btn-warning">กลับหน้าหลัก</a>
        <a href="{{ route('user.mycourse') }}" class="btn btn-success">เริ่มเรียน</a>
    </div>
    </div>
@endsection
