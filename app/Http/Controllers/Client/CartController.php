<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\CartItem;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity ?? 1;

        if(Auth::check()) {
            $user_id = Auth::id();

            $cart_item = CartItem::where('user_id', $user_id)
                ->where('product_id', $product_id)
                ->first();
            
            if($cart_item) {
                $cart_item->quantity += $quantity;
                $cart_item->save();
            } else {
                $product = Product::findOrFail($product_id);

                CartItem::create([
                    'user_id' => $user_id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            $product = Product::findOrFail($product_id);

            if(isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] += $quantity;
                $cart[$product_id]['price'] = $product->price * $cart[$product_id]['quantity'];
            } else {
                $cart[$product_id] = [
                    'product_id' => $product_id,
                    'quantity' => $quantity,
                    'price' => $product->price * $quantity
                ];
            }
            session()->put('cart', $cart);
            Log::info('Cart session:', session()->get('cart'));
        }

        return view('client.cart.poup', ['cart_items' => CartService::getCartItems()]);
    }

    public function index()
    {
        $list_cart_items = [];

        if(Auth::check()) {
            $user_id = Auth::id();

            $items = CartItem::join('products', 'cart_items.product_id', '=', 'products.id')
                ->where('cart_items.user_id', $user_id)
                ->select('products.id as product_id',
                        'products.name',
                        'products.price',
                        'products.feature_image_path',
                        'cart_items.quantity',)
                ->get();

            foreach($items as $item) {
                $list_cart_items[] = [
                    'product_id' => $item->product_id,
                    'name' => $item->name,
                    'price' => $item->price,
                    'feature_image_path' => $item->feature_image_path,
                    'quantity' => $item->quantity
                ]; 
            }
        } else {
            $cart = session('cart', []);

            $product_ids = array_keys($cart);

            $products = Product::whereIn('id', $product_ids)->get()->keyBy('id');

            foreach($cart as $product_id => $item) {
                $product = $products[$product_id] ?? null;
                if (!$product) continue;

                $list_cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'feature_image_path' => $product->feature_image_path,
                    'quantity' => $item['quantity']
                ]; 
            }
        }

        return view('client.cart.index', compact('list_cart_items'));
    }

    public function edit(Request $request)
    {
        $product_id = $request->product_id;
        $quantity = $request->quantity;

        if(Auth::check()) {
            $user_id = Auth::id();

            $cart_item = CartItem::where('user_id', $user_id)
                        ->where('product_id', $product_id)
                        ->first();
            if($cart_item) {
                $cart_item->quantity = $quantity;
                $cart_item->save();
            }
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_id])) {
                $cart[$product_id]['quantity'] = $quantity;
                session()->put('cart', $cart);
            }
        }

        $product = Product::findOrFail($product_id);
        $total_price = number_format($product->price * $quantity, 0, 0).' VNĐ';
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
        $product_id = $request->product_id;

        if(Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_id])) {
                unset($cart[$product_id]);
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
        $product_id = $request->product_id;

        if(Auth::check()) {
            CartItem::where('user_id', Auth::id())
                ->where('product_id', $product_id)
                ->delete();
        } else {
            $cart = session()->get('cart', []);

            if(isset($cart[$product_id])) {
                unset($cart[$product_id]);
                session()->put('cart', $cart);
            }
        }

        return view('client.cart.poup', ['cart_items' => CartService::getCartItems()]);
    }
}
