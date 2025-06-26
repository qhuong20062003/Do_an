@extends('admin.layouts.admin')

@section('title')
<title>Danh sách đơn hàng</title>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('admins/order/index/list.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header', ['name' => 'Danh sách', 'key' => 'đơn hàng'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-light">
                            <h5 class="mb-0">Danh sách đơn hàng</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-hover align-middle text-center">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Mã đơn hàng</th>
                                        <th>Người đặt</th>
                                        <th>Ngày đặt</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($orders as $order)
                                    <tr>
                                        <td>{{ $order->id }}</td>
                                        <td>{{ $order->code }}</td>
                                        <td>{{ $order->customer_name }}</td>
                                        <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ number_format($order->total_price, 0, '.', ',') }} VNĐ</td>
                                        <td>
                                            @if($order->status == 0)
                                            <a href="{{ route('orders.edit', ['id' => $order->id]) }}"
                                                class="btn btn-sm btn-outline-warning">Đang xử lý</a>
                                            @elseif($order->status == 1)
                                            <a href="{{ route('orders.edit', ['id' => $order->id]) }}"
                                                class="btn btn-sm btn-outline-primary">Đã xác nhận</a>
                                            @elseif($order->status == 2)
                                            <a href="{{ route('orders.edit', ['id' => $order->id]) }}"
                                                class="btn btn-sm btn-outline-info">Đang giao hàng</a>
                                            @else
                                            <a href="{{ route('orders.edit', ['id' => $order->id]) }}"
                                                class="btn btn-sm btn-outline-success">Giao hàng thành công</a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="d-flex justify-content-center mt-3">
                                {{ $orders->links() }}
                            </div>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>
    </div>
</div>
@endsection