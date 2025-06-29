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
                    <li>Sản phẩm</li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!--breadcrumbs area end-->

<!--pos home section-->
<div class=" pos_home_section">
    <div class="row pos_home">
        <div class="col-lg-3 col-md-12">
            @if(isset($categories) && count($categories) > 0)
            <!--layere categorie"-->
            <div class="sidebar_widget shop_c">
                <div class="categorie__titile">
                    <h4>Danh mục sản phẩm</h4>
                </div>
                <div class="layere_categorie">
                    <ul class="category-list">
                        @foreach($categories as $category)
                        <li>
                            <input type="radio" name="category" value="{{ $category['id'] }}">
                            <label for="acces">{{ $category['name'] }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!--layere categorie end-->
            @endif

            <!--color area start-->
            <div class="sidebar_widget color">
                <h2>Màu sắc</h2>
                <div class="widget_color">
                    <ul class="color-list">
                        @if(isset($colors) && !empty($colors))
                        @foreach($colors as $color)
                        <li>
                            <label class="color-option">
                                <input type="checkbox" name="color[]" value="{{ $color->id }}">
                                <span class="color-circle" style="background-color: {{ $color->code }};"></span>
                                {{ $color->name }}
                            </label>
                        </li>
                        @endforeach
                        @endif
                    </ul>
                </div>
            </div>

            <!--color area end-->

            <!--price slider start-->
            <div class="sidebar_widget price">
                <h2>Khoảng Giá</h2>
                <div class="ca_search_filters">
                    <p>
                        <input type="text" id="amount" readonly style="border:0; font-weight:bold;">
                    </p>
                    <div id="slider-range"></div>
                </div>
            </div>

            <!--price slider end-->

            <!--wishlist block start-->
            <!-- <div class="sidebar_widget wishlist mb-30">
                <div class="block_title">
                    <h3><a href="#">Wishlist</a></h3>
                </div>
                <div class="cart_item">
                    <div class="cart_img">
                        <a href="#"><img src="assets\img\cart\cart.jpg" alt=""></a>
                    </div>
                    <div class="cart_info">
                        <a href="#">lorem ipsum dolor</a>
                        <span class="cart_price">$115.00</span>
                        <span class="quantity">Qty: 1</span>
                    </div>
                    <div class="cart_remove">
                        <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                    </div>
                </div>
                <div class="cart_item">
                    <div class="cart_img">
                        <a href="#"><img src="assets\img\cart\cart2.jpg" alt=""></a>
                    </div>
                    <div class="cart_info">
                        <a href="#">Quisque ornare dui</a>
                        <span class="cart_price">$105.00</span>
                        <span class="quantity">Qty: 1</span>
                    </div>
                    <div class="cart_remove">
                        <a title="Remove this item" href="#"><i class="fa fa-times-circle"></i></a>
                    </div>
                </div>
                <div class="block_content">
                    <p>2 products</p>
                    <a href="#">» My wishlists</a>
                </div>
            </div> -->
            <!--wishlist block end-->

            <!--popular tags area-->
            <!-- <div class="sidebar_widget tags  mb-30">
                <div class="block_title">
                    <h3>Tags</h3>
                </div>
                <div class="block_tags">
                    <a href="#">ao</a>
                    <a href="#">quan</a>
                    <a href="#">phu kien</a>
                </div>
            </div> -->
            <!--popular tags end-->

            <!--newsletter block start-->
            <!-- <div class="sidebar_widget newsletter mb-30">
                <div class="block_title">
                    <h3>newsletter</h3>
                </div>
                <form action="#">
                    <p>Sign up for your newsletter</p>
                    <input placeholder="Your email address" type="text">
                    <button type="submit">Subscribe</button>
                </form>
            </div> -->
            <!--newsletter block end-->

            <!--special product start-->
            <!-- <div class="sidebar_widget special">
                <div class="block_title">
                    <h3>Special Products</h3>
                </div>
                <div class="special_product_inner mb-20">
                    <div class="special_p_thumb">
                        <a href="single-product.html"><img src="{{ asset('client\assets\img\cart\cart3.jpg') }}" alt=""></a>
                    </div>
                    <div class="small_p_desc">
                        <div class="product_ratting">
                            <ul>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h3><a href="single-product.html">Lorem ipsum dolor</a></h3>
                        <div class="special_product_proce">
                            <span class="old_price">$124.58</span>
                            <span class="new_price">$118.35</span>
                        </div>
                    </div>
                </div>
                <div class="special_product_inner">
                    <div class="special_p_thumb">
                        <a href="single-product.html"><img src="{{ asset('client\assets\img\cart\cart18.jpg') }}" alt=""></a>
                    </div>
                    <div class="small_p_desc">
                        <div class="product_ratting">
                            <ul>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                            </ul>
                        </div>
                        <h3><a href="single-product.html">Printed Summer</a></h3>
                        <div class="special_product_proce">
                            <span class="old_price">$124.58</span>
                            <span class="new_price">$118.35</span>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--special product end-->


        </div>
        <div class="col-lg-9 col-md-12">
            <!--banner slider start-->
            <!-- <div class="banner_slider mb-35">
                <img src="{{ asset('client\assets\img\banner\bannner10.jpg') }}" alt="">
            </div> -->
            <!--banner slider start-->

            <!--shop toolbar start-->
            <div class="shop_toolbar mb-35">

                <div class="list_button">
                    <ul class="nav" role="tablist">
                        <li>
                            <a class="active" data-toggle="tab" href="#large" role="tab" aria-controls="large" aria-selected="true"><i class="fa fa-th-large"></i></a>
                        </li>
                        <li>
                            <a data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="false"><i class="fa fa-th-list"></i></a>
                        </li>
                    </ul>
                </div>
                <!-- <div class="page_amount">
                    <p>Showing 1–9 of 21 results</p>
                </div> -->

                <!-- <div class="select_option">
                    <form action="#">
                        <label>Sort By</label>
                        <select name="orderby" id="short">
                            <option selected="" value="1">Position</option>
                            <option value="1">Price: Lowest</option>
                            <option value="1">Price: Highest</option>
                            <option value="1">Product Name:Z</option>
                            <option value="1">Sort by price:low</option>
                            <option value="1">Product Name: Z</option>
                            <option value="1">In stock</option>
                            <option value="1">Product Name: A</option>
                            <option value="1">In stock</option>
                        </select>
                    </form>
                </div> -->
            </div>
            <!--shop toolbar end-->

            <!--shop tab product-->
            <div class="shop_tab_product">
                <div class="tab-content list-product" id="myTabContent">
                    <div class="tab-pane fade show active" id="large" role="tabpanel">
                        <div class="row">
                            @if(isset($products) && !empty($products))
                            @foreach($products as $product)
                            <div class="col-lg-4 col-md-6">
                                <div class="single_product">
                                    <div class="product_thumb">
                                        <a href="{{ route('detail.product', ['id' => $product->id]) }}"><img src="{{ $product->feature_image_path }}" alt=""></a>
                                        <div class="img_icone">
                                            <img src="assets\img\cart\span-new.png" alt="">
                                        </div>
                                        <div class="product_action">
                                            <a class="detail_product" data-id="{{ $product->id }}"> <i class="fa fa-shopping-cart"></i> Mua hàng</a>
                                        </div>
                                    </div>
                                    <div class="product_content">
                                        <span class="product_price">{{ number_format($product->price, 0, 0) }} VNĐ</span>
                                        <h3 class="product_title"><a href="{{ route('detail.product', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                    </div>
                                    <div class="product_info">
                                        <ul>
                                            <!-- <li><a href="#" title=" Add to Wishlist ">Yêu thích</a></li> -->
                                            <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view">Chi tiết</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="tab-pane fade" id="list" role="tabpanel">
                        @if(isset($products) && !empty($products))
                        @foreach($products as $product)
                        <div class="product_list_item mb-35">
                            <div class="row align-items-center">
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product_thumb">
                                        <a href="{{ route('detail.product', ['id' => $product->id]) }}"><img src="{{ $product->feature_image_path }}" alt=""></a>
                                        <div class="hot_img">
                                            <img src="assets\img\cart\span-hot.png" alt="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-md-6 col-sm-6">
                                    <div class="list_product_content">
                                        <div class="product_ratting">
                                            <ul>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                                <li><a href="#"><i class="fa fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="list_title">
                                            <h3><a href="{{ route('detail.product', ['id' => $product->id]) }}">{{ $product->name }}</a></h3>
                                        </div>
                                        <p class="design"> in quibusdam accusantium qui nostrum consequuntur, officia, quidem ut placeat. Officiis, incidunt eos recusandae! Facilis aliquam vitae blanditiis quae perferendis minus eligendi</p>

                                        <!-- <p class="compare">
                                            <input id="select" type="checkbox">
                                            <label for="select">Select to compare</label>
                                        </p> -->
                                        <div class="content_price">
                                            <span>{{ number_format($product->price, 0, 0) }} VNĐ</span>
                                            <span class="old-price">$130.00</span>
                                        </div>
                                        <div class="add_links">
                                            <ul>
                                                <li><a class="detail_product" data-id="{{ $product->id }}" title="add to cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a></li>
                                                <!-- <li><a href="#" title="add to wishlist"><i class="fa fa-heart" aria-hidden="true"></i></a></li> -->
                                                <li><a href="#" data-toggle="modal" data-target="#modal_box" title="Quick view"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!--shop tab product end-->

            <!--pagination style start-->
            <!-- <div class="pagination_style">
                <div class="item_page">
                    <form action="#">
                        <label for="page_select">show</label>
                        <select id="page_select">
                            <option value="1">9</option>
                            <option value="2">10</option>
                            <option value="3">11</option>
                        </select>
                        <span>Products by page</span>
                    </form>
                </div>
                <div class="page_number">
                    <span>Pages: </span>
                    <ul>
                        <li>«</li>
                        <li class="current_number">1</li>
                        <li><a href="#">2</a></li>
                        <li>»</li>
                    </ul>
                </div>
            </div> -->
            <!--pagination style end-->
        </div>
    </div>
</div>
<!--pos home section end-->

<!-- modal area start -->
<div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">

</div>
<!-- modal area end -->

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $("#slider-range").slider({
            range: true,
            min: 0,
            max: 1000000,
            step: 10000,
            values: [100000, 500000],
            slide: function(event, ui) {
                $("#amount").val(ui.values[0].toLocaleString() + "₫ - " + ui.values[1].toLocaleString() + "₫");
            },
            change: function(event, ui) {
                filterProducts();
            }
        });
        // Hiển thị mặc định
        $("#amount").val(
            $("#slider-range").slider("values", 0).toLocaleString() + "₫ - " +
            $("#slider-range").slider("values", 1).toLocaleString() + "₫"
        );

        $('.detail_product').click(function() {
            let productId = $(this).data('id');

            $.ajax({
                url: '{{ route("view.detail.product") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                },
                success: function(response) {
                    $('#modal_box').html(response);
                    $('#modal_box').modal('show');
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });

        $('.color-list input[type="checkbox"]').on('change', function () {
            filterProducts(); 
        });

        $('.category-list input[type="radio"]').on('change', function () {
            filterProducts(); 
        });

        function filterProducts() {
            var id = <?php echo json_encode($id) ?>;
            let priceRange = $("#slider-range").slider("values");
            let priceMin = priceRange[0];
            let priceMax = priceRange[1];
            let colors = [];
            $('.color-list input[type="checkbox"]:checked').each(function () {
                colors.push($(this).val());
            });

            let category_id = $('.category-list input[type="radio"]:checked').val();
            
            $.ajax({
                url: '{{ route("filter.product") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    colors: colors,
                    id: id,
                    category_id: category_id,
                    price_min: priceMin,
                    price_max: priceMax
                },
                success: function(response) {
                    console.log(response);
                    
                    $(".list-product").html(response);
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        }
    });
</script>
<style>
    .color-list {
        list-style: none;
        padding-left: 0;
        margin: 0;
    }

    .color-option {
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        font-size: 14px;
    }

    .color-option input[type="checkbox"] {
        width: 16px;
        height: 16px;
        margin-right: 6px;
    }

    .color-circle {
        display: inline-block;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        border: 1px solid #ccc;
    }

    .count {
        color: #888;
        margin-left: auto;
        font-size: 13px;
    }
</style>
@endsection