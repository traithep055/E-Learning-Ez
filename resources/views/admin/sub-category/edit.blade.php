@extends('admin.layouts.master')

@section('content')
    <!-- Main Content --> 
    <section class="section">
        <div class="section-header">
            <h1>จัดการประเภทย่อย</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Create</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขประเภทย่อย</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sub-category.update', $subCategory->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">ประเภท</label>
                                    <select id="inputState" class="form-control select2" name="category">
                                        <option value="">Select</option>
                                        @foreach ($categories as $category)
                                        <option {{$category->id == $subCategory->category_id ? 'selected' : ''}} 
                                            value="{{$category->id}}">{{$category->name}}</option> 
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ชื่อประเภทย่อย</label>
                                    <input type="text" name="name" class="form-control" value="{{$subCategory->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">สถานะ</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$subCategory->status == 1 ? 'selected': ''}} value="1">Active</option>
                                        <option {{$subCategory->status == 0 ? 'selected': ''}} value="0">Inactive</option>
                                    </select>
                                  </div>
                                <button type="submit" class="btn btn-primary">บันทึก</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
