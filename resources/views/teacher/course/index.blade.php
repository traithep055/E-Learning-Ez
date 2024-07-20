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
            <h3><i class="far fa-solid fa-book"></i> คอร์ส</h3>
            <div class="create_button">
                <a href="{{route('teacher.courses.create')}}" class="btn btn-primary"><i class="fas fa-plus"></i> สร้างคอร์ส</a>
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

    <script>
      $(document).ready(function(){
  
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });
  
          $('body').on('click', '.change-status', function(){
              let isChecked = $(this).is(':checked');
              let id = $(this).data('id');
  
              $.ajax({
                  url: "{{route('teacher.course.change-status')}}",
                  method: 'PUT',
                  data: {
                      status: isChecked,
                      id: id
                  },
                  success: function(data){
                      toastr.success(data.message)
                  },
                  error: function(xhr, status, error){
                      console.log(error);
                  }
              })
  
          })
      })
  </script>
@endpush
