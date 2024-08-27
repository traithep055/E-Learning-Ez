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
                            <h4>แก้ไขหมวดหมู่ย่อย</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.sub-category.update', $subCategory->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="inputState">หมวดหมู่หลัก</label>
                                    <select id="inputState" class="form-control select2" name="category">
                                        <option value="">เลือก</option>
                                        @foreach ($categories as $category)
                                            <option {{ $category->id == $subCategory->category_id ? 'selected' : '' }}
                                                value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>ชื่อหมวดหมู่ย่อย</label>
                                    <input type="text" name="name" class="form-control"
                                        value="{{ $subCategory->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="inputState">การทำงาน</label>
                                    <select id="inputState" class="form-control" name="status">
                                        <option {{ $subCategory->status == 1 ? 'selected' : '' }} value="1">เปิดใช้งาน
                                        </option>
                                        <option {{ $subCategory->status == 0 ? 'selected' : '' }} value="0">ปิดใช้งาน
                                        </option>
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
