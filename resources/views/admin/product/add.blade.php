@extends('admin.layouts.admin')

@section('title')
<title>Thêm mới sản phẩm</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header',['name' => 'Thêm mới','key'=> 'sản phẩm'])

  <form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tên sản phẩm</label>
                  <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Nhập tên sản phẩm" value="{{ old('name') }}">
                  @error('name')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Giá sản phẩm</label>
                  <input type="text" class="form-control @error('price') is-invalid @enderror" name="price" placeholder="Nhập giá sản phẩm" value="{{ old('price') }}">
                  @error('price')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>

                <div class="form-group">
                  <label>Giá khuyến mãi</label>
                  <input type="text" class="form-control" name="discount" placeholder="Nhập giá khuyến mãi sản phẩm" value="{{ old('discount') }}">
                </div>

                <div class="form-group">
                  <label>Hình ảnh đại diện</label>
                  <input type="file" class="form-control-file" name="feature_image_path">
                </div>

                <div class="form-group">
                  <label>Ảnh chi tiết sản phẩm</label>
                  <input type="file" multiple class="form-control-file" name="image_path[]">
                </div>

                <div class="form-group">
                  <label>Danh mục</label>
                  <select class="form-control select2_init @error('category_id') is-invalid @enderror" name="category_id">
                    <option value="">-- Chọn danh mục --</option>
                    {!! $htmlOption !!}
                  </select>
                  @error('category_id')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                  <label>Nội dung mô tả</label>
                  <textarea name="content" class="form-control tinymced_editor_init @error('content') is-invalid @enderror" rows="8">{{ old('content') }}</textarea>
                  @error('content')
                  <small class="text-danger">{{ $message }}</small>
                  @enderror
                </div>
              </div>

              <div class="col-md-12">
                <label class="mt-3">Màu sắc, Size, Số lượng tồn kho</label>
                <div class="table-responsive">
                  <table class="table table-bordered" id="variant-table">
                    <thead class="thead-light">
                      <tr>
                        <th>Màu sắc</th>
                        <th>Size</th>
                        <th>Số lượng</th>
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
                            <option value="{{ $color->id }}" style="background-color: {{ $color->code }};color:white;">
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
              </div>

              <div class="col-md-12 text-right mt-3">
                <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
              </div>
            </div>
          </div>
        </div> <!-- end card -->
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

    $(document).on('click', '.remove-product-variant', function() {
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