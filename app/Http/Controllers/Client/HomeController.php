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

        return view('client.index', compact('sliders', 'categories', 'new_products'));
    }
}
