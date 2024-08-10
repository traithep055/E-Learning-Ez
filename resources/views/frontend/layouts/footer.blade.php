<link rel="stylesheet" href="{{ asset('frontend/css/home.css') }}">
<footer style=" padding:2%; margin-top:2%">
    <div id="carouselExampleFade" class="carousel slide mb-8" data-bs-ride="carousel">
        <div class="carousel-inner">
            <img src="{{ asset('images/slide2.jpg') }} " width="1301" height="350">
        </div>
    </div>
    <div class="row">
        <div class="foot col-md-3" style=" margin:1%">
            <div class="foot-logo p-2">
                <img src="{{ asset('images/Logo.png') }}" class="card-img-top w-50" alt="..."><br>
                <span>แพลตฟอร์มเรียนออนไลน์สำหรับอนาคต</span>
            </div>
        </div>
        <div class="foot col-md-3" style="background-color: rgb(255, 255, 255); margin:1%">
            <div class="row">
                <a href="{{ route('user.show_package') }}">สมัครแพ็คเกจรายปี</a>
                <a href="">คอร์สเรียน</a>
                <a href="">เกี่ยวกับองค์กร</a>
            </div>
        </div>
        <div class="foot col-md-3" style="background-color: rgb(255, 255, 255); margin:1%">
            <div class="row">
                <a href="">ข้อตกลงการให้บริการ</a>
                <a href="">นโยบายความเป็นส่วนตัว</a>
                <a href="">นโยบายการคืนเงิน</a>
                <a href="">คำถามที่พบบ่อย</a>
            </div>
        </div>
        <div class="foot col-md-2" style="background-color: rgb(255, 255, 255); margin:1%">
            <div class="row">
                <a href="">สมัครงาน</a>
                <a href="">บล็อค</a>
                <a href="">เกี่ยวกับเรา</a>
                <a href="{{ route('admin.login') }}">สำหรับแอดมิน</a>
            </div>
        </div>
    </div>
    <div class="divider" style="width: 100%;"></div>
    <span> Copyright © 2024 </span>
    <div class="icon-f" style="margin-left:95%; margin-top:-2%">
        <box-icon name='facebook' type='logo' animation='tada' color='#4EB6FF'></box-icon>
        <box-icon name='instagram' type='logo' animation='tada' color='#4EB6FF'></box-icon>
    </div>
</footer>
