@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>ผู้ใช้ทั้งหมด</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>ผู้ดูแลระบบทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.admin-report.pdf')}}" class="btn btn-primary" target="_blank"><i class="fas fa-solid fa-print"></i> พิมพ์รายงาน</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ภาพ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">อีเมลล์</th>
                                        <th scope="col">โทรศัพท์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td>{{ $admin->id }}</td>
                                            <td>
                                                <img src="{{ $admin->image }}" alt="" width="60">
                                            </td>
                                            <td>
                                                {{ $admin->firstname }} {{ $admin->lastname }}
                                            </td>

                                            <td>
                                                {{ $admin->user->email }}
                                            </td>
                                            <td>
                                                {{ $admin->phone }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$admins->links()}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>ผู้สอนทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.teacher-report.pdf')}}" class="btn btn-primary" target="_blank"><i class="fas fa-solid fa-print"></i> พิมพ์รายงาน</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ภาพ</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">อีเมลล์</th>
                                        <th scope="col">โทรศัพท์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td>{{ $teacher->id }}</td>
                                            <td>
                                                @if ($teacher->image == null)
                                                    <img src="{{ $teacher->user->image }}" alt="" width="60">
                                                @else
                                                    <img src="{{ $teacher->image }}" alt="" width="60">
                                                @endif
                                                {{-- <img src="{{ $teacher->image }}" alt="" width="60"> --}}
                                            </td>
                                            <td>
                                                {{ $teacher->firstname }} {{ $teacher->lastname }}
                                            </td>

                                            <td>
                                                {{ $teacher->user->email }}
                                            </td>
                                            <td>
                                                {{ $teacher->phone }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$teachers->links()}}
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4>ผู้เรียนทั้งหมด</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.user-report.pdf')}}" class="btn btn-primary" target="_blank"><i class="fas fa-solid fa-print"></i> พิมพ์รายงาน</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">ภาพ</th>
                                        <th scope="col">ชื่อผู้ใช้</th>
                                        <th scope="col">ชื่อ-นามสกุล</th>
                                        <th scope="col">อีเมลล์</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>
                                                <img src="{{ $user->image }}" alt="" width="60">
                                            </td>
                                            <td>
                                                {{ $user->name }}
                                            </td>
                                            <td>
                                                {{ $user->firstname }} {{ $user->lastname }}
                                            </td>

                                            <td>
                                                {{ $user->email }}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{$users->links()}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')

@endpush
