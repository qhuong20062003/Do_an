@extends('admin.layouts.admin')

@section('title')
<title>Danh sách kích thước</title>
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
    @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'kích thước'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Nút thêm -->
                <div class="col-md-12 mb-3 text-end">
                    <a href="{{ route('sizes.create') }}" class="btn btn-success">
                        <i class="bi bi-plus-circle"></i> Thêm kích thước
                    </a>
                </div>

                <!-- Bảng -->
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Danh sách kích thước</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>STT</th>
                                        <th>Tên size</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sizes as $size)
                                    <tr>
                                        <td>{{ ($sizes->currentPage() - 1) * $sizes->perPage() + $loop->iteration }}</td>
                                        <td>{{ $size->name }}</td>
                                        <td>
                                            <a href="{{ route('sizes.edit', ['id' => $size->id]) }}"
                                                class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                                            <a href="#"
                                                data-url="{{ route('sizes.delete', ['id' => $size->id]) }}"
                                                class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <!-- Phân trang -->
                            <div class="d-flex justify-content-center mt-3">
                                {{ $sizes->links('pagination::bootstrap-4') }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>
@endsection