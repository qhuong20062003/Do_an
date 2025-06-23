<div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal_body">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-sm-12">
                        <div class="modal_tab">
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="tab1" role="tabpanel">
                                    <div class="modal_tab_img">
                                        <a href="#"><img src="{{ $product->feature_image_path }}" alt=""></a>
                                    </div>
                                </div>
                                @if(isset($product_images) && !empty($product_images))
                                @php $index = 1; @endphp
                                @foreach($product_images as $product_image)
                                @php $index ++; @endphp
                                <div class="tab-pane fade" id="tab{{ $index }}" role="tabpanel">
                                    <div class="modal_tab_img">
                                        <a href="#"><img src="{{ $product_image->image_path }}" alt=""></a>
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <div class="modal_tab_button">
                                <ul class="nav product_navactive" role="tablist">
                                    <li>
                                        <a class="nav-link active" data-toggle="tab" href="#tab1" role="tab" aria-controls="tab1" aria-selected="false"><img src="{{ $product->feature_image_path }}" alt=""></a>
                                    </li>
                                    @if(isset($product_images) && !empty($product_images))
                                    @php $index = 1; @endphp
                                    @foreach($product_images as $product_image)
                                    @php $index ++; @endphp
                                    <li>
                                        <a class="nav-link" data-toggle="tab" href="#tab{{ $index }}" role="tab" aria-controls="tab{{ $index }}" aria-selected="false"><img src="{{ $product_image->image_path }}" alt=""></a>
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-sm-12">
                        <div class="modal_right">
                            <div class="modal_title mb-10">
                                <h2>{{ $product->name }}</h2>
                            </div>
                            <div class="modal_price mb-10">
                                @if(!empty($product->discount) && $product->discount > 0)
                                <span class="new_price">{{ number_format($product->discount, 0, 0) }} VNĐ</span>
                                <span class="old_price">{{ number_format($product->price, 0, 0) }} VNĐ</span>
                                @else
                                <span class="product_price">{{ number_format($product->price, 0, 0) }} VNĐ</span>
                                @endif
                            </div>
                            <!-- <div class="modal_content mb-10">
                                <p>Short-sleeved blouse with feminine draped sleeve detail.</p>
                            </div> -->
                            @if(isset($sizes) && !empty($sizes))
                            <div class="modal_size mb-15">
                                <h2>Size</h2>
                                <ul class="product-size-list">
                                    @foreach($sizes as $size)
                                    <li>
                                        <label class="size-option">
                                            <input type="radio" name="product_size" class="product_size" value="{{ $size->id }}">
                                            <span class="size-label">{{ $size->name }}</span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(isset($colors) && !empty($colors))
                            <div class="modal_size mb-15">
                                <h2>Màu sắc</h2>
                                <ul class="product-color-list">
                                    @foreach($colors as $color)
                                    <li>
                                        <label class="color-option" style="--color: {{ $color->code }}">
                                            <input type="radio" name="product_color" class="color-radio" value="{{ $color->id }}">
                                            <span class="color-circle"></span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif


                            <div class="modal_add_to_cart mb-15">
                                <form action="" method="POST" class="buy-now">
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}" />
                                    <input min="0" max="100" value="1" type="number" id="product_quantity">
                                    <input type="hidden" name="product_variant_id" id="product_variant_id" value="" />
                                    <span class="box_add_to_cart"></span>
                                    @csrf
                                </form>
                            </div>
                            <!-- <div class="modal_description mb-15">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,</p>
                            </div>
                            <div class="modal_social">
                                <h2>Share this product</h2>
                                <ul>
                                    <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                    <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                    <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                    <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                                </ul>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    /* Size radio */
    .product-size-list {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 10px;
    }

    .size-option {
        position: relative;
        cursor: pointer;
        display: inline-block;
    }

    .size-option input[type="radio"] {
        display: none;
    }

    .size-label {
        display: inline-block;
        padding: 8px 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
        min-width: 40px;
        text-align: center;
        font-weight: bold;
        transition: all 0.3s ease;
    }

    .size-option input[type="radio"]:checked+.size-label {
        background-color: #000;
        color: #fff;
        border-color: #000;
    }


    /* Color radio */
    .product-color-list {
        list-style: none;
        padding: 0;
        display: flex;
        gap: 10px;
    }

    .color-option {
        position: relative;
        display: inline-block;
        cursor: pointer;
    }

    .color-option input[type="radio"] {
        display: none;
    }

    .color-circle {
        display: inline-block;
        width: 25px;
        height: 25px;
        border-radius: 50%;
        background-color: var(--color);
        border: 2px solid transparent;
        transition: all 0.3s ease;
    }

    /* Hiển thị viền khi chọn */
    .color-option input[type="radio"]:checked+.color-circle {
        border: 2px solid #000;
        box-shadow: 0 0 0 2px #fff, 0 0 0 4px #000;
    }

    .product_price{
        color: #000 !important;
    }

    .sold_out {
        color: red;
        font-size: 16px;
        align-items: center;
        margin-left: 20px;
    }
</style>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $('.buy-now').submit(function(e) {
            e.preventDefault();

            let quantity = $("#product_quantity").val();
            let product_variant_id = $("#product_variant_id").val();
            
            $.ajax({
                url: '{{ route("cart.add") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    product_variant_id: product_variant_id,
                    quantity: quantity
                },
                success: function (response) {
                    $('#modal_box').modal('hide');
                    $("#shopping_cart").html(response);
                },
                error: function (xhr) {
                    alert('Có lỗi xảy ra, vui lòng thử lại!');
                }
            });
        }); 

        $('.product_size').change(function() {
            let size_id = $('.product_size:checked').val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();
            
            if (!color_id || !product_quantity) {
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
                    success: function(response) {
                        $(".box_add_to_cart").empty();
                        if (response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit" class='btn-buy-now'>Mua hàng</button>`);
                        } else if (response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }

                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }

        });

        $('#product_quantity').change(function() {
            let size_id = $('.product_size:checked').val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();

            if (!color_id || !product_quantity) {
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
                    success: function(response) {
                        $(".box_add_to_cart").empty();
                        if (response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit" class='btn-buy-now'>Mua hàng</button>`);
                        } else if (response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }
        });

        $('.color-radio').change(function() {
            let size_id = $('.product_size:checked').val();
            let color_id = $('.color-radio:checked').val();
            let product_id = $("#product_id").val();
            let product_quantity = $("#product_quantity").val();

            if (!color_id || !product_quantity) {
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
                    success: function(response) {
                        $(".box_add_to_cart").empty();
                        if (response.status === 'success') {
                            $("#product_variant_id").val(response.product_variant_id);
                            $(".box_add_to_cart").append(`<button type="submit" class='btn-buy-now'>Mua hàng</button>`);
                        } else if (response.status === 'sold_out') {
                            $(".box_add_to_cart").append(`<span class='sold_out'>Hết hàng</span>`);
                        } else {
                            $(".box_add_to_cart").empty();
                        }
                    },
                    error: function(xhr) {
                        alert('Có lỗi xảy ra, vui lòng thử lại!');
                    }
                });
            }
        });
    });
</script>