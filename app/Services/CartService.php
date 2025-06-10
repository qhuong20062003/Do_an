<?php 

namespace App\Services;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductVariant;
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

            $items = CartItem::join('product_variants', 'cart_items.product_variant_id', '=', 'product_variants.id')
                ->join('products', 'product_variants.product_id', '=', 'products.id')
                ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
                ->join('colors', 'product_variants.color_id', '=', 'colors.id')
                ->where('cart_items.user_id', $user_id)
                ->select('product_variants.id as product_variant_id',
                        'products.name',
                        'products.price',
                        'sizes.name as size_name',
                        'colors.name as color_name',
                        'products.feature_image_path',
                        'cart_items.quantity',)
                ->get();
            $total_quantity = count($items);

            foreach($items as $item) {
                $cart_items[] = [
                    'product_variant_id' => $item->product_variant_id,
                    'name' => $item->name,
                    'price' => $item->price,
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

                $cart_items[] = [
                    'product_variant_id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'size_name' => $product->size_name,
                    'color_name' => $product->color_name,
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