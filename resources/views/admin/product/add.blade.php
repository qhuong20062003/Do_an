@extends('layouts.admin')
 
@section('title')
  <title>Add Product</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

 @section('content')

 <div class="content-wrapper">
    @include('partials.content-header',['name' => 'product','key'=> 'Add'])
    <div class="col-md-12">
        <!-- @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </di>
@endif -->
    </div>
    <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">

    <div class="content">
      <div class="container-fluid">
        <div class="row">
        <div class="col-md-6">
          @csrf
        <div class="form-group">
            <label>Tên san pham</label>
            <input type="text" 
                  class="form-control @error ('name') is-invalid @enderror" 
                  name="name"
                  placeholder="Nhập tên san pham"
                  value="{{ old('name') }}">
            @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>gia san pham</label>
            <input type="text" 
                  class="form-control @error ('price') is-invalid @enderror" 
                  name="price"
                  placeholder="Nhập gia san pham"
                  value="{{ old('price') }}">
                  @error('price')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label>Hinh anh san pham</label>
            <input type="file" 
                  class="form-control-file" 
                  name="feature_image_path">
        </div>
        
        <div class="form-group">
            <label>Anh chi tiet san pham</label>
            <input type="file" 
                    multiple
                  class="form-control-file" 
                  name="image_path[]">
        </div>
        



            <div class="form-group">
                <label>Chọn danh mục</label>
                <select class="form-control select2_init @error ('category_id') is-invalid @enderror" name="category_id" >
                <option value="">Chọn danh mục </option>
                {!! $htmlOption !!}
                </select>
                @error('category_id')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            </div>
            <div class="form-group">
                  <label>Nhap tags</label>
                    <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">
 
                    </select>
            </div>
            

        
        
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <label>Nhap noi dung</label>
                <textarea 
                  name="content"
                  class="form-control tinymced_editor_init @error ('content') is-invalid @enderror" rows="8" >
                  {{ old('content') }}
                </textarea>
                @error('content')
              <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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





