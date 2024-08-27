<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>รายงานคอร์ส</title>

    <style>
        @page {
            size: landscape;
            margin: 10mm;
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
            padding: 10px;
            text-align: left;
            border: 1px solid #333;
        }

        th {
            background-color: #f2f2f2;
            font-size: 1.2em;
        }

        td {
            font-size: 1em;
        }

        tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f1f1f1;
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
    <h1 style="text-align: center; margin-bottom: 20px;">รายงานคอร์ส</h1>
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>ชื่อคอร์ส</th>
                <th>จำนวนผู้เรียน</th>
                <th>ราคา</th>
                <th>ผู้สอน</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>{{ $course->id }}</td>
                    <td>{{ $course->name }}</td>
                    <td>{{ $course->purchasedCourses->count() }} คน</td>
                    <td>{{ $course->price }} บาท</td>
                    <td>{{ $course->teacher->firstname }} {{ $course->teacher->lastname }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="total-count">
        จำนวนคอร์สทั้งหมด: {{ $courses->count() }} คอร์ส
    </div>
</body>
</html>
