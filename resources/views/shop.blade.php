@extends('layouts.app')
@section('content')
<div class="app">
    <div class="app__container">
        <div class="grid wide">
    
            <div class="breadcrumb-container">
                <div class="breadcrumb-bg">
                    <h1 class="breadcrumb-title">Tất cả sản phẩm</h1>
                    <div class="breadcrumb">
                        <a href="{{ route('home.index') }}" class="breadcrumb__link">Trang chủ</a>
                        <span class="breadcrumb__separator">/</span>
                        <span class="breadcrumb__current">Sản phẩm</span>
                    </div>
                </div>
            </div>

            @if(!empty($query))
                <h2 class="shop-search-title">Kết quả tìm kiếm cho: "{{ $query }}"</h2>
            @endif
            
            <div class="row  sm-gutter app__content">
                <div class="col l-2 m-0 c-0">
                    <nav class="category">
                        <h3 class="filter__heading">
                            <i class="filter__heading-icon fas fa-list"></i>
                            Danh mục
                        </h3>
                        <ul class="filter-list">
                            @foreach($categories as $category)
                                <li class="filter-item">
                                    <label>
                                        <input type="checkbox" class="filter-option" name="categories[]" value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                        
                    </nav>

                    <nav class="category">
                        <h3 class="filter__heading">
                            <i class="filter__heading-icon fas fa-list"></i>
                            Nhà sản xuất
                        </h3>
                        <ul class="filter-list">
                            @foreach($producers as $producer)
                                <li class="filter-item">
                                    <label>
                                        <input type="checkbox" class="filter-option" name="producer[]" value="{{ $producer->id }}">
                                        {{ $producer->name }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                    <nav class="category">
                        <h3 class="filter__heading">
                            <i class="filter__heading-icon fas fa-list"></i>
                            Màu sắc
                        </h3>
                        <ul class="filter-list">
                            @foreach($colors as $color)
                                <li class="filter-item">
                                    <label>
                                        <input type="checkbox" class="filter-option" name="colors[]" value="{{ $color }}">
                                        {{ $color }}
                                    </label>
                                </li>
                            @endforeach
                        </ul>
                    </nav>

                    <!-- Mức giá -->
                    <nav class="category">
                        <h3 class="filter__heading">
                            <i class="filter__heading-icon fas fa-list"></i>
                            Mức giá
                        </h3>
                        <ul class="filter-list">
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="0-999999">Dưới 1 triệu</label>
                            </li>
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="1000000-2000000">1 triệu - 2 triệu</label>
                            </li>
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="2000000-3000000">2 triệu - 3 triệu</label>
                            </li>
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="3000000-4000000">3 triệu - 4 triệu</label>
                            </li>
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="4000000-5000000">4 triệu - 5 triệu</label>
                            </li>
                            <li class="filter-item">
                                <label><input type="checkbox" class="filter-option" name="price[]" value="5000000-999999999">Trên 5 triệu</label>
                            </li>
                        </ul>
                    </nav>
                </div>

                <div class="col l-10 m-12 c-12">
                    <div class="home-filter hide-on-tablet-and-mobile">
                        <span class="home-filter__lable">Sắp xếp theo</span>
                        <button class="home-filter__btn btn btn--primary" data-order="0">Mới nhất</button>
                        <button class="home-filter__btn btn" data-order="1">Cũ nhất</button>
                        {{-- <button class="home-filter__btn btn">Bán chạy</button> --}}
                    
                        <div class="seclect-input">
                            <span class="seclect-input__label">Mặc định</span>
                            <i class="seclect-input__icon fas fa-chevron-down"></i>
                            <ul class="seclect-input__list">
                                <li class="seclect-input__item">
                                    <a href="#" class="seclect-input-link" data-sort="name_asc">Tên sản phẩm A → Z</a>
                                </li>
                                <li class="seclect-input__item">
                                    <a href="#" class="seclect-input-link" data-sort="name_desc">Tên sản phẩm Z → A</a>
                                </li>
                                <li class="seclect-input__item">
                                    <a href="#" class="seclect-input-link" data-sort="price_asc">Giá thấp đến cao</a>
                                </li>
                                <li class="seclect-input__item">
                                    <a href="#" class="seclect-input-link" data-sort="price_desc">Giá cao đến thấp</a>
                                </li>
                            </ul>
                            
                        </div>
                    </div>
                  
                    <div class="home-product">
                        <div class="row sm-gutter">
                            @foreach($products as $product)
                                @php
                                    // Kiểm tra nếu sản phẩm có biến thể
                                    if ($product->has_variants) {
                                        $variant = $product->variants->sortBy('regular_price')->first(); // Lấy biến thể có giá thấp nhất
                                        $image = asset('uploads/products/' . $product->image); // Giữ nguyên ảnh từ products
                                        $name = $product->name; // Giữ nguyên tên từ products
                                        $regular_price = $variant ? $variant->regular_price : 0;
                                        $sale_price = $variant ? $variant->sale_price : 0;
                                        $sale = ($variant && $variant->regular_price > 0) ? round((($variant->regular_price - $variant->sale_price) / $variant->regular_price) * 100) : 0;
                                    } else {
                                        // Nếu không có biến thể, lấy từ bảng products
                                        $image = asset('uploads/products/' . $product->image);
                                        $name = $product->name;
                                        $regular_price = $product->regular_price;
                                        $sale_price = $product->sale_price;
                                        $sale = $product->sale;
                                    }
                                @endphp
                    
                                <div class="col l-2-4 m-4 c-6">
                                    <a class="home-product-item" href="{{ route('shop.product.details', ['product_id' => $product->id]) }}">
                                        <!-- Hiển thị hình ảnh sản phẩm -->
                                        <div class="home-product-item__img" style="background-image: url('{{ $image }}');"></div>
                    
                                        <!-- Hiển thị tên sản phẩm -->
                                        <h4 class="home-product-item__name">{{ $name }}</h4>
                    
                                        <!-- Hiển thị giá bán và giá gốc -->
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-old">
                                                {{ number_format($regular_price, 0, ',', '.') }}đ
                                            </span>
                                            <span class="home-product-item__price-current">
                                                {{ number_format($sale_price, 0, ',', '.') }}đ
                                            </span>
                                        </div>
                    
                                        <div class="home-product-item__action">
                                            <div class="home-product-item__rating">
                                                <span class="home-product-item__sold">88 đã bán</span>
                                            </div>
                                        </div>
                    
                                        <!-- Hiển thị % giảm giá từ CSDL -->
                                        @if($sale > 0)
                                            <div class="home-product-item__sele-off">
                                                <span class="home-product-item__sele-off-percent">{{ number_format($sale, 0, ',', '.') }}%</span>
                                                <span class="home-product-item__sele-off-label">GIẢM</span>
                                            </div>
                                        @endif
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    


                  {{-- <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$products->withQueryString()->links('pagination::bootstrap-5')}}
                  </div> --}}
                    <div class="flex items-center justify-between flex-wrap gap10">
                        {{$products->links('pagination::bootstrap-5')}} 
                    </div>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Khi thay đổi checkbox danh mục
        $('.filter-list input[type="checkbox"]').change(function () {
            filterProducts();
        });

        // Khi click vào nút lọc (Mới nhất, Phổ biến, Bán chạy)
        $('.home-filter__btn').click(function () {
            $('.home-filter__btn').removeClass('btn--primary'); // Xóa class active khỏi tất cả
            $(this).addClass('btn--primary'); // Thêm class active vào nút được chọn

            filterProducts(); // Gọi hàm lọc
        });

        // Khi chọn giá trị sắp xếp trong dropdown
        $('.seclect-input__item a').click(function (e) {
            e.preventDefault();
            $('.seclect-input__item a').removeClass('active');
            $(this).addClass('active');

            filterProducts(); // Gọi hàm lọc
        });

        function filterProducts() {
            let categories = $('.filter-list input[name="categories[]"]:checked').map(function () {
                return this.value;
            }).get().join(',');

            let producers = $('.filter-list input[name="producer[]"]:checked').map(function () {
                return this.value;
            }).get().join(',');

            let colors = $('.filter-list input[name="colors[]"]:checked').map(function () {
                return this.value;
            }).get().join(',');

            let priceRanges = $('.filter-list input[name="price[]"]:checked').map(function () {
                return this.value;
            }).get(); // Mảng chứa các giá trị "min-max"

            let order = $('.home-filter__btn.btn--primary').data('order');
            let sort_by = $('.seclect-input__item a.active').attr('data-sort');

            $.ajax({
                url: "{{ route('shop.index') }}",
                type: "GET",
                data: {
                    categories: categories,
                    producers: producers,
                    colors: colors,
                    prices: priceRanges,
                    order: order,
                    sort_by: sort_by,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    $('.home-product .row').html(response.html);
                },
                error: function () {
                    alert('Có lỗi xảy ra! Vui lòng thử lại.');
                }
            });
        }
    });
</script>
@endsection

