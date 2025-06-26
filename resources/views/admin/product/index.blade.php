@extends('admin.layouts.admin')

@section('title')
<title>Danh sách sản phẩm</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/product/index/list.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'sản phẩm'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 text-end">
          <a href="{{ route('product.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm sản phẩm
          </a>
        </div>

        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-header bg-light">
              <h5 class="mb-0">Danh sách sản phẩm</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên sản phẩm</th>
                    <th>Giá gốc</th>
                    <th>Giá khuyến mãi</th>
                    <th>Hình ảnh</th>
                    <th>Danh mục</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($products as $productItem)
                  <tr>
                    <td>{{ $productItem->id }}</td>
                    <td>{{ $productItem->name }}</td>
                    <td>{{ number_format((float)$productItem->price) }} VNĐ</td>
                    <td>{{ number_format((float)$productItem->discount) }} VNĐ</td>
                    <td>
                      <img class="img-thumbnail" src="{{ $productItem->feature_image_path }}" alt="" width="100">
                    </td>
                    <td>{{ optional($productItem->category)->name }}</td>
                    <td>
                      <a href="{{ route('product.edit', ['id' => $productItem->id]) }}"
                         class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                      <a href="#" data-url="{{ route('product.delete', ['id' => $productItem->id]) }}"
                         class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex justify-content-center mt-3">
                {{ $products->links() }}
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div>
    </div>
  </div>
</div>
@endsection
