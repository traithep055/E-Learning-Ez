@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>รายงานการซื้อคอร์สทั้งหมด</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>รายการซื้อคอร์ส</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">หมายเลขใบเสร็จ</th>
                                        <th scope="col">ชื่อคอร์ส</th>
                                        <th scope="col">ราคาคอร์ส</th>
                                        <th scope="col">ส่วนลด</th>
                                        <th scope="col">ราคาหลังหักส่วนลด</th>
                                        <th scope="col">ยืนยันการโอน</th>
                                        <th scope="col">วันที่</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bills as $bill)
                                        <tr>
                                            <td>{{ $bill->order_number }}</td>
                                            <td>
                                                {{ $bill->course->name }}
                                            </td>
                                            <td>
                                                {{ $bill->price }} บาท
                                            </td>
                                            <td>
                                                {{ $bill->price - $bill->final_price }}  บาท
                                            </td>

                                            <td>
                                                {{ $bill->final_price }} บาท
                                            </td>
                                            <td>
                                                <a href="{{ $bill->slip_image }}" data-lightbox="slip-image" data-title="{{ $bill->course->name }}">
                                                    <img src="{{ $bill->slip_image }}" alt="" style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
                                                </a>
                                            </td>
                                            <td>
                                                {{ date('d-m-Y', strtotime($bill->created_at)) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$bills->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
