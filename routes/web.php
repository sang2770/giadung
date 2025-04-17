<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\IntroduceController;
use App\Http\Controllers\ContentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VnpayController;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;





Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home.index');
Route::get('/cua-hang', [ShopController::class, 'index'])->name('shop.index');
Route::get('/gioi-thieu', [IntroduceController::class, 'index'])->name('introduce.index');
Route::get('/tin-tuc', [ContentController::class, 'index'])->name('content.index');
Route::get('/tin-tuc-chi-tiet/{id}', [ContentController::class, 'content_details'])->name('content.detail');
Route::match(['GET', 'POST'], '/lien-he', [ContactController::class, 'index'])->name('contact.index');
Route::get('/cua-hang/{product_id}', [ShopController::class, 'product_details'])->name('shop.product.details');
Route::get('/filter-products', [ShopController::class, 'filterProducts'])->name('shop.filter');

Route::get('/search-suggestions', [SearchController::class, 'getSuggestions']);
Route::get('/search', [SearchController::class, 'search']); 
Route::post('/save-search-history', [SearchController::class, 'saveSearchHistory']);

Route::post('/vnpay_payment', [VnpayController::class, 'vnpay_payment'])->name('vnpay.return');




//Quan ly gio hang
Route::get('/gio-hang', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add', [CartController::class, 'add_to_cart'])->name('cart.add');
Route::put('/cart/increase-quantity/{rowId}', [CartController::class, 'increase_cart_quantity'])->name('cart.qty.increase');
Route::put('/cart/decrease-quantity/{rowId}', [CartController::class, 'decrease_cart_quantity'])->name('cart.qty.decrease');
Route::post('/cart/update/{rowId}', [CartController::class, 'update_cart_item']);
Route::delete('/cart/remove/{rowId}', [CartController::class, 'remove_item'])->name('cart.item.remove');
Route::delete('/cart/clear', [CartController::class, 'empty_cart'])->name('cart.empty');


//Xử lý mã giảm giá
Route::post('/cart/apply-coupon', [CartController::class, 'apply_coupon_code'])->name('cart.coupon.apply');
Route::delete('cart/remove-coupon', [CartController::class, 'remove_coupon_code'])->name('cart.coupon.remove');


Route::get('/checkout',[CartController::class,'checkout'])->name('cart.checkout');
Route::post('/checkout', [CartController::class, 'store'])->name('checkout.store');
Route::get('/get-provinces', [CartController::class, 'getProvinces']);
Route::get('/get-districts/{province_id}', [CartController::class, 'getDistricts']);



Route::middleware(['auth'])->group(function () {
    Route::get('/thong-tin-tai-khoan', [UserController::class, 'index'])->name('user.index');
    Route::post('/thong-tin-tai-khoan/cap-nhat', [UserController::class, 'update'])->name('user.update');
    Route::get('/thong-tin-tai-khoan/doi-mat-khau', [UserController::class, 'password_reset'])->name('user.password.reset');
    Route::post('/doi-mat-khau', [UserController::class, 'updatePassword'])->name('user.password.update');
    Route::get('/tai-khoan-don-hang',[UserController::class,'orders'])->name('user.orders');
    Route::get('/tai-khoan-don-hang/chi-tiet/{order_id}',[UserController::class,'order_details'])->name('user.order.details');
    Route::put('/tai-khoan-don-hang/huy-don-hang',[UserController::class,'order_cancel'])->name('user.order.cancel');
});


Route::middleware(['auth',AuthAdmin::class])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    //Quản lý nhà cung cấp
    Route::get('/admin/producers', [AdminController::class, 'producers'])->name('admin.producers');
    Route::get('/admin/producer/add', [AdminController::class, 'add_producer'])->name('admin.producer.add');
    Route::post('/admin/producer/store', [AdminController::class, 'producer_store'])->name('admin.producer.store');
    Route::post('/admin/producer/toggle-status', [AdminController::class, 'toggleStatus'])->name('admin.producer.toggle_status');
    Route::get('/admin/producer/edit/{id}', [AdminController::class, 'edit_producer'])->name('admin.producer.edit');
    Route::put('/admin/producer/update', [AdminController::class, 'update_producer'])->name('admin.producer.update');
    Route::delete('/admin/producer/{id}/delete', [AdminController::class, 'delete_producer'])->name('admin.producer.delete');


    //Quản lý danh mục
    Route::get('/admin/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/admin/category/add', [AdminController::class, 'add_category'])->name('admin.category.add');
    Route::post('/admin/category/store', [AdminController::class, 'category_store'])->name('admin.category.store');
    Route::get('/admin/category/edit/{id}', [AdminController::class, 'edit_category'])->name('admin.category.edit');
    Route::put('/admin/category/update', [AdminController::class, 'update_category'])->name('admin.category.update');
    Route::delete('/admin/category/{id}/delete', [AdminController::class, 'delete_category'])->name('admin.category.delete');


    //Quản lý sản phẩm
    Route::get('/admin/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/admin/product/add', [AdminController::class, 'add_product'])->name('admin.product.add');
    Route::post('/admin/product/store', [AdminController::class, 'product_store'])->name('admin.product.store');
    Route::get('/admin/product/edit/{id}', [AdminController::class, 'edit_product'])->name('admin.product.edit');
    Route::put('/admin/product/update', [AdminController::class, 'update_product'])->name('admin.product.update');
    Route::delete('/admin/product/{id}/delete', [AdminController::class, 'delete_product'])->name('admin.product.delete');

    //Quản lý mã giảm giá
    Route::get('/admin/coupons', [AdminController::class, 'coupons'])->name('admin.coupons');
    Route::get('/admin/coupon/add', [AdminController::class, 'add_coupon'])->name('admin.coupon.add');
    Route::post('/admin/coupon/store', [AdminController::class, 'coupon_store'])->name('admin.coupon.store');
    Route::get('/admin/coupon/edit/{id}', [AdminController::class, 'edit_coupon'])->name('admin.coupon.edit');
    Route::put('/admin/coupon/update', [AdminController::class, 'update_coupon'])->name('admin.coupon.update');
    Route::delete('/admin/coupon/{id}/delete', [AdminController::class, 'delete_coupon'])->name('admin.coupon.delete');


    //Quản lý đơn hàng
    Route::get('/admin/orders', [AdminController::class,'orders'])->name('admin.orders');
    Route::get('/admin/order/details/{order_id}', [AdminController::class,'order_details'])->name('admin.order.details');
    Route::put('/admin/order/update-status', [AdminController::class,'update_order_status'])->name('admin.order.status.update');


    //Quản lý slide
    Route::get('/admin/slides', [AdminController::class,'slides'])->name('admin.slides');
    Route::get('/admin/slide/add', [AdminController::class,'add_slide'])->name('admin.slide.add');
    Route::post('/admin/slide/store', [AdminController::class,'slide_store'])->name('admin.slide.store');
    Route::get('/admin/slide/edit/{id}', [AdminController::class,'edit_slide'])->name('admin.slide.edit');
    Route::put('/admin/slide/update', [AdminController::class,'update_slide'])->name('admin.slide.update');
    Route::delete('/admin.slide/{id}/delete', [AdminController::class,'delete_slide'])->name('admin.slide.delete');


    // Quản lý tin tức
    Route::get('/admin/contents', [AdminController::class, 'contents'])->name('admin.contents');
    Route::get('/admin/content/add', [AdminController::class,'add_content'])->name('admin.content.add');
    Route::post('/admin/content/store', [AdminController::class,'content_store'])->name('admin.content.store');
    Route::get('/admin/content/edit/{id}', [AdminController::class,'edit_content'])->name('admin.content.edit');
    Route::put('/admin/content/update', [AdminController::class,'update_content'])->name('admin.content.update');
    Route::delete('/admin.content/{id}/delete', [AdminController::class,'delete_content'])->name('admin.content.delete');

    //Quản lý liên hệ
    Route::get('/admin/contacts', [AdminController::class,'contacts'])->name('admin.contacts');
    Route::delete('/admin.contact/{id}/delete', [AdminController::class,'delete_contact'])->name('admin.contact.delete');
    

});
