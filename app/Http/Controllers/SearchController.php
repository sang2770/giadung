<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class SearchController extends Controller
{
    public function getSuggestions(Request $request)
    {
        $query = $request->input('query');
        
        // Lấy danh sách sản phẩm phù hợp với từ khóa tìm kiếm
        $suggestions = Product::where('name', 'like', '%' . $query . '%')
            ->limit(5)  // Giới hạn số lượng gợi ý
            ->pluck('name');  // Lấy tên sản phẩm

        return response()->json([
            'suggestions' => $suggestions
        ]);
    }


    // Phương thức tìm kiếm
    public function search(Request $request)
    {
        $query = $request->input('query');
        $products = Product::where('name', 'like', '%' . $query . '%')->get();

        return view('search.results', compact('products'));
    }

    public function saveSearchHistory(Request $request)
    {
        $query = $request->input('query');

        // Lưu vào session
        $history = session()->get('search_history', []);
        array_unshift($history, $query); // Thêm mới vào đầu danh sách
        $history = array_unique($history); // Đảm bảo không trùng lặp
        session()->put('search_history', array_slice($history, 0, 3)); // Giới hạn 3 tìm kiếm gần nhất

        return response()->json(['message' => 'Lịch sử tìm kiếm đã được lưu']);
    }

}
