@extends('admin.layouts.master')

@section('content')
<section class="section">
    <div class="section-header">
      <h1>โปรไฟล์</h1>
      <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">บอร์ด</a></div>
        <div class="breadcrumb-item">โปรไฟล์</div>
      </div>
    </div>
    <div class="section-body">

      <div class="row mt-sm-4">
        <div class="col-12 col-md-12 col-lg-7">
          <div class="card">
            <form method="post" class="needs-validation" novalidate="" action="{{route('admin.profile.update')}}" enctype="multipart/form-data">
                @csrf
              <div class="card-header">
                <h4>แก้ไขโปรไฟล์</h4>
              </div>
              <div class="card-body">
                  <div class="row">
                    <div class="form-group col-12">
                      <div class="mb-3">
                          <img width="100px" src="{{asset($admin->image)}}" alt="">
                      </div>
                      <label>รูปภาพ</label>
                      <input type="file" name="image" class="form-control">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>ชื่อผู้ใช้</label>
                      <input type="text" name="name" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>อีเมลล์</label>
                      <input type="text" name="email" class="form-control" value="{{Auth::user()->email}}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>ชื่อ</label>
                      <input type="text" name="firstname" class="form-control" value="{{$admin->firstname}}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>นามสกุล</label>
                      <input type="text" name="lastname" class="form-control" value="{{$admin->lastname}}">
                    </div>
                    <div class="form-group col-md-6 col-12">
                      <label>โทรศัพท์</label>
                      <input type="text" name="phone" class="form-control" value="{{ $admin->phone }}">
                    </div>
                  </div>

              </div>
              <div class="card-footer text-right">
                <button class="btn btn-primary">บันทึก</button>
              </div>
            </form>
          </div>
        </div>

        <div class="col-12 col-md-12 col-lg-7">
            <div class="card">

              <form method="post" class="needs-validation" novalidate="" action="{{route('admin.password.update')}}" enctype="multipart/form-data">
                  @csrf
                <div class="card-header">
                  <h4>แก้ไขรหัสผ่าน</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                      <div class="form-group col-12">
                        <label>รหัสผ่านปัจจุบัน</label>
                        <input type="password" name="current_password" class="form-control">
                      </div>
                      <div class="form-group col-12">
                        <label>รหัสผ่านใหม่</label>
                        <input type="password" name="password" class="form-control">
                      </div>
                      <div class="form-group col-12">
                        <label>ยืนยันรหัสผ่าน</label>
                        <input type="password" name="password_confirmation" class="form-control">
                      </div>

                    </div>

                </div>
                <div class="card-footer text-right">
                  <button class="btn btn-primary">บันทึก</button>
                </div>
              </form>
            </div>
          </div>

      </div>
    </div>
</section>
@endsection
