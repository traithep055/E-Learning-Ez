<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ez Login</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
</head>

<body style="background-image: url('{{ asset('images/back.jpg') }}');">
    <div class="container">
        <div class="forms">
            <div class="form login">
                <span class="title">สร้างบัญชี Ez ของคุณ</span>
                <div class="sub-title">
                    <span เพื่อพบกับคอร์สเรียนหลากหลายสาขา>เพื่อพบกับคอร์สเรียนหลากหลายสาขา</span>
                </div>
                <form action="{{ route('register') }}" method="post">
                    @csrf
                    <div class="input-field">

                        <input id="name" type="text" name="name" value="{{old('name')}}" placeholder="Enter your Name" required>
                        <i class="uil uil-user"></i>
                    </div>
                    @if($errors->has('name'))
                            <span class="error" style="color: red">{{ $errors->first('name') }}</span>
                    @endif

                    <div class="input-field">

                        <input id="email" type="email" name="email" value="{{old('email')}}" placeholder="Enter your email" required>
                        <i class="uil uil-envelope"></i>
                    </div>
                    @if($errors->has('email'))
                            <span class="error" style="color: red">{{ $errors->first('email') }}</span>
                    @endif

                    <div class="input-field">
                        <input type="password" id="password" name="password" class="password" placeholder="Enter your password"
                            required autocomplete="new-password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>


                    </div>
                    @if($errors->has('password'))
                            <span class="error" style="color: red">{{ $errors->first('password') }}</span>
                    @endif

                    <div class="input-field">
                        <input type="password" id="password_confirmation" name="password_confirmation" class="password" placeholder="Confirm your password"
                            required autocomplete="new-password">
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>


                    </div>
                    @if($errors->has('password_confirmation'))
                            <span class="error" style="color: red">{{ $errors->first('password_confirmation') }}</span>
                    @endif

                    <div class="input-field">
                        <style>
                            input[type="submit"] {
                                background-color: #7dba7c;
                                /* สีม่วง */
                                color: #ffffff;
                                /* สีข้อความ */
                                padding: 10px 20px;
                                /* กำหนดขนาดพื้นที่ภายในปุ่ม */
                                border: none;
                                /* ลบเส้นขอบ */
                                border-radius: 5px;
                                /* ทำมุมขอบเรียบ */
                            }
                            /* เม้าส์ไปชี้ปุ่ม Submit */
                            input[type="submit"]:hover {
                                background-color: #E8DFCA;
                                color: black;
                                /* สีม่วงอ่อน */
                            }
                        </style>
                        <input type="submit" value="Sign up">
                    </div>
                </form>
            </div>

            <script>
                const container = document.querySelector(".container"),
                    pwShowHide = document.querySelectorAll(".showHidePw"),
                    pwFields = document.querySelectorAll(".password");
                pwShowHide.forEach(eyeIcon => {
                    eyeIcon.addEventListener("click", () => {
                        pwFields.forEach(pwField => {
                            if (pwField.type === "password") {
                                pwField.type = "text";
                                pwShowHide.forEach(icon => {
                                    icon.classList.replace("uil-eye-slash", "uil-eye");
                                })
                            } else {
                                pwField.type = "password";
                                pwShowHide.forEach(icon => {
                                    icon.classList.replace("uil-eye", "uil-eye-slash");
                                })
                            }
                        });
                    });
                });
            </script>
            <script src="script.js"></script>

</body>
</html>
