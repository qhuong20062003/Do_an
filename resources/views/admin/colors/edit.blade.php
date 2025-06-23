@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Colors','key'=> 'Edit'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('colors.update', ['id' => $color->id]) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Màu thực tế</label>
                            <div style="width: 60px; height: 30px; background-color: {{ $color->code }}; border: 1px solid #ccc; border-radius: 4px;"></div>
                        </div>
                        <div class="form-group">
                            <label>Tên màu</label>
                            <input type="text"
                                class="form-control"
                                name="name"
                                value="{{ $color->name }}">
                        </div>
                        <div class="form-group">
                            <label>Mã màu</label>
                            <input type="text"
                                class="form-control"
                                name="code"
                                value="{{ $color->code }}">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection