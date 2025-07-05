@extends('admin.layouts.admin')

@section('title')
<title>Danh sách màu sắc</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'màu sắc'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12 mb-3 text-end">
                    <a href="{{ route('colors.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm màu sắc
                    </a>
                </div>

                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Danh sách màu sắc</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mẫu màu</th>
                                        <th>Tên màu</th>
                                        <th>Mã màu</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($colors as $color)
                                    <tr>
                                        <td>{{ ($colors->currentPage() - 1) * $colors->perPage() + $loop->iteration }}</td>
                                        <td>
                                            <div class="rounded shadow-sm mx-auto"
                                                style="width: 60px; height: 30px; background-color: {{ $color->code }}; border: 1px solid #ccc;">
                                            </div>
                                        </td>
                                        <td>{{ $color->name }}</td>
                                        <td>{{ $color->code }}</td>
                                        <td>
                                            <a href="{{ route('colors.edit', ['id' => $color->id]) }}"
                                                class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                            <a href="#"
                                                data-url="{{ route('colors.delete', ['id' => $color->id]) }}"
                                                class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $colors->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>
@endsection