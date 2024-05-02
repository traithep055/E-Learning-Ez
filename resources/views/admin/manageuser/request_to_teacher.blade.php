@extends('admin.layouts.master')

@section('content')
    <!-- Main Content --> 
    <section class="section">
        <div class="section-header">
            <h1>จัดการผู้ใช้</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>คำขอเป็นผู้สอน</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">รายละเอียด</th>
                                        <th scope="col">Publish Date</th>
                                        <th scope="col">การอนุมัติ</th>
                                        <th scope="col">เอกสาร</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($becomeTeachers as $becomeTeacher)
                                    <tr>
                                        <td>{{ $becomeTeacher->id }}</td>
                                        <td>
                                            @if ($becomeTeacher->user)
                                                {{ $becomeTeacher->user->firstname }} {{ $becomeTeacher->user->lastname }}
                                            @else
                                                No User Found
                                            @endif
                                        </td>
                                        <td>{{ $becomeTeacher->reason }}</td>
                                        <td>{{ $becomeTeacher->updated_at->format('d-m-Y') }}</td>
                                        <td>
                                            {{-- <a href="{{route('admin.managebecome_teacher.approve', $becomeTeacher->id)}}" class="btn btn-success mx-1">อนุมัติ</a> --}}
                                            <a href="{{ route('admin.managebecome_teacher.approve', $becomeTeacher->id) }}" class="btn btn-success mx-1"
                                                onclick="event.preventDefault();
                                                document.getElementById('approve-form-{{ $becomeTeacher->id }}').submit();">
                                                อนุมัติ
                                            </a>
                                            
                                            <form id="approve-form-{{ $becomeTeacher->id }}" action="{{ route('admin.managebecome_teacher.approve', $becomeTeacher->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                            
                                            <a href="{{ route('admin.managebecome_teacher.decline', $becomeTeacher->id) }}" class="btn btn-danger mx-1"
                                                onclick="event.preventDefault();
                                                document.getElementById('decline-form-{{ $becomeTeacher->id }}').submit();">
                                                ปฎิเสธ
                                            </a>
                                            
                                            <form id="decline-form-{{ $becomeTeacher->id }}" action="{{ route('admin.managebecome_teacher.decline', $becomeTeacher->id) }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </td>
                                        <td>
                                            @if ($becomeTeacher->pdf_path)
                                                <a href="{{route('admin.managebecome_teacher.download', $becomeTeacher->id)}}" class="btn btn-sm btn-secondary">
                                                    <i class="fas fa-download"></i> ดาวน์โหลดไฟล์
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach


                                </tbody>
                            </table>
                            {{$becomeTeachers->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
