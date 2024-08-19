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
    <div class="receipt">
    <img src="{{ public_path('images/logo.png') }}" alt="Logo" width="200px" style="display: block; margin: 0 auto;">
    <h2 class="text-center">ใบเสร็จการสั่งซื้อคอร์สเรียน</h2>
    <h4 class="text-center">Ez Academy</h4>
    <div class="receipt-body">
        <p><strong>เลขที่ใบเสร็จ:</strong> {{ $purchase->order_number }}</p>
        <p><strong>วันที่:</strong> {{ date('d-m-Y', strtotime($purchase->created_at)) }}</p>
        <p><strong>รหัสผู้ใช้:</strong> {{ $purchase->user_id }}</p>
        <p><strong>ชื่อผู้ใช้:</strong> {{ $purchase->user->firstname }} {{ $purchase->user->lastname }}</p>
        <p><strong>รหัสคอร์ส:</strong> {{ $purchase->course_id }}</p>
        <p><strong>ชื่อคอร์ส:</strong> {{ $purchase->course->name }}</p>
        <p><strong>ราคาปกติ:</strong> {{ number_format($purchase->price, 2) }} บาท</p>
        @if ($purchase->coupon_id)
            <p><strong>ส่วนลด:</strong> {{ number_format($purchase->price - $purchase->final_price, 2) }} บาท</p>
        @endif
        <p><strong>ราคาหลังหักส่วนลด:</strong> {{ number_format($purchase->final_price, 2) }} บาท</p>
        @if($purchase->coupon_id)
            <p><strong>รหัสคูปอง:</strong> {{ $purchase->coupon_id }}</p>
        @endif
    </div>
    <hr>
    <p class="text-center">อัปเดตเมื่อ: {{ date('d-m-Y', strtotime($purchase->updated_at)) }}</p>
    <p class="text-center">ขอบคุณที่ใช้บริการ</p>
</div>

<style>
    @font-face {
        font-family: 'THSarabunNew';
        src: url("{{ public_path('fonts/THSarabunNew.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    .receipt {
        width: 300px;
        padding: 20px;
        border: 1px solid #000;
        margin: 0 auto;
        font-family: "THSarabunNew", sans-serif;
        font-size: 16px;
        background-color: #fff;
    }

    .receipt img {
        margin-bottom: 10px;
    }

    .receipt h2 {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .receipt h4 {
        font-size: 16px;
        margin-bottom: 15px;
    }

    .receipt-body {
        margin-bottom: 10px;
    }

    .receipt-body p {
        margin: 5px 0;
    }

    .receipt hr {
        border: 0;
        border-top: 1px dashed #000;
        margin: 10px 0;
    }

    .text-center {
        text-align: center;
    }
</style>


</body>
</html>
