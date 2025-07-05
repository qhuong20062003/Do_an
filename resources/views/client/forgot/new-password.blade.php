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
                    <li>Đặt lại mật khẩu</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
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
                <form action="{{ route('reset.password') }}" method="POST" id="myForm">
                    @csrf
                    <p>
                        <label>Mật khẩu mới <span class="required">*</span></label>
                        <input type="password" name="password" id="new_password">
                        <small id="new-password-error" class="text-danger" style="display: none;">Vui lòng nhập mật khẩu mới</small>
                    </p>

                    <p>
                        <label>Xác nhận mật khẩu <span class="required">*</span></label>
                        <input type="password" name="password_confirm" id="confirm_password">
                        <small id="confirm-password-error" class="text-danger" style="display: none;">Vui lòng xác nhận mật khẩu mới</small>
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

<script>
    $(document).ready(function(){
        $('#myForm').on('submit', function(e) {
            let is_valid = true;

            let new_password = $('#new_password');
            if(!new_password.val().trim()) {
                $('#new-password-error').show();
                new_password.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#new-password-error').hide();
                new_password.css('border', '');
            }

            let confirm_password = $('#confirm_password');
            if(!confirm_password.val().trim()) {
                $('#confirm-password-error').show();
                confirm_password.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#confirm-password-error').hide();
                confirm_password.css('border', '');
            }

            if(!is_valid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection