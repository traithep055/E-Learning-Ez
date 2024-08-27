@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการคูปองส่วนลด</h1>
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
                                    <label>โค้ดคูปอง</label>
                                    <input type="text" name="code" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label>จำนวนส่วนลดเป็นเงิน</label>
                                    <input type="number" step="0.01" name="discount" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label>ส่วนลดเปอร์เซ็นต์ %</label>
                                    <input type="number" step="0.01" name="discount_percentage" class="form-control" value="">
                                </div>

                                <div class="form-group">
                                    <label>หมดอายุ ณ วันที่</label>
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
