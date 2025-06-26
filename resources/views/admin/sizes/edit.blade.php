@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa kích thước</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Chỉnh sửa', 'key' => 'kích thước'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('sizes.update', ['id' => $size->id]) }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên size</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ $size->name }}">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection