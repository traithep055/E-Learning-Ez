<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ใบเสร็จ</title>
    <style>
         @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: normal;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew Bold.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: normal;
            src: url("{{ public_path('fonts/THSarabunNew Italic.ttf') }}") format('truetype');
        }
        @font-face {
            font-family: 'THSarabunNew';
            font-style: italic;
            font-weight: bold;
            src: url("{{ public_path('fonts/THSarabunNew BoldItalic.ttf') }}") format('truetype');
        }
        body {
            font-family: "THSarabunNew";
        }
        .container {
            margin-top: 50px;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 20px;
        }
        .card-header {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }
        .table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        .table, .table th, .table td {
            border: 1px solid #ccc;
        }
        .table th, .table td {
            padding: 10px;
            text-align: left;
        }
        .card-footer {
            text-align: right;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    {{-- <div class="container">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" width="200px" style="margin-top: 0">
        <div class="card">
            <div class="card-header">
                ใบเสร็จการสั่งซื้อคอร์สเรียน
            </div>
            <h4>Ez Academy</h4>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>number</th>
                            <td>{{ $purchase->order_number }}</td>
                        </tr>
                        <tr>
                            <th>date</th>
                            <td>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>รหัสผู้ใช้</th>
                            <td>{{ $purchase->user_id }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อผู้ใช้</th>
                            <td>{{ $purchase->user->firstname }} {{ $purchase->user->lastname }}</td>
                        </tr>
                        <tr>
                            <th>รหัสคอร์ส</th>
                            <td>{{ $purchase->course_id }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อคอร์ส</th>
                            <td>{{ $purchase->course->name }}</td>
                        </tr>
                        <tr>
                            <th>ราคาปกติ</th>
                            <td>{{ $purchase->price }} บาท</td>
                        </tr>
                        @if ($purchase->coupon_id)
                            <tr>
                                <th>ส่วนลด</th>
                                <td>{{ $purchase->price - $purchase->final_price }} บาท</td>
                            </tr>
                        @endif
                        <tr>
                            <th>ราคาหลังหักส่วนลด</th>
                            <td>{{ $purchase->final_price }} บาท</td>
                        </tr>
                        @if($purchase->coupon_id)
                        <tr>
                            <th>รหัสคูปอง</th>
                            <td>{{ $purchase->coupon_id }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                อัปเดตเมื่อ: {{ date('d-m-Y', strtotime($purchase->updated_at)) }}
            </div>
        </div>
    </div> --}}
     <div class="container">
        <img src="{{ public_path('images/logo.png') }}" alt="Logo" width="200px" style="margin-top: 0">
        <div class="card">
            <div class="card-header">
                ใบเสร็จการสั่งซื้อคอร์สเรียน
            </div>
            <h4>Ez Academy</h4>
            <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>เลขที่ใบเสร็จ</th>
                            <td>{{ $purchase->order_number }}</td>
                        </tr>
                        <tr>
                            <th>วันที่</th>
                            <td>{{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
                        </tr>
                        <tr>
                            <th>รหัสผู้ใช้</th>
                            <td>{{ $purchase->user_id }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อผู้ใช้</th>
                            <td>{{ $purchase->user->firstname }} {{ $purchase->user->lastname }}</td>
                        </tr>
                        <tr>
                            <th>รหัสคอร์ส</th>
                            <td>{{ $purchase->course_id }}</td>
                        </tr>
                        <tr>
                            <th>ชื่อคอร์ส</th>
                            <td>{{ $purchase->course->name }}</td>
                        </tr>
                        <tr>
                            <th>ราคาปกติ</th>
                            <td>{{ $purchase->price }} บาท</td>
                        </tr>
                        @if ($purchase->coupon_id)
                            <tr>
                                <th>ส่วนลด</th>
                                <td>{{ $purchase->price - $purchase->final_price }} บาท</td>
                            </tr>
                        @endif
                        <tr>
                            <th>ราคาหลังหักส่วนลด</th>
                            <td>{{ $purchase->final_price }} บาท</td>
                        </tr>
                        @if($purchase->coupon_id)
                        <tr>
                            <th>รหัสคูปอง</th>
                            <td>{{ $purchase->coupon_id }}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                อัปเดตเมื่อ: {{ date('d-m-Y', strtotime($purchase->updated_at)) }}
            </div>
        </div>
    </div>
</body>
</html>
