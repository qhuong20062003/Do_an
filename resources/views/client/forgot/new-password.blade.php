@extends('client.layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Đặt lại mật khẩu</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- reset password form start -->
<div class="customer_login">
    <div class="d-flex justify-content-center">
        <!--reset area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form">
                <h2>Đặt lại mật khẩu</h2>
                {{-- Hiển thị thông báo lỗi --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('reset.password') }}" method="POST">
                    @csrf
                    <p>
                        <label>Mật khẩu mới <span>*</span></label>
                        <input type="password" name="password" required>
                    </p>

                    <p>
                        <label>Xác nhận mật khẩu <span>*</span></label>
                        <input type="password" name="password_confirm" required>
                    </p>

                    <!-- Truyền mã token hoặc email nếu cần -->
                    <input type="hidden" name="email" value="{{ $email ?? '' }}">

                    <div class="login_submit">
                        <button type="submit">Đặt lại mật khẩu</button>
                        <a href="{{ route('login') }}">Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
        <!--reset area end-->
    </div>
</div>
<!-- reset password form end -->
@endsection