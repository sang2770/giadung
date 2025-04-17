<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Producer;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;


class ShopController extends Controller
{
    public function index(Request $request)
    {
        $size = $request->query('size', 12);
        $order = $request->query('order', -1);
        $sort_by = $request->query('sort_by', '');
        $f_producers = $request->query('producers', '');
        $f_categories = $request->query('categories', '');
        $min_price = $request->query('min', 1);
        $max_price = $request->query('max', 9999999);
        $f_colors = $request->query('colors', '');
        $f_prices = $request->query('prices', []);
        $query = $request->query('query', ''); // <-- thêm dòng này để nhận từ khóa tìm kiếm



        // Xử lý thứ tự sắp xếp theo nút (Mới nhất - Cũ nhất)
        $orderByColumns = [
            0 => ['created_at', 'DESC'], // Mới nhất
            1 => ['created_at', 'ASC'],  // Cũ nhất
        ];

        $o_column = $orderByColumns[$order][0] ?? 'id';
        $o_order = $orderByColumns[$order][1] ?? 'DESC';


        // Xử lý sắp xếp theo dropdown
        switch ($sort_by) {
            case 'name_asc':
                $o_column = 'name';
                $o_order = 'ASC';
                break;
            case 'name_desc':
                $o_column = 'name';
                $o_order = 'DESC';
                break;
            case 'price_asc':
                $o_column = 'sale_price';
                $o_order = 'ASC';
                break;
            case 'price_desc':
                $o_column = 'sale_price';
                $o_order = 'DESC';
                break;
        }

        // Truy vấn sản phẩm, lấy cả biến thể nếu có
        $products = Product::with(['variants' => function ($query) {
            $query->orderBy('sale_price', 'ASC'); // Lấy biến thể có giá thấp nhất
        }])
        ->when(!empty($f_producers), function ($query) use ($f_producers) {
            return $query->whereIn('producer_id', explode(',', $f_producers));
        })
        ->when(!empty($f_categories), function ($query) use ($f_categories) {
            return $query->whereIn('category_id', explode(',', $f_categories));
        })
        ->when(!empty($f_colors), function ($query) use ($f_colors) {
            $colors = explode(',', $f_colors);
            $query->where(function ($q) use ($colors) {
                $q->whereIn('color', $colors)
                  ->orWhereHas('variants', function ($sub) use ($colors) {
                      $sub->whereIn('color', $colors);
                  });
            });
        })
        ->when(!empty($query), function ($queryBuilder) use ($query) {
            $queryBuilder->where('name', 'like', '%' . $query . '%');
        })        
        ->get();

        // Nếu không có sản phẩm
        $noResults = $products->isEmpty();

        // Sau khi get() xong
        if (!empty($f_prices)) {
            $f_prices = array_map(function ($range) {
                [$min, $max] = explode('-', $range);
                return ['min' => (float)$min, 'max' => (float)$max];
            }, $f_prices);

            $products = $products->filter(function ($product) use ($f_prices) {
                $price = $product->has_variants && $product->variants->count() > 0
                    ? $product->variants->min('sale_price')
                    : $product->sale_price;

                foreach ($f_prices as $range) {
                    if ($price >= $range['min'] && $price <= $range['max']) {
                        return true;
                    }
                }
                return false;
            })->values(); // reset keys
        }


        // Sắp xếp theo giá thực tế nếu có yêu cầu
        if (in_array($sort_by, ['price_asc', 'price_desc'])) {
            $products = $products->sortBy(function ($product) {
                if ($product->has_variants && $product->variants->count() > 0) {
                    return $product->variants->first()->sale_price;
                }
                return $product->sale_price;
            }, SORT_REGULAR, $sort_by === 'price_desc');
        } else {
            // Sắp xếp theo tiêu chí khác (created_at, sold, popularity, name, ...)
            $products = $products->sortBy(function ($product) use ($o_column) {
                return $product->$o_column;
            }, SORT_REGULAR, $o_order === 'DESC');
        }

        // Phân trang thủ công
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $items = $products->slice(($currentPage - 1) * $size, $size)->values();
        $products = new LengthAwarePaginator($items, $products->count(), $size, $currentPage, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);

        // Lấy danh sách màu sắc
        $colors = DB::table('products')
        ->select(DB::raw("CAST(color AS CHAR CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci) as color"))
        ->whereNotNull('color')
        ->whereNotIn('id', function ($query) {
            $query->select('product_id')->from('product_variants');
        })
        ->union(
            DB::table('product_variants')
                ->select(DB::raw("CAST(color AS CHAR CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci) as color"))
                ->whereNotNull('color')
        )
        ->distinct()
        ->pluck('color');

        // Trả về AJAX hoặc view
        if ($request->ajax()) {
            if ($products->isEmpty()) {
                return response()->json(['html' => '<p class="no-products">Không có sản phẩm phù hợp.</p>']);
            }

            $html = '';
            foreach ($products as $product) {
                // Nếu sản phẩm có biến thể, lấy biến thể có giá thấp nhất
                if ($product->has_variants && $product->variants->count() > 0) {
                    $variant = $product->variants->first();
                    $regular_price = $variant->regular_price;
                    $sale_price = $variant->sale_price;
                    $sale = round(($regular_price - $sale_price) / $regular_price * 100);
                } else {
                    $regular_price = $product->regular_price;
                    $sale_price = $product->sale_price;
                    $sale = $product->sale;
                }

                $html .= '
                <div class="col l-2-4 m-4 c-6">
                    <a class="home-product-item" href="' . route('shop.product.details', ['product_id' => $product->id]) . '">
                        <div class="home-product-item__img" style="background-image: url(' . asset('uploads/products/' . $product->image) . ');"></div>
                        <h4 class="home-product-item__name">' . $product->name . '</h4>
                        <div class="home-product-item__price">
                            <span class="home-product-item__price-old">' . number_format($regular_price, 0, ',', '.') . 'đ</span>
                            <span class="home-product-item__price-current">' . number_format($sale_price, 0, ',', '.') . 'đ</span>
                        </div>
                        <div class="home-product-item__action">
                                            <div class="home-product-item__rating">
                                                <span class="home-product-item__sold">88 đã bán</span>
                                            </div>
                                        </div>';

                if ($sale > 0) {
                    $html .= '<div class="home-product-item__sele-off">
                                <span class="home-product-item__sele-off-percent">' . number_format($sale, 0, ',', '.') . '%</span>
                                <span class="home-product-item__sele-off-label">GIẢM</span>
                            </div>';
                }

                $html .= '</a></div>';
            }

            return response()->json(['html' => $html]);
        }

        $producers = Producer::orderBy('name', 'ASC')->get();
        $categories = Category::orderBy('name', 'ASC')->get();
        return view('shop', compact('products', 'size', 'order', 'sort_by', 'producers', 'f_producers', 'categories', 'f_categories', 'min_price', 'max_price', 'colors', 'query', 'noResults'));
    }


    public function product_details($product_id)
    {
        $product = Product::with('variants')->where('id', $product_id)->first();

        if ($product->has_variants) {
            $variants = $product->variants->sortBy('regular_price');
            $cheapest_variant = $variants->first(); // Lấy biến thể có giá thấp nhất

            $regular_price = $cheapest_variant->regular_price;
            $sale_price = $cheapest_variant->sale_price;
            $sale = round(($regular_price - $sale_price) / $regular_price * 100);
        } else {
            $regular_price = $product->regular_price;
            $sale_price = $product->sale_price;
            $sale = $product->sale;
            $variants = collect(); // Đảm bảo biến $variants tồn tại, tránh lỗi compact()
        }

        // $rproducts = Product::where('id', '<>', $product_id)->get()->take(6);
        $rproducts = Product::where('category_id', $product->category_id)
                    ->where('id', '<>', $product->id) // Không lấy sản phẩm hiện tại
                    ->inRandomOrder() // Lấy ngẫu nhiên
                    ->limit(6)
                    ->get();
        return view('details', compact('product', 'variants', 'rproducts', 'regular_price', 'sale_price', 'sale'));
    }
}
