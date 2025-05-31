<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function list(string $id)
    {
        $products = Product::where('category_id', $id)->get();
        return view('client.product.list', compact('products'));
    }

    public function detail(string $id)
    {
        $product = Product::findOrFail($id);
        $related_products = Product::where('id', '!=', $product->id)->where('category_id', $product->category_id)->limit(5)->get();

        return view('client.product.detail', compact('product', 'related_products'));
    }
}
