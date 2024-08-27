<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงานการสั่งซื้อ</title>
    <style>
        @page {
            size: landscape;
            margin: 15mm;
        }

        body {
            font-family: "THSarabunNew", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            font-size: 1.1em;
            color: #333;
        }

        td {
            font-size: 1em;
            color: #555;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table-container {
            padding: 20px;
        }

        .table-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        .table-header h1 {
            font-size: 1.5em;
            margin: 0;
        }

        .badge {
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.9em;
        }

        .bg-success {
            background-color: #28a745;
            color: white;
        }

        .bg-info {
            background-color: #17a2b8;
            color: white;
        }

        .bg-dark {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <div class="table-container">
        <div class="table-header">
            <h1>รายงานการสั่งซื้อคอร์ส</h1>
        </div>
        <table class="table table-striped table-bordered border-dark">
            <thead>
                <tr>
                    <th>หมายเลขใบเสร็จ</th>
                    <th>ชื่อคอร์ส</th>
                    <th>ราคาปกติ</th>
                    <th>ส่วนลด</th>
                    <th>ราคาหลังหักส่วนลด</th>
                    <th>วันที่</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($bills as $bill)
                    <tr>
                        <td>{{ $bill->order_number }}</td>
                        <td>{{ $bill->course->name }}</td>
                        <td>{{ number_format($bill->price, 2) }} บาท</td>
                        <td>{{ number_format($bill->price - $bill->final_price, 2) }} บาท</td>
                        <td>{{ number_format($bill->final_price, 2) }} บาท</td>
                        <td>{{ date('d-m-Y', strtotime($bill->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>
