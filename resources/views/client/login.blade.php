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
                    <li>Đăng nhập</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!-- customer login start -->
<div class="customer_login">
    <div class="row">
        <!--login area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form">
                <h2>Đăng nhập</h2>
                <form action="{{ route('post.login') }}" method="POST">
                    <p>
                        <label>Email <span>*</span></label>
                        <input type="text" name="email">
                    </p>
                    <p>
                        <label>Mật khẩu <span>*</span></label>
                        <input type="password" name="password">
                    </p>
                    <div class="login_submit">
                        <button type="submit">Đăng nhập</button>
                        <label for="remember">
                            <input id="remember" type="checkbox">
                            Lưu đăng nhập
                        </label>
                        <a href="#">Quên mật khẩu?</a>
                    </div>
                @csrf
                </form>
            </div>
        </div>
        <!--login area start-->

        <!--register area start-->
        <div class="col-lg-6 col-md-6">
            <div class="account_form register">
                <h2>Đăng ký</h2>
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('post.register') }}" method="POST">
                    <p>
                        <label>Tên khách hàng <span>*</span></label>
                        <input type="text" name="name">
                    </p>
                    <p>
                        <label>Email <span>*</span></label>
                        <input type="text" name="email">
                    </p>
                    <p>
                        <label>Mật khẩu <span>*</span></label>
                        <input type="password" name="password">
                    </p>
                    <div class="login_submit">
                        <button type="submit">Đăng ký</button>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
        <!--register area end-->
    </div>
</div>
<!-- customer login end -->
@endsection