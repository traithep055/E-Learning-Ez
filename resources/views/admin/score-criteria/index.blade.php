@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการเกณฑ์การออกใบประกาศณียบัตร</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>เกณฑ์ใบประกาศณียบัตร</h4>
                            <div class="card-header-action">
                                <a href="{{route('admin.scorecriteria.create')}}" class="btn btn-primary">+ เพิ่มเกณฑ์</a>
                                {{-- @if ($criterias->isEmpty())
                                    <a href="{{ route('admin.scorecriteria.create') }}" class="btn btn-primary">+ เพิ่มเกณฑ์</a>
                                @endif --}}
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped table-bordered border-dark">
                                <thead style="background: #f2f2f2">
                                    <tr>
                                        <th scope="col" style="width: 100px">#</th>
                                        <th scope="col">เกณฑ์การผ่าน</th>
                                        <th scope="col">วันที่กำหนดเกณฑ์</th>
                                        <th scope="col" style="width: 200px">ใช้งาน</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($criterias as $criteria)
                                        <tr>
                                            <td>{{$criteria->id}}</td>
                                            <td>
                                                {{$criteria->criteria}} %
                                            </td>
                                            <td>{{ $criteria->created_at->format('d-m-Y') }}</td>
                                            <td>
                                                <a href="{{route('admin.scorecriteria.edit', $criteria->id)}}" class="btn btn-warning"><i class="far fa-edit"></i></a>
                                            </td>

                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

