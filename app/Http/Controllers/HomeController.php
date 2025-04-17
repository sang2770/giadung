<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Slide;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Lấy các slide có trạng thái là 1, giới hạn 3 slide
        $slides = Slide::where('status', 1)->get()->take(3);

        // Lấy 12 sản phẩm mới nhất (theo ngày tạo hoặc cập nhật)
        $newProducts = Product::orderBy('created_at', 'desc')->take(12)->get();

        // Lấy 12 sản phẩm có khuyến mãi và có % giảm giá > 0
        $saleProducts = Product::where('sale', '>', 0)->orderBy('created_at', 'desc')->take(12)->get();

        // Trả về view với các biến cần thiết
        return view('index', compact('slides', 'newProducts', 'saleProducts'));
    }
}
