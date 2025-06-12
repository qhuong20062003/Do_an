@extends('client.layouts.app')

@section('content')
<div class=" pos_home_section">
    <div class="row pos_home">
        <div class="col-lg-3 col-md-8 col-12">
            <!--sidebar banner-->
            <div class="sidebar_widget banner mb-35">
                <div class="banner_img mb-35">
                    <a href="#"><img src="{{ asset('client\assets\img\banner\banner5.jpg') }}" alt=""></a>
                </div>
                <div class="banner_img">
                    <a href="#"><img src="{{ asset('client\assets\img\banner\banner6.jpg') }}" alt=""></a>
                </div>
            </div>
            <!--sidebar banner end-->

            <!--categorie menu start-->
            <div class="sidebar_widget catrgorie mb-35">
                <h3>Danh mục sản phẩm</h3>
                @if(isset($categories) && !empty($categories))
                <ul>
                    @foreach($categories->where('parent_id', 0) as $category)
                    <li class="has-sub"><a href="{{ route('product.category', ['id' => $category->id, 'slug' => $category->slug ]) }}"><i class="fa fa-caret-right"></i> {{ $category->name }}</a>
                        @if($categories->where('parent_id', $category->id)->count())
                        <ul class="categorie_sub">
                            @foreach($categories->where('parent_id', $category->id) as $category_child)
                            <li><a href="{{ route('product.category', ['id' => $category_child->id, 'slug' => $category_child->slug ]) }}"><i class="fa fa-caret-right"></i> {{ $category_child->name }}</a></li>
                            @endforeach
                        </ul>
                        @endif
                    </li>
                    @endforeach
                </ul>
                @endif
            </div>
            <!--categorie menu end-->

            <!--wishlist block start-->
            <!-- <div class="sidebar_widget wishlist mb-35">
                <div class="block_title">
                    <h3><a href="#">Wishlist</a></h3>
                </div>
                <div class="cart_item">
                    <div class="cart_img">
                        <a href="#"><img src="{{ asset('client\assets\img\cart\cart.jpg') }}" alt=""></a>
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
                        <a href="#"><img src="{{ asset('client\assets\img\cart\cart2.jpg') }}" alt=""></a>
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
            <div class="sidebar_widget tags mb-35">
                <div class="block_title">
                    <h3>popular tags</h3>
                </div>
                <div class="block_tags">
                    <a href="#">ipod</a>
                    <a href="#">sam sung</a>
                    <a href="#">apple</a>
                    <a href="#">iphone 5s</a>
                    <a href="#">superdrive</a>
                    <a href="#">shuffle</a>
                    <a href="#">nano</a>
                    <a href="#">iphone 4s</a>
                    <a href="#">canon</a>
                </div>
            </div>
            <!--popular tags end-->

            <!--newsletter block start-->
            <div class="sidebar_widget newsletter mb-35">
                <div class="block_title">
                    <h3>newsletter</h3>
                </div>
                <form action="#">
                    <p>Sign up for your newsletter</p>
                    <input placeholder="Your email address" type="text">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <!--newsletter block end-->

            <!--sidebar banner-->
            <div class="sidebar_widget bottom ">
                <div class="banner_img">
                    <a href="#"><img src="{{ asset('client\assets\img\banner\banner9.jpg') }}" alt=""></a>
                </div>
            </div>
            <!--sidebar banner end-->



        </div>
        <div class="col-lg-9 col-md-12">
            <!--banner slider start-->
            <div class="banner_slider slider_1">
                <div class="slider_active owl-carousel">
                    @if(isset($sliders) && !empty($sliders))
                    @foreach($sliders as $key => $slider)
                    <div class="single_slider" style="background-image: url('{{ $slider->image_path }}')">
                        <div class="slider_content">
                            <div class="slider_content_inner">
                                <h1>{{ $slider->name }}</h1>
                                <p>{{ $slider->description }}</p>
                                <a href="#">shop now</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>
            </div>
            <!--banner slider start-->

            <!--new product area start-->
            <div class="new_product_area">
                <div class="block_title">
                    <h3>Sản phẩm mới</h3>
                </div>
                <div class="row">
                    <div class="product_active owl-carousel">
                        @if(isset($new_products) && !empty($new_products))
                        @foreach($new_products as $new_product)
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a href="{{ route('detail.product', ['id' => $new_product->id]) }}"><img src="{{ $new_product->feature_image_path }}" alt=""></a>
                                    <div class="img_icone">
                                        <img src="{{ asset('client\assets\img\cart\span-new.png') }}" alt="">
                                    </div>
                                    <div class="product_action">
                                        <a class="detail_product" data-id="{{ $new_product->id }}"> <i class="fa fa-shopping-cart"></i> Mua hàng</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ number_format($new_product->price, 0, 0) }} VNĐ</span>
                                    <h3 class="product_title"><a href="{{ route('detail.product', ['id' => $new_product->id]) }}">{{ $new_product->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>
                                        <li><a href="#" title=" Add to Wishlist ">Yêu thích</a></li>
                                        <li><a href="{{ route('detail.product', ['id' => $new_product->id]) }}" title="Quick view">Chi tiết</a></li>
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

            <!--featured product start-->
            <div class="featured_product">
                <div class="block_title">
                    <h3>Sản phẩm đang hạ giá</h3>
                </div>
                <div class="row">
                    <div class="product_active owl-carousel">
                        @if(isset($discount_products) && !empty($discount_products))
                        @foreach($discount_products as $discount_product)
                        <div class="col-lg-3">
                            <div class="single_product">
                                <div class="product_thumb">
                                    <a href="{{ route('detail.product', ['id' => $discount_product->id]) }}"><img src="{{ $discount_product->feature_image_path }}" alt=""></a>
                                    <div class="hot_img">
                                        <img src="{{ asset('client\assets\img\cart\span-hot.png') }}" alt="">
                                    </div>
                                    <div class="product_action">
                                        <a class="detail_product" data-id="{{ $discount_product->id }}"> <i class="fa fa-shopping-cart"></i> Mua hàng</a>
                                    </div>
                                </div>
                                <div class="product_content">
                                    <span class="product_price">{{ number_format($discount_product->price, 0, 0) }} VNĐ</span>
                                    <h3 class="product_title"><a href="{{ route('detail.product', ['id' => $discount_product->id]) }}">{{ $discount_product->name }}</a></h3>
                                </div>
                                <div class="product_info">
                                    <ul>
                                        <li><a href="#" title=" Add to Wishlist ">Yêu thích</a></li>
                                        <li><a href="{{ route('detail.product', ['id' => $discount_product->id]) }}" title="Quick view">Chi tiết</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
            <!--featured product end-->

            <!--banner area start-->
            <div class="banner_area mb-60">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="single_banner">
                            <a href="#"><img src="{{ asset('client\assets\img\banner\banner7.jpg') }}" alt=""></a>
                            <div class="banner_title">
                                <p>Up to <span> 40%</span> off</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="single_banner">
                            <a href="#"><img src="{{ asset('client\assets\img\banner\banner8.jpg') }}" alt=""></a>
                            <div class="banner_title title_2">
                                <p>sale off <span> 30%</span></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--banner area end-->

            <!--brand logo strat-->
            <!-- <div class="brand_logo mb-60">
                <div class="block_title">
                    <h3>Brands</h3>
                </div>
                <div class="row">
                    <div class="brand_active owl-carousel">
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand1.jpg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand2.jpg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand3.jpg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand4.jpg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand5.jpg') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-lg-2">
                            <div class="single_brand">
                                <a href="#"><img src="{{ asset('client\assets\img\brand\brand6.jpg') }}" alt=""></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div> -->
            <!--brand logo end-->
        </div>
    </div>
</div>

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
    });
</script>
@endsection