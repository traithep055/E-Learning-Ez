@extends('frontend.layouts.master')

@section('content')
    <style>
        #qr-code-image {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto;
            max-width: 100%;
        }

        .pay {
            justify-content: center;
            display: flex;
        }

        .payment {
            margin-top: 1%;
            font-weight: 100;
            color: #00c5ff;
            /* สีของข้อความ */
            background-color: transparent;
            /* พื้นหลังโปร่งใส */
            border: none;
            /* เอาขอบออก */
            display: flex;
            align-items: center;
            /* จัดไอคอนและข้อความให้อยู่ตรงกลางแนวตั้ง */
            cursor: pointer;
            /* เปลี่ยนเคอร์เซอร์เป็นรูปมือเมื่อ hover */
            font-size: 19px;
        }

        .payment:hover {
            color: rgb(6, 126, 255);
            /* เปลี่ยนสีข้อความเมื่อ hover */
        }

        .btn.payment {
            justify-content: center;
            /* จัดกลางแนวนอน (ถ้าต้องการ) */
        }

        .btn.payment box-icon {
            margin-right: 8px;
            /* ปรับช่องว่างระหว่างไอคอนและข้อความ */
        }

        .col-md-6 {
            /* #000 คือสีดำ คุณสามารถเปลี่ยนสีตามต้องการได้ */
            padding: 2%
        }

        .form-img {
            border: 1px solid #4e4c4c60;
            padding: 2%;
            text-align: center;
            /* box-shadow: 0 2px 2px 1px rgba(0, 0, 0, 0.252),
                0 2px 2px 1px rgba(0, 0, 0, 0.249); */
        }

        .form-group label {
            color: #000;
        }

        .form-group b,
        .form-group span {
            color: #000;
        }

        .p-4 {
            border: 1px solid #4e4c4c60;
        }
    </style>
    <div class="container mt-8" style="margin-top: 8%; margin-bottom: 8%">
        <h2 class="mt-6" style="font-weight: 100;">รายการคำสั่งซื้อ</h2>
        <button type="button" class="payment mb-4" data-toggle="modal" data-target="#paymentModal">
            <box-icon name='bank' type='solid' color='#00c5ff'></box-icon> ช่องทางชำระ
        </button>
        <form action="{{ route('user.course_purchase.store', ['course' => $course->id]) }}" method="POST"
            enctype="multipart/form-data" id="purchase-form">
            @csrf
            <div class="pay">
                <div class="col-md-6">
                    <div class="form-img">
                        <img src="{{ $course->image }}" alt="" width="100%" class="img-fluid">
                        <h4 class="mt-2">คอร์ส {{ $course->name }}</h4>
                        <p>จำนวน {{ $course->lessons->count() }} บทเรียน 10 ชั่วโมง</p>
                        <div class="form-group">
                            <label style="font-size: 20px; font-weight: 100">ราคาคอร์ส: </label>
                            <span style="font-weight: bold" id="original_price">{{ $course->price }}</span> <b>บาท</b>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="p-4">
                        <div class="form-group">
                            <label for="coupon_code">รหัสคูปอง</label>
                            <div class="d-flex">
                                <input type="text" name="coupon_code" id="coupon_code" class="form-control col-1 border"
                                    style="height: 40px; margin-right: 160%">
                            </div>
                            <button type="button" class="btn btn-primary mt-3" id="apply-coupon"
                                    style="margin-right: 160%">ใช้</button>
                        </div>
                        <div class="form-group">
                            <label style="font-size: 20px; font-weight: 100">ยอดที่ต้องชำระ: </label>
                            <span style="font-weight: bold" id="discounted_price">{{ $course->price }}</span> <b>บาท</b>
                        </div>
                        <div class="form-group">
                            <label for="slip_image">อัปโหลดภาพยืนยันการชำระ</label>
                            <div class="d-flex" >
                                <input type="file" name="slip_image" id="slip_image" class="form-control col-2 mb-3 border" style="margin-right: 160%">
                            </div>
                        </div>
                        <!-- ตำแหน่งที่ใช้เพื่อแสดงข้อความเกี่ยวกับข้อมูลคูปอง -->
                        <div id="coupon-info" class="form-group" style="display: none;"></div>

                        <button type="submit" class="btn btn-success mt-3">ยืนยันการสั่งซื้อ</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="paymentModalLabel">วิธีการจ่าย</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    <div id="qr-code-image" class="img-fluid mb-3">
                        <!-- QR Code จะถูกใส่ที่นี่โดย JavaScript -->
                    </div>
                    <p>บัญชี: ธนาคาร</p>
                    <p>ชื่อบัญชี: EZ Academy</p>
                    <p>เลขบัญชี: 025-0-458000</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var applyCouponButton = document.getElementById('apply-coupon');
            var couponCodeInput = document.getElementById('coupon_code');
            var paymentModal = document.getElementById('paymentModal');

            couponCodeInput.addEventListener('keypress', function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    applyCoupon();
                }
            });

            applyCouponButton.addEventListener('click', function() {
                applyCoupon();
            });

            function applyCoupon() {
                var couponCode = couponCodeInput.value.trim();
                var originalPrice = parseFloat(document.getElementById('original_price').innerText);
                var discountedPrice = originalPrice;

                if (couponCode === '') {
                    // ไม่มีคูปอง, จึงไม่ต้องตรวจสอบคูปอง
                    updateQRCode(discountedPrice);
                    return;
                }

                fetch('/api/coupons/' + couponCode)
                    .then(response => response.json())
                    .then(data => {
                        if (data.discounted_price !== undefined) {
                            if (data.discounted_price !== null) {
                                discountedPrice = originalPrice - parseFloat(data.discounted_price);
                            } else if (data.discount_percentage !== null) {
                                discountedPrice = originalPrice - (originalPrice * (parseFloat(data
                                    .discount_percentage) / 100));
                            }
                            document.getElementById('discounted_price').innerText = discountedPrice.toFixed(2);
                            var couponInfo = document.getElementById('coupon-info');
                            if (data.discounted_price !== null) {
                                couponInfo.innerText = 'ส่วนลด ' + data.discounted_price +
                                    ' บาท จากการใช้คูปอง';
                            } else if (data.discount_percentage !== null) {
                                couponInfo.innerText = 'ส่วนลด ' + data.discount_percentage +
                                    ' % จากการใช้คูปอง';
                            }
                            couponInfo.style.display = 'block';
                        } else {
                            document.getElementById('coupon-info').innerText = 'ไม่พบคูปองหรือคูปองไม่ถูกต้อง';
                            document.getElementById('coupon-info').style.display = 'block';
                        }

                        updateQRCode(discountedPrice);
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            function updateQRCode(price) {
                var qrCodeImage = document.getElementById('qr-code-image');
                fetch('{{ route('user.generate-qr-code') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            price: price
                        })
                    })
                    .then(response => response.text())
                    .then(svg => {
                        qrCodeImage.innerHTML = svg;
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            }

            // โหลด QR Code ของราคาคอร์สเริ่มต้นเมื่อหน้าเว็บโหลด
            var originalPrice = parseFloat(document.getElementById('original_price').innerText);
            updateQRCode(originalPrice);
        });
    </script>
@endpush
