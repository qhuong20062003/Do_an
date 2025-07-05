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
                    <li>Đăng ký</li>
                </ul>

            </div>
        </div>
    </div>
</div> -->
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

                <form action="{{ route('post.register') }}" method="POST" id="myForm">
                    <p>
                        <label>Tên khách hàng <span class="required">*</span></label>
                        <input type="text" name="name" id="name" placeholder="Nhập họ tên">
                        <small id="name-error" class="text-danger" style="display: none;">Vui lòng nhập họ tên</small>
                    </p>
                    <p>
                        <label>Email <span class="required">*</span></label>
                        <input type="email" name="email" id="email" placeholder="Nhập email">
                        <small id="email-error" class="text-danger" style="display: none;">Vui lòng nhập email</small>
                    </p>
                    <p>
                        <label>Mật khẩu <span class="required">*</span></label>
                        <input type="password" name="password" id="password" placeholder="Nhập mật khẩu">
                        <small id="password-error" class="text-danger" style="display: none;">Vui lòng nhập password</small>
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

<script>
    $(document).ready(function(){
        $('#myForm').on('submit', function(e) {
            let is_valid = true;

            let email = $('#email');
            if(!email.val().trim()) {
                $('#email-error').show();
                email.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#email-error').hide();
                email.css('border', '');
            }
            
            let password = $('#password');
            if(!password.val().trim()) {
                $('#password-error').show();
                password.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#password-error').hide();
                password.css('border', '');
            }

            let name = $('#name');
            if(!name.val().trim()) {
                $('#name-error').show();
                name.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#name-error').hide();
                name.css('border', '');
            }

            if(!is_valid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection