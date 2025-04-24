<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;

class VnpayController extends Controller
{
    /**
     * Tạo yêu cầu thanh toán VNPay
     */
    public function vnpay_payment(Request $request)
    {
        $data = $request->all();
        $code_cart = $request->order_code;
        Log::info('VNPay Code: ' . $code_cart);

        // Lấy cấu hình từ file config
        $vnp_Url = config('vnpay.url');
        $vnp_Returnurl = config('vnpay.return_url');
        $vnp_TmnCode = config('vnpay.tmn_code');
        $vnp_HashSecret = config('vnpay.hash_secret');

        // Thông tin đơn hàng
        $vnp_TxnRef = $code_cart;
        $vnp_OrderInfo = 'Thanh toan don hang:' . $code_cart;
        $vnp_OrderType = 'other';
        $vnp_Amount = (int)$data['total'] * 100; // Nhân 100 theo yêu cầu VNPay
        $vnp_Locale = 'vn';
        $vnp_IpAddr = $request->ip() ?? '127.0.0.1';
        $vnp_ExpireDate = date('YmdHis', strtotime('+15 minutes'));

        // Chuẩn bị dữ liệu gửi
        $inputData = [
            'vnp_Version' => '2.1.0',
            'vnp_TmnCode' => $vnp_TmnCode,
            'vnp_Amount' => $vnp_Amount,
            'vnp_Command' => 'pay',
            "vnp_CreateDate" => date('YmdHis'),
            'vnp_CurrCode' => 'VND',
            'vnp_IpAddr' => $vnp_IpAddr,
            'vnp_Locale' => $vnp_Locale,
            'vnp_OrderInfo' => $vnp_OrderInfo,
            'vnp_OrderType' => $vnp_OrderType,
            'vnp_ReturnUrl' => $vnp_Returnurl,
            'vnp_TxnRef' => $vnp_TxnRef,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        ];

        // Sắp xếp dữ liệu theo thứ tự alphabet
        ksort($inputData);

        // Tạo chuỗi hash
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

        Log::info('VNPay HashData: ' . $hashdata);
        Log::info('VNPay HashData: ' . $vnp_HashSecret);

        // Tạo chữ ký
        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
            $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }
        Log::info('VNPay Final URL: ' . $vnp_Url);
        return response()->json(['RspCode' => '200', 'Message' => 'Confirm Success', 'Url' => $vnp_Url]);
    }


    /**
     * Xử lý kết quả trả về từ VNPay (Return URL)
     */
    public function vnpay_return(Request $request)
    {
        $vnp_HashSecret = config('vnpay.hash_secret');
        $inputData = [];
    
        foreach ($request->all() as $key => $value) {
            if (substr($key, 0, 4) === 'vnp_') {
                $inputData[$key] = $value;
            }
        }
    
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);
    
        // Sắp xếp theo thứ tự alphabet
        ksort($inputData);
    
        // Build chuỗi dữ liệu giống mẫu VNPay
        $i = 0;
        $hashData = '';
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
        }
    
        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
    
        // Ghi log để debug
        Log::info('VNPay Return Data:', $inputData);
        Log::info('Generated Secure Hash: ' . $secureHash);
        Log::info('Received Secure Hash: ' . $vnp_SecureHash);
    
        if ($secureHash !== $vnp_SecureHash) {
            Log::error('Secure hash mismatch. Expected: ' . $secureHash . ', Received: ' . $vnp_SecureHash);
            return redirect()->route('home.index')->with('error', 'Sai chữ ký (secure hash không khớp)');
        }

        if ($inputData['vnp_ResponseCode'] !== '00') {
            Log::error('Transaction failed with response code: ' . $inputData['vnp_ResponseCode']);
            return redirect()->route('home.index')->with('error', 'Thanh toán thất bại: ' . $inputData['vnp_ResponseCode']);
        }

        // Giao dịch thành công
        $order = Order::where('order_code', $inputData['vnp_TxnRef'])->first();
        $transaction = Transaction::where('order_id', $order->id);
        if ($order) {
            $transaction->update(['status' => 'paid']);
        }
        return redirect()->route('home.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }

    /**
     * Xử lý IPN (Instant Payment Notification)
     */
    public function vnpay_ipn(Request $request)
    {
        $vnp_HashSecret = config('vnpay.hash_secret');
        $inputData = $request->all();
        $vnp_SecureHash = $inputData['vnp_SecureHash'] ?? '';
        unset($inputData['vnp_SecureHash']);

        // Sắp xếp dữ liệu
        ksort($inputData);
        $hashdata = http_build_query($inputData);
        $secureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);

        // Log để debug
        Log::info('VNPay IPN Data: ', $inputData);
        Log::info('Generated Secure Hash: ' . $secureHash);
        Log::info('Received Secure Hash: ' . $vnp_SecureHash);

        // Kiểm tra chữ ký và trạng thái
        if ($secureHash === $vnp_SecureHash && $inputData['vnp_ResponseCode'] == '00') {
            // Cập nhật đơn hàng
            $order = Order::where('code', $inputData['vnp_TxnRef'])->first();
            if ($order) {
                $order->update(['status' => 'paid']);
                Transaction::create([
                    'order_id' => $order->id,
                    'user_id'  => Auth::id(),
                    'txn_ref' => $inputData['vnp_TxnRef'],
                    'amount' => $inputData['vnp_Amount'] / 100,
                    'status' => 'success',
                    'response_code' => $inputData['vnp_ResponseCode'],
                ]);
            }
            return response()->json(['RspCode' => '00', 'Message' => 'Confirm Success']);
        } else {
            return response()->json(['RspCode' => '97', 'Message' => 'Invalid Checksum']);
        }
    }
}