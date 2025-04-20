<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\PurchaseOrder;
use App\Models\PurchaseOrderItem;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PurchaseOrderController extends Controller
{
    public function index()
    {
        $purchaseOrders = purchaseOrder::with('items.product')->orderBy('created_at', 'desc')->get();
        return view('admin.imports', compact('purchaseOrders'));
    }

    public function imports()
    {
        return view('admin.imports');
    }

    public function add_import()
    {
        $categories = Category::all();
        return view('admin.import-add', compact('categories'));
    }

    public function getByCategory($categoryId)
    {
        return Product::where('category_id', $categoryId)->get(['id', 'name']);
    }

    public function checkVariants($productId)
    {
        $product = Product::find($productId);
        return ['has_variants' => $product->has_variants];
    }

    public function getVariants($productId)
    {
        $variants = ProductVariant::where('product_id', $productId)->get();
        $sizes = $variants->pluck('size')->unique()->values();
        $colors = $variants->pluck('color')->unique()->values();
        return compact('sizes', 'colors');
    }


    public function store(Request $request)
{
    // Validate dữ liệu đầu vào
    $request->validate([
        'supplier_name' => 'required|string|max:255',
        'batch_number' => 'required|string|max:255',
        'category_id.*' => 'required|integer|exists:categories,id',
        'product_id.*' => 'required|integer|exists:products,id',
        'quantity.*' => 'required|integer|min:1',
        'import_price.*' => 'required|numeric|min:0',
    ]);

    // 1. Tạo phiếu nhập hàng
    $purchaseOrder = new PurchaseOrder();
    $purchaseOrder->batch_code = $request->batch_number;
    $purchaseOrder->imported_by = $request->supplier_name;
    $purchaseOrder->created_at = now();
    $purchaseOrder->updated_at = now();
    $purchaseOrder->save();

    // 2. Lưu các item chi tiết
    foreach ($request->product_id as $index => $productId) {
        $orderItem = new PurchaseOrderItem();
        $orderItem->purchase_order_batch_code = $purchaseOrder->batch_code;
        $orderItem->product_id = $productId;
        $orderItem->product_variant_id = null; // Mặc định là null
        $orderItem->quantity = $request->quantity[$index];
        $orderItem->import_price = $request->import_price[$index];
        $orderItem->created_at = now();
        $orderItem->updated_at = now();

        // Kiểm tra nếu có size và color
        $size = $request->size[$index] ?? null;
        $color = $request->color[$index] ?? null;

        if ($size && $color) {
            // Tìm biến thể sản phẩm dựa trên product_id, size, và color
            $variant = ProductVariant::where('product_id', $productId)
                ->where('size', $size)
                ->where('color', $color)
                ->first();

            if ($variant) {
                // Cộng số lượng vào biến thể
                $variant->quantity += $request->quantity[$index];
                $variant->save();

                // Gán product_variant_id cho order item
                $orderItem->product_variant_id = $variant->id;
            } else {
                // Nếu không tìm thấy biến thể, có thể log lỗi hoặc xử lý tùy ý
                return redirect()->back()->withErrors(['error' => 'Không tìm thấy biến thể sản phẩm với size và color đã chọn!']);
            }
        } else {
            // Nếu không có size và color, cập nhật số lượng sản phẩm chính
            $product = Product::find($productId);
            if ($product) {
                $product->quantity += $request->quantity[$index];
                $product->save();
            }
        }

        // Lưu order item
        $orderItem->save();
    }

    return redirect()->route('admin.imports')->with('success', 'Nhập hàng thành công!');
}
}
