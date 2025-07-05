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
                    <li>Quên mật khẩu</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->

<!-- forgot password start -->
<div class="customer_login">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6 col-md-6">
            <div class="account_form">
                <h2>Quên mật khẩu</h2>
                {{-- Hiển thị thông báo lỗi --}}
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('otp.email') }}" method="POST" id="myForm">
                    @csrf
                    <p>
                        <label>Nhập email để đặt lại mật khẩu <span class="required">*</span></label>
                        <input type="email" name="email" id="email">
                        <small id="email-error" class="text-danger" style="display: none;">Vui lòng nhập email</small>
                    </p>
                    <div class="login_submit">
                        <button type="submit">Gửi liên kết đặt lại mật khẩu</button>
                        <a href="{{ route('login') }}" class="d-block mt-3">← Quay lại đăng nhập</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- forgot password end -->

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

            if(!is_valid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection