@extends('frontend.dashboard.layouts.master')

@section('content')
<section id="wsus__dashboard">
    <div class="container-fluid">
     @include('frontend.dashboard.layouts.sidebar')
      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content">
            <div class="wsus__dashboard">
              <div class="row">
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item red" href="{{route('user.mycourse')}}">
                    <i class="fas fa-solid fa-book"></i>
                    <p>การเรียนรู้ของฉัน</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item green" href="dsahboard_download.html">
                    <i class="fal fa-cloud-download"></i>
                    <p>download</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item sky" href="dsahboard_review.html">
                    <i class="fas fa-star"></i>
                    <p>review</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item blue" href="dsahboard_wishlist.html">
                    <i class="far fa-heart"></i>
                    <p>wishlist</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item orange" href="{{route('user.profile')}}">
                    <i class="fas fa-user-shield"></i>
                    <p>โปรไฟล์</p>
                  </a>
                </div>
                <div class="col-xl-2 col-6 col-md-4">
                  <a class="wsus__dashboard_item purple" href="dsahboard_address.html">
                    <i class="fal fa-map-marker-alt"></i>
                    <p>address</p>
                  </a>
                </div>
              </div>
              <div class="row">
                <div class="col-xl-12">
                  {{-- show coupons --}}
                  <div class="wsus__message">
                      <h4>คูปองของคุณ</h4>
                      @foreach($userCoupons as $coupon)
                        @if ($coupon->expires_at > now())
                            <div class="wsus__message_single">
                                <div class="wsus__message_text">
                                    @if ($coupon->package)
                                        <h6>จาก {{ $coupon->package->name }}</h6>
                                    @else
                                        <h6>จากแพ็กเกจที่ไม่มีชื่อ</h6>
                                    @endif
                                    <span style="font-weight: bold">{{ $coupon->code }}</span>
                                    <span style="font-weight: bold">ลด {{ $coupon->discount_percentage }}%</span>
                                </div>
                                <div class="wsus__message_icon">
                                    <span class="copy-icon" data-code="{{ $coupon->code }}"><i class="fas fa-solid fa-copy"></i></span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                  </div>
                  {{-- show coupons --}}
                  <div class="wsus__message">
                    <h4>คูปองทั้งหมด</h4>
                    @foreach($generalCoupons as $coupon)
                        @if ($coupon->expires_at > now())
                            <div class="wsus__message_single">
                                <div class="wsus__message_text">
                                  <span style="font-weight: bold">{{ $coupon->code }}</span>
                                  @if ($coupon->discount)
                                      <span style="font-weight: bold">ลด {{ $coupon->discount }} บาท</span>
                                  @elseif ($coupon->discount_percentage)
                                      <span style="font-weight: bold">ลด {{ $coupon->discount_percentage }}%</span>
                                  @endif
                                </div>
                                <div class="wsus__message_icon">
                                    <span class="copy-icon" data-code="{{ $coupon->code }}"><i class="fas fa-solid fa-copy"></i></span>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>                
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
</section>

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // Find all copy icons
      var copyIcons = document.querySelectorAll('.copy-icon');
  
      // Add event listeners to each icon
      copyIcons.forEach(function (icon) {
          icon.addEventListener('click', function () {
              // Get the coupon code
              var code = icon.getAttribute('data-code');
              
              // Copy the coupon code to clipboard
              navigator.clipboard.writeText(code).then(function() {
                  alert('คัดลอกคูปองโค้ดเรียบร้อย: ' + code);
              }, function() {
                  alert('ไม่สามารถคัดลอกคูปองโค้ดได้');
              });
          });
      });
  });
  </script>
@endsection