<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Colors;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use App\Models\Sizes;
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
        $sizes = Sizes::join('product_variants', 'sizes.id', '=', 'product_variants.size_id')
                ->select('sizes.*')
                ->where('product_variants.product_id', $id)
                ->distinct()
                ->get();
        $colors = Colors::join('product_variants', 'colors.id', '=', 'product_variants.color_id')
                ->select('colors.*')
                ->where('product_variants.product_id', $id)
                ->distinct()
                ->get();
        $product_images = ProductImage::where('product_id', $id)->get();

        return view('client.product.detail', compact('product', 'related_products', 'sizes', 'colors', 'product_images'));
    }

    public function checkStock(Request $request)
    {
        $product_variant = ProductVariant::where('product_id', $request->product_id)
                            ->where('color_id', $request->color_id)
                            ->where('size_id', $request->size_id)
                            ->first();

        if($product_variant && $request->quantity <= $product_variant->stock) {
            return response()->json(['status' => 'success', 'product_variant_id' => $product_variant->id]);
        } else {
            return response()->json(['status' => 'sold_out']);
        }
    }

    public function viewDetail(Request $request)
    {
        $product_id = $request->product_id;

        $product = Product::findOrFail($product_id);
        $colors = Colors::join('product_variants', 'colors.id', '=', 'product_variants.color_id')
                ->select('colors.*')
                ->where('product_variants.product_id', $product_id)
                ->distinct()
                ->get();
        $sizes = Sizes::join('product_variants', 'sizes.id', '=', 'product_variants.size_id')
                ->select('sizes.*')
                ->where('product_variants.product_id', $product_id)
                ->distinct()
                ->get();
        $product_images = ProductImage::where('product_id', $product_id)->get();

        return view('client.product.fade', compact('product', 'colors', 'sizes', 'product_images'));
    }
}
