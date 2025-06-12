<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{
    private $order;
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function index()
    {
        $orders = $this->order->latest()->paginate(5);
        return view('admin.orders.index',compact('orders'));
    }

    public function edit(string $id)
    {
        $order = $this->order->find($id);
        $products = OrderDetail::join('product_variants', 'order_detail.product_variant_id', '=', 'product_variants.id')
                    ->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->join('colors', 'product_variants.color_id', '=', 'colors.id')
                    ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
                    ->select('products.name as product_name',
                            'products.price as product_price',
                            'colors.name as color_name',
                            'sizes.name as size_name',
                            'order_detail.quantity',
                            'order_detail.price')
                    ->where('order_detail.order_id', $id)
                    ->get();

        return view('admin.orders.edit', compact('order', 'products'));
    }

    public function update(Request $request)
    {
        $order_id = $request->order_id;
        $status = $request->status;

        $result = $this->order->find($order_id)->update([
            'status' => $status
        ]);

        if($result) {
            return redirect()->route('orders.index');
        }
    }
}
