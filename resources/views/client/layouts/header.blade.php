<div class="header_area">
    <!--header top-->
    <!-- <div class="header_top">
        <div class="row align-items-center">
            <div class="col-lg-6 col-md-6">
                <div class="switcher">
                    <ul>
                        <li class="languages"><a href="#"><img src="{{ asset('client\assets\img\logo\fontlogo.jpg') }}" alt=""> English <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown_languages">
                                <li><a href="#"><img src="{{ asset('client\assets\img\logo\fontlogo.jpg') }}" alt=""> English</a></li>
                                <li><a href="#"><img src="{{ asset('client\assets\img\logo\fontlogo2.jpg') }}" alt=""> French </a></li>
                            </ul>
                        </li>

                        <li class="currency"><a href="#"> Currency : $ <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown_currency">
                                <li><a href="#"> Dollar (USD)</a></li>
                                <li><a href="#"> Euro (EUR) </a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="header_links">
                    <ul>
                        <li><a href="contact.html" title="Contact">Contact</a></li>
                        <li><a href="wishlist.html" title="wishlist">My wishlist</a></li>
                        <li><a href="my-account.html" title="My account">My account</a></li>
                        <li><a href="cart.html" title="My cart">My cart</a></li>
                        <li><a href="login.html" title="Login">Login</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> -->
    <!--header top end-->

    <!--header middel-->
    <div class="header_middel">
        <div class="row align-items-center">
            <!--logo start-->
            <div class="col-lg-3 col-md-3">
                <div class="logo">
                    <a href="{{ route('index') }}"><img src="{{ asset('client\assets\img\logo\logo.jpg.png') }}" alt=""></a>
                </div>
            </div>
            <!--logo end-->
            <div class="col-lg-9 col-md-9">
                <div class="header_right_info">
                    <div class="search_bar">
                        <form action="#">
                            <input placeholder="Tìm kiếm..." type="text">
                            <button type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </div>
                    <div class="shopping_cart" id="shopping_cart">
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
                                    <span class="quantity">SL: {{ $item['quantity'] }}</span>
                                </div>
                                <div class="cart_remove">
                                    <a class="remove_cart_item" data-id="{{ $item['product_variant_id'] }}"><i class="fa fa-times-circle"></i></a>
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
                    </div>

                    <div class="account_dropdown">
                        @if(Auth::check())
                        <a href="#" id="accountToggle">{{ Auth::user()->name }} <i class="fa fa-angle-down"></i></a>

                        <div class="account_menu" style="display: none;">
                            <a href="{{ route('logout') }}">
                                Đăng xuất
                            </a>
                        </div>
                        @else
                        <a href="{{ route('login') }}">Đăng nhập</a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!--header middel end-->
    <div class="header_bottom">
        <div class="row">
            <div class="col-12">
                <div class="main_menu_inner">
                    <div class="main_menu d-none d-lg-block">
                        @if(isset($menus) && !empty($menus))
                        <nav>
                            <ul>
                                <!-- <li class="active"><a href="index.html">Home</a>
                                    <div class="mega_menu jewelry">
                                        <div class="mega_items jewelry">
                                            <ul>
                                                <li><a href="index.html">Home 1</a></li>
                                                <li><a href="index-2.html">Home 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li> -->
                                @foreach($menus->where('parent_id', 0) as $menu)
                                <li><a href="shop.html">{{ $menu->name }}</a>
                                    @if($menus->where('parent_id', $menu->id)->count())
                                    <div class="mega_menu jewelry">
                                        <div class="mega_items jewelry">
                                            <ul>
                                                @foreach($menus->where('parent_id', $menu->id) as $menu_child)
                                                <li><a href="{{ route('product.menu', ['id' => $menu_child->id, 'slug' => $menu_child->slug]) }}">{{ $menu_child->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </li>
                                @endforeach
                                <!-- <li><a href="#">women</a>
                                    <div class="mega_menu">
                                        <div class="mega_top fix">
                                            <div class="mega_items">
                                                <h3><a href="#">Accessories</a></h3>
                                                <ul>
                                                    <li><a href="#">Cocktai</a></li>
                                                    <li><a href="#">day</a></li>
                                                    <li><a href="#">Evening</a></li>
                                                    <li><a href="#">Sundresses</a></li>
                                                    <li><a href="#">Belts</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <h3><a href="#">HandBags</a></h3>
                                                <ul>
                                                    <li><a href="#">Accessories</a></li>
                                                    <li><a href="#">Hats and Gloves</a></li>
                                                    <li><a href="#">Lifestyle</a></li>
                                                    <li><a href="#">Bras</a></li>
                                                    <li><a href="#">Scarves</a></li>
                                                    <li><a href="#">Small Leathers</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <h3><a href="#">Tops</a></h3>
                                                <ul>
                                                    <li><a href="#">Evening</a></li>
                                                    <li><a href="#">Long Sleeved</a></li>
                                                    <li><a href="#">Shrot Sleeved</a></li>
                                                    <li><a href="#">Tanks and Camis</a></li>
                                                    <li><a href="#">Sleeveless</a></li>
                                                    <li><a href="#">Sleeveless</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="mega_bottom fix">
                                            <div class="mega_thumb">
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner1.jpg') }}" alt=""></a>
                                            </div>
                                            <div class="mega_thumb">
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner2.jpg') }}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">men</a>
                                    <div class="mega_menu">
                                        <div class="mega_top fix">
                                            <div class="mega_items">
                                                <h3><a href="#">Rings</a></h3>
                                                <ul>
                                                    <li><a href="#">Platinum Rings</a></li>
                                                    <li><a href="#">Gold Ring</a></li>
                                                    <li><a href="#">Silver Ring</a></li>
                                                    <li><a href="#">Tungsten Ring</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <h3><a href="#">Bands</a></h3>
                                                <ul>
                                                    <li><a href="#">Platinum Bands</a></li>
                                                    <li><a href="#">Gold Bands</a></li>
                                                    <li><a href="#">Silver Bands</a></li>
                                                    <li><a href="#">Silver Bands</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner3.jpg') }}" alt=""></a>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                                <li><a href="#">pages</a>
                                    <div class="mega_menu">
                                        <div class="mega_top fix">
                                            <div class="mega_items">
                                                <h3><a href="#">Column1</a></h3>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-details.html">single portfolio </a></li>
                                                    <li><a href="about.html">About Us </a></li>
                                                    <li><a href="about-2.html">About Us 2</a></li>
                                                    <li><a href="services.html">Service </a></li>
                                                    <li><a href="my-account.html">my account </a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <h3><a href="#">Column2</a></h3>
                                                <ul>
                                                    <li><a href="blog.html">Blog </a></li>
                                                    <li><a href="blog-details.html">Blog Details </a></li>
                                                    <li><a href="blog-fullwidth.html">Blog FullWidth</a></li>
                                                    <li><a href="blog-sidebar.html">Blog Sidebar</a></li>
                                                    <li><a href="faq.html">Frequently Questions</a></li>
                                                    <li><a href="404.html">404</a></li>
                                                </ul>
                                            </div>
                                            <div class="mega_items">
                                                <h3><a href="#">Column3</a></h3>
                                                <ul>
                                                    <li><a href="contact.html">Contact</a></li>
                                                    <li><a href="cart.html">cart</a></li>
                                                    <li><a href="checkout.html">Checkout </a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="login.html">Login</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li> -->

                                <!-- <li><a href="blog.html">blog</a>
                                    <div class="mega_menu jewelry">
                                        <div class="mega_items jewelry">
                                            <ul>
                                                <li><a href="blog-details.html">blog details</a></li>
                                                <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                                <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="contact.html">contact us</a></li> -->

                            </ul>
                        </nav>
                        @endif
                    </div>
                    <div class="mobile-menu d-lg-none">
                        <nav>
                            <ul>
                                <li><a href="index.html">Home</a>
                                    <div>
                                        <div>
                                            <ul>
                                                <li><a href="index.html">Home 1</a></li>
                                                <li><a href="index-2.html">Home 2</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="shop.html">shop</a>
                                    <div>
                                        <div>
                                            <ul>
                                                <li><a href="shop-list.html">shop list</a></li>
                                                <li><a href="shop-fullwidth.html">shop Full Width Grid</a></li>
                                                <li><a href="shop-fullwidth-list.html">shop Full Width list</a></li>
                                                <li><a href="shop-sidebar.html">shop Right Sidebar</a></li>
                                                <li><a href="shop-sidebar-list.html">shop list Right Sidebar</a></li>
                                                <li><a href="single-product.html">Product Details</a></li>
                                                <li><a href="single-product-sidebar.html">Product sidebar</a></li>
                                                <li><a href="single-product-video.html">Product Details video</a></li>
                                                <li><a href="single-product-gallery.html">Product Details Gallery</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">women</a>
                                    <div>
                                        <div>
                                            <div>
                                                <h3><a href="#">Accessories</a></h3>
                                                <ul>
                                                    <li><a href="#">Cocktai</a></li>
                                                    <li><a href="#">day</a></li>
                                                    <li><a href="#">Evening</a></li>
                                                    <li><a href="#">Sundresses</a></li>
                                                    <li><a href="#">Belts</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3><a href="#">HandBags</a></h3>
                                                <ul>
                                                    <li><a href="#">Accessories</a></li>
                                                    <li><a href="#">Hats and Gloves</a></li>
                                                    <li><a href="#">Lifestyle</a></li>
                                                    <li><a href="#">Bras</a></li>
                                                    <li><a href="#">Scarves</a></li>
                                                    <li><a href="#">Small Leathers</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3><a href="#">Tops</a></h3>
                                                <ul>
                                                    <li><a href="#">Evening</a></li>
                                                    <li><a href="#">Long Sleeved</a></li>
                                                    <li><a href="#">Shrot Sleeved</a></li>
                                                    <li><a href="#">Tanks and Camis</a></li>
                                                    <li><a href="#">Sleeveless</a></li>
                                                    <li><a href="#">Sleeveless</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div>
                                            <div>
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner1.jpg') }}" alt=""></a>
                                            </div>
                                            <div>
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner2.jpg') }}" alt=""></a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="#">men</a>
                                    <div>
                                        <div>
                                            <div>
                                                <h3><a href="#">Rings</a></h3>
                                                <ul>
                                                    <li><a href="#">Platinum Rings</a></li>
                                                    <li><a href="#">Gold Ring</a></li>
                                                    <li><a href="#">Silver Ring</a></li>
                                                    <li><a href="#">Tungsten Ring</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3><a href="#">Bands</a></h3>
                                                <ul>
                                                    <li><a href="#">Platinum Bands</a></li>
                                                    <li><a href="#">Gold Bands</a></li>
                                                    <li><a href="#">Silver Bands</a></li>
                                                    <li><a href="#">Silver Bands</a></li>
                                                    <li><a href="#">Sweets</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <a href="#"><img src="{{ asset('client\assets\img\banner\banner3.jpg') }}" alt=""></a>
                                            </div>
                                        </div>

                                    </div>
                                </li>
                                <li><a href="#">pages</a>
                                    <div>
                                        <div>
                                            <div>
                                                <h3><a href="#">Column1</a></h3>
                                                <ul>
                                                    <li><a href="portfolio.html">Portfolio</a></li>
                                                    <li><a href="portfolio-details.html">single portfolio </a></li>
                                                    <li><a href="about.html">About Us </a></li>
                                                    <li><a href="about-2.html">About Us 2</a></li>
                                                    <li><a href="services.html">Service </a></li>
                                                    <li><a href="my-account.html">my account </a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3><a href="#">Column2</a></h3>
                                                <ul>
                                                    <li><a href="blog.html">Blog </a></li>
                                                    <li><a href="blog-details.html">Blog Details </a></li>
                                                    <li><a href="blog-fullwidth.html">Blog FullWidth</a></li>
                                                    <li><a href="blog-sidebar.html">Blog Sidebar</a></li>
                                                    <li><a href="faq.html">Frequently Questions</a></li>
                                                    <li><a href="404.html">404</a></li>
                                                </ul>
                                            </div>
                                            <div>
                                                <h3><a href="#">Column3</a></h3>
                                                <ul>
                                                    <li><a href="contact.html">Contact</a></li>
                                                    <li><a href="cart.html">cart</a></li>
                                                    <li><a href="checkout.html">Checkout </a></li>
                                                    <li><a href="wishlist.html">Wishlist</a></li>
                                                    <li><a href="login.html">Login</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </li>

                                <li><a href="blog.html">blog</a>
                                    <div>
                                        <div>
                                            <ul>
                                                <li><a href="blog-details.html">blog details</a></li>
                                                <li><a href="blog-fullwidth.html">blog fullwidth</a></li>
                                                <li><a href="blog-sidebar.html">blog sidebar</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                                <li><a href="contact.html">contact us</a></li>

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .account_dropdown {
        margin-left: 25px;
        position: relative;
        display: flex;
        align-items: center;
    }

    .account_menu {
        position: absolute;
        top: 100%;
        left: 0;
        background-color: white;
        border: 1px solid #ccc;
        padding: 8px 12px;
        z-index: 999;
        min-width: 90px;
    }

    .account_menu a {
        display: block;
        padding: 5px 0;
        text-decoration: none;
        color: #333;
    }
</style>
<script>
    $(document).ready(function() {
        $('#accountToggle').on('click', function(e) {
            e.preventDefault();
            $('.account_menu').toggle();
        });

        // Đóng nếu click bên ngoài
        $(document).on('click', function(e) {
            if (!$(e.target).closest('.account_dropdown').length) {
                $('.account_menu').hide();
            }
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.remove_cart_item').click(function() {

            let productId = $(this).data('id');

            $.ajax({
                url: '{{ route("cart.delete.header") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_id: productId,
                },
                success: function(response) {
                    $("#shopping_cart").html(response);
                },
                error: function(xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        });
    });
</script>