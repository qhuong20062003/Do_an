@extends('admin.layouts.admin')

@section('title')
<title>Thêm Slider</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header', ['name' => 'Thêm', 'key' => 'slider'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('slider.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <!-- Tên slider -->
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Tên slider</label>
                <input type="text" id="name" name="name"
                  class="form-control @error('name') is-invalid @enderror"
                  placeholder="Nhập tên slider"
                  value="{{ old('name') }}">
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
                  placeholder="Nhập mô tả slider">{{ old('description') }}</textarea>
                @error('description')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Hình ảnh slider -->
              <div class="col-md-6 mb-3">
                <label for="image_path" class="form-label">Hình ảnh</label>
                <input type="file" id="image_path" name="image_path"
                  class="form-control @error('image_path') is-invalid @enderror">
                @error('image_path')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Thêm slider</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection