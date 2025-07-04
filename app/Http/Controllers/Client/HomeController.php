<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Colors;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $new_products = Product::whereIn('id', function ($query) {
            $query->select('product_id')
                ->from('product_variants')
                ->where('stock', '>', 0)
                ->groupBy('product_id');
        })->orderBy('id', 'desc')->limit(5)->get();
        $discount_products = Product::whereIn('id', function ($query) {
            $query->select('product_id')
                ->from('product_variants')
                ->where('stock', '>', 0)
                ->groupBy('product_id');
        })->where('discount', '>', 0)->orderBy('id', 'desc')->limit(5)->get();
        
        return view('client.index', compact('sliders', 'categories', 'new_products', 'discount_products'));
    }

    public function search(Request $request)
    {
        $text = $request->text;

        $colors = Colors::all();
        $products = Product::whereIn('id', function ($query) {
            $query->select('product_id')
                ->from('product_variants')
                ->where('stock', '>', 0)
                ->groupBy('product_id');
        })->where('name', 'like', "%$text%")->get();

        return view('client.product.search', compact('colors', 'products', 'text'));
    }
}
