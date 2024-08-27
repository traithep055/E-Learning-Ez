@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการหมวดหมู่คอร์ส</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>แก้ไขหมวดหมู่</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.category.update', $category->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>ชื่อหมวดหมู่</label>
                                    <input type="text" name="name" class="form-control" value="{{$category->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">สถานะ</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{$category->status == 1 ? 'selected': ''}} value="1">เปิดใช้งาน</option>
                                        <option {{$category->status == 0 ? 'selected': ''}} value="0">ปิดใช้งาน</option>
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
