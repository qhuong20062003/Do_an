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
                    <li>{{ $product->name }}</li>
                </ul>

            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->


<!--product wrapper start-->
<div class="product_details">
    <div class="row">
        <div class="col-lg-5 col-md-6">
            <div class="product_tab fix">
                <div class="product_tab_button">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-toggle="tab" href="#p_tab1" role="tab" aria-controls="p_tab1" aria-selected="false"><img src="{{ $product->feature_image_path }}" alt=""></a>
                        </li>
                        @if(isset($product_images) && !empty($product_images))
                        @php $index = 2; @endphp
                        @foreach($product_images as $product_image)
                        <li>
                            <a data-toggle="tab" href="#p_tab{{ $index }}" role="tab" aria-controls="p_tab{{ $index }}" aria-selected="false"><img src="{{ $product_image->image_path }}" alt=""></a>
                        </li>
                        @php $index ++; @endphp
                        @endforeach
                        @endif
                    </ul>
                </div>
                <div class="tab-content produc_tab_c">
                    <div class="tab-pane fade show active" id="p_tab1" role="tabpanel">
                        <div class="modal_img">
                            <a href="#"><img src="{{ $product->feature_image_path }}" alt=""></a>
                            <div class="img_icone">
                                <img src="assets\img\cart\span-new.png" alt="">
                            </div>
                            <div class="view_img">
                                <a class="large_view" href="{{ $product->feature_image_path }}"><i class="fa fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    @if(isset($product_images) && !empty($product_images))
                    @php $index = 2; @endphp
                    @foreach($product_images as $product_image)
                    <div class="tab-pane fade" id="p_tab{{ $index }}" role="tabpanel">
                        <div class="modal_img">
                            <a href="#"><img src="{{ $product_image->image_path }}" alt=""></a>
                            <div class="img_icone">
                                <img src="assets\img\cart\span-new.png" alt="">
                            </div>
                            <div class="view_img">
                                <a class="large_view" href="{{ $product_image->image_path }}"><i class="fa fa-search-plus"></i></a>
                            </div>
                        </div>
                    </div>
                    @php $index ++; @endphp
                    @endforeach
                    @endif
                </div>

            </div>
        </div>
        <div class="col-lg-7 col-md-6">
            <div class="product_d_right">
                <h1>{{ $product->name }}</h1>
                <div class="product_ratting mb-10">
                    <ul>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"><i class="fa fa-star"></i></a></li>
                        <li><a href="#"> Write a review </a></li>
                    </ul>
                </div>
                <div class="product_desc">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Obcaecati modi culpa voluptates illo, quos magni totam inventore delectus perspiciatis necessitatibus, iure rerum! Deleniti nobis voluptatibus minus, iusto ullam quae esse..</p>
                </div>

                <div class="content_price mb-15">
                    @if(!empty($product->discount) && $product->discount > 0)
                    <span>{{ number_format($product->discount, 0, 0) }} VNĐ</span>
                    <span class="old-price">{{ number_format($product->price, 0, 0) }} VNĐ</span>
                    @else
                    <span>{{ number_format($product->price, 0, 0) }} VNĐ</span>
                    @endif
                </div>
                <form action="{{ route('cart.add') }}" method="POST">
                <div class="box_quantity mb-20">
                    <label>Số lượng</label>
                    <input min="0" max="100" value="1" type="number" name="quantity" id="product_quantity">
                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}"/>
                    <input type="hidden" name="product_variant_id" id="product_variant_id" value=""/>
                    <input type="hidden" name="type_cart" value="detail_product"/>
                    @csrf
                    <div class="box_add_to_cart"></div>
                    <!-- <a href="#" title="add to wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a> -->
                </div>
                </form>
                @if(isset($sizes) && !empty($sizes))
                <div class="product_d_size mb-20">
                    <label for="group_1">size</label>
                    <select name="size_id" id="size">
                        @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if(isset($colors) && !empty($colors))
                <div class="sidebar_widget color">
                    <h2>Màu sắc</h2>
                    <div class="widget_color">
                        <ul class="list-unstyled d-flex">
                            @foreach($colors as $color)
                            <li>
                                <label>
                                    <input type="radio" class="color-radio" name="color_id" value="{{ $color->id }}">
                                    <span class="color-option" style="background-color: {{ $color->code }};"></span>
                                </label>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                </div>
                @endif

                <!-- <div class="product_stock mb-20">
                    <p>299 items</p>
                    <span> Số lượng còn trong kho </span>
                </div>
                <div class="wishlist-share">
                    <h4>Share on:</h4>
                    <ul>
                        <li><a href="#"><i class="fa fa-rss"></i></a></li>
                        <li><a href="#"><i class="fa fa-vimeo"></i></a></li>
                        <li><a href="#"><i class="fa fa-tumblr"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                    </ul>
                </div> -->

            </div>
        </div>
    </div>
