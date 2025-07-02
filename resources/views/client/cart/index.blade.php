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
                    <li>Giỏ hàng</li>
                </ul>

            </div>
        </div>
    </div>
</div> -->
<!--breadcrumbs area end-->



<!--shopping cart area start -->
<div class="shopping_cart_area">
    <form action="#">
        <div class="row">
            <div class="col-12">
                <div class="table_desc">
                    <div class="cart_page table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_remove"></th>
                                    <th class="product_thumb">Hình ảnh</th>
                                    <th class="product_name">Sản phẩm</th>
                                    <th class="product-price">Giá</th>
                                    <th class="product_quantity">Số lượng</th>
                                    <th class="product_total">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $total_price = 0;
                                $sub_total = 0;
                                @endphp
                                @if(isset($list_cart_items) && !empty($list_cart_items))
                                @foreach($list_cart_items as $item)
                                @php 
                                $total_price = $item['price'] * $item['quantity'];
                                $sub_total += $total_price;
                                @endphp
                                <tr data-id="{{ $item['product_variant_id'] }}">
                                    <td class="product_remove"><a class="remove_product_cart"><i class="fa fa-trash-o"></i></a></td>
                                    <td class="product_thumb"><a href="#"><img src="{{ $item['feature_image_path'] }}" alt=""></a></td>
                                    <td class="product_name">
                                        <a href="#">{{ $item['name'] }}</a>
                                        <br>
                                        <span>{{ $item['color_name'] }}, {{ $item['size_name'] }}</span>
                                    </td>
                                    <td class="product-price">{{ number_format($item['price'], 0, 0) }} VNĐ</td>
                                    <td class="product_quantity"><input min="0" max="100" value="{{ $item['quantity'] }}" type="number" class="input_product_quantity"></td>
                                    <td class="product_total">{{ number_format($total_price, 0, 0) }} VNĐ</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <!-- <div class="cart_submit">
                        <button type="submit">update cart</button>
                    </div> -->
                </div>
            </div>
        </div>
        <!--coupon code area start-->
        <div class="coupon_area">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <!-- <div class="coupon_code">
                        <h3>Coupon</h3>
                        <div class="coupon_inner">
                            <p>Enter your coupon code if you have one.</p>
                            <input placeholder="Coupon code" type="text">
                            <button type="submit">Apply coupon</button>
                        </div>
                    </div> -->
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="coupon_code">
                        <h3>Hóa đơn</h3>
                        <div class="coupon_inner">
                            <div class="cart_subtotal">
                                <p>Đơn giá</p>
                                <p class="cart_amount" id="sub_total">{{ number_format($sub_total, 0, 0) }} VNĐ</p>
                            </div>
                            <div class="cart_subtotal ">
                                <p>Phí giao hàng</p>
                                <p class="cart_amount"> 20,000 VNĐ</p>
                            </div>
                            <!-- <a href="#">Calculate shipping</a> -->

                            <div class="cart_subtotal">
                                <p>Tổng tiền</p>
                                <p class="cart_amount" id="g_total">{{ number_format($sub_total + 20000, 0, 0) }} VNĐ</p>
                            </div>
                            <div class="checkout_btn">
                                <a href="{{ route('checkout') }}">Thanh toán</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--coupon code area end-->
    </form>
</div>
<!--shopping cart area end -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('.input_product_quantity').off('change').on('change',function() {
            let self = this;
            let productVariantId = $(self).closest('tr').data('id');
            let quantity = $(self).val();

            $.ajax({
                url: '{{ route("cart.edit") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_variant_id: productVariantId,
                    quantity: quantity
                },
                success: function (response) {
                    $(self).closest('tr').find('.product_total').text(response.total_price);
                    $("#sub_total").text(response.sub_total);
                    $("#g_total").text(response.g_total);
                },
                error: function (xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        }); 

        $('.remove_product_cart').click(function() {
            let self = this;
            let productVariantId = $(self).closest('tr').data('id');

            $.ajax({
                url: '{{ route("cart.delete") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_variant_id: productVariantId,
                },
                success: function (response) {
                    $(self).closest('tr').remove();
                    $("#sub_total").text(response.sub_total);
                    $("#g_total").text(response.g_total);
                },
                error: function (xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });
    });
</script>
@endsection