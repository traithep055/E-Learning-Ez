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
                            <h4>แก้ไขเกณฑ์</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.scorecriteria.update', $criteria->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label>เกณฑ์ใบประกาศณียบัตร %</label>
                                    <input type="number" name="criteria" class="form-control" value="{{$criteria->criteria}}">
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
