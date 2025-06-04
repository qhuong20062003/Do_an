<?php 

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CartService
{
    public static function getCartItems()
    {
        $cart_items = [];
        $total_quantity = 0;

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
            $total_quantity = count($items);

            foreach($items as $item) {
                $cart_items[] = [
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

            $total_quantity = count($cart);
            foreach($cart as $product_id => $item) {
                $product = $products[$product_id] ?? null;
                if (!$product) continue;

                $cart_items[] = [
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'feature_image_path' => $product->feature_image_path,
                    'quantity' => $item['quantity']
                ]; 
            }
        }

        return [
            'items' => $cart_items,
            'total_quantity' => $total_quantity
        ];
    }
}