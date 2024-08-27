@extends('teacher.layouts.master')

@section('content')
      <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('teacher.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="far fa-user"></i>โปรไฟล์</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4>ข้อมูลพื้นฐาน</h4>

                  <form action="{{route('teacher.profile.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="col-md-12">
                      <div class="col-md-2">
                        <div class="wsus__dash_pro_img">
                          <img src="{{$teacher->image ? asset($teacher->image) : asset(Auth::user()->image)}}" alt="img" class="img-fluid w-100">
                          <input type="file" name="image">
                        </div>
                      </div>
                        <div class="col-md-12 mt-5">
                          <div class="wsus__dash_pro_single">
                            <i class="fas fa-user-tie"></i>
                            <input type="text" placeholder="Name" name="name" value="{{Auth::user()->name}}">
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="wsus__dash_pro_single">
                            <i class="fal fa-envelope-open"></i>
                            <input type="email" placeholder="Email" name="email" value="{{Auth::user()->email}}">
                          </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-solid fa-user"></i>
                              <input type="text" placeholder="ชื่อ" name="firstname" value="{{ $teacher->firstname }}">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-solid fa-user"></i>
                              <input type="text" placeholder="นามสกุล" name="lastname" value="{{ $teacher->lastname }}">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-solid fa-phone"></i>
                              <input type="text" placeholder="เบอร์โทรศัพท์" name="phone" value="{{$teacher->phone}}">
                            </div>
                        </div>
                        <div class="from-group wsus__input">
                          <i class="fas fa-solid fa-graduation-cap"></i>
                          <label>ประวัติเพิ่มเติม</label>
                          <textarea name="education" cols="10" rows="10" class="form-control summernote">{{ $teacher->education }}</textarea>
                        </div>
                    </div>
                    <div class="col-xl-12">
                      <button class="common_btn mb-4 mt-2" type="submit">บันทึกข้อมูล</button>
                    </div>
                  </form>

                    <div class="wsus__dash_pass_change mt-2">
                      <form action="{{route('teacher.profile.update.password')}}" method="POST">
                        @csrf
                        <div class="row">
                          <h4>แก้ไขรหัสผ่าน</h4>
                          <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-unlock-alt"></i>
                              <input type="password" placeholder="รหัสผ่านเดิม" name="current_password">
                            </div>
                          </div>
                          <div class="col-xl-4 col-md-6">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-lock-alt"></i>
                              <input type="password" placeholder="รหัสผ่านใหม่" name="password">
                            </div>
                          </div>
                          <div class="col-xl-4">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-lock-alt"></i>
                              <input type="password" placeholder="ยืนยันรหัสผ่าน" name="password_confirmation">
                            </div>
                          </div>
                          <div class="col-xl-12">
                            <button class="common_btn" type="submit">บันทึกข้อมูล</button>
                          </div>
                        </div>
                      </form>
                    </div>


              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--=============================
    DASHBOARD START
  ==============================-->
@endsection
