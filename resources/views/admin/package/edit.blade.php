@extends('admin.layouts.master')

@section('content')
    <!-- Main Content --> 
    <section class="section">
        <div class="section-header">
            <h1>จัดการแพ็คเกจ</h1>
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
                            <h4>แก้ไขแพ็คเกจ</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.package.update', $package->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>ชื่อแพ็คเกจ</label>
                                    <input type="text" name="name" class="form-control" value="{{$package->name}}">
                                </div>

                                <div class="form-group">
                                    <label for="description">คำอธิบาย:</label>
                                    <textarea name="description" id="description" class="form-control" required>{{$package->description}}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="duration">ระยะเวลา:</label>
                                    <select id="inputState" class="form-control" name="duration">
                                        <option value="">Select</option>
                                        <option {{$package->duration == '1_year' ? 'selected': ''}} value="1_year">1 ปี</option>
                                        <option {{$package->duration == '2_years' ? 'selected': ''}} value="2_years">2 ปี</option>
                                        <option {{$package->duration == '3_years' ? 'selected': ''}} value="3_years">3 ปี</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>ราคา</label>
                                    <input type="number" name="price" id="price" step="0.01" class="form-control" value="{{$package->price}}" required>
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
