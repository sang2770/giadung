<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Transaction;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index');
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'name'   => 'required|string|max:255',
            'email'  => 'required|email|unique:users,email,' . $user->id,
            'mobile' => 'required|digits:10|unique:users,mobile,' . $user->id,
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cập nhật avatar nếu có
        if ($request->hasFile('avatar')) {
            // Xóa avatar cũ nếu có
            if ($user->avatar && file_exists(public_path($user->avatar))) {
                unlink(public_path($user->avatar));
            }

            $file = $request->file('avatar');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/avatars'), $fileName);
            $user->avatar = 'uploads/avatars/' . $fileName;
        }

        // Cập nhật các thông tin khác
        $user->name   = $request->name;
        $user->email  = $request->email;
        $user->mobile = $request->mobile;
        $user->save();

        return back()->with('success', 'Cập nhật thông tin thành công!');
    }

    public function password_reset()
    {
        return view('user.password-reset');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed', // xác nhận với `new_password_confirmation`
        ]);

        $user = auth()->user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu cũ không đúng']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Đổi mật khẩu thành công!');
    }



    public function orders()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('created_at', 'DESC')->paginate(10);
        return view('user.orders', compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = Order::where('user_id',Auth::user()->id)->where('id',$order_id)->first();
        if($order)
        {
            $orderItems = OrderItem::where('order_id',$order->id)->orderBy('id')->paginate(12);
            $transaction = Transaction::where('order_id',$order->id)->first();

        // Lấy danh sách id đơn hàng của người dùng theo thời gian
        $userOrderIds = Order::where('user_id', Auth::id())
            ->orderBy('created_at', 'ASC') // ASC để STT tăng theo thời gian
            ->pluck('id')
            ->toArray();

        // Tìm vị trí (STT) của đơn hàng hiện tại
        $orderPosition = array_search($order->id, $userOrderIds) + 1;

            return view('user.order-details',compact('order','orderItems','transaction', 'orderPosition'));
        }
        else
        {
            return redirect()->route('login');
        }
    }

    public function order_cancel(Request $request)
    {
        $order = Order::find($request->order_id);

        if ($order && $order->user_id == auth()->id()) {
            $order->status = "canceled";
            $order->canceled_date = Carbon::now();
            $order->save();

            return back()->with('canceled_success', 'Đơn hàng của bạn đã được hủy thành công!');
        }

        return back()->withErrors(['Không thể hủy đơn hàng.']);
    }

}
