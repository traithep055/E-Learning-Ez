<!DOCTYPE html>
<html lang="th">

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

        body {
            font-family: "THSarabunNew";
            font-size: 20px; /* เพิ่มขนาดตัวอักษร */
            margin: 0;
            padding: 0;
        }

        .receipt {
            width: 100%;
            max-width: 600px; /* เพิ่มขนาดความกว้าง */
            padding: 20px; /* เพิ่ม padding */
            border: 1px solid #000;
            margin: 0 auto;
            background-color: #fff;
        }

        .receipt h2 {
            font-size: 24px; /* เพิ่มขนาดตัวอักษรหัวข้อ */
            margin-bottom: 15px;
            margin-top: 0;
        }

        .receipt h4 {
            font-size: 20px; /* เพิ่มขนาดตัวอักษรหัวข้อย่อย */
            margin-bottom: 10px;
        }

        .receipt-body {
            margin-bottom: 15px; /* เพิ่ม margin ด้านล่าง */
        }

        .receipt-table {
            width: 100%;
            border-collapse: collapse;
        }

        .receipt-table td {
            padding: 5px 0; /* เพิ่ม padding */
        }

        .text-right {
            text-align: right;
        }

        .receipt hr {
            border: 0;
            border-top: 1px dashed #000;
            margin: 15px 0;
        }

        .text-center {
            text-align: center;
        }

        @page {
            size: A4;
            margin: 10mm;
        }
    </style>
</head>

<body>
    <div class="receipt">
        <h4 class="text-center">Ez Academy</h4>
        <h2 class="text-center">ใบเสร็จสำหรับคำสั่งซื้อ</h2>
        <div class="receipt-body">
            <table class="receipt-table">
                <tr>
                    <td><strong>เลขที่ใบเสร็จ:</strong> {{ $purchase->order_number }}</td>
                </tr>
                <tr>
                    <td><strong>วันที่:</strong> {{ date('d-m-Y', strtotime($purchase->created_at)) }}</td>
                </tr>
                <hr>
                <tr>
                    <td><strong>รหัสผู้ใช้:</strong> {{ $purchase->user_id }}</td>
                </tr>
                <tr>
                    <td><strong>ชื่อผู้ใช้:</strong> {{ $purchase->user->firstname }} {{ $purchase->user->lastname }}</td>
                </tr>
                <hr>
                <tr>
                    <td><strong>รหัสคอร์ส:</strong></td>
                    <td class="text-right">{{ $purchase->course_id }}</td>
                </tr>
                <tr>
                    <td><strong>ชื่อคอร์ส:</strong></td>
                    <td class="text-right">{{ $purchase->course->name }}</td>
                </tr>
                <tr>
                    <td><strong>ราคาปกติ:</strong></td>
                    <td class="text-right">{{ number_format($purchase->price, 2) }} บาท</td>
                </tr>
                @if ($purchase->coupon_id)
                    <tr>
                        <td><strong>ส่วนลด:</strong></td>
                        <td class="text-right">{{ number_format($purchase->price - $purchase->final_price, 2) }} บาท</td>
                    </tr>
                @endif
                <tr>
                    <td><strong>ราคาหลังหักส่วนลด:</strong></td>
                    <td class="text-right">{{ number_format($purchase->final_price, 2) }} บาท</td>
                </tr>
                <tr>
                    <td><strong>ยอดชำระ:</strong></td>
                    <td class="text-right">{{ number_format($purchase->final_price, 2) }} บาท</td>
                </tr>
            </table>
        </div>
        <hr>
        <p><strong>หมายเหตุ:</strong></p>
        @if ($purchase->coupon_id)
            <p><strong>รหัสคูปองที่ใช้:</strong> {{ $purchase->coupon->code }}</p>
        @endif
        <p class="text-center">วันที่ออกใบเสร็จ: {{ date('d-m-Y', strtotime($purchase->updated_at)) }}</p>
        <hr>
        <p class="text-center">ขอบคุณสำหรับคำสั่งซื้อ</p>
    </div>
</body>

</html>
