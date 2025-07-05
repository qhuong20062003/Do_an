@extends('admin.layouts.admin')

@section('title')
<title>Danh sách danh mục</title>
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
  @include('admin.partials.content-header',['name' => 'Danh sách','key'=> 'danh mục'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 text-end">
          <a href="{{ route('categories.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm danh mục
          </a>
        </div>

        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-header bg-light">
              <h5 class="mb-0">Danh sách danh mục</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover">
                <thead class="thead-light">
                  <tr>
                    <th scope="col" style="width: 5%;">STT</th>
                    <th scope="col">Tên danh mục</th>
                    <th scope="col" style="width: 20%;">Hành động</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($categories as $category)
                  <tr>
                    <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $loop->iteration }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                      <a href="{{ route('categories.edit',['id'=> $category->id]) }}"
                        class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                      <a href="#"
                        data-url="{{ route('categories.delete', ['id' => $category->id]) }}"
                        class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex justify-content-center mt-3">
                {{ $categories->links('pagination::bootstrap-4') }}
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
</div>
@endsection