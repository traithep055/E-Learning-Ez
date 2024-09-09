@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>เพิ่มผู้ดูแลระบบ</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">บอร์ด</a></div>
        <div class="breadcrumb-item">โปรไฟล์</div>
      </div>
    </div>
    <div class="section-body">

      <div class="row mt-sm-4 d-flex justify-content-center">
        <div class="col-12 col-md-10 col-lg-8 mx-auto">
          <div class="card">
            <form method="post" class="needs-validation" novalidate="" action="{{ route('admin.add-admin') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-header">
                <h4>เพิ่มผู้ดูแลระบบ</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="form-group col-md-6 col-12">
                      <label>ชื่อผู้ใช้</label>
                      <input type="text" name="name" class="form-control" required>
                      <div class="invalid-feedback">กรุณากรอกชื่อผู้ใช้</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>อีเมลล์</label>
                      <input type="email" name="email" class="form-control" required>
                      <div class="invalid-feedback">กรุณากรอกอีเมลล์ที่ถูกต้อง</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control" required>
                        <div class="invalid-feedback">กรุณากรอกรหัสผ่าน</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                        <div class="invalid-feedback">กรุณากรอกยืนยันรหัสผ่านให้ตรงกัน</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>ชื่อ</label>
                      <input type="text" name="firstname" class="form-control" required>
                      <div class="invalid-feedback">กรุณากรอกชื่อ</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>นามสกุล</label>
                      <input type="text" name="lastname" class="form-control" required>
                      <div class="invalid-feedback">กรุณากรอกนามสกุล</div>
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>โทรศัพท์</label>
                      <input type="text" name="phone" class="form-control" required>
                      <div class="invalid-feedback">กรุณากรอกเบอร์โทรศัพท์</div>
                    </div>
              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">เพิ่มผู้ดูแลระบบ</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
</section>
@endsection
