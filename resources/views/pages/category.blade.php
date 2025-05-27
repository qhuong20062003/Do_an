@extends('welcome')

@section('content')
<div class="col-lg-9">
                <div id="header-carousel" class="carousel slide" data-ride="carousel">

<div class="container">
    <div class="row">           

      {{-- Nội dung chính: danh sách sản phẩm --}}
        <div class="col-md-9">
            <h3 class="mb-4">Sản phẩm trong danh mục: {{ $category->name }}</h3>
            <div class="row">
                @forelse ($products as $product)
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <img src="{{ asset('storage/' . $product->feature_image_path) }}" class="card-img-top" alt="{{ $product->name }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $product->name }}</h5>
                                <p class="card-text text-danger font-weight-bold">{{ number_format($product->price) }} VND</p>
                                <a href="{{ route('product.details', $product->id) }}" class="btn btn-sm btn-outline-primary mt-auto">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Chưa có sản phẩm nào trong danh mục này.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
</div>
</div>
@endsection