</div>
<!--product details end-->


<!--product info start-->
<div class="product_d_info">
    <div class="row">
        <div class="col-12">
            <div class="product_d_inner">
                <div class="product_info_button">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-toggle="tab" href="#info" role="tab" aria-controls="info" aria-selected="false">Mô tả sản phẩm</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#sheet" role="tab" aria-controls="sheet" aria-selected="false">Data sheet</a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#reviews" role="tab" aria-controls="reviews" aria-selected="false">Reviews</a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade show active" id="info" role="tabpanel">
                        <div class="product_info_content">
                            {!! $product->content !!}
                        </div>
                    </div>

                    <div class="tab-pane fade" id="sheet" role="tabpanel">
                        <div class="product_d_table">
                            <form action="#">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td class="first_child">Compositions</td>
                                            <td>Polyester</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Styles</td>
                                            <td>Girly</td>
                                        </tr>
                                        <tr>
                                            <td class="first_child">Properties</td>
                                            <td>Short Dress</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                        <div class="product_info_content">
                            <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="reviews" role="tabpanel">
                        <div class="product_info_content">
                            <p>Fashion has been creating well-designed collections since 2010. The brand offers feminine designs delivering stylish separates and statement dresses which have since evolved into a full ready-to-wear collection in which every item is a vital part of a woman's wardrobe. The result? Cool, easy, chic looks with youthful elegance and unmistakable signature style. All the beautiful pieces are made in Italy and manufactured with the greatest attention. Now Fashion extends to a range of accessories including shoes, hats, belts and more!</p>
                        </div>
                        <div class="product_info_inner">
                            <div class="product_ratting mb-10">
                                <ul>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                    <li><a href="#"><i class="fa fa-star"></i></a></li>
                                </ul>
                                <strong>Posthemes</strong>
                                <p>09/07/2018</p>
                            </div>
                            <div class="product_demo">
                                <strong>demo</strong>
                                <p>That's OK!</p>
                            </div>
                        </div>
                        <div class="product_review_form">
                            <form action="#">
                                <h2>Add a review </h2>
                                <p>Your email address will not be published. Required fields are marked </p>
                                <div class="row">
                                    <div class="col-12">
                                        <label for="review_comment">Your review </label>
                                        <textarea name="comment" id="review_comment"></textarea>
                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="author">Name</label>
                                        <input id="author" type="text">

                                    </div>
                                    <div class="col-lg-6 col-md-6">
                                        <label for="email">Email </label>
                                        <input id="email" type="text">
                                    </div>
                                </div>
                                <button type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--product info end-->


<!--new product area start-->
<!-- <div class="new_product_area product_page">
    <div class="row">
        <div class="col-12">
            <div class="block_title">
                <h3> 11 other products category:</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="single_p_active owl-carousel">
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="assets\img\product\product1.jpg" alt=""></a>
                        <div class="img_icone">
                            <img src="assets\img\cart\span-new.png" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">$50.00</span>
                        <h3 class="product_title"><a href="single-product.html">Curabitur sodales</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="assets\img\product\product2.jpg" alt=""></a>
                        <div class="hot_img">
                            <img src="assets\img\cart\span-hot.png" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">$40.00</span>
                        <h3 class="product_title"><a href="single-product.html">Quisque ornare dui</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="assets\img\product\product3.jpg" alt=""></a>
                        <div class="img_icone">
                            <img src="assets\img\cart\span-new.png" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">$60.00</span>
                        <h3 class="product_title"><a href="single-product.html">Sed non turpiss</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="assets\img\product\product4.jpg" alt=""></a>
                        <div class="hot_img">
                            <img src="assets\img\cart\span-hot.png" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">$65.00</span>
                        <h3 class="product_title"><a href="single-product.html">Duis convallis</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="single-product.html"><img src="assets\img\product\product6.jpg" alt=""></a>
                        <div class="img_icone">
                            <img src="assets\img\cart\span-new.png" alt="">
                        </div>
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Add to cart</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">$50.00</span>
                        <h3 class="product_title"><a href="single-product.html">Curabitur sodales</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Add to Wishlist</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">View Detail</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> -->
<!--new product area start-->


<!--new product area start-->
<div class="new_product_area product_page">
    <div class="row">
        <div class="col-12">
            <div class="block_title">
                <h3> Sản phẩm liên quan</h3>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="single_p_active owl-carousel">
            @if(isset($related_products) && !empty($related_products))
            @foreach($related_products as $related_product)
            <div class="col-lg-3">
                <div class="single_product">
                    <div class="product_thumb">
                        <a href="{{ route('detail.product', ['id' => $related_product->id]) }}"><img src="{{ $related_product->feature_image_path }}" alt=""></a>
                        <!-- <div class="img_icone">
                            <img src="{{ asset('client\assets\img\cart\span-new.png') }}" alt="">
                        </div> -->
                        <div class="product_action">
                            <a href="#"> <i class="fa fa-shopping-cart"></i> Mua hàng</a>
                        </div>
                    </div>
                    <div class="product_content">
                        <span class="product_price">{{ number_format($related_product->price, 0, 0) }} VNĐ</span>
                        <h3 class="product_title"><a href="{{ route('detail.product', ['id' => $related_product->id]) }}">{{ $related_product->name }}</a></h3>
                    </div>
                    <div class="product_info">
                        <ul>
                            <li><a href="#" title=" Add to Wishlist ">Yêu thích</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">Chi tiết</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</div>
<!--new product area start-->
<style>
    .list-unstyled{
        gap: 10px;
    }
    .color-option {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        display: inline-block;
        cursor: pointer;
        position: relative;
        border: 2px solid transparent;
        transition: border-color 0.3s;
    }

    .color-radio:checked + .color-option {
        border-color: #fff; /* Viền màu đen khi được chọn */
    }

    .color-radio {
        display: none; /* Ẩn radio */
    }
    .sold_out{
        color: red;
        font-size: 16px;
        display: flex;
        align-items: center;
        margin-left: 30px;
    }
</style>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('#size').change(function() {
            let size_id = $("#size").val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();

            if(!color_id || !product_quantity) {
                alert('Vui lòng chọn đủ thuộc tính của sản phẩm');
            } else {
                $.ajax({
                    url: '{{ route("check.stock") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        color_id: color_id,
                        size_id: size_id,
                        quantity: product_quantity,
                    },
                    success: function (response) {
                        $(".box_add_to_cart").empty();
                        if(response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit"><i class="fa fa-shopping-cart"></i> Mua hàng</button>`);
                        } else if(response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }
                        
                    },
                    error: function (xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }
            
        });
        
        $('#product_quantity').change(function() {
            let size_id = $("#size").val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();

            if(!color_id || !product_quantity) {
                alert('Vui lòng chọn đủ thuộc tính của sản phẩm');
            } else {
                $.ajax({
                    url: '{{ route("check.stock") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        color_id: color_id,
                        size_id: size_id,
                        quantity: product_quantity,
                    },
                    success: function (response) {
                        $(".box_add_to_cart").empty();
                        if(response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit"><i class="fa fa-shopping-cart"></i> Mua hàng</button>`);
                        } else if(response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }
                    },
                    error: function (xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }
        });

        $('.color-radio').change(function() {
            let size_id = $("#size").val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();

            if(!color_id || !product_quantity) {
                alert('Vui lòng chọn đủ thuộc tính của sản phẩm');
            } else {
                $.ajax({
                    url: '{{ route("check.stock") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        product_id: product_id,
                        color_id: color_id,
                        size_id: size_id,
                        quantity: product_quantity,
                    },
                    success: function (response) {
                        $(".box_add_to_cart").empty();
                        if(response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit"><i class="fa fa-shopping-cart"></i> Mua hàng</button>`);
                        } else if(response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }
                    },
                    error: function (xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }
        });
    });
</script>
@endsection