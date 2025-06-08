@extends('admin.layouts.admin')

@section('title')
<title>Trang chu</title>
@endsection
@section('css')
<link rel="stylesheet" href="{{ asset('admins/slider/index/index.css') }}">
@endsection

@section('js')
<script src="{{ asset('vendors/sweetAlert2/sweetalert2@11.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/main.js') }}"></script>

@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Order','key'=> 'List'])

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Mã đơn hàng </th>
                                <th scope="col">Họ và tên người đặt</th>
                                <th scope="col">Tổng tiền</th>
                                <th scope="col">Trạng thái</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order )

                            <tr>
                                <th scope="row">{{ $order->id }}</th>
                                <td>{{ $order->code }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td>{{ number_format($order->total_price, 0, 0) }} VNĐ</td>

                                <td>
                                    <a href="#" class="btn btn-warning">
                                        @if($order->status == 0)
                                        Đang chờ xác nhận
                                        @elseif($order->status == 1)
                                        Đang giao hàng
                                        @else
                                        Đã giao hàng
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection