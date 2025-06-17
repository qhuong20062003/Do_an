@extends('admin.layouts.admin')

@section('title')
<title>Thống kê</title>
@endsection

@section('content')
<div class="content-wrapper">
    @include('admin.partials.content-header',['name' => 'Thống kê','key'=> 'Tổng quan'])

    <section class="content">
        <div class="container-fluid">

            <div class="row">
                <!-- Biểu đồ doanh thu -->
                <div class="col-md-8">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Doanh thu 12 tháng</h3>
                        </div>
                        <div class="card-body">
                            <canvas id="revenueChart" height="150"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Sản phẩm bán chạy và bán chậm -->
                <div class="col-md-4">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">Top 5 bán chạy</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @if(isset($top_sellers) && !empty($top_sellers))
                                @foreach($top_sellers as $top_seller)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $top_seller->name }} 
                                    <span class="badge badge-success badge-pill">{{ $top_seller->total_sold }}</span>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>

                    <div class="card card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Top 5 bán chậm</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                @if(isset($down_sellers) && !empty($down_sellers))
                                @foreach($down_sellers as $down_seller)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    {{ $down_seller->name }}
                                    <span class="badge badge-danger badge-pill">{{ $down_seller->total_sold }}</span>
                                </li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@section('js')
<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($months) !!},
            datasets: [{
                label: 'Doanh thu (VNĐ)',
                data: {!! json_encode($revenues) !!},
                backgroundColor: 'rgba(60,141,188,0.9)',
                borderColor: 'rgba(60,141,188,1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection