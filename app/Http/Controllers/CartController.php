<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\Province;
use Carbon\Carbon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\District;
use App\Models\Transaction;
use Surfsidemedia\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmationMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class CartController extends Controller
{
    public function index()
    {
        $items = Cart::instance('cart')->content(); 
        return view('cart', compact('items'));
    }

    public function add_to_cart(Request $request)
    {
        $product = Product::with('variants')->find($request->id);

        if (!$product) {
            return response()->json(['success' => false, 'message' => 'Sản phẩm không tồn tại']);
        }

        // Kiểm tra xem có size, color từ request không (trường hợp thêm từ trang chi tiết)
        $selectedSize = $request->size;
        $selectedColor = $request->color;

        if ($product->has_variants) {
            if ($selectedSize && $selectedColor) {
                // THÊM TỪ TRANG CHI TIẾT: Lấy biến thể theo size, color được chọn
                $variant = $product->variants
                    ->where('size', $selectedSize)
                    ->where('color', $selectedColor)
                    ->first();

                if (!$variant) {
                    return response()->json(['success' => false, 'message' => 'Biến thể không tồn tại']);
                }
            } else {
                // THÊM TỪ TRANG INDEX: Lấy biến thể có giá sale thấp nhất
                $variant = $product->variants->sortBy('sale_price')->first();
            }

            $price = $variant->sale_price;
            $size = $variant->size;
            $color = $variant->color;
        } else {
            // Nếu sản phẩm không có biến thể, lấy từ bảng products
            $price = $product->sale_price;
            $size = $product->size ?: 'Không có';
            $color = $product->color ?: 'Không có';
        }

        Cart::instance('cart')->add(
            $product->id,
            $product->name,
            $request->quantity,
            $price,
            [
                'image' => $product->image,
                'size' => $size,
                'color' => $color
            ]
        )->associate('App\Models\Product');

        return response()->json([
            'success' => true,
            'cartCount' => Cart::instance('cart')->count()
        ]);
    }



    public function increase_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);
        $qty = $product->qty + 1;
        Cart::instance('cart')->update($rowId, $qty);

        return response()->json([
            'success' => true,
            'cartCount' => Cart::instance('cart')->count(),
            'newQuantity' => $qty,
            'price' => $product->price
        ]);
    }

    public function decrease_cart_quantity($rowId)
    {
        $product = Cart::instance('cart')->get($rowId);

        if ($product->qty > 1) {
            $qty = $product->qty - 1;
            Cart::instance('cart')->update($rowId, $qty);
        } else {
            $qty = $product->qty;
        }

        return response()->json([
            'success' => true,
            'cartCount' => Cart::instance('cart')->count(),
            'newQuantity' => $qty,
            'price' => $product->price
        ]);
    }

    public function remove_item($rowId)
    {
        Cart::instance('cart')->remove($rowId);

        return response()->json([
            'success' => true
        ]);
    }


    public function update_cart_item(Request $request, $rowId)
    {
        Cart::instance('cart')->update($rowId, $request->qty);
        $item = Cart::instance('cart')->get($rowId);

        return response()->json([
            'success' => true,
            'newTotal' => number_format($item->price * $item->qty, 0, ',', '.')."đ"
        ]);
    }

    public function empty_cart()
    {
        Cart::instance('cart')->destroy();
        return redirect()->back();
    }

    


    // Checkout
    public function checkout()
    {
        $cartItems = Cart::instance('cart')->content();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống!');
        }
        return view('checkout', compact('cartItems'));
    }

    // Mã giảm giá
    public function apply_coupon_code(Request $request)
    {
        $coupon_code = $request->coupon_code;

        if (!isset($coupon_code)) {
            return redirect()->back()->with('error', 'Invalid coupon code');
        }

        // Chuyển subtotal thành số thực để tránh lỗi so sánh
        $cartSubtotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        if ($cartSubtotal <= 0) {
            return redirect()->back()->with('error', 'Giỏ hàng trống hoặc subtotal không hợp lệ');
        }

        // Tìm mã giảm giá hợp lệ
        $coupon = Coupon::where('code', $coupon_code)
            ->whereDate('expiry_date', '>=', Carbon::today())
            ->where('cart_value', '<=', $cartSubtotal)
            ->first();

        if (!$coupon) {
            return redirect()->back()->with('error', 'Invalid or expired coupon code');
        }

        // Lưu mã giảm giá vào session
        Session::put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value
        ]);

        // Tính toán giảm giá
        $this->calculateDiscount();

        return redirect()->back()->with('success', 'Coupon has been applied!');
    }

    public function calculateDiscount()
    {
        // Chuyển subtotal về số thực để tránh lỗi
        $cartSubtotal = (float) str_replace(',', '', Cart::instance('cart')->subtotal());

        // Phí vận chuyển (giả sử bạn có logic tính phí riêng)
        $shippingFee = session('shipping_fee', 0); // Lấy từ session hoặc tính toán ở đâu đó

        // Kiểm tra giỏ hàng có sản phẩm không
        if ($cartSubtotal <= 0) {
            Session::forget('coupon');
            Session::forget('discounts');
            return;
        }

        $discount = 0;

        if (Session::has('coupon')) {
            $coupon = Session::get('coupon');

            if ($coupon['type'] == 'fixed') {
                $discount = (float) $coupon['value'];
            } else {
                $discount = ($cartSubtotal * (float) $coupon['value']) / 100;
            }
        }

        // Đảm bảo giảm giá không lớn hơn tổng giỏ hàng
        $discount = min($discount, $cartSubtotal);

        // Lưu vào session
        Session::put('discounts', [
            'discount' => number_format($discount, 0, '.', ''),
            'subtotal' => number_format($cartSubtotal - $discount, 0, '.', ''),
        ]);
    }

    public function remove_coupon_code()
    {
        Session::forget('coupon');
        Session::forget('discounts');
        return back()->with('success','Coupon has been remove');
    }
    // End mã giảm giá

    // Load dữ liệu tỉnh/quận/huyện
    public function getProvinces()
    {
        $provinces = Province::all(); // Lấy tất cả tỉnh/thành phố
        return response()->json($provinces);
    }

    public function getDistricts($province_id)
    {
        $districts = District::where('province_id', $province_id)->get();
        return response()->json($districts);
    }
    // End load dữ liệu tỉnh/quận/huyện 


    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'customer_name'  => 'required|max:100',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|numeric|digits:10',
            'province'       => 'required',
            'district'       => 'required',
            'address'        => 'required',
            'payment_method' => 'required|in:cod,bank_transfer',
            'cart_items'     => 'required|array', // Đảm bảo có sản phẩm trong giỏ hàng
        ]);

        $cartItems = $request->cart_items;

        if (empty($cartItems)) {
            return response()->json(['error' => 'Giỏ hàng của bạn đang trống.'], 400);
        }
    
        $subtotal = array_reduce($cartItems, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);
    
        // Lấy ID tỉnh từ request
        $provinceId = $request->province;

        // Lấy tên tỉnh từ bảng provinces
        $provinceName = Province::where('id', $provinceId)->value('name');

        // Danh sách tỉnh miễn phí ship
        $freeShippingProvinces = ['Sóc Trăng', 'Cần Thơ', 'Bạc Liêu', 'Cà Mau', 'Hậu Giang'];

        // Kiểm tra miễn phí ship
        $shippingFee = in_array($provinceName, $freeShippingProvinces) ? 0 : 40000;


        $discount = $request->discount ?? 0;
        $total = max(0, $subtotal + $shippingFee - $discount);

        // Tạo mã đơn hàng không trùng
        $orderCode = $this->generateUniqueOrderCode();        
        
        // Tạo đơn hàng
        $order = Order::create([
            'order_code'     => $orderCode,
            'user_id' => auth()->id(), // hoặc auth()->user()->id
            'customer_name'  => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'province'       => $provinceId,
            'district'       => $request->district,
            'address'        => $request->address,
            'payment_method' => $request->payment_method,
            'subtotal'       => $subtotal,
            'shipping_fee'   => $shippingFee,
            'discount'       => $discount,
            'total'          => $total,
            'status'         => 'pending',
        ]);

        // Lưu thông tin sản phẩm trong đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id'     => $order->id,
                'product_id'   => $item['product_id'],
                'product_name' => $item['product_name'],
                'price'        => $item['price'],
                'quantity'     => $item['quantity'],
                'subtotal'     => ($item['price'] ?? 0) * ($item['quantity'] ?? 0),
                'size'         => $item['size'] ?? null,
                'color'        => $item['color'] ?? null,
        ]);
        }

        // Nếu khách chọn COD, tạo transaction
        if ($request->payment_method === "cod") {
            Transaction::create([
                'user_id'  => Auth::id(),
                'order_id' => $order->id,
                'mode'     => "cod",
                'status'   => "pending",
            ]);
        }

        // Xóa giỏ hàng & session sau khi đặt hàng
        session()->forget('cart'); // Nếu dùng Session
        Session::forget('discount');
        // Gửi email xác nhận đơn hàng
        Mail::to($request->customer_email)->send(new OrderConfirmationMail($order));

        return redirect()->route('home.index')->with('success', 'Đơn hàng của bạn đã được đặt thành công!');
    }



    private function generateUniqueOrderCode()
    {
        do {
            $code = 'DH' . strtoupper(uniqid()); // ví dụ: DH661B9C4AB1FBC
        } while (Order::where('order_code', $code)->exists());

        return $code;
    }

}
