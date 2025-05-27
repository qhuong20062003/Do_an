<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {   
      
        // Lấy tất cả categories bằng Eloquent
        $categories = Category::all();

        // Lấy 8 sản phẩm đầu tiên (vẫn có thể dùng DB::table nếu không cần quan hệ)
        $products = DB::table('products')->limit(8)->get();

        // Lấy parent categories và eager load categoryChildrent bằng Eloquent
        $parentCategories = Category::with('categoryChildrent')->whereNull('parent_id')->get();

        $sliders = DB::table('sliders')->get();

        return view('pages.home', compact('categories', 'products', 'parentCategories', 'sliders'));
    }
}
