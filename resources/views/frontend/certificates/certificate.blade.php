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
            position: relative;
        }

        .card {
            border-radius: 8px;
            padding: 10px;
            width: 100%;
            height: 95%;
            max-width: 290mm;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            position: relative;
            /* margin-top: 2.5%; */
            margin-left: -1.5%;
            border: 5px solid rgb(19, 38, 137);

        }

        .card-header {
            margin-top: -125px;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
            line-height: 1.2;
            /* Adjust line-height for card header */
        }

        .card-body {
            margin-top: -5px;
        }

        .card-body h2 {
            font-size: 25px;
            margin: 5px 0;
            line-height: 2.5;
            /* Adjust line-height for headings */
        }

        .card-body p {
            margin: 3px 0;
            font-size: 25px;
            line-height: -5;
            /* Adjust line-height for paragraphs */
        }

        .card-footer {
            margin-top: 20px;
            font-size: 20px;
            line-height: 1.2;
            /* Adjust line-height for card footer */
            margin-bottom: 25px;
        }

        img.logo {
            width: 250px;
            margin-top: 90px;
        }

        .details {
            margin: 10px 0;
        }

        .details p {
            margin: 3px 0;
            line-height: 1.2;
            /* Adjust line-height for details */
        }

        /* Corner rectangles */
        .corner-rect {
            position: absolute;
            width: 150px;
            height: 30px;
            background-color: rgb(6, 28, 135);
            clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%);
        }

        .top-left {
            background-color: rgb(0, 149, 255);
            top: -5px;
            right: -2%;
            width: 350px;
            height: 15px;
            z-index: 2;
            border-radius: 0px 20px 0px 0px;
            transform: rotate(40deg);
        }

        .top-right {
            top: -75px;
            right: -15%;
            width: 350px;
            height: 150px;
            transform: rotate(40deg);

        }

        .bottom-left {
            bottom: -10%;
            left: -15%;
            right: -15%;
            width: 350px;
            height: 150px;
            transform: rotate(40deg);
        }

        .bottom-right {
            bottom: -15px;
            left: 83px;
            transform: rotate(180deg);
            width: 170px;
            height: 15px;
            background-color: rgb(0, 149, 255);
            transform: rotate(40deg);
            border-radius: 0px 20px 0px 20px;
        }

        /* Corner rectangles 2 */
        .corner-rect-2 {
            position: absolute;
            width: 150px;
            height: 30px;
            clip-path: polygon(0 0, 100% 0, 90% 100%, 0% 100%);
        }

        .top-left-2 {
            top: -15px;
            right: -2%;
            width: 200px;
            height: 15px;
            border-radius: 0px 20px 0px 0px;
            transform: rotate(40deg);
            background-color: rgba(47, 210, 255, 0.495);

        }

        .top-right-2 {
            top: -15px;
            right: -5%;
            width: 350px;
            height: 15px;
            background-color: rgb(0, 110, 255);

            border-radius: 0px 20px 0px 0px;
            transform: rotate(40deg);
        }

        .bottom-left-2 {
            bottom: -25px;
            left: -60px;
            transform: rotate(270deg);
            width: 300px;
            height: 15px;
            background-color: rgba(47, 210, 255, 0.495);
            transform: rotate(40deg);
            border-radius: 0px 20px 0px 20px;
        }

        .bottom-right-2 {
            bottom: -25px;
            left: -2px;
            width: 270px;
            height: 15px;
            background-color: rgb(0, 110, 255);
            transform: rotate(40deg);
            border-radius: 0px 20px 0px 20px;
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
                <p style="margin-top: 45px">ผ่านการศึกษาออนไลน์และทดสอบวัดความรู้</p>
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
        <div class="corner-rect top-left"></div>
        <div class="corner-rect top-right"></div>
        <div class="corner-rect bottom-left"></div>
        <div class="corner-rect bottom-right"></div>
        <div class="corner-rect-2 top-left-2"></div>
        <div class="corner-rect-2 top-right-2"></div>
        <div class="corner-rect-2 bottom-left-2"></div>
        <div class="corner-rect-2 bottom-right-2"></div>
    </div>
</body>

</html>
