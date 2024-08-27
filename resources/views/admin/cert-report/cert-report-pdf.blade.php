<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงานการรับใบประกาศณียบัตร - PDF</title>
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

        .table-header {
            text-align: center;
            margin-bottom: 20px;
        }

        .table-header h1 {
            font-size: 1.5em;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="table-header">
        <h1>รายงานการรับใบประกาศณียบัตร</h1>
    </div>
    <table>
        <thead>
            <tr>
                <th>หมายเลขผู้ใช้</th>
                <th>ชื่อผู้ใช้</th>
                <th>หมายเลขคอร์ส</th>
                <th>ชื่อคอร์ส</th>
                <th>จำนวนครั้งที่ทำข้อสอบ</th>
                <th>คะแนนสูงสุด</th>
                <th>วันที่ออกใบประกาศณียบัตร</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($students as $student)
                <tr>
                    <td>{{ $student['user_id'] }}</td>
                    <td>{{ $student['user']->name }}</td>
                    <td>{{ $student['course_id'] }}</td>
                    <td>{{ $student['course'] }}</td>
                    <td>{{ $student['count'] }}</td>
                    <td>{{ $student['highest_score'] }}</td>
                    <td>{{ $student['certificate_date'] ? date('d-m-Y', strtotime($student['certificate_date'])) : 'ไม่มี' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
