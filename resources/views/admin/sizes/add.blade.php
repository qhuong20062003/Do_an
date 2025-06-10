@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Sizes','key'=> 'Add'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <form action="{{ route('sizes.store') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>Tên size</label>
                            <input type="text"
                                class="form-control"
                                name="name"
                                placeholder="Nhập tên size">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection