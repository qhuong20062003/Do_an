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
                    <li>Đăng ký</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<div class="customer_login">
    <div class="d-flex justify-content-center">
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
                        <a href="{{ route('login') }}">Đăng nhập</a>
                    </div>
                    @csrf
                </form>
            </div>
        </div>
        <!--register area end-->
    </div>
</div>
@endsection