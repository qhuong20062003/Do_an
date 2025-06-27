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
            <!-- Biểu đồ doanh thu 12 tháng (thu nhỏ lại) -->
            <div class="col-md-8 mx-auto">
                <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Doanh thu 12 tháng</h3>
                </div>
                <div class="card-body">
                    <canvas id="revenueChart" height="150"></canvas>
                </div>
                </div>
            </div>
            </div>

            <!-- Top sản phẩm -->
            <div class="row">
            <!-- Top bán chạy -->
            <div class="col-md-6">
                <div class="card card-success">
                <div class="card-header">
                    <h3 class="card-title">Top 5 bán chạy</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                    <ul class="list-group">
                        @foreach($top_sellers as $top_seller)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $top_seller->name }}
                        <span class="badge badge-success badge-pill">{{ $top_seller->total_sold }}</span>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="col-md-6">
                    <canvas id="topSellerChart" height="200"></canvas>
                    </div>
                </div>
                </div>
            </div>

            <!-- Top bán chậm -->
            <div class="col-md-6">
                <div class="card card-danger">
                <div class="card-header">
                    <h3 class="card-title">Top 5 bán chậm</h3>
                </div>
                <div class="card-body row">
                    <div class="col-md-6">
                    <ul class="list-group">
                        @foreach($down_sellers as $down_seller)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $down_seller->name }}
                        <span class="badge badge-danger badge-pill">{{ $down_seller->total_sold }}</span>
                        </li>
                        @endforeach
                    </ul>
                    </div>
                    <div class="col-md-6">
                    <canvas id="downSellerChart" height="200"></canvas>
                    </div>
                </div>
                </div>
            </div>
            </div>
        </div>
    </section>

</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Biểu đồ doanh thu 12 tháng
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

    // Biểu đồ Top bán chạy
    const ctxTopSeller = document.getElementById('topSellerChart').getContext('2d');
    new Chart(ctxTopSeller, {
        type: 'doughnut',
        data: {
            labels: {!! json_encode($top_sellers->pluck('name')) !!},
            datasets: [{
                data: {!! json_encode($top_sellers->pluck('total_sold')) !!},
                backgroundColor: ['#28a745', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc']
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Biểu đồ Top bán chậm
    const ctxDownSeller = document.getElementById('downSellerChart').getContext('2d');
    new Chart(ctxDownSeller, {
        type: 'bar',
        data: {
            labels: {!! json_encode($down_sellers->pluck('name')) !!},
            datasets: [{
                label: 'Số lượng đã bán',
                data: {!! json_encode($down_sellers->pluck('total_sold')) !!},
                backgroundColor: '#d81b60'
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            scales: {
                x: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection