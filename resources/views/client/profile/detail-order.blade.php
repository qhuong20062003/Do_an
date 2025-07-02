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
                    <li>Chi tiết đơn hàng</li>
                </ul>

            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->

<!-- Start Maincontent  -->
<section class="main_content_area">
    <div class="container mt-4 mb-5">
        <h2 class="mb-4">Chi tiết đơn hàng</h2>
        <div class="row">
            <!-- Cột trái -->
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white">Thông tin đơn hàng</div>
                    <div class="card-body">
                        <p><strong>Mã đơn hàng:</strong> {{ $order->code }}</p>
                        <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                        <p>
                            <strong>Trạng thái:</strong>
                            @if($order->status == 0) 
                            <span class="badge bg-warning">Đang xử lý</span>
                            @elseif($order->status == 1)
                            <span class="badge bg-primary">Đã xác nhận</span>
                            @elseif($order->status == 2)
                            <span class="badge bg-info">Đang giao hàng</span>
                            @else
                            <span class="badge bg-success">Giao hàng thành công</span>
                            @endif
                        </p>
                        <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header bg-primary text-white">Thông tin khách hàng</div>
                    <div class="card-body">
                        <p><strong>Họ tên:</strong> {{ $order->customer_name }}</p>
                        <p><strong>SĐT:</strong> {{ $order->customer_phone }}</p>
                        <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                        @if(isset($order->customer_email) && !empty($order->customer_email))
                        <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                        @endif
                    </div>
                </div>
                @if($order->status == 0) 
                <a href="{{ route('cancel.order', ['id' => $order->id]) }}" class="btn btn-danger mt-3">Hủy đơn hàng</a>
                @endif
            </div>

            <!-- Cột phải -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">Danh sách sản phẩm</div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered">
                            <thead class="table-light">
                                <tr>
                                    <th>Sản phẩm</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($products) && !empty($products))
                                @foreach($products as $product)
                                <tr>
                                    <td>
                                        {{ $product->product_name }}
                                        <br>
                                        <small>{{ $product->color_name }}, {{ $product->size_name }}</small>
                                    </td>
                                    <td>{{ number_format($product->product_price, 0, 0) }} VNĐ</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td>{{ number_format($product->price * $product->quantity, 0, 0) }} VNĐ</td>
                                </tr>
                                @endforeach
                                @endif
                                <tr>
                                    <td colspan="3" class="text-end">Phí giao hàng:</td>
                                    <td>20,000 VNĐ</td>
                                </tr>
                                <tr>
                                    <td colspan="3" class="text-end"><strong>Tổng cộng:</strong></td>
                                    <td><strong>{{ number_format($order->total_price, 0, 0) }} VNĐ</strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- End Maincontent  -->
<style>
    .bg-primary{
        background: #00bba6 !important;
    }
</style>
@endsection