@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa sản phẩm</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/product/add/add.css') }}" rel="stylesheet" />
@endsection

@section('content')

<div class="content-wrapper">
  @include('admin.partials.content-header',['name' => 'Chỉnh sửa','key'=> 'sản phẩm'])

  <form action="{{ route('product.update', ['id'=>$product->id]) }}" method="post" enctype="multipart/form-data">
    @csrf
    <div class="content">
      <div class="container-fluid">
        <div class="card shadow-sm">
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label>Tên sản phẩm</label>
                  <input type="text" class="form-control" name="name" placeholder="Nhập tên sản phẩm" value="{{ $product->name }}">
                </div>

                <div class="form-group mb-3">
                  <label>Giá sản phẩm</label>
                  <input type="text" class="form-control" name="price" placeholder="Nhập giá sản phẩm" value="{{ $product->price }}">
                </div>

                <div class="form-group mb-3">
                  <label>Giá khuyến mãi</label>
                  <input type="text" class="form-control @error('price') is-invalid @enderror" name="discount" placeholder="Nhập giá khuyến mãi" value="{{ (int)$product->discount }}">
                </div>

                <div class="form-group mb-3">
                  <label>Hình ảnh đại diện</label>
                  <input type="file" class="form-control-file" name="feature_image_path">
                  <div class="mt-2">
                    <img src="{{ $product->feature_image_path }}" alt="" class="img-thumbnail" style="max-width: 200px;">
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label>Ảnh chi tiết sản phẩm</label>
                  <input type="file" multiple class="form-control-file" name="image_path[]">
                  <div class="row mt-2">
                    @foreach ($product->productImages as $productImageItem)
                    <div class="col-md-3 mb-2">
                      <img src="{{ $productImageItem->image_path }}" alt="" class="img-fluid img-thumbnail">
                    </div>
                    @endforeach
                  </div>
                </div>

                <div class="form-group mb-3">
                  <label>Danh mục</label>
                  <select class="form-control select2_init" name="category_id">
                    <option value="">-- Chọn danh mục --</option>
                    {!! $htmlOption !!}
                  </select>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group mb-3">
                  <label>Nội dung</label>
                  <textarea name="content" class="form-control tinymced_editor_init" rows="8">{{ $product->content }}</textarea>
                </div>
              </div>

              <div class="col-md-12 mt-4">
                <label>Màu sắc, Size, Số lượng tồn kho</label>
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
                      @if(isset($product_variants) && !empty($product_variants))
                      @foreach($product_variants as $key => $product_variant)
                      <tr>
                        <td>
                          <select name="product_variant[{{$key}}][color_id]" class="form-control">
                            @foreach($colors as $color)
                            <option value="{{ $color->id }}" {{ $product_variant['color_id'] == $color->id ? 'selected' : '' }} style="background-color: {{ $color->code }}; color: white;">
                              {{ $color->name }}
                            </option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <select name="product_variant[{{$key}}][size_id]" class="form-control">
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}" {{ $product_variant['size_id'] == $size->id ? 'selected' : '' }}>
                              {{ $size->name }}
                            </option>
                            @endforeach
                          </select>
                        </td>
                        <td>
                          <input type="number" name="product_variant[{{$key}}][stock]" class="form-control" min="0" value="{{ $product_variant['stock'] }}">
                        </td>
                        <td>
                          <button type="button" class="btn btn-sm btn-danger remove-product-variant">Xóa</button>
                        </td>
                      </tr>
                      @endforeach
                      @endif
                    </tbody>
                  </table>
                </div>
              </div>

              <div class="col-md-12 text-right mt-4">
                <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
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
    let index = '<?php echo count($product_variants); ?>';

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