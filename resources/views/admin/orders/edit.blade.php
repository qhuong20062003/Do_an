@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection

@section('css')
<link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
<link href="{{ asset('admins/user/add/add.css') }}" rel="stylesheet" />
@endsection
@section('js')
<script src="{{ asset('vendors/select2/select2.min.js') }}"></script>
<script src="{{ asset('admins/user/add/add.js') }}"></script>
@endsection

@section('content')

<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Chỉnh sửa','key'=> 'đơn hàng'])

    <!-- Nội dung chính -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- Thông tin khách hàng + Trạng thái -->
                <div class="col-md-6">
                    <!-- Thông tin khách hàng -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Thông tin khách hàng</h3>
                        </div>
                        <div class="card-body">
                            <p><strong>Tên:</strong> {{ $order->customer_name }}</p>
                            <p><strong>Email:</strong> {{ $order->customer_email }}</p>
                            <p><strong>Số điện thoại:</strong> {{ $order->customer_phone }}</p>
                            <p><strong>Địa chỉ:</strong> {{ $order->customer_address }}</p>
                            <p><strong>Ngày đặt:</strong> {{ $order->created_at->format('d/m/Y H:i') }}</p>
                            <p><strong>Ghi chú:</strong> {{ $order->note }}</p>
                        </div>
                    </div>

                    <!-- Cập nhật trạng thái đơn hàng -->
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Trạng thái đơn hàng</h3>
                        </div>
                        <form action="{{ route('orders.update') }}" method="POST">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Chọn trạng thái:</label>
                                    <select class="form-control" name="status">
                                        <option value="0" selected>Đang xử lý</option>
                                        <option value="1">Đã xác nhận</option>
                                        <option value="2">Đang giao hàng</option>
                                        <option value="3">Giao hàng thành công</option>
                                    </select>
                                </div>
                            </div>
                            <div class="card-footer">
                                <input type="hidden" name="order_id" value="{{ $order->id }}"/>
                                <button type="submit" class="btn btn-success">Cập nhật</button>
                            </div>
                            @csrf
                        </form>
                    </div>
                </div>

                <!-- Danh sách sản phẩm -->
                <div class="col-md-6">
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Sản phẩm trong đơn hàng</h3>
                        </div>
                        <div class="card-body table-responsive p-0">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Đơn giá</th>
                                        <th>Thành tiền</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($products) && !empty($products))
                                    @foreach($products as $product)
                                    <tr>
                                        <td>{{ $product->product_name }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ number_format($product->product_price, 0, 0) }} VNĐ</td>
                                        <td>{{ number_format($product->product_price * $product->quantity, 0, 0) }} VNĐ</td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="3">Phí giao hàng</td>
                                        <td><strong>20,000 VNĐ</strong></td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="3"><strong>Tổng tiền</strong></td>
                                        <td><strong>{{ number_format($order->total_price, 0, 0) }} VNĐ</strong></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- /col -->
            </div> <!-- /row -->
        </div>
    </section>
</div>

@endsection