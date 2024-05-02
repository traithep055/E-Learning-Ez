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
            <h3><i class="far fa-solid fa-book"></i> แก้ไขบทเรียน</h3>
            <h4>For {{$lesson->lesson_name}}</h4>
            <div class="create_button">
                <a href="{{ route('teacher.lesson.index', ['course' => $course->id]) }}" class="btn btn-primary"><i class="fas fa-solid fa-arrow-left"></i></a>
            </div>
            <div class="wsus__dashboard_profile mt-4">
              <div class="wsus__dash_pro_area">
                <form action="{{ route('teacher.lesson.update', [$lesson->id, 'course' => $course->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group wsus__input">
                        <label>ชื่อบทเรียน</label>
                        <input type="text" class="form-control" name="lesson_name" value="{{$lesson->lesson_name}}">
                    </div>


                    <div class="form-group wsus__input">
                        <label>คำอธิบาย</label>
                        <textarea name="description" class="form-control summernote">{{$lesson->description}}</textarea>
                    </div>

                    <div class="form-group wsus__input">
                      <label>ไฟล์เอกสาร</label>
                      @if ($lesson->file_doc ==! null)
                        <code>({{$lesson->file_doc}})</code>
                      @endif
                      <input type="file" class="form-control" name="file_doc">
                  </div>

                  <div class="form-group wsus__input">
                      <label>ลิงค์วิดีโอ</label>
                      <input type="text" class="form-control" name="video_url" value="{{$lesson->video_url}}">
                  </div>

                  <div class="form-group wsus__input">
                      <label>ไฟล์วิดีโอ</label>
                      @if ($lesson->video_path ==! null)
                        <code>({{$lesson->video_path}})</code>
                      @endif
                      <input type="file" class="form-control" name="video_path">
                  </div>

                    <button type="submmit" class="btn btn-primary mt-4">บันทึก</button>
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
    {{-- <script>
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
    </script> --}}
@endpush
