@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Colors','key'=> 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <a href="{{ route('colors.create') }}" class="btn btn-success">Add</a>
                </div>
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col"></th>
                                <th scope="col">Tên màu sắc</th>
                                <th scope="col">Mã màu sắc</th>
                                <th scope="col">Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($colors) && !empty($colors))
                            @foreach($colors as $color)
                            <tr>
                                <th scope="row">{{ $color->id }}</th>
                                <td>
                                    <div style="width: 60px; height: 30px; background-color: {{ $color->code }}; border: 1px solid #ccc; border-radius: 4px;"></div>
                                </td>
                                <td>{{ $color->name }}</td>
                                <td>{{ $color->code }}</td>
                                <td>
                                    <a href="{{ route('colors.edit',[ 'id' => $color->id ]) }}" class="btn btn-default">Sửa</a>
                                    <a onclick="return confirm('Bạn có chắc chắn muốn xóa màu sắc này không?')" href="{{ route('colors.delete',[ 'id' => $color->id ]) }}" class="btn btn-danger">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
                @if(isset($colors) && !empty($colors))
                <div class="col-md-12">
                    {{ $colors->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection