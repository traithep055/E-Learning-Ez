@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการหมวดหมู่ย่อย</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>เพิ่มหมวดหมู่ย่อย</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.sub-category.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="inputState">หมวดหมู่หลัก</label>
                                    <select id="inputState" class="form-control select2" name="category">
                                        <option value="">เลือก</option>
                                        @foreach ($categories as $category)
                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ชื่อหมวดหมู่ย่อย</label>
                                    <input type="text" name="name" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">การทำงาน</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option value="1">เปิดใช้งาน</option>
                                        <option value="0">ปิดใช้งาน</option>
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
