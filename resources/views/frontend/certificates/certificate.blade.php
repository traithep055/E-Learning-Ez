<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ใบประกาศณียบัตร</title>
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
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        .card {
            border: 1px solid #ccc;
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            max-width: 290mm;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            box-sizing: border-box;
        }
        .card-header {
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
            line-height: 1.2; /* Adjust line-height for card header */
        }
        .card-body {
            margin-top: 10px;
        }
        .card-body h2 {
            font-size: 22px;
            margin: 5px 0;
            line-height: 1.2; /* Adjust line-height for headings */
        }
        .card-body p {
            margin: 3px 0;
            line-height: 1.2; /* Adjust line-height for paragraphs */
        }
        .card-footer {
            margin-top: 15px;
            font-size: 12px;
            line-height: 1.2; /* Adjust line-height for card footer */
        }
        img.logo {
            width: 150px;
            margin-top: 10px;
        }
        .details {
            margin: 10px 0;
        }
        .details p {
            margin: 3px 0;
            line-height: 1.2; /* Adjust line-height for details */
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            <img src="{{ public_path('images/logo.png') }}" alt="Logo" class="logo">
            <div class="card-header">Ez Academy</div>
            <div class="card-body">
                <p>ขอมอบเกียรติบัตรให้ไว้เพื่อแสดงว่า</p>
                <h2>{{ $user->firstname }} {{ $user->lastname }}</h2>
                <p>ผ่านการศึกษาออนไลน์และทดสอบวัดความรู้</p>
                <h2>{{ $course->name }}</h2>
                <div class="details">
                    <p>จำนวน {{ $course->hours }} ชั่วโมง</p>
                    <p>โดยผ่านการประเมิณคิดเป็นร้อยละ {{ $testResult->score }}%</p>
                    <p>ออกให้ไว้ ณ วันที่ {{ date('d-m-Y', strtotime($testResult->updated_at)) }}</p>
                </div>
            </div>
            <div class="card-footer">
                Ez Academy
            </div>
        </div>
    </div>
</body>
</html>
