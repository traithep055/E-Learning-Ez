@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>รายงานข้อมูลคอร์ส</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>คอร์สทั้งหมด</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ชื่อคอร์ส</th>
                                        <th scope="col">จำนวนผู้เรียน</th>
                                        <th scope="col">ราคา</th>
                                        {{-- <th scope="col">Course Type</th> --}}
                                        <th scope="col">ผู้สอน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($courses as $course)
                                        <tr>
                                            <td>{{$course->id}}</td>
                                            <td>
                                                {{$course->name}}
                                            </td>
                                            <td>
                                                {{$course->purchasedCourses->count()}} คน
                                            </td>
                                            <td>
                                                {{ $course->price }} บาท
                                            </td>
                                            {{-- <td>
                                                @switch($course->course_type)
                                                    @case('new_arrival')
                                                        <i class="badge bg-success">New Arrival</i>
                                                        @break
                                                    @case('top_course')
                                                        <i class="badge bg-info text-dark">Top Course</i>
                                                        @break
                                                    @default
                                                        <i class="badge bg-dark">None</i>
                                                        @break
                                                @endswitch
                                            </td> --}}

                                            <td>
                                                {{ $course->teacher->firstname }} {{ $course->teacher->lastname }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$courses->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    {{-- {{ $dataTable->scripts(attributes: ['type' => 'module']) }}  --}}
@endpush
