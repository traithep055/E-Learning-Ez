@extends('frontend.layouts.master')

@section('content')
<div class="container">
    <h2 class="mt-6">ซื้อคอร์ส</h2>
    <form action="{{route('user.course_purchase.store', ['course' => $course->id])}}" method="POST" enctype="multipart/form-data" id="purchase-form">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <img src="{{$course->image}}" alt="" width="70%" class="img-fluid">
                    <h4 class="mt-2">คอร์ส {{$course->name}}</h4>
                    <p>จำนวน 10 ชั่วโมง</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card p-4">
                    <div class="form-group">
                        <label style="font-size: 20px; font-weight: bold">ราคาปกติ: </label>
                        <span style="font-weight: bold" id="original_price">{{$course->price}}</span> <b>฿</b>
                    </div>
                    <div class="form-group">
                        <label style="font-size: 20px; font-weight: bold">ราคาหลังหักส่วนลด: </label>
                        <span style="font-weight: bold" id="discounted_price">{{$course->price}}</span> <b>฿</b>
                    </div>
                    <div class="form-group">
                        <label for="slip_image">อัปโหลดภาพสลิป</label>
                        <div class="d-flex">
                            <input type="file" name="slip_image" id="slip_image" class="form-control col-2 border">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="coupon_code">รหัสคูปอง</label>
                        <div class="d-flex">
                            <input type="text" name="coupon_code" id="coupon_code" class="form-control col-1 border" style="height: 40px; width: 84%">
                            <button type="button" class="btn btn-primary ml-2 col-2" id="apply-coupon" style="height: 40px;">ใช้คูปอง</button>
                        </div>
                    </div>
                    <!-- ตำแหน่งที่ใช้เพื่อแสดงข้อความเกี่ยวกับข้อมูลคูปอง -->
                    <div id="coupon-info" class="form-group" style="display: none;"></div>

                    <button type="submit" class="btn btn-success mt-3">ซื้อ</button>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('coupon_code').addEventListener('keypress', function(event) {
    // ตรวจสอบว่าปุ่มที่กดคือปุ่ม Enter หรือไม่
    if (event.keyCode === 13) {
        event.preventDefault(); // ป้องกันการส่งฟอร์ม
        // นำโค้ดที่ต้องการให้ทำเมื่อกด Enter ได้แทนที่นี่
        // เช่น เรียกใช้ฟังก์ชั่นสำหรับการใช้คูปอง
        applyCoupon();
    }
});

// ฟังก์ชั่นสำหรับใช้คูปอง
function applyCoupon() {
    var couponCode = document.getElementById('coupon_code').value;

    fetch('/api/coupons/' + couponCode)
        .then(response => response.json())
        .then(data => {
            if (data.discounted_price !== undefined) {
                var originalPrice = parseFloat(document.getElementById('original_price').innerText);
                var discountedPrice = 0;
                if (data.discounted_price !== null) {
                    // หากค่าส่วนลดไม่ใช่ null ให้คำนวณราคาหลังหักส่วนลด
                    discountedPrice = originalPrice - parseFloat(data.discounted_price);
                } else if (data.discount_percentage !== null) {
                    // หากเปอร์เซ็นต์ส่วนลดไม่ใช่ null ให้คำนวณราคาหลังหักส่วนลดด้วยเปอร์เซ็นต์
                    discountedPrice = originalPrice - (originalPrice * (parseFloat(data.discount_percentage) / 100));
                } else {
                    // หากค่าส่วนลดเป็น null ให้ราคาหลังหักส่วนลดเป็นราคาปกติ
                    discountedPrice = originalPrice;
                }
                document.getElementById('discounted_price').innerText = discountedPrice.toFixed(2);
                if (data.discounted_price !== null) {
                    document.getElementById('coupon-info').innerText = 'ส่วนลด ' + data.discounted_price + ' บาท จากการใช้คูปอง';
                } else if (data.discount_percentage !== null) {
                    document.getElementById('coupon-info').innerText = 'ส่วนลด ' + data.discount_percentage + ' % จากการใช้คูปอง';
                }
                document.getElementById('coupon-info').style.display = 'block';
            } else {
                document.getElementById('coupon-info').innerText = 'ไม่พบคูปองหรือคูปองไม่ถูกต้อง';
                document.getElementById('coupon-info').style.display = 'block';
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


</script>
@endpush
