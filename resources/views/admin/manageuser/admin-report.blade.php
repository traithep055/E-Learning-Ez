<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงานจำนวนแอดมิน</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
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
            color: #333;
            font-size: 1.1em;
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

        .table-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-header h1 {
            font-size: 1.5em;
            margin: 0;
            color: #333;
        }

        .total-count {
            text-align: right;
            margin-top: 20px;
            font-size: 1.2em;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="table-header">
        <h1>รายงานจำนวนผู้ดูแลระบบ</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อ-นามสกุล</th>
                <th>อีเมลล์</th>
                <th>โทรศัพท์</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $index => $admin)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $admin->firstname }} {{ $admin->lastname }}</td>
                    <td>{{ $admin->user->email }}</td>
                    <td>{{ $admin->phone }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total-count">
        จำนวนผู้ดูแลระบบทั้งหมด: {{ $admins->count() }} คน
    </div>
</body>
</html>
