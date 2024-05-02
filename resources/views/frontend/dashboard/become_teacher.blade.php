@extends('frontend.dashboard.layouts.master')

@section('content')
  <!--=============================
    DASHBOARD START
  ==============================-->
  <section id="wsus__dashboard">
    <div class="container-fluid">
        @include('frontend.dashboard.layouts.sidebar')

      <div class="row">
        <div class="col-xl-9 col-xxl-10 col-lg-9 ms-auto">
          <div class="dashboard_content mt-2 mt-md-0">
            <h3><i class="fas fa-solid fa-graduation-cap"></i> ขอเป็นผู้สอน</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <h4 class="mb-5">คำขอ</h4>
                @if ($becomeTeachers && $becomeTeachers->status == 'decline')
                    <span class="alert alert-danger">
                        คุณถูกปฏิเสธ กรุณาส่งคำขอมาใหม่
                    </span>
                @endif
                  <form action="{{route('user.become_teacher.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                              <i class="fas fa-solid fa-user"></i>
                              <input type="text" placeholder="Firstname" name="firstname" value="{{Auth::user()->firstname}}">
                            </div>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-solid fa-user"></i>
                              <input type="text" placeholder="Lastname" name="lastname" value="{{Auth::user()->lastname}}">
                            </div>
                        </div>
                        <div class="col-md-12 mt-5">
                            <i class="fas fa-info-circle"></i>
                            <label>รายละเอียด</label>
                            <textarea class="form-control" placeholder="Reason"name="reason" rows="3"></textarea>
                        </div>

                        <div class="col-md-12 mt-5">
                            <div class="wsus__dash_pro_single">
                                <i class="fas fa-solid fa-upload"></i>
                              <input type="file" placeholder="Uploads" name="pdf_path">
                            </div>
                        </div>
                        <div class="col-xl-12">
                            <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                          </div>
                    </div>
                    {{-- <div class="col-xl-12">
                      <button class="common_btn mb-4 mt-2" type="submit">upload</button>
                    </div> --}}
                  </form>
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