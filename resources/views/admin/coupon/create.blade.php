@extends('admin.layouts.master')

@section('content')
    <!-- Main Content --> 
    <section class="section">
        <div class="section-header">
            <h1>จัดการคูปองส่วนลด</h1>
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
                            <h4>เพิ่มคูปอง</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.coupons.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>คูปองโค้ด</label>
                                    <input type="text" name="code" class="form-control" value="">
                                </div>
                                
                                <div class="form-group">
                                    <label>จำนวนส่วนลด</label>
                                    <input type="number" step="0.01" name="discount" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label>ส่วนลดเปอร์เซ็นต์ %</label>
                                    <input type="number" step="0.01" name="discount_percentage" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label>หมดอายุ ณ</label>
                                    <input type="datetime-local" name="expires_at" class="form-control" value="">
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
