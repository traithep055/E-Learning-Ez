@extends('admin.layouts.master')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>รายงานข้อมูลคอร์ส</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>คอร์สทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.all-course.report')}}" class="btn btn-primary" target="_blank"><i class="fas fa-solid fa-print"></i> พิมพ์รายงาน</a>                   
                            </div>
                            <form method="GET" action="{{ route('admin.all-course') }}">
                                <div class="row">
                                    <div class="col-md-5">
                                        <select id="inputState" class="form-control main-category" name="category_id">
                                        <option value="">เลือกหมวดหมู่</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-5">
                                        <select id="inputState" class="form-control sub-category" name="sub_category_id">
                                            <option value="">เลือกหมวดหมู่ย่อย</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary">กรอง</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th>#</th>
                                        <th>ชื่อคอร์ส</th>
                                        <th>จำนวนผู้เรียน</th>
                                        <th>ราคา</th>
                                        <th>ผู้สอน</th>
                                        <th>รายงานผู้เรียน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{$course->id}}</td>
                                            <td>{{$course->name}}</td>
                                            <td>{{$course->purchasedCourses->count()}} คน</td>
                                            <td>{{ $course->price }} บาท</td>
                                            <td>{{ $course->teacher->firstname }} {{ $course->teacher->lastname }}</td>
                                            <td>
                                                <a href="{{ route('admin.course.students-report', $course->id) }}" class="btn btn-primary" target="_blank">
                                                    ดูข้อมูลผู้เรียน
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$courses->links()}}
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
    $('body').on('change', '.main-category', function(e){
        let id = $(this).val();
        $.ajax({
            method: 'GET',
            url: "{{ route('admin.course.get-subcategories') }}",
            data: {
                id: id  // ใช้ category_id ในการส่ง
            },
            success: function(data){
                $('.sub-category').html('<option value="">เลือกหมวดหมู่ย่อย</option>')

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