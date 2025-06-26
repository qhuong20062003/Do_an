@extends('admin.layouts.admin')

@section('title')
<title>Chỉnh sửa User</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet" />
<style>
  .select2-selection__choice {
    background-color: blueviolet !important;
  }
</style>
@endsection

@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
  @include('admin.partials.content-header',['name' => 'Chỉnh sửa', 'key'=> 'người dùng'])

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form action="{{ route('users.update',['id'=>$user->id]) }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="row">
              <!-- Tên -->
              <div class="col-md-6 mb-3">
                <label for="name" class="form-label">Tên</label>
                <input type="text"
                  id="name"
                  name="name"
                  class="form-control @error('name') is-invalid @enderror"
                  placeholder="Nhập tên người dùng"
                  value="{{ old('name', $user->name) }}">
                @error('name')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Email -->
              <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="text"
                  id="email"
                  name="email"
                  class="form-control @error('email') is-invalid @enderror"
                  placeholder="Nhập email"
                  value="{{ old('email', $user->email) }}">
                @error('email')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Password -->
              <div class="col-md-6 mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password"
                  id="password"
                  name="password"
                  class="form-control @error('password') is-invalid @enderror"
                  placeholder="Nhập mật khẩu (bỏ trống nếu không đổi)">
                @error('password')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>

              <!-- Role -->
              <div class="col-md-6 mb-3">
                <label for="role" class="form-label">Vai trò</label>
                <select id="role"
                  name="role"
                  class="form-control select2_init @error('role') is-invalid @enderror">
                  <option value="">-- Chọn vai trò --</option>
                  @foreach ($roles as $role)
                  <option value="{{ $role }}" {{ old('role', $user->role) === $role ? 'selected' : '' }}>
                    {{ ucfirst($role) }}
                  </option>
                  @endforeach
                </select>
                @error('role')
                <div class="invalid-feedback d-block">{{ $message }}</div>
                @enderror
              </div>
            </div>

            <div class="text-end">
              <button type="submit" class="btn btn-primary">Cập nhật người dùng</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection