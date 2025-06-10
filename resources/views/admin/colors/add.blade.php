@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Colors','key'=> 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('colors.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên màu</label>
                            <input type="text"
                                class="form-control"
                                name="name"
                                placeholder="Nhập tên màu">
                        </div>
                        <div class="form-group">
                            <label>Mã màu</label>
                            <input type="text"
                                class="form-control"
                                name="code"
                                placeholder="Nhập mã màu">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection