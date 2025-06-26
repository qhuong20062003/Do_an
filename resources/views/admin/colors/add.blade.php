@extends('admin.layouts.admin')

@section('title')
<title>Thêm màu sắc</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Màu sắc', 'key' => 'Thêm'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <h5 class="mb-4">Thêm màu sắc mới</h5>

                    <form action="{{ route('colors.store') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên màu</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên màu">
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="code" class="form-label">Mã màu</label>
                                <input type="text" class="form-control" id="code" name="code" placeholder="VD: #ff5733">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Thêm màu</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection