<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function index()
    {
        $result = CartService::getCartItems();

        return view('client.checkout.index', compact('result'));
    }

    public function payment(Request $request)
    {
        $data = $request->all();

        if ($data['action'] === 'offline') {
            $result = Order::create([
                'code' => rand(00, 9999),
                'user_id' => Auth::id(),
                'customer_name' => $data['name'],
                'customer_email' => !empty($data['email']) ? $data['email'] : null,
                'customer_phone' => $data['phone'],
                'customer_address' => $data['address'],
                'note' => !empty($data['note']) ? $data['note'] : null,
                'total_price' => $data['total_price'],
                'status' => 0,
                'payment_method' => 0
            ]);

            if ($result) {
                return redirect()->route('payment.success');
            }
        } else {
            $code_cart = rand(00, 9999); //random mã đơn hàng
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://127.0.0.1:8000/thanh-toan/thanh-cong";
            $vnp_TmnCode = "EDO2P1ZA"; //Mã website tại VNPAY 
            $vnp_HashSecret = "X8STXAJEKO0PMZ8JVOE8D13ZRZZ8UYWB"; //Chuỗi bí mật

            $vnp_TxnRef = $code_cart; //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Thanh toán đơn hàng test';
            $vnp_OrderType = 'billpayment';
            $vnp_Amount = $data['total_price'] * 100;
            $vnp_Locale = 'vn';
            // $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];

            // $startTime = date("YmdHis");
            // $expire = date('YmdHis',strtotime('+15 minutes',strtotime($startTime)));

            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef,
                // "vnp_ExpireDate"=>$expire,
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            // if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
            //     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
            // }

            //var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret); //  
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array(
                'code' => '00',
                'message' => 'success',
                'data' => $vnp_Url
            );

            $result = Order::create([
                'code' => rand(00, 9999),
                'user_id' => Auth::id(),
                'customer_name' => $data['name'],
                'customer_email' => !empty($data['email']) ? $data['email'] : null,
                'customer_phone' => $data['phone'],
                'customer_address' => $data['address'],
                'note' => !empty($data['note']) ? $data['note'] : null,
                'total_price' => $data['total_price'],
                'status' => 0,
                'payment_method' => 1
            ]);

            if (isset($_POST['action'])) {
                return redirect()->to($vnp_Url);
                // header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }
    }

    public function success()
    {
        return view('client.checkout.success');
    }
}
