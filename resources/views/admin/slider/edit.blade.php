@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/slider/add/add.css') }}">
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header',['name' => 'Slider','key'=> 'Edit'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <form action="{{ route('slider.update',['id'=>$slider->id]) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
              <label>Tên slider</label>
              <input type="text"
                class="form-control @error ('name') is-invalid @enderror"
                name="name"
                placeholder="Nhập tên slider"
                value="{{ $slider->name }}">
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror

            </div>

            <div class="form-group">
              <label>Mo ta slider</label>
              <textarea
                name="description"
                class="form-control @error ('description') is-invalid @enderror" rows="4">
              {{ $slider->description }}
              </textarea>

              @error('description')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror


            </div>

            <div class="form-group">
              <label>Hinh anh slider</label>
              <input type="file"
                class="form-control-file @error('image_path') is-invalid @enderror"
                name="image_path">
              <div class="col-md-4">
                <img class="image_slider" src="{{ $slider->image_path }}" alt="">
              </div>
              @error('image_path')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection