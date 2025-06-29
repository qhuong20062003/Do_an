@if(count($products) > 0)
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
@else
<p class="text-center">Không tìm thấy sản phẩm bạn mong muốn</p>
@endif
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