<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_variant_id = $request->product_variant_id;
        $quantity = $request->quantity ?? 1;

        if(Auth::check()) {
            $user_id = Auth::id();

            $cart_item = CartItem::where('user_id', $user_id)
                ->where('product_variant_id', $product_variant_id)
                ->first();
            
            if($cart_item) {
                $cart_item->quantity += $quantity;
                $cart_item->save();
            } else {
                $product = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
                        ->select('products.*')
                        ->where('product_variants.id', $product_variant_id)
                        ->first();
                
                CartItem::create([
                    'user_id' => $user_id,
                    'product_variant_id' => $product_variant_id,
                    'quantity' => $quantity,
                    'price' => $product->discount ? $product->discount : $product->price,
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $product = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
                        ->select('products.*')
                        ->where('product_variants.id', $product_variant_id)
                        ->first();

            $unit_price = ( $product->discount > 0) ? $product->discount : $product->price;
            if(isset($cart[$product_variant_id])) {
                $cart[$product_variant_id]['quantity'] += $quantity;
                $cart[$product_variant_id]['price'] = $unit_price;
            } else {
                $cart[$product_variant_id] = [
                    'product_variant_id' => $product_variant_id,
                    'quantity' => $quantity,
                    'price' => $unit_price
                ];
            }
            session()->put('cart', $cart);
            Log::info('Cart session:', session()->get('cart'));
        }

        if($request->type_cart == 'detail_product') {
            return redirect()->back();
        }
        return view('client.cart.poup', ['cart_items' => CartService::getCartItems()]);
    }

    public function index()
    {
        $list_cart_items = [];

        if(Auth::check()) {
            $user_id = Auth::id();

            $items = CartItem::join('product_variants', 'cart_items.product_variant_id', '=', 'product_variants.id')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
                ->join('colors', 'product_variants.color_id', '=', 'colors.id')
                ->where('cart_items.user_id', $user_id)
                ->select('product_variants.id as product_variant_id',
                        'products.name',
                        'products.price',
                        'products.discount',
                        'sizes.name as size_name',
                        'colors.name as color_name',
                        'products.feature_image_path',
                        'cart_items.quantity',)
                ->get();
            $total_quantity = count($items);

            foreach($items as $item) {
                $list_cart_items[] = [
                    'product_variant_id' => $item->product_variant_id,
                    'name' => $item->name,
                    'price' => ($item->discount > 0) ? $item->discount : $item->price,
                    'size_name' => $item->size_name,
                    'color_name' => $item->color_name,
                    'feature_image_path' => $item->feature_image_path,
                    'quantity' => $item->quantity
                ]; 
            }
        } else {
            $cart = session('cart', []);
            
            $product_variant_ids = array_keys($cart);

            $product_variants = ProductVariant::join('products', 'product_variants.product_id', '=', 'products.id')
                        ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
                        ->join('colors', 'product_variants.color_id', '=', 'colors.id')
                        ->select('product_variants.*',
                                'product_variants.id as variant_id',
                                'products.name',
                                'products.price',
                                'products.discount',
                                'products.feature_image_path',
                                'sizes.name as size_name', 
                                'colors.name as color_name')
                        ->whereIn('product_variants.id', $product_variant_ids)
                        ->get()
                        ->keyBy('variant_id');
            
            $total_quantity = count($cart);
            foreach($cart as $product_variant_id => $item) {
                $product = $product_variants[$product_variant_id] ?? null;
                if (!$product) continue;

                $list_cart_items[] = [
                    'product_variant_id' => $product->id,
                    'name' => $product->name,
                    'price' => ($item->discount > 0) ? $item->discount : $item->price,
                    'size_name' => $product->size_name,
                    'color_name' => $product->color_name,
                    'feature_image_path' => $product->feature_image_path,
                    'quantity' => $item['quantity']
                ]; 
            }
        }

        return view('client.cart.index', compact('list_cart_items'));
    }

    public function edit(Request $request)
    {
        $product_variant_id = $request->product_variant_id;
        $quantity = $request->quantity;

        if(Auth::check()) {
            $user_id = Auth::id();

            $cart_item = CartItem::where('user_id', $user_id)
                        ->where('product_variant_id', $product_variant_id)
                        ->first();
            if($cart_item) {
                $cart_item->quantity = $quantity;
                $cart_item->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_variant_id])) {
                $cart[$product_variant_id]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        $product = Product::join('product_variants', 'products.id', '=', 'product_variants.product_id')
                ->select('products.*')
                ->where('product_variants.id', $product_variant_id)
                ->first();
        $total_price = number_format((($product->discount > 0) ? $product->discount : $product->price) * $quantity, 0, 0).' VNĐ';
        $sub_total = 0;

        $carts = CartService::getCartItems();
        foreach($carts['items'] as $item) {
            $sub_total += $item['price'] * $item['quantity'];
        }
        $g_total = number_format($sub_total + 20000, 0, 0).' VNĐ';
        return response()->json(['total_price' => $total_price, 'sub_total' => number_format($sub_total, 0, 0).' VNĐ', 'g_total' => $g_total]);
    }

    public function delete(Request $request)
    {
        $product_variant_id = $request->product_variant_id;

        if(Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_variant_id', $product_variant_id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_variant_id])) {
                unset($cart[$product_variant_id]);
                session()->put('cart', $cart);
            }
        }

        $sub_total = 0;
        $carts = CartService::getCartItems();
        foreach($carts['items'] as $item) {
            $sub_total += $item['price'] * $item['quantity'];
        }
        $g_total = number_format($sub_total + 20000, 0, 0).' VNĐ';
        return response()->json(['sub_total' => number_format($sub_total, 0, 0).' VNĐ', 'g_total' => $g_total]);
    }

    public function delete_cart_header(Request $request)
    {
        $product_variant_id = $request->product_variant_id;

        if(Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_variant_id', $product_variant_id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_variant_id])) {
                unset($cart[$product_variant_id]);
                session()->put('cart', $cart);
            }
        }

        return view('client.cart.poup', ['cart_items' => CartService::getCartItems()]);
    }
}
