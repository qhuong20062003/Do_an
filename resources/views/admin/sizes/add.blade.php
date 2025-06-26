@extends('admin.layouts.admin')

@section('title')
<title>Thêm kích thước</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Thêm', 'key' => 'kích thước'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('sizes.store') }}" method="post">
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="name" class="form-label">Tên size</label>
                                <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên size">
                            </div>
                        </div>

                        <div class="text-end">
                            <button type="submit" class="btn btn-primary">Thêm size</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection