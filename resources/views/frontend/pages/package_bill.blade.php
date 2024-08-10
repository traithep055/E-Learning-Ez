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
            background-color: #343a40;
            /* Darker background for headers */
            color: #ffffff;
            /* White text for headers */
        }

        /* Zebra Stripes */
        .table tbody tr:nth-of-type(odd) {
            background-color: rgba(0, 0, 0, 0.05);
            /* Light gray for odd rows */
        }

        /* Hover Effects */
        .table tbody tr:hover {
            background-color: rgba(0, 0, 0, 0.075);
            /* Slightly darker gray on hover */
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
</style>
<div class="container mt-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>การสั่งซื้อแพ็คเกจ</h2>
                </div>
                <div class="card-body">
                    <a href="{{ route('user.package_bill.downloadPDF', ['order_number' => $billpackage->order_number]) }}" class="btn btn-primary btn-sm">พิมพ์ใบเสร็จ</a>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>หมายเลขใบเสร็จ</th>
                                    <th>ชื่อแพ็คเกจ</th>
                                    <th>ราคา</th>
                                    <th>วันที่</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-weight: bold">{{ $billpackage->order_number }}</td>
                                    <td style="font-weight: bold">{{ $billpackage->package->name }}</td>
                                    <td style="font-weight: bold">{{ $billpackage->total }} บาท</td>
                                    <td style="font-weight: bold">{{ date('d-m-Y', strtotime($billpackage->created_at)) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="button-group">
        <a href="{{ route('home') }}" class="btn btn-warning">กลับหน้าหลัก</a>
        {{-- <a href="{{route('user.mycourse')}}" class="btn btn-success">เริ่มเรียน</a> --}}
    </div>
</div>
@endsection
