<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            // Validate dữ liệu đầu vào
            $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'message' => 'required|string',
            ]);
    
            // Lưu vào database
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'message' => $request->message,
            ]);
    
            // Quay lại trang với thông báo thành công
            return response()->json(['message' => 'Cảm ơn bạn đã liên hệ với chúng tôi.', 'status' => 'success']);
        }
    
        return view('contact');
    }


}
