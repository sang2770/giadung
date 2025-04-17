<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\Producer;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use App\Models\Transaction;
use App\Models\Slide;
use App\Models\Content;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    //Quản lý nhà cung cấp
    public function producers()
    {
        $producers = Producer::orderBy('id', 'DESC')->paginate(10);
        return view('admin.producers', compact('producers'));
    }

    public function add_producer()
    {
        return view('admin.producer-add');
    }

    public function producer_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:producers,slug',
            'image' => 'mimes:png,jpg,jpeg,gif,svg|max:2048'
        ]);

        $producer = new Producer();
        $producer->name = $request->name;
        $producer->slug = Str::slug($request->name);
        $producer->status = 'đang hợp tác';
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateProducerThumbailsImage($image, $file_name);
        $producer->image = $file_name;
        $producer->save();
        return redirect()->route('admin.producers')->with('status', 'Thêm nhà cung cấp thành công');
    }

    public function edit_producer($id)
    {
        $producer = Producer::find($id);
        return view('admin.producer-edit', compact('producer'));
    }

    public function update_producer(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:producers,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg,gif,svg|max:2048',
            'status' => 'required'
        ]);

        $producer = Producer::find($request->id);
        $producer->name = $request->name;
        $producer->slug = Str::slug($request->name);
        $producer->status = $request->status;
        if($request->hasFile('image')) {
            if(File::exists(public_path('uploads/producers/'.$producer->image)))
            {
                File::delete(public_path('uploads/producers/'.$producer->image));
            }
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateProducerThumbailsImage($image, $file_name);
        $producer->image = $file_name;
        }
        $producer->save();
        return redirect()->route('admin.producers')->with('status', 'Chỉnh sửa nhà cung cấp thành công');
    }

    public function GenerateProducerThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/producers');
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124,function($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function toggleStatus(Request $request)
    {
        $producer = Producer::find($request->id);
        if ($producer) {
            $producer->status = $request->status;
            $producer->save();
            return response()->json(['success' => true]);
        } 
        return response()->json(['success' => false], 400);
    }

    public function delete_producer($id)
    {
        $producer = Producer::find($id);
            if(File::exists(public_path('uploads/producers/'.$producer->image)))
            {
                File::delete(public_path('uploads/producers/'.$producer->image));
            }
            $producer->delete();
            return redirect()->route('admin.producers')->with('status', 'Xóa nhà cung cấp thành công');
    }



    //Quản lý danh mục
    public function categories()
    {
        $categories = Category::orderBy('id', 'DESC')->paginate(10);
        return view('admin.categories', compact('categories'));
    }

    public function add_category()
    {
        return view('admin.category-add');
    }

    public function category_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug',
            'image' => 'mimes:png,jpg,jpeg,gif,svg|max:2048'
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateCategoryThumbailsImage($image, $file_name);
        $category->image = $file_name;
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Thêm danh mục thành công');
    }

    public function GenerateCategoryThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/categories');
        $img = Image::read($image->path());
        $img->cover(124, 124, "top");
        $img->resize(124, 124,function($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);
    }

    public function edit_category($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit', compact('category'));
    }

    public function update_category(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'slug' => 'required|unique:categories,slug,'.$request->id,
            'image' => 'mimes:png,jpg,jpeg,gif,svg,webp|max:2048'
        ]);

        $category = Category::find($request->id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        if($request->hasFile('image')) {
            if(File::exists(public_path('uploads/categories/'.$category->image)))
            {
                File::delete(public_path('uploads/categories/'.$category->image));
            }
        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateCategoryThumbailsImage($image, $file_name);
        $category->image = $file_name;
        }
        $category->save();
        return redirect()->route('admin.categories')->with('status', 'Chỉnh sửa danh mục thành công');
    }

    public function delete_category($id)
    {
        $category = Category::find($id);
            if(File::exists(public_path('uploads/categories/'.$category->image)))
            {
                File::delete(public_path('uploads/categories/'.$category->image));
            }
            $category->delete();
            return redirect()->route('admin.categories')->with('status', 'Xóa danh mục thành công');
    }



    //Quản lý sản phẩm
    public function products()
    {
        $products = Product::orderBy('id', 'DESC')->paginate(10);
        return view('admin.products', compact('products'));
    }

    public function add_product()
    {
        $producers = Producer::select('id', 'name')->orderBy('name')->get();
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        return view('admin.product-add', compact('producers', 'categories'));
    }

    public function product_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'short_description' => 'nullable|string',
            'description' => 'required',
            'SKU' => 'required|unique:products,SKU',
            'stock_status' => 'required',
            'featured' => 'required',
            'producer_id' => 'required',
            'category_id' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            'has_variants' => 'nullable',
            'sizes' => 'nullable|array',
            'colors' => 'nullable|array',
            'quantities' => 'nullable|array',
            'import_prices' => 'nullable|array',
            'regular_prices' => 'nullable|array',
            'sales' => 'nullable|array',
            'quantity' => 'nullable|integer|min:1',
            'import_price' => 'nullable|numeric|min:0',
            'regular_price' => 'nullable|numeric|min:0',
            'sale' => 'nullable|numeric|min:0|max:100',
            'color' => 'nullable|string',
            'size' => 'nullable|string',
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->short_description = $request->short_description ?? null;
        $product->description = $request->description;
        $product->SKU = $request->SKU;
        $product->stock_status = $request->stock_status;
        $product->featured = $request->featured;
        $product->producer_id = $request->producer_id;
        $product->category_id = $request->category_id;

        $current_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageNameWithoutExt = $current_timestamp;
            $this->GenerateProductThumbailsImage($image, $imageNameWithoutExt);
            $product->image = $imageNameWithoutExt . '.webp';
        }

        // ✅ Lưu ảnh phụ
        $gallery_arr = [];
        $gallery_images = "";
        $counter = 1;

        if ($request->hasFile('images')) {
            $allowedFileExtensions = ['jpg', 'png', 'jpeg', 'gif', 'svg', 'webp'];
            $files = $request->file('images');

            foreach ($files as $file) {
                $gextension = $file->getClientOriginalExtension();
                if (in_array($gextension, $allowedFileExtensions)) {
                    $gfileName = $current_timestamp . "-" . $counter; // Không kèm extension
                    $this->GenerateProductThumbailsImage($file, $gfileName);
                    array_push($gallery_arr, $gfileName . '.webp');
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
        }
        $product->images = $gallery_images; // ✅ Lưu ảnh phụ vào DB

        $product->has_variants = $request->input('has_variants', 0);

        if ($request->has_variants) {
            // Nếu có biến thể, đặt giá trị mặc định để tránh lỗi
            $product->quantity = 0;
            $product->import_price = 0;
            $product->regular_price = 0;
            $product->sale_price = 0;
            $product->color = null;
            $product->size = null;
        } else {
            // Nếu không có biến thể, lấy dữ liệu từ form
            $product->quantity = $request->quantity;
            $product->import_price = $request->import_price;
            $product->regular_price = $request->regular_price;
            $product->sale = $request->sale ?? 0;
            $product->sale_price = $product->regular_price * (1 - $product->sale / 100);
            $product->color = $request->color;
            $product->size = $request->size;
        }

        $product->save();

        if ($request->has_variants) {
            foreach ($request->sizes as $index => $size) {
                $color = $request->colors[$index] ?? null;
                $quantity = $request->quantities[$index] ?? 0;
                $import_price = $request->import_prices[$index] ?? 0;
                $regular_price = $request->regular_prices[$index] ?? 0;
                $sale = $request->sales[$index] ?? 0;
                $sale_price = $regular_price * (1 - $sale / 100);

                ProductVariant::create([
                    'product_id' => $product->id,
                    'size' => $size,
                    'color' => $color,
                    'quantity' => $quantity,
                    'SKU' => $product->SKU . '-' . strtolower($size) . '-' . strtolower($color),
                    'import_price' => $import_price,
                    'regular_price' => $regular_price,
                    'sale' => $sale,
                    'sale_price' => $sale_price,
                ]);
            }
        }

        return redirect()->route('admin.products')->with('status', 'Thêm sản phẩm thành công');
    }

    public function GenerateProductThumbailsImage($image, $imageNameWithoutExtension)
    {
        $destinationPath = public_path('uploads/products');
        $destinationPathThumbnails = public_path('uploads/products/thumbnails');

        $img = Image::read($image->path());

        // Resize lớn hơn, chất lượng cao hơn
        $img->resize(600, 600, function($constraint) {
            $constraint->aspectRatio();
        })->toWebp(95)->save($destinationPath . '/' . $imageNameWithoutExtension . '.webp');

        $img->resize(300, 300, function($constraint) {
            $constraint->aspectRatio();
        })->toWebp(95)->save($destinationPathThumbnails . '/' . $imageNameWithoutExtension . '.webp');
    }

    
    public function edit_product($id)
    {
        $product = Product::find($id);
        $producers = Producer::select('id', 'name')->orderBy('name')->get();
        $categories = Category::select('id', 'name')->orderBy('name')->get();
        
        if ($product->has_variants) {
            $variants = ProductVariant::where('product_id', $id)->get();
            return view('admin.product-edit', compact('product', 'producers', 'categories', 'variants'));
        }
        
        return view('admin.product-edit', compact('product', 'producers', 'categories'));
    }

    public function update_product(Request $request)
    {
        // 1. Validate dữ liệu
        $request->validate([
            'name'             => 'required',
            'short_description'=> 'nullable|string',
            'description'      => 'required',
            'stock_status'     => 'required',
            'featured'         => 'required',
            'producer_id'      => 'required',
            'category_id'      => 'required',
            'image'            => 'nullable|mimes:png,jpg,jpeg,gif,svg,webp|max:2048',
            // Nếu không có biến thể, cần các trường sau:
            'SKU'             => 'required_if:has_variants,0',
            'quantity'        => 'required_if:has_variants,0|integer|min:0',
            'import_price'    => 'required_if:has_variants,0|numeric|min:0',
            'regular_price'   => 'required_if:has_variants,0|numeric|min:0',
            'sale'            => 'nullable|numeric|min:0|max:100',
        ], [
            // Có thể thêm custom message
            'SKU.required_if' => 'Vui lòng nhập Mã sản phẩm nếu không có biến thể.'
        ]);

        // 2. Tìm sản phẩm
        $id = $request->id;
        $product = Product::find($id);
        if (!$product) {
            return redirect()->route('admin.products')->with('error', 'Không tìm thấy sản phẩm.');
        }

        // 3. Cập nhật các trường chung
        $product->name              = $request->name;
        $product->short_description = $request->short_description ?? null;
        $product->description       = $request->description;
        $product->stock_status      = $request->stock_status;
        $product->featured          = $request->featured;
        $product->producer_id       = $request->producer_id;
        $product->category_id       = $request->category_id;

        // 4. Kiểm tra cột has_variants trong DB có cho thay đổi không
        // Giả sử ta cho phép thay đổi has_variants
        $product->has_variants = $request->input('has_variants', $product->has_variants);

        // 5. Upload ảnh chính (nếu có)
        $current_timestamp = Carbon::now()->timestamp;
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu tồn tại
            if ($product->image && File::exists(public_path('uploads/products/'.$product->image))) {
                File::delete(public_path('uploads/products/'.$product->image));
            }
            if ($product->image && File::exists(public_path('uploads/products/thumbnails/'.$product->image))) {
                File::delete(public_path('uploads/products/thumbnails/'.$product->image));
            }

            $image = $request->file('image');
            $imageName = $current_timestamp.'.'.$image->extension();

            // Gọi hàm tự tạo thumbnail + lưu ảnh
            $this->GenerateProductThumbailsImage($image, $imageName);

            $product->image = $imageName;
        }

        // 6. Upload ảnh phụ (nhiều ảnh)
        if ($request->hasFile('images')) {
            // Xóa ảnh phụ cũ
            if (!empty($product->images)) {
                foreach (explode(',', $product->images) as $oldImage) {
                    if (File::exists(public_path('uploads/products/'.$oldImage))) {
                        File::delete(public_path('uploads/products/'.$oldImage));
                    }
                    if (File::exists(public_path('uploads/products/thumbnails/'.$oldImage))) {
                        File::delete(public_path('uploads/products/thumbnails/'.$oldImage));
                    }
                }
            }

            $gallery_arr = [];
            $gallery_images = "";
            $counter = 1;

            $allowedExt = ['jpg','jpeg','png','gif','svg'];
            $files = $request->file('images');
            foreach ($files as $file) {
                $ext = $file->getClientOriginalExtension();
                if (in_array($ext, $allowedExt)) {
                    $fileName = $current_timestamp . '-' . $counter . '.' . $ext;
                    $this->GenerateProductThumbailsImage($file, $fileName);
                    $gallery_arr[] = $fileName;
                    $counter++;
                }
            }
            $gallery_images = implode(',', $gallery_arr);
            $product->images = $gallery_images;
        }

        // 7. Nếu sản phẩm có biến thể
        if ($product->has_variants) {
            // => Reset các trường variant trong products
            $product->SKU           = $request->SKU ?? $product->SKU; // Nếu SKU chung
            $product->quantity      = 0;
            $product->import_price  = 0;
            $product->regular_price = 0;
            $product->sale          = 0;
            $product->sale_price    = 0;
            $product->size          = null;
            $product->color         = null;

            // => Cập nhật các biến thể
            // Kiểm tra xem form gửi mảng variant_sku, variant_size,... hay không
            if ($request->has('variant_sku')) {
                foreach ($request->variant_sku as $key => $sku) {
                    // Tìm biến thể
                    $variantId = $request->variant_id[$key];
                    $variant = ProductVariant::find($variantId);
                    if ($variant) {
                        $variant->SKU           = $sku;
                        $variant->size          = $request->variant_size[$key];
                        $variant->color         = $request->variant_color[$key];
                        $variant->quantity      = $request->variant_quantity[$key];
                        $variant->import_price  = $request->variant_import_price[$key];
                        $variant->regular_price = $request->variant_regular_price[$key];
                        $variant->sale          = $request->variant_sale[$key] ?? 0;
                        $variant->sale_price    = $variant->regular_price * (1 - ($variant->sale / 100));
                        $variant->save();
                    }
                }
            }
        } else {
            // 8. Nếu không có biến thể => Lưu trực tiếp vào bảng products
            $product->SKU           = $request->SKU;
            $product->quantity      = $request->quantity;
            $product->import_price  = $request->import_price;
            $product->regular_price = $request->regular_price;
            $product->sale          = $request->sale ?? 0;
            $product->sale_price    = ($product->sale > 0)
                ? $product->regular_price * (1 - $product->sale / 100)
                : $product->regular_price;
            $product->size          = $request->size;
            $product->color         = $request->color;
        }

        // 9. Lưu product
        $product->save();

        // 10. Trả về
        return redirect()->route('admin.products')->with('status', 'Chỉnh sửa sản phẩm thành công');
    }
    
    public function delete_product($id)
    {
        $product = Product::find($id);
        if(File::exists(public_path('uploads/products/'.$product->image)))
        {
            File::delete(public_path('uploads/products/'.$product->image));
        }
        if(File::exists(public_path('uploads/products/thumbnails/'.$product->image)))
        {
            File::delete(public_path('uploads/products/thumbnails/'.$product->image));
        }
        foreach(explode(',', $product->images) as $oflie)
        {
            if(File::exists(public_path('uploads/products/'.$oflie)))
            {
                File::delete(public_path('uploads/products/'.$oflie));
            }
            if(File::exists(public_path('uploads/products/thumbnails/'.$oflie)))
            {
                File::delete(public_path('uploads/products/thumbnails/'.$oflie));
            }
        }
        $product->delete();
        return redirect()->route('admin.products')->with('status', 'Xóa sản phẩm thành công');
    }


    //Quản lý mã giảm giá
    public function coupons() {
        $coupons = Coupon::orderBy('expiry_date', 'DESC')->paginate(12);
        return view('admin.coupons', compact('coupons'));
    }

    public function add_coupon() {
        return view('admin.coupon-add');
    }

    public function coupon_store(Request $request) {
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date'
        ]);

        $coupon = new Coupon();
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Thêm mã giảm giá thành công');
    }

    public function edit_coupon($id) {
        $coupon = Coupon::find($id);
        return view('admin.coupon-edit', compact('coupon'));
    }

    public function update_coupon(Request $request) {
        $request->validate([
            'code' => 'required|unique:coupons,code,'.$request->id,
            'type' => 'required',
            'value' => 'required|numeric',
            'cart_value' => 'required|numeric',
            'expiry_date' => 'required|date'
        ]);

        $coupon = Coupon::find($request->id);
        $coupon->code = $request->code;
        $coupon->type = $request->type;
        $coupon->value = $request->value;
        $coupon->cart_value = $request->cart_value;
        $coupon->expiry_date = $request->expiry_date;
        $coupon->save();
        return redirect()->route('admin.coupons')->with('status', 'Chỉnh sửa mã giảm giá thành công');
    }

    public function delete_coupon($id) {
        $coupon = Coupon::find($id);
        $coupon->delete();
        return redirect()->route('admin.coupons')->with('status', 'Xóa mã giảm giá thành công');
    }


    // Quản lý đơn hàng
    public function orders()
    {
        $orders = Order::orderBy('created_at','DESC')->paginate(12);
        return view('admin.orders',compact('orders'));
    }

    public function order_details($order_id)
    {
        $order = Order::find($order_id);
        $orderItems = OrderItem::where('order_id', $order_id)->orderBy('id')->paginate(12);
        $transaction = Transaction::where('order_id', $order_id)->first();
        return view('admin.order-details', compact('order', 'orderItems', 'transaction'));
    }

    public function update_order_status(Request $request)
    {
        $order = Order::find($request->order_id);
        if (!$order) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy đơn hàng'], 404);
        }

        $order->status = $request->order_status;

        // Cập nhật ngày giao/hủy/trả nếu cần
        if ($request->order_status === 'delivered') {
            $order->delivered_date = now();
        } elseif ($request->order_status === 'canceled') {
            $order->canceled_date = now();
        } elseif ($request->order_status === 'returned') {
            $order->returned_date = now();
        }

        $order->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }



    //Quản lý slide
    public function slides()
    {
        $slides = Slide::orderBy('id','DESC')->paginate(12);
        return view('admin.slides',compact('slides'));
    }

    public function add_slide()
    {
        return view('admin.slide-add');
    }

    public function slide_store(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $slide = new Slide();
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateSlideThumbailsImage($image, $file_name);
        $slide->image = $file_name;
        $slide->save();
        return redirect()->route('admin.slides')->with("status","Đã thêm Slide thành công !");
    }

    public function GenerateSlideThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/slides');
        $img = Image::read($image->path());
        $img->save($destinationPath.'/'.$imageName);
    }

    public function edit_slide($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide-edit',compact('slide'));
    }

    public function update_slide(Request $request)
    {
        $request->validate([
            'tagline' => 'required',
            'title' => 'required',
            'subtitle' => 'required',
            'link' => 'required',
            'status' => 'required',
            'image' => 'mimes:png,jpg,jpeg|max:2048'
        ]);
        $slide = Slide::find($request->id);
        $slide->tagline = $request->tagline;
        $slide->title = $request->title;
        $slide->subtitle = $request->subtitle;
        $slide->link = $request->link;
        $slide->status = $request->status;

        if($request->hasFile('image')) 
        {
            if(File::exists(public_path('uploads/slides/'.$slide->image)))
            {
                File::delete(public_path('uploads/slides/'.$slide->image));
            }
            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenerateSlideThumbailsImage($image, $file_name);
            $slide->image = $file_name;
        }
        $slide->save();
        return redirect()->route('admin.slides')->with("status", "Chỉnh sửa Slide thành công !");
    }

    public function delete_slide($id)
    {
        $slide = Slide::find($id);
        if(File::exists(public_path('uploads/slides').'/'.$slide->image));
        {
            File::delete(public_path('uploads/slides').'/'.$slide->image);
        }
        $slide->delete();
        return redirect()->route('admin.slides')->with("status","Xóa Slide thành công !");
    }


    // Quản lý tin tức
    public function contents()
    {
        $contents = Content::orderBy('id', 'DESC')->paginate(10); // ✅ Dùng paginate()
        return view('admin.contents', compact('contents'));
    }

    public function add_content()
    {
        return view('admin.content-add');
    }

    public function content_store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'introtext' => 'required',
            'fulltext' => 'required',
            'status' => 'required',
            'image' => 'required|mimes:png,jpg,jpeg|max:2048'
        ]);
        $content = new Content();
        $content->title = $request->title;
        $slug = Str::slug($request->title, '-');
        $count = Content::where('alias', 'LIKE', $slug . '%')->count();
        $content->alias = $count ? $slug . '-' . ($count + 1) : $slug;
        $content->introtext = $request->introtext;
        $content->fulltext = $request->fulltext;
        $content->status = $request->status;

        $image = $request->file('image');
        $file_extension = $request->file('image')->extension();
        $file_name = Carbon::now()->timestamp.'.'.$file_extension;
        $this->GenerateContentThumbailsImage($image, $file_name);
        $content->image = $file_name;
        $content->save();
        return redirect()->route('admin.contents')->with("status","Đã thêm Tin tức thành công !");
    }

    public function GenerateContentThumbailsImage($image, $imageName)
    {
        $destinationPath = public_path('uploads/contents');
        $img = Image::read($image->path());
        $img->save($destinationPath.'/'.$imageName);
    }

    public function edit_content($id)
    {
        $content = Content::find($id);
        return view('admin.content-edit',compact('content'));
    }

    public function update_content(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'introtext' => 'required',
            'fulltext' => 'required',
            'status' => 'required',
            'image' => 'nullable|mimes:png,jpg,jpeg|max:2048'
        ]);
        $content = Content::find($request->id);
        $content->title = $request->title;
        $content->introtext = $request->introtext;
        $content->fulltext = $request->fulltext;
        $content->status = $request->status;

        if($request->hasFile('image')) 
        {
            if(File::exists(public_path('uploads/contents/'.$content->image)))
            {
                File::delete(public_path('uploads/contents/'.$content->image));
            }
            $image = $request->file('image');
            $file_extension = $request->file('image')->extension();
            $file_name = Carbon::now()->timestamp.'.'.$file_extension;
            $this->GenerateContentThumbailsImage($image, $file_name);
            $content->image = $file_name;
        }
        $content->save();
        return redirect()->route('admin.contents')->with("status", "Chỉnh sửa Tin tức thành công !");
    }

    public function delete_content($id)
    {
        $content = Content::find($id);
        if(File::exists(public_path('uploads/contents').'/'.$content->image));
        {
            File::delete(public_path('uploads/contents').'/'.$content->image);
        }
        $content->delete();
        return redirect()->route('admin.contents')->with("status","Xóa Tin tức thành công !");
    }

    //Quản lý liên hệ
    public function contacts()
    {
        $contacts = Contact::orderBy('id', 'DESC')->paginate(10);
        return view('admin.contacts', compact('contacts'));
    }

    public function delete_contact($id)
    {
        $contact = Contact::find($id);
        $contact->delete();
        return redirect()->route('admin.contacts')->with('status', 'Xóa liên hệ thành công');
    }
}

