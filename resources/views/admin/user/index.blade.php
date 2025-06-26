@extends('admin.layouts.admin')

@section('title')
<title>Danh sách người dùng</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/user/index/list.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'người dùng'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3 text-end">
          <a href="{{ route('users.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Thêm người dùng
          </a>
        </div>

        <div class="col-md-12">
          <div class="card shadow-sm">
            <div class="card-header bg-light">
              <h5 class="mb-0">Danh sách người dùng</h5>
            </div>
            <div class="card-body">
              <table class="table table-bordered table-hover align-middle text-center">
                <thead class="table-light">
                  <tr>
                    <th>ID</th>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai trò</th>
                    <th>Thao tác</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($users as $user)
                  <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->role) }}</td>
                    <td>
                      <a href="{{ route('users.edit', ['id' => $user->id]) }}"
                        class="btn btn-sm btn-outline-primary me-1">Sửa</a>
                      <a href="#" data-url="{{ route('users.delete', ['id' => $user->id]) }}"
                        class="btn btn-sm btn-outline-danger action_delete">Xóa</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>

              <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
              </div>
            </div>
          </div>
        </div> <!-- end col -->
      </div>
    </div>
  </div>
</div>
@endsection