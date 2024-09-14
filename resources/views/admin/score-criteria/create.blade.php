@extends('admin.layouts.master')

@section('content')
    <!-- Main Content -->
    <section class="section">
        <div class="section-header">
            <h1>จัดการเกณฑ์การออกใบประกาศณียบัตร</h1>
            {{-- <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Create</div>
            </div> --}}
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>เพิ่มเกณฑ์</h4>
                        </div>
                        <div class="card-body">
                            <form action="{{route('admin.scorecriteria.store')}}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label>เกณฑ์ใบประกาศณียบัตร %</label>
                                    <input type="number" name="criteria" class="form-control">
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
