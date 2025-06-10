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
                                <span class="new_price">$64.99</span>
                                <span class="old_price">$78.99</span>
                            </div>
                            <!-- <div class="modal_content mb-10">
                                <p>Short-sleeved blouse with feminine draped sleeve detail.</p>
                            </div> -->
                            @if(isset($sizes) && !empty($sizes))
                            <div class="modal_size mb-15">
                                <h2>Size</h2>
                                <ul>
                                    @foreach($sizes as $size)
                                    <li>
                                        <label>
                                            <input type="radio" name="product_size" value="{{ $size->id }}">
                                            {{ $size->name }}
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(isset($colors) && !empty($colors))
                            <div class="modal_size mb-15">
                                <h2>Màu sắc</h2>
                                <ul>
                                    @foreach($colors as $color)
                                    <li>
                                        <label style="display: inline-block; cursor: pointer;">
                                            <input type="radio" name="product_color" value="{{ $color->id }}" style="display: none;">
                                            <span style="display: inline-block; width: 20px; height: 20px; background-color: {{ $color->code }}; border-radius: 50%; border: 1px solid #ccc;"></span>
                                        </label>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            <div class="modal_add_to_cart mb-15">
                                <form action="#">
                                    <input min="0" max="100" step="2" value="1" type="number">
                                    <button type="submit">Mua hàng</button>
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