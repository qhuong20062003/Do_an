<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() 
    {
        $sliders = Slider::all();
        $categories = Category::all();
        $new_products = Product::orderBy('id', 'desc')->limit(5)->get();
        $discount_products = Product::where('discount', '>', 0)->orderBy('id', 'desc')->limit(5)->get();
        
        return view('client.index', compact('sliders', 'categories', 'new_products', 'discount_products'));
    }

    public function search(Request $request)
    {
        $text = $request->text;

        $categories = Category::where('parent_id', 0)->get();
        $products = Product::where('name', 'like', "%$text%")->get();

        return view('client.product.list', compact('products', 'categories'));
    }
}
