@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Sizes','key'=> 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('sizes.create') }}" class="btn btn-success">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên size</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($sizes) && !empty($sizes))
                            @foreach($sizes as $size)
                            <tr>
                                <th scope="row">{{ $size->id }}</th>
                                <td>{{ $size->name }}</td>
                                <td>
                                    <a href="{{ route('sizes.edit',[ 'id' => $size->id ]) }}" class="btn btn-default">Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa size này không?')" href="{{ route('sizes.delete',[ 'id' => $size->id ]) }}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($sizes) && !empty($sizes))
                <div class="col-md-12">
                    {{ $sizes->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection