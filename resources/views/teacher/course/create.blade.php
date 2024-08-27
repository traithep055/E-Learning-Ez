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
            <h3><i class="far fa-solid fa-book"></i>เพิ่มคอร์ส</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('teacher.courses.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group wsus__input">
                        <label>รูปปกคอร์สเรียน</label>
                        <input type="file" class="form-control" name="image">
                    </div>
                    <div class="form-group wsus__input">
                        <label>ชื่อคอร์สเรียน</label>
                        <input type="text" class="form-control" name="name" value="{{old('name')}}">
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">หมวดหมู่หลักของคอร์ส</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option value="">เลือก</option>
                                  @foreach ($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">หมวดหมู่ย่อย</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                    <option value="">เลือก</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">ระดับคอร์สเรียน</label>
                                <select id="inputState" class="form-control child-category" name="level">
                                    <option value="">เลือก</option>
                                    <option value="basic">ระดับพื้นฐาน</option>
                                    <option value="advance">ระดับสูง</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group wsus__input">
                        <label>จำนวนชั่วโมงเรียน</label>
                        <input type="number" class="form-control" name="hours" value="{{ old('hours') }}" step="0.01">
                    </div>

                    <div class="form-group wsus__input">
                        <label>ราคาคอร์สเรียน</label>
                        <input type="text" class="form-control" name="price" value="{{old('price')}}">
                    </div>

                    {{-- <div class="form-group wsus__input">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{old('offer_price')}}">
                    </div> --}}

                    <div class="form-group wsus__input">
                        <label>คำอธิบายเพิ่มเติมสำหรับคอร์ส</label>
                        <textarea name="content" class="form-control summernote"></textarea>
                    </div>

                        {{-- <div class="form-group wsus__input mt-4">
                            <label for="inputState">Product Type</label>
                            <select id="inputState" class="form-control" name="course_type">
                                <option value="">Select</option>
                                <option value="new_arrival">New Arrival</option>
                                <option value="top_course">Top Course</option>

                            </select>
                        </div> --}}

                    <div class="form-group wsus__input">
                        <label for="inputState">สถานะการทำงานของคอร์ส</label>
                        <select id="inputState" class="form-control" name="status">
                          <option value="1">เปิดสอน</option>
                          <option value="0">ปิดการสอน</option>
                        </select>
                    </div>
                    <button type="submmit" class="btn btn-primary">บันทึก</button>
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

@push('scripts')
    <script>
        $(document).ready(function(){
            $('body').on('change', '.main-category', function(e){
                let id = $(this).val();
                $.ajax({
                    method: 'GET',
                    url: "{{route('teacher.course.get-subcategories')}}",
                    data: {
                        id:id
                    },
                    success: function(data){
                        $('.sub-category').html('<option value="">Select</option>')

                        $.each(data, function(i, item){
                            $('.sub-category').append(`<option value="${item.id}">${item.name}</option>`)
                        })
                    },
                    error: function(xhr, status, error){
                        console.log(error);
                    }
                })
            })

        })
    </script>
@endpush
