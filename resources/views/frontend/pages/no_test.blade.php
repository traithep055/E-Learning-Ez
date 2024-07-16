@extends('frontend.layouts.master')

@section('content')
<div class="container mt-8">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="mb-4"><i class="fas fa-graduation-cap"></i> {{ $course->name }}</h3>
                </div>
                <div class="card-body">
                    <p>แบบทดสอบยังไม่พร้อมสำหรับคอร์สนี้ กรุณาลองใหม่ในภายหลัง</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
