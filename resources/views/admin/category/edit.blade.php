@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa danh mục</title>
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header', ['name' => 'Chỉnh sửa', 'key' => 'danh mục'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('categories.update', ['id' => $category->id]) }}" method="post">
            @csrf
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Tên danh mục</label>
                <input type="text"
                  id="name"
                  class="form-control"
                  name="name"
                  value="{{ $category->name }}"
                  placeholder="Nhập tên danh mục">
              </div>

              <div class="col-md-6 mb-3">
                <label for="parent_id" class="form-label">Danh mục cha</label>
                <select class="form-control" id="parent_id" name="parent_id">
                  <option value="0">-- Chọn danh mục cha --</option>
                  {!! $htmlOption !!}
                </select>
              </div>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Cập nhật danh mục</button>
            </div>
          </form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection