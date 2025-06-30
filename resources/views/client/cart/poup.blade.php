<a href="#"><i class="fa fa-shopping-cart"></i> {{ $cart_items['total_quantity'] }} Sản phẩm <i class="fa fa-angle-down"></i></a>

<!--mini cart-->
<div class="mini_cart">
    @if(isset($cart_items['items']) && !empty($cart_items['items']))
    @php
    $total_price = 0;
    @endphp
    @foreach($cart_items['items'] as $item)
    @php
    $total_price += $item['price'] * $item['quantity'];
    @endphp
    <div class="cart_item">
        <div class="cart_img">
            <a href="#"><img src="{{ $item['feature_image_path'] }}" alt=""></a>
        </div>
        <div class="cart_info">
            <a href="#">{{ $item['name'] }}</a>
            <span class="cart_price">{{ number_format($item['price'], 0, 0) }} VNĐ</span>
            <span>{{ $item['color_name'] }}, {{ $item['size_name'] }}</span>
            <span class="quantity">Số lượng: {{ $item['quantity'] }}</span>
        </div>
        <div class="cart_remove">
            <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
        </div>
    </div>
    @endforeach
    <!-- <div class="shipping_price">
                                <span> Shipping </span>
                                <span> $7.00 </span>
                            </div> -->
    <div class="total_price">
        <span> Tổng cộng </span>
        <span class="prices"> {{ number_format($total_price, 0, 0) }} VNĐ</span>
    </div>
    <div class="cart_button">
        <a href="{{ route('cart.index') }}"> Thanh toán</a>
    </div>
    @else
    <p>Giỏ hàng trống</p>
    @endif
</div>
<!--mini cart end-->