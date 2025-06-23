<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function myProfile()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return view('client.profile.my-profile', compact('orders'));
    }

    public function detailOrder(string $id)
    {
        $order = Order::findOrFail($id);
        $products = OrderDetail::join('product_variants', 'order_detail.product_variant_id', '=', 'product_variants.id')
                    ->join('products', 'product_variants.product_id', '=', 'products.id')
                    ->join('colors', 'product_variants.color_id', '=', 'colors.id')
                    ->join('sizes', 'product_variants.size_id', '=', 'sizes.id')
                    ->select('products.name as product_name',
                            'order_detail.price as product_price',
                            'colors.name as color_name',
                            'sizes.name as size_name',
                            'order_detail.quantity',
                            'order_detail.price')
                    ->where('order_detail.order_id', $id)
                    ->get();

        return view('client.profile.detail-order', compact('order', 'products'));
    }

    public function cancelOrder(string $id)
    {
        $order = Order::find($id)->delete();

        if($order) {
            $order_details = OrderDetail::where('order_id', $id)->get();

            foreach($order_details as $order_detail) {
                ProductVariant::where('id', $order_detail->product_variant_id)
                    ->increment('stock', $order_detail->quantity);
            }
            OrderDetail::where('order_id', $id)->delete();

            return redirect()->route('my.profile');
        }
    }

    public function updateProfile(Request $request)
    {
        $user_id = Auth::id();

        $user = User::findOrFail($user_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->birth = $request->birth;
        $user->save();

        return redirect()->back()->with('success', 'Cập nhật thông tin khách hàng thành công');
    }

    public function changePassword(Request $request)
    {
        $user = User::findOrFail(Auth::id());
        
        if(empty($request->new_password)) {
            return redirect()->back()->with('error', 'Vui lòng nhập mật khẩu mới');
        } 
        if(empty($request->old_password)) {
            return redirect()->back()->with('error', 'Vui lòng nhập mật khẩu cũ');
        }
        if(empty($request->confirm_password)) {
            return redirect()->back()->with('error', 'Vui lòng nhập xác nhận mật khẩu');
        }

        if($request->new_password != $request->confirm_password) {
            return redirect()->back()->with('error', 'Mật khẩu mới và xác nhận mật khẩu không khớp');
        } else {
            if(!Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Mật khẩu cũ không khớp');
            } else {
                $user->password = Hash::make($request->new_password);
                $user->save();

                return redirect()->back()->with('success', 'Đổi mật khẩu thành công');
            }
        } 
    }
}
