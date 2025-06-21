<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
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
        $colors = Colors::all();
        $category = Category::find($id);
        if($category->parent_id == 0) {
            $child_ids = Category::where('parent_id', $id)->pluck('id')->toArray();
            $category_ids = array_merge([$id], $child_ids);
            $products = Product::whereIn('category_id', $category_ids)->get();
            $categories = Category::where('parent_id', $id)->get();
        } else {
            $products = Product::where('category_id', $id)->get();
            $categories = collect();
        }
        
        return view('client.product.list', compact('products', 'categories', 'colors', 'id'));
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

    public function filterProduct(Request $request)
    {
        $query = Product::query();
        $id = $request->id;

        if($request->filled('category_id')) {
            $category_id = $request->category_id;
            
            $query->where('category_id', $category_id);
        } else {
            $category = Category::find($id);

            if($category && $category->parent_id == 0) {
                $child_ids = Category::where('parent_id', $id)->pluck('id')->toArray();
                $category_ids = array_merge([$id], $child_ids);
                $query->whereIn('category_id', $category_ids);
            } else {
                $query->where('category_id', $id);
            }
        }

        if($request->has('colors')) {
            $color_id = is_array($request->colors) ? $request->colors : [$request->colors];

            $product_id_by_color = ProductVariant::whereIn('color_id', $color_id)
                                ->pluck('product_id')
                                ->unique()
                                ->toArray();

            $query->whereIn('id', $product_id_by_color);
        }

        if($request->filled('price_min') && $request->filled('price_max')) {
            $min = (float) $request->price_min;
            $max = (float) $request->price_max;

            $query->where(function($q) use ($min, $max) {
                $q->whereBetween('price', [$min, $max])
                    ->orWhereBetween('discount', [$min, $max]);
            }); 
        }

        $products = $query->get();

        return view('client.product.filter', compact('products'));
    }
}
