@extends('client.layouts.app')

@section('content')
<!--breadcrumbs area start-->
<!-- <div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="{{ route('index') }}">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Đăng nhập</li>
                </ul>

            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->

<!-- customer login start -->
<div class="customer_login">
    <div class="d-flex justify-content-center">
        <!--login area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form">
                <h2>Đăng nhập</h2>
                {{-- Hiển thị thông báo lỗi --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                {{-- Hiển thị thông báo thành công --}}
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
                @endif
                <form action="{{ route('post.login') }}" method="POST">
                    <p>
                        <label for="email">Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" placeholder="Nhập email của bạn" required>
                    </p>
                    <p>
                        <label>Mật khẩu <span>*</span></label>
                        <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                    </p>
                    <div class="login_submit">
                        <button type="submit">Đăng nhập</button>
                        <label for="remember">
                            <input id="remember" type="checkbox">
                            Lưu đăng nhập
                        </label>
                        <a href="{{ route('register') }}">Đăng ký</a>
                        <a href="{{ route('forgot.password') }}">Quên mật khẩu?</a>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
        <!--login area start-->
    </div>
</div>
<!-- customer login end -->
@endsection