@extends('admin.layouts.admin')

@section('title')
<title>Add Product</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="content-wrapper">
  @include('admin.partials.content-header',['name' => 'product','key'=> 'Edit'])
  <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">

    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
            @csrf
            <div class="form-group">
              <label>Tên san pham</label>
              <input type="text"
                class="form-control"
                name="name"
                placeholder="Nhập tên san pham"
                value="{{ $product->name }}">

            </div>
            <div class="form-group">
              <label>gia san pham</label>
              <input type="text"
                class="form-control"
                name="price"
                placeholder="Nhập gia san pham"
                value="{{ $product->price }}">
            </div>
            <div class="form-group">
              <label>Hinh anh san pham</label>
              <input type="file"
                class="form-control-file"
                name="feature_image_path">
              <div class="col-md-4 feature_image_container">
                <div class="row">
                  <img class="feature_image" src="{{ $product->feature_image_path }}" alt="">
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Anh chi tiet san pham</label>
              <input type="file"
                multiple
                class="form-control-file"
                name="image_path[]">

              <div class="col-md-12 container_image_detail">
                <div class="row">
                  @foreach ($product->productImages as $productImageItem)
                  <div class="col-md-3">
                    <img class="image_detail_product" src="{{ $productImageItem->image_path }}" alt="">
                  </div>
                  @endforeach
                </div>
              </div>
            </div>
            <div class="form-group">
              <label>Chọn danh mục</label>
              <select class="form-control select2_init" name="category_id">
                <option value="">Chọn danh mục </option>
                {!! $htmlOption !!}
              </select>
            </div>
            <div class="form-group">
              <label>Nhap tags</label>
              <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
                @foreach ($product->tags as $tagItem )
                <option value="{{ $tagItem->name }}" selected>{{ $tagItem->name }}</option>

                @endforeach
              </select>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Nhap noi dung</label>
              <textarea name="content" class="form-control tinymced_editor_init" rows="8">{{ $product->content }}</textarea>
            </div>
          </div>
          <div class="col-md-">
            <button type="submit" class="btn btn-primary">Submit</button>

          </div>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/pb79ks2ulpfc1cuxjv5zh9ve9s9iysbbmqkux5x3sifwiobx/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script src="{{ asset('admins/product/add/add.js') }}"></script>


@endsection