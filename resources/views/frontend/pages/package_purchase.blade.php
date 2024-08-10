@extends('frontend.layouts.master')

@section('content')
<div class="container mt-8" style="margin-top: 8%; max-width: 800px;">
    <h2 class="mt-6 text-center" style="font-size: 28px; font-weight: bold;">ซื้อแพ็คเกจ</h2>
    <button type="button" class="btn btn-info mb-4 d-block mx-auto" data-toggle="modal" data-target="#paymentModal" style="font-size: 18px;">
        วิธีการจ่าย
    </button>

    <form action="{{route('user.package_purchase.buy', ['package' => $package->id])}}" method="POST" enctype="multipart/form-data" id="purchase-form">
        @csrf
        <div class="card p-4 shadow-lg">
            <div class="card-body">
                <h3 class="card-title" style="font-size: 24px; font-weight: bold;">{{$package->name}}</h3>
                <h5 class="card-text text-muted mb-4" style="font-size: 18px;">{{$package->description}}</h5>
                <div class="form-group">
                    <label style="font-size: 20px; font-weight: bold;">ราคา:</label>
                    <span style="font-weight: bold; font-size: 20px;">{{$package->price}} บาท</span>
                </div>
                <div class="form-group">
                    <label for="payment_slip" style="font-size: 18px; font-weight: bold;">อัปโหลดภาพสลิป</label>
                    <div class="custom-file">
                        <input type="file" name="payment_slip" id="payment_slip" class="custom-file-input">
                        <label class="custom-file-label" for="payment_slip">เลือกไฟล์</label>
                    </div>
                </div>
                <button type="submit" class="btn btn-success mt-4 d-block w-100" style="font-size: 18px; font-weight: bold;">
                    ซื้อ
                </button>
            </div>
        </div>
    </form>
</div>

<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" role="dialog" aria-labelledby="paymentModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="paymentModalLabel" style="font-size: 22px; font-weight: bold;">วิธีการจ่าย</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
        <img src="{{ asset('images/qr-code.jpeg') }}" alt="QR Code" class="img-fluid mb-3" style="max-width: 200px;">
        <p style="font-size: 18px;">บัญชี: ธนาคารกรุงเทพ</p>
        <p style="font-size: 18px;">ชื่อบัญชี: นาย ไตรเทพ น้อยแสง</p>
        <p style="font-size: 18px;">เลขบัญชี: 640-0-444383</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="font-size: 16px;">ปิด</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script>
    // Script to display file name after selecting a file
    document.querySelector('.custom-file-input').addEventListener('change', function (e) {
        var fileName = document.getElementById("payment_slip").files[0].name;
        var nextSibling = e.target.nextElementSibling;
        nextSibling.innerText = fileName;
    });
</script>
@endpush
