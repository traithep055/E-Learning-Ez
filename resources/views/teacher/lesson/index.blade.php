@extends('teacher.layouts.master')

{{-- @section('title')
{{$settings->site_name}} || Product
@endsection --}}

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
            <h3><i class="far fa-solid fa-book"></i> บทเรียน</h3>
            <p>ชื่อคอร์ส: {{$course->name}}</p>
            <div class="create_button">
                <a href="{{ route('teacher.lesson.create', ['course' => $course->id]) }}" class="btn btn-primary"><i class="fas fa-plus"></i> สร้างบทเรียน</a>
            </div>
            <div class="wsus__dashboard_profile">
              <div class="wsus__dash_pro_area">
                {{ $dataTable->table() }}
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
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

  {{-- delete Filedoc --}}
  <script>

    $(document).ready(function(){
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                // เพิ่ม event listener สำหรับปุ่ม delete-filedoc
          // After your DataTable initialization script
        $('body').on('click', '.delete-filedoc', function(event){
            event.preventDefault();
    
            let lessonId = $(this).data('id');
            let deleteUrl = "{{ route('teacher.lesson.del-doc', ':id') }}".replace(':id', lessonId);
    
            $.ajax({
                type: 'PUT',
                url: deleteUrl,
                success: function(response) {
                    if (response.status === 'success') {
                        toastr.success(response.message);
                        // Optionally, you can update the DataTable after successful deletion
                        $('#lesson-table').DataTable().ajax.reload();
                    } else {
                        toastr.error(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    toastr.error('Something went wrong!');
                }
                  });
                });
    
              })   
      </script>

      {{-- delete Filedoc --}}
      <script>

        $(document).ready(function(){
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
              // เพิ่ม event listener สำหรับปุ่ม delete-filevideo
              // After your DataTable initialization script
            $('body').on('click', '.delete-filevideo', function(event){
                event.preventDefault();
        
                let lessonId = $(this).data('id');
                let deleteUrl = "{{ route('teacher.lesson.del-video', ':id') }}".replace(':id', lessonId);
        
                $.ajax({
                    type: 'PUT',
                    url: deleteUrl,
                    success: function(response) {
                        if (response.status === 'success') {
                            toastr.success(response.message);
                            // Optionally, you can update the DataTable after successful deletion
                            $('#lesson-table').DataTable().ajax.reload();
                        } else {
                            toastr.error(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                        toastr.error('Something went wrong!');
                    }
                      });
                    });
        
                  })   
        </script>
@endpush
