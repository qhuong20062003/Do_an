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
                    <li>Xác thực OTP</li>
                </ul>
            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->

<!-- otp verification start -->
<div class="customer_login">
    <div class="d-flex justify-content-center">
        <div class="col-lg-6 col-md-6">
            <div class="account_form text-center">
                <h2>Xác minh OTP</h2>
                @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                <form action="{{ route('verify.otp') }}" method="POST" id="otpForm">
                    @csrf
                    <p>Nhập mã OTP đã gửi đến email</p>

                    <div class="d-flex justify-content-center gap-2 mb-4" style="gap: 10px;">
                        @for ($i = 0; $i
                        < 6; $i++)
                            <input type="text" name="otp[]" maxlength="1" class="otp-input text-center"
                            required
                            style="width: 50px; height: 50px; font-size: 24px; border: 1px solid #ccc; border-radius: 6px;" />
                        @endfor
                    </div>

                    <input type="hidden" name="email" value="{{ $email }}">

                    <div class="login_submit">
                        <button type="submit">Xác nhận OTP</button>
                        <a href="#" class="d-block mt-3">← Quay lại Quên mật khẩu</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- otp verification end -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const $inputs = $('.otp-input');

        $inputs.on('input', function(e) {
            const $this = $(this);
            const value = $this.val();

            if (value.length > 1) {
                let chars = value.split('');
                $this.val(chars[0]);
                let nextInputs = $inputs.toArray().slice($inputs.index($this) + 1);
                for (let i = 1; i < chars.length && i <= nextInputs.length; i++) {
                    $(nextInputs[i - 1]).val(chars[i]);
                }
                $(nextInputs[Math.min(chars.length - 1, nextInputs.length - 1)]).focus();
            } else if (value.length === 1) {
                $this.next('.otp-input').focus();
            }
        });

        $inputs.on('keydown', function(e) {
            const $this = $(this);
            const index = $inputs.index(this);

            if (e.key === 'Backspace') {
                if ($this.val() === '') {
                    if (index > 0) {
                        $inputs.eq(index - 1).focus().val('');
                    }
                } else {
                    $this.val('');
                }
                e.preventDefault(); 
            } else if (e.key >= '0' && e.key <= '9') {
                // Cho phép nhập số
            } else if (e.key !== 'Tab' && e.key !== 'ArrowLeft' && e.key !== 'ArrowRight') {
                e.preventDefault(); 
            }
        });
    });
</script>
@endsection