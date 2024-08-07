@extends('admin.layouts.master')

@section('content')
    <!-- Main Content --> 
    <section class="section">
        <div class="section-header">
            <h1>จัดการประเภทคอร์ส</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ประเภททั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.category.create')}}" class="btn btn-primary">+ เพิ่มประเภท</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col" style="width: 100px">#</th>
                                        <th scope="col">ชื่อประเภท</th>
                                        <th scope="col" style="width: 200px">สถานะ</th>
                                        {{-- <th scope="col">Publish Date</th> --}}
                                        <th scope="col" style="width: 200px">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>
                                                {{ $category->name }}
                                            </td>
                                            <td>
                                                @if ($category->status == 1)
                                                    <label class="custom-switch mt2">
                                                        <input type="checkbox" checked name="custom-switch-checkbox" data-id="{{$category->id}}" class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch mt2">
                                                        <input type="checkbox" name="custom-switch-checkbox" data-id="{{$category->id}}" class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>
                                            {{-- <td>{{ $category->created_at->format('d-m-Y') }}</td> --}}
                                            <td>
                                                <a href="{{route('admin.category.edit', $category->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                <a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-danger ml-2 delete-item"><i class="far fa-trash-alt"></i></a>
                                                {{-- <a href="{{ route('admin.category.destroy', $category->id) }}" class="btn btn-danger ml-2 delete-item"
                                                    onclick="event.preventDefault();
                                                    document.getElementById('delete-form-{{ $category->id }}').submit();">
                                                    <i class="far fa-trash-alt"></i>
                                                </a> --}}

                                                {{-- <form id="delete-form-{{ $category->id }}" action="{{ route('admin.category.destroy', $category->id) }}" method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>                                                 --}}
                                                
                                            </td>
                                            
                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            {{$categories->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
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
                url: "{{route('admin.category.change-status')}}",
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