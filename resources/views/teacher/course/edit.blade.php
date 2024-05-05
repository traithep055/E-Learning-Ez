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
            <h3><i class="far fa-solid fa-book"></i> แก้ไขคอร์ส</h3>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                <form action="{{route('teacher.courses.update', $course->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>Preview</label>
                        <br>
                        <img src="{{asset($course->image)}}" style="width:200px" alt="">
                    </div>
                    
                    <div class="form-group wsus__input">
                        <label>รูปภาพ</label>
                        <input type="file" class="form-control" name="image">
                    </div>

                    <div class="form-group wsus__input">
                        <label>ชื่อ</label>
                        <input type="text" class="form-control" name="name" value="{{$course->name}}">
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">ประเภท</label>
                                <select id="inputState" class="form-control main-category" name="category">
                                  <option value="">Select</option>
                                  @foreach ($categories as $category)
                                    <option {{$category->id == $course->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                  @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">ประเภทย่อย</label>
                                <select id="inputState" class="form-control sub-category" name="sub_category">
                                    <option value="">Select</option>
                                    @foreach ($subCategories as $subCategory)
                                    <option {{$subCategory->id == $course->sub_category_id ? 'selected' : ''}} value="{{$subCategory->id}}">{{$subCategory->name}}</option>
                                    @endforeach
                                </select>
                            </div>                            
                        </div>

                        <div class="col-md-4">
                            <div class="form-group wsus__input">
                                <label for="inputState">ระดับ</label>
                                <select id="inputState" class="form-control child-category" name="level">
                                    <option value="">Select</option>
                                    <option {{$course->level == 'พื้นฐาน' ? 'selected' : ''}} value="พื้นฐาน">พื้นฐาน</option>
                                    <option {{$course->level == 'สูง' ? 'selected' : ''}} value="สูง">สูง</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="form-group wsus__input">
                        <label>SKU</label>
                        <input type="text" class="form-control" name="sku" value="{{$course->sku}}">
                    </div> --}}

                    <div class="form-group wsus__input">
                        <label>ราคา</label>
                        <input type="text" class="form-control" name="price" value="{{$course->price}}">
                    </div>

                    {{-- <div class="form-group wsus__input">
                        <label>Offer Price</label>
                        <input type="text" class="form-control" name="offer_price" value="{{$course->offer_price}}">
                    </div> --}}

                    <div class="form-group wsus__input">
                        <label>คำอธิบายคอร์ส</label>
                        <textarea name="content" class="form-control summernote">{{ $course->content }}</textarea>
                    </div>

                        {{-- <div class="form-group wsus__input mt-4">
                            <label for="inputState">Product Type</label>
                            <select id="inputState" class="form-control" name="course_type">
                                <option value="">Select</option>
                                <option {{$course->course_type == 'new_arrival' ? 'selected' : ''}} value="new_arrival">New Arrival</option>
                                <option {{$course->course_type == 'top_course' ? 'selected' : ''}} value="top_course">Top Course</option>

                            </select>
                        </div> --}}

                    <div class="form-group wsus__input">
                        <label for="inputState">สถานะ</label>
                        <select id="inputState" class="form-control" name="status">
                          <option {{$course->status == '1' ? 'selected' : ''}} value="1">Active</option>
                          <option {{$course->status == '0' ? 'selected' : ''}} value="0">Inactive</option>
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
