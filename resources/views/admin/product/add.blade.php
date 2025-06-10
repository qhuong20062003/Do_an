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
  @include('admin.partials.content-header',['name' => 'product','key'=> 'Add'])
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
              <label>Tên sản phẩm</label>
              <input type="text"
                class="form-control @error ('name') is-invalid @enderror"
                name="name"
                placeholder="Nhập tên sản phẩm"
                value="{{ old('name') }}">
              @error('name')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Giá sản phẩm</label>
              <input type="text"
                class="form-control @error ('price') is-invalid @enderror"
                name="price"
                placeholder="Nhập giá sản phẩm"
                value="{{ old('price') }}">
              @error('price')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Giá khuyến mãi sản phẩm</label>
              <input type="text"
                class="form-control @error ('price') is-invalid @enderror"
                name="discount"
                placeholder="Nhập giá khuyến mãi sản phẩm"
                value="{{ old('discount') }}">
            </div>

            <div class="form-group">
              <label>Hình ảnh sản phẩm</label>
              <input type="file"
                class="form-control-file"
                name="feature_image_path">
            </div>

            <div class="form-group">
              <label>Ảnh chi tiết sản phẩm</label>
              <input type="file"
                multiple
                class="form-control-file"
                name="image_path[]">
            </div>

            <div class="form-group">
              <label>Chọn danh mục</label>
              <select class="form-control select2_init @error ('category_id') is-invalid @enderror" name="category_id">
                <option value="">Chọn danh mục </option>
                {!! $htmlOption !!}
              </select>
              @error('category_id')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>

            <div class="form-group">
              <label>Chọn menu</label>
              <select class="form-control select2_init @error ('menu_id') is-invalid @enderror" name="menu_id">
                <option value="">Chọn menu </option>
                @if(isset($menus) && !empty($menus))
                @foreach($menus as $menu)
                <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                @endforeach
                @endif
              </select>
            </div>

            <div class="form-group">
              <label>Nhập tags</label>
              <select class="form-control tags_select_choose" name="tags[]" multiple="multiple">

              </select>
            </div>

          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Nhập nội dung</label>
              <textarea
                name="content"
                class="form-control tinymced_editor_init @error ('content') is-invalid @enderror" rows="8">
              {{ old('content') }}
              </textarea>
              @error('content')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="form-group">
            <label>Màu sắc, size, số lượng</label>
            <table class="table table-bordered" id="variant-table">
              <thead class="thead-light">
                <tr>
                    <th>Màu sắc</th>
                    <th>Size</th>
                    <th>Số lượng tồn kho</th>
                    <th>
                        <button type="button" id="add-product-variant" class="btn btn-sm btn-success">
                            <i class="bi bi-plus"></i> Thêm hàng
                        </button>
                    </th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>
                    <select name="product_variant[0][color_id]" class="form-control">
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}" style="background-color: {{ $color->code }};color: white;">
                            {{ $color->name }}
                        </option>
                        @endforeach
                    </select>
                  </td>
                  <td>
                    <select name="product_variant[0][size_id]" class="form-control">
                        @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                  </td>
                  <td>
                      <input type="number" name="product_variant[0][stock]" class="form-control" min="0" value="0">
                  </td>
                  <td>
                      <button type="button" class="btn btn-sm btn-danger remove-product-variant">Xóa</button>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

          <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
          </div>

        </div>
      </div>
    </div>
  </form>
</div>
<script>
  $(document).ready(function() {
      let index = 1;

      $("#add-product-variant").click(function() {
          const row = `
              <tr>
                  <td>
                    <select name="product_variant[${index}][color_id]" class="form-control">
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}" style="background-color: {{ $color->code }};color: white;">
                            {{ $color->name }}
                        </option>
                        @endforeach
                    </select>
                  </td>
                  <td>
                    <select name="product_variant[${index}][size_id]" class="form-control">
                        @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                  </td>
                  <td>
                      <input type="number" name="product_variant[${index}][stock]" class="form-control" min="0" value="0">
                  </td>
                  <td>
                      <button type="button" class="btn btn-sm btn-danger remove-product-variant">Xóa</button>
                  </td>
                </tr>
          `;
          $("#variant-table tbody").append(row);
          index++;
      });

      $(document).on('click', '.remove-product-variant', function(){
        $(this).closest('tr').remove();
      });
  });
</script>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="https://cdn.tiny.cloud/1/pb79ks2ulpfc1cuxjv5zh9ve9s9iysbbmqkux5x3sifwiobx/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script src="{{ asset('admins/product/add/add.js') }}"></script>
@endsection