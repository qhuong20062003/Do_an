@extends('client.layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="row">
        <div class="col-12">
            <div class="breadcrumb_content">
                <ul>
                    <li><a href="index.html">Trang chủ</a></li>
                    <li><i class="fa fa-angle-right"></i></li>
                    <li>Thanh toán</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->


<!--Checkout page section-->
<div class="Checkout_section">
    <!-- <div class="row">
        <div class="col-12">
            <div class="user-actions mb-20">
                <h3>
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    Returning customer?
                    <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_login" aria-expanded="true">Click here to login</a>

                </h3>
                <div id="checkout_login" class="collapse" data-parent="#accordion">
                    <div class="checkout_info">
                        <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing & Shipping section.</p>
                        <form action="#">
                            <div class="form_group mb-20">
                                <label>Username or email <span>*</span></label>
                                <input type="text">
                            </div>
                            <div class="form_group mb-25">
                                <label>Password <span>*</span></label>
                                <input type="text">
                            </div>
                            <div class="form_group group_3 ">
                                <input value="Login" type="submit">
                                <label for="remember_box">
                                    <input id="remember_box" type="checkbox">
                                    <span> Remember me </span>
                                </label>
                            </div>
                            <a href="#">Lost your password?</a>
                        </form>
                    </div>
                </div>
            </div>
            <div class="user-actions mb-20">
                <h3>
                    <i class="fa fa-file-o" aria-hidden="true"></i>
                    Returning customer?
                    <a class="Returning" href="#" data-toggle="collapse" data-target="#checkout_coupon" aria-expanded="true">Click here to enter your code</a>

                </h3>
                <div id="checkout_coupon" class="collapse" data-parent="#accordion">
                    <div class="checkout_info">
                        <form action="#">
                            <input placeholder="Coupon code" type="text">
                            <input value="Apply coupon" type="submit">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <form action="{{ route('payment.handle') }}" method="POST">
        <div class="checkout_form">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <h3>Thông tin khách hàng</h3>
                    <div class="row">
                        <div class="col-12 mb-30">
                            <label>Tên người nhận <span>*</span></label>
                            <input type="text" name="name">
                        </div>
                        <div class="col-12 mb-30">
                            <label>Số điện thoại người nhận <span>*</span></label>
                            <input type="number" name="phone">
                        </div>
                        <div class="col-12 mb-30">
                            <label>Địa chỉ người nhận <span>*</span></label>
                            <input type="text" name="address">
                        </div>
                        <div class="col-12 mb-30">
                            <label>Email người nhận </label>
                            <input type="text" name="email">
                        </div>
                        <div class="col-12">
                            <div class="order-notes">
                                <label for="order_note">Ghi chú</label>
                                <textarea id="order_note" name="note" rows="4"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <h3>Thông tin đơn hàng</h3>
                    <div class="order_table table-responsive mb-30">
                        <table>
                            <thead>
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Đơn giá</th>
                                </tr>
                            </thead>
                            @if(isset($result['items']) && !empty($result['items']))
                            <tbody>
                                @php
                                $total_price = 0;
                                @endphp
                                @foreach($result['items'] as $item)
                                @php
                                $total_price += $item['price'] * $item['quantity'];
                                @endphp
                                <tr>
                                    <td> {{ $item['name'] }} <strong> × {{ $item['quantity'] }}</strong></td>
                                    <td> {{ number_format($item['price'] * $item['quantity'], 0, 0) }} VNĐ</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Thành tiền</th>
                                    <td>{{ number_format($total_price, 0, 0) }} VNĐ</td>
                                </tr>
                                <tr>
                                    <th>Phí giao hàng</th>
                                    <td><strong>20,000 VNĐ</strong></td>
                                </tr>
                                <tr class="order_total">
                                    <th>Tổng cộng</th>
                                    <td><strong>{{ number_format($total_price + 20000, 0, 0) }} VNĐ</strong></td>
                                    <input type="hidden" name="total_price" value="{{ $total_price + 20000 }}"/>
                                </tr>
                            </tfoot>
                            @endif
                        </table>
                    </div>
                    @if(Auth::check())
                    <div class="payment_method">
                        <div class="order_button">
                            <button type="submit" name="action" value="online">Thanh toán VN Pay</button>
                        </div>
                    </div>
                    <div class="payment_method mt-2">
                        <div class="order_button">
                            <button type="submit" name="action" value="offline">Thanh toán khi nhận hàng</button>
                        </div>
                    </div>
                    @else
                    <p>Bạn chưa đăng nhập. Hãy thực hiện <a href="{{ route('login') }}" class="text-success">Đăng nhập</a> để tiếp tục thanh toán</p>
                    @endif
                </div>
            </div>
        </div>
        @csrf
    </form>
</div>
<!--Checkout page section end-->
@endsection