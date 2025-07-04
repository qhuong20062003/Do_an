<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $now = Carbon::now();
        $thirty_day_ago = Carbon::now()->subDays(30);
        $revenues = [];

        for($i = 1; $i <= 12; $i++) {
            $month = Carbon::create($now->year, $i, 1);

            $total = Order::whereMonth('created_at', $i)
                    ->whereYear('created_at', $now->year)
                    ->where('status', 3)
                    ->sum('total_price');

            $revenues[] = round($total, 0); 
        }

        $months = ['T1', 'T2', 'T3', 'T4', 'T5', 'T6', 'T7', 'T8', 'T9', 'T10', 'T11', 'T12'];

        $top_sellers = OrderDetail::join('orders', 'order_detail.order_id', '=', 'orders.id')
                    ->join('product_variants', 'order_detail.product_variant_id', '=', 'product_variants.id')
                    ->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->where('orders.status', 3)
                    ->select('products.name', DB::raw('SUM(order_detail.quantity) as total_sold'))
                    ->groupBy('products.id', 'products.name')
                    ->orderByDesc('total_sold')
                    ->limit(5)
                    ->get();
        
        $down_sellers = Product::leftJoin('product_variants', 'products.id', '=', 'product_variants.product_id')
                    ->leftJoin('order_detail', 'product_variants.id', '=', 'order_detail.product_variant_id')
                    ->leftJoin('orders', 'order_detail.order_id', '=', 'orders.id')
                    ->where('products.created_at', '<', $thirty_day_ago)
                    ->where(function($query) {
                        $query->whereNull('orders.status')
                            ->orWhere('orders.status', 3);
                    })
                    ->select('products.id', 'products.name', DB::raw('COALESCE(SUM(order_detail.quantity), 0) as total_sold'))
                    ->groupBy('products.id', 'products.name')
                    ->orderBy('total_sold', 'asc')
                    ->limit(5)
                    ->get();

        return view('admin.dashboard', compact('revenues', 'months', 'top_sellers', 'down_sellers'));
    }
}
