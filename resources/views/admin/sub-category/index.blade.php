@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จักการหมวดหมู่ย่อย</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>หมวดหมู่ย่อยทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.sub-category.create')}}" class="btn btn-primary">+ เพิ่มหมวดหมู่ย่อย</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col" style="width: 100px">#</th>
                                        <th scope="col">ชื่อหมวดหมู่ย่อย</th>
                                        {{-- <th scope="col">Slug</th> --}}
                                        <th scope="col">หมวดหมู่หลัก</th>
                                        <th scope="col" style="width: 200px">การทำงาน</th>
                                        {{-- <th scope="col">Publish Date</th> --}}
                                        <th scope="col" style="width: 200px">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($subcategories as $subcategory)
                                        <tr>
                                            <td>{{$subcategory->id}}</td>
                                            <td>
                                                {{ $subcategory->name }}
                                            </td>
                                            {{-- <td>
                                                {{ $subcategory->slug }}
                                            </td> --}}
                                            {{-- <td>{{ $category->created_at->format('d-m-Y') }}</td> --}}
                                            <td>
                                                {{ $subcategory->category->name }}
                                            </td>
                                            <td>
                                                @if ($subcategory->status == 1)
                                                    <label class="custom-switch mt2">
                                                        <input type="checkbox" checked name="custom-switch-checkbox" data-id="{{$subcategory->id}}" class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @else
                                                    <label class="custom-switch mt2">
                                                        <input type="checkbox" name="custom-switch-checkbox" data-id="{{$subcategory->id}}" class="custom-switch-input change-status">
                                                        <span class="custom-switch-indicator"></span>
                                                    </label>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{route('admin.sub-category.edit', $subcategory->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                                <a href="{{route('admin.sub-category.destroy', $subcategory->id)}}" class="btn btn-danger ml-2 delete-item"><i class="far fa-trash-alt"></i></a>
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
                            {{$subcategories->links()}}
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
                url: "{{route('admin.sub-category.change-status')}}",
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
