<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงานข้อมูลผู้เรียน</title>
    <style>
        body {
            font-family: "THSarabunNew", sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1>รายงานข้อมูลผู้เรียนคอร์ส: {{ $course->name }}</h1>
    
    <!-- แสดงจำนวนผู้เรียนทั้งหมด -->
    <p>จำนวนผู้เรียนทั้งหมด: {{ $course->purchasedCoursesDetails->count() }} คน</p>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อผู้เรียน</th>
                <th>อีเมล</th>
                <th>ราคา</th>
                <th>วันที่ซื้อ</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($course->purchasedCoursesDetails as $key => $purchase)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $purchase->user->name }}</td>
                    <td>{{ $purchase->user->email }}</td>
                    <td>{{ $purchase->final_price }} บาท</td>
                    <td>{{ $purchase->created_at->format('d/m/Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
