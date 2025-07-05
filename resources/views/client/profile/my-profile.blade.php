@extends('client.layouts.app')

@section('content')
<!--breadcrumbs area start-->
<!-- <div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Thông tin khách hàng</li>
                </ul>

            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->

<!-- Start Maincontent  -->
<section class="main_content_area">
    <div class="account_dashboard">
        <div class="row">
            <div class="col-sm-12 col-md-3 col-lg-3">
                <!-- Nav tabs -->
                <div class="dashboard_tab_button">
                    <ul role="tablist" class="nav flex-column dashboard-list">
                        <li><a href="#account-details" data-toggle="tab" class="nav-link active">Thông tin khách hàng</a></li>
                        <li> <a href="#orders" data-toggle="tab" class="nav-link">Đơn hàng</a></li>
                        <li> <a href="#dashboard" data-toggle="tab" class="nav-link">Đổi mật khẩu</a></li>
                        <li><a href="{{ route('logout') }}" class="nav-link">Đăng xuất</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-sm-12 col-md-9 col-lg-9">
                <!-- Tab panes -->
                <div class="tab-content dashboard_content">
                    <div class="tab-pane fade" id="dashboard">
                        <h3>Đổi mật khẩu </h3>
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{ route('change.password') }}" method="POST" id="updatePassword">
                                        <p>
                                            <label>Mật khẩu cũ</label>
                                            <input type="password" name="old_password" id="old_password">
                                            <small id="old-password-error" class="text-danger" style="display: none;">Vui lòng nhập mật khẩu cũ</small>
                                        </p>
                                        <p>
                                            <label>Mật khẩu mới</label>
                                            <input type="password" name="new_password" id="new_password">
                                            <small id="new-password-error" class="text-danger" style="display: none;">Vui lòng nhập mật khẩu mới</small>
                                        </p>
                                        <p>
                                            <label>Xác nhận mật khẩu mới</label>
                                            <input type="password" name="confirm_password" id="confirm_password">
                                            <small id="confirm-password-error" class="text-danger" style="display: none;">Vui lòng xác nhận mật khẩu mới</small>
                                        </p>
                                        @csrf
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit" class="btn btn-success">Cập nhật</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="orders">
                        <h3>Đơn hàng của bạn</h3>
                        <div class="coron_table table-responsive text-center">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Mã đơn hàng</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Tổng tiền</th>
                                        <th>Chi tiết</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($orders) && !empty($orders))
                                    @foreach($orders as $order)
                                    <tr>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if($order->status == 0) 
                                            <span class="badge bg-warning">Đang xử lý</span>
                                            @elseif($order->status == 1)
                                            <span class="badge bg-primary">Đã xác nhận</span>
                                            @elseif($order->status == 2)
                                            <span class="badge bg-info">Đang giao hàng</span>
                                            @else
                                            <span class="badge bg-success">Giao hàng thành công</span>
                                            @endif
                                        </td>
                                        <td>{{ number_format($order->total_price, 0, 0) }} VNĐ</td>
                                        <td><a href="{{ route('detail.order', ['id' => $order->id]) }}" class="view">Xem chi tiết</a></td>
                                    </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class="tab-pane fade" id="downloads">
                        <h3>Downloads</h3>
                        <div class="coron_table table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Downloads</th>
                                        <th>Expires</th>
                                        <th>Download</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Shopnovilla - Free Real Estate PSD Template</td>
                                        <td>May 10, 2018</td>
                                        <td><span class="danger">Expired</span></td>
                                        <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                    </tr>
                                    <tr>
                                        <td>Organic - ecommerce html template</td>
                                        <td>Sep 11, 2018</td>
                                        <td>Never</td>
                                        <td><a href="#" class="view">Click Here To Download Your File</a></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div> -->
                    <!-- <div class="tab-pane" id="address">
                        <p>The following addresses will be used on the checkout page by default.</p>
                        <h4 class="billing-address">Billing address</h4>
                        <a href="#" class="view">Edit</a>
                        <p><strong>Bobby Jackson</strong></p>
                        <address>
                            House #15<br>
                            Road #1<br>
                            Block #C <br>
                            Banasree <br>
                            Dhaka <br>
                            1212
                        </address>
                        <p>Bangladesh</p>
                    </div> -->
                    <div class="tab-pane fade show active" id="account-details">
                        <h3>Thông tin khách hàng </h3>
                        {{-- Hiển thị thông báo thành công --}}
                        @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                        @endif

                        {{-- Hiển thị thông báo lỗi --}}
                        @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                        </div>
                        @endif
                        <div class="login">
                            <div class="login_form_container">
                                <div class="account_login_form">
                                    <form action="{{ route('update.profile') }}" method="POST" id="profileForm">
                                        <!-- <p>Already have an account? <a href="#">Log in instead!</a></p>
                                        <div class="input-radio">
                                            <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mr.</span>
                                            <span class="custom-radio"><input type="radio" value="1" name="id_gender"> Mrs.</span>
                                        </div> <br> -->
                                        <p>
                                            <label>Họ và tên</label>
                                            <input type="text" name="name" id="name" value="{{ Auth::user()->name }}">
                                            <small id="name-error" class="text-danger" style="display: none;">Vui lòng nhập họ tên</small>
                                        </p>
                                        <p>
                                            <label>Ngày sinh</label>
                                            <input type="date" name="birth" id="birth" value="{{ Auth::user()->birth }}">
                                            <small id="birth-error" class="text-danger" style="display: none;">Vui lòng nhập ngày sinh</small>
                                        </p>
                                        <p>
                                            <label>Email</label>
                                            <input type="text" name="email" id="email" value="{{ Auth::user()->email }}">
                                            <small id="email-error" class="text-danger" style="display: none;">Vui lòng nhập email</small>
                                        </p>
                                        <p>
                                            <label>Số điện thoại</label>
                                            <input type="number" value="{{ Auth::user()->phone }}" id="phone" name="phone">
                                            <small id="phone-error" class="text-danger" style="display: none;">Vui lòng nhập số điện thoại</small>
                                        </p>
                                        <!-- <label>Mật khẩu cũ</label>
                                        <input type="password" name="old_password">
                                        <label>Mật khẩu</label>
                                        <input type="password" name="new_password"> -->
                                        <!-- <span class="example">
                                            (E.g.: 05/31/1970)
                                        </span>
                                        <br>
                                        <span class="custom_checkbox">
                                            <input type="checkbox" value="1" name="optin">
                                            <label>Receive offers from our partners</label>
                                        </span>
                                        <br>
                                        <span class="custom_checkbox">
                                            <input type="checkbox" value="1" name="newsletter">
                                            <label>Sign up for our newsletter<br><em>You may unsubscribe at any moment. For that purpose, please find our contact info in the legal notice.</em></label>
                                        </span> -->
                                        @csrf
                                        <div class="save_button primary_btn default_button">
                                            <button type="submit" class="btn btn-success">Cập nhật</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Maincontent  -->

<script>
    $(document).ready(function(){
        $('#updatePassword').on('submit', function(e) {
            let is_valid = true;

            let old_password = $('#old_password');
            if(!old_password.val().trim()) {
                $('#old-password-error').show();
                old_password.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#old-password-error').hide();
                old_password.css('border', '');
            }
            
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

        $('#profileForm').on('submit', function(e) {
            let is_valid = true;

            let name = $('#name');
            if(!name.val().trim()) {
                $('#name-error').show();
                name.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#name-error').hide();
                name.css('border', '');
            }
            
            let birth = $('#birth');
            if(!birth.val()) {
                $('#birth-error').show();
                birth.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#birth-error').hide();
                birth.css('border', '');
            }
            
            let email = $('#email');
            if(!email.val().trim()) {
                $('#email-error').show();
                email.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#email-error').hide();
                email.css('border', '');
            }
            
            let phone = $('#phone');
            if(!phone.val().trim()) {
                $('#phone-error').show();
                phone.css('border', '1px solid red');
                is_valid = false;
            } else {
                $('#phone-error').hide();
                phone.css('border', '');
            }

            if(!is_valid) {
                e.preventDefault();
            }
        });
    });
</script>
@endsection