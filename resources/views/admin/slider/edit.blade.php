@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa Slider</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header', ['name' => 'Chỉnh sửa', 'key' => 'slider'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('slider.update', ['id' => $slider->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <!-- Tên slider -->
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Tên slider</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ $slider->name }}"
                       placeholder="Nhập tên slider">
                @error('name')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Mô tả slider -->
              <div class="col-md-6 mb-3">
                <label for="description" class="form-label">Mô tả</label>
                <textarea id="description" name="description"
                          class="form-control @error('description') is-invalid @enderror"
                          rows="4"
                          placeholder="Nhập mô tả slider">{{ $slider->description }}</textarea>
                @error('description')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Hình ảnh mới -->
              <div class="col-md-6 mb-3">
                <label for="image_path" class="form-label">Chọn hình ảnh mới (nếu muốn)</label>
                <input type="file" id="image_path" name="image_path"
                       class="form-control @error('image_path') is-invalid @enderror">
                @error('image_path')
                  <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Hình ảnh cũ -->
              <div class="col-md-6 mb-3">
                <label class="form-label">Hình ảnh hiện tại</label>
                <div>
                  <img src="{{ $slider->image_path }}" alt="Slider image"
                       class="img-fluid rounded shadow-sm"
                       style="width: 250px; height: 160px; object-fit: cover;">
                </div>
              </div>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Cập nhật slider</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
