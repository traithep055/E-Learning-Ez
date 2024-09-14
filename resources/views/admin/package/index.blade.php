@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการแพ็คเกจ</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>แพ็คเกจทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.package.create')}}" class="btn btn-primary">+ เพิ่มแพ็ตเกจ</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col" style="width: 100px">#</th>
                                        <th scope="col">ชื่อแพ็คเกจ</th>
                                        <th scope="col">ส่วนลด %</th>
                                        <th scope="col" style="width: 200px">ระยะเวลา</th>
                                        <th scope="col">ราคา</th>
                                        <th scope="col">สร้างเมื่อวันที่</th>
                                        <th scope="col" style="width: 200px">หมายเหตุ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->id }}</td>
                                            <td>
                                                {{ $package->name }}
                                            </td>
                                            <td>
                                                {{ number_format($package->discount, 0) }} %
                                            </td>
                                            <td>
                                                @switch($package->duration)
                                                    @case('1_year')
                                                        1 ปี
                                                        @break
                                                    @case('2_years')
                                                        2 ปี
                                                        @break
                                                    @case('3_years')
                                                        3 ปี
                                                        @break
                                                    @default

                                                @endswitch
                                            </td>
                                            <td>
                                                {{ $package->price }}
                                            </td>
                                            <td>{{ $package->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{route('admin.package.edit', $package->id)}}" class="btn btn-warning" style='background-color: #ffc107;'><i class="far fa-edit"></i></a>
                                                <a href="{{route('admin.package.destroy', $package->id)}}" class="btn btn-danger ml-2 delete-item" style='background-color: #e74c3c;'><i class="far fa-trash-alt"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                            {{$packages->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')


@endpush
