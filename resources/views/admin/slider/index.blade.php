@extends('admin.layouts.admin')

@section('title')
<title>Danh sách Slider</title>
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
  @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'slider'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- Nút thêm -->
        <div class="col-md-12 mb-3 text-end">
          <a href="{{ route('slider.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm slider
          </a>
        </div>

        <!-- Bảng slider -->
        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-header bg-light">
              <h5 class="mb-0">Danh sách slider</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                  <tr>
                    <th>#</th>
                    <th>Tên slider</th>
                    <th>Mô tả</th>
                    <th>Hình ảnh</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($sliders as $slider)
                  <tr>
                    <td>{{ $slider->id }}</td>
                    <td>{{ $slider->name }}</td>
                    <td class="text-start">{{ $slider->description }}</td>
                    <td>
                      <img src="{{ $slider->image_path }}" alt=""
                        class="img-thumbnail" style="width: 150px; height: 100px; object-fit: cover;">
                    </td>
                    <td>
                      <a href="{{ route('slider.edit', ['id' => $slider->id]) }}"
                        class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                      <a href="#"
                        data-url="{{ route('slider.delete', ['id' => $slider->id]) }}"
                        class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex justify-content-center mt-3">
                {{ $sliders->links() }}
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div>
    </div>
  </div>
</div>
@endsection