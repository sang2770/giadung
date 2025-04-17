@extends('layouts.app')
@section('content')

<style>
    .description-html.line-clamp {
    display: -webkit-box;
    -webkit-line-clamp: 10;
    -webkit-box-orient: vertical;
    overflow: hidden;
    position: relative;
    }

    .description-html.expanded {
        display: block;
        -webkit-line-clamp: unset;
        overflow: visible;
    }

    .variant-size-options {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    }

    .variant-size-btn {
        border: 1px solid #ccc;
        padding: 10px 15px;
        background: white;
        cursor: pointer;
        font-size: 1.4rem;
        border-radius: 4px;
        min-width: 80px;
        text-align: center;
        transition: 0.2s;
    }

    .variant-size-btn:hover {
        border-color: #888;
    }

    .variant-size-btn.active {
        border: 1px solid red;
        color: red;
        font-weight: bold;
    }

    .variant-color-options {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    margin-bottom: 10px;
    }

    .variant-color-btn {
        border: 1px solid #ccc;
        padding: 10px 15px;
        background: white;
        cursor: pointer;
        font-size: 1.4rem;
        border-radius: 4px;
        min-width: 80px;
        text-align: center;
        transition: 0.2s;
    }

    .variant-color-btn:hover {
        border-color: #888;
    }

    .variant-color-btn.active {
        border: 1px solid red;
        color: red;
        font-weight: bold;
    }


</style>

    <div class="app">
        <div class="app__container">
            <div class="grid wide">
                
                <nav style="font-size: 1.6rem; padding-top: 20px">
                    <span>
                        <a class="link-page" href="{{ url('/') }}">Trang chủ</a> / 
                        <a class="link-page" href="{{ url('/cua-hang') }}">Sản phẩm</a> / 
                        <span style="color: rgb(247, 143, 75)">{{ $product->name }}</span>
                    </span>
                </nav>
                

                <div class="row sm-gutter app__content">
                    <!-- Ảnh sản phẩm -->
                    <div class="col l-5 m-0 c-0">

                        <div class="product-container">
                            <div class="product-image">
                                <img id="main-image" src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}">
                            </div>
                        
                            <div class="thumbnail-container">
                                @php
                                    // Chuyển chuỗi ảnh thành mảng (nếu có ảnh)
                                    $gallery = $product->images ? explode(',', $product->images) : [];
                                @endphp
                            
                                @foreach ($gallery as $image)
                                    <div class="thumbnail {{ $loop->first ? 'active' : '' }}" onclick="changeImage('{{ asset('uploads/products/thumbnails/' . trim($image)) }}', this)">
                                        <img src="{{ asset('uploads/products/thumbnails/' . trim($image)) }}" alt="Ảnh sản phẩm">
                                    </div>
                                @endforeach
                            </div>
                            
                        </div>
                    </div>
                    
                    <!-- Thông tin sản phẩm -->
                    <div class="col l-4 m-0 c-0">
                        <div class="product-info">
                            <h1 class="product-title">{{ $product->name }}</h1>
                            <p class="producer-status">Nhà cung cấp: <span class="producer-details">{{ $product->producer->name ?? 'Không rõ' }}</span> |
                                                        Tình trạng: <span class="status-details">{{ $product->stock_status === 'instock' ? 'Còn hàng' : 'Hết hàng' }}</span></p>
                            <div class="price-section">
                                <span class="sale-price">{{ number_format($sale_price, 0, ',', '.') }} đ</span>
                                <span class="regular-price">{{ number_format($regular_price, 0, ',', '.') }} đ</span>
                                <p class="save-money">Tiết kiệm: {{ number_format($regular_price - $sale_price, 0, ',', '.') }} đ ({{ $sale }}%)</p>
                            </div>
                            @if($product->has_variants)
                                <p class="size-details"><strong>Kích thước:</strong></p>
                                <div class="variant-size-options">
                                    @foreach($variants->unique('size') as $variant)
                                        <button 
                                            class="variant-size-btn" 
                                            data-size="{{ $variant->size }}"
                                        >
                                            {{ $variant->size }}
                                        </button>
                                    @endforeach
                                </div>


                                <p class="color-details"><strong>Màu sắc:</strong></p>
                                <div class="variant-color-options" id="color-options"></div>

                            @else
                                <p class="size-details"><strong>Kích thước:</strong></p>
                                <div class="variant-size-options">
                                    <button class="variant-size-btn active" data-size="{{ $product->size }}">{{ $product->size }}</button>
                                </div>
                                
                                <p class="color-details"><strong>Màu sắc:</strong></p>
                                <div class="variant-color-options">
                                    <button class="variant-color-btn active" data-color="{{ $product->color }}">{{ $product->color }}</button>
                                </div>                            
                            @endif



                            <p><strong>Cam kết:</strong> Hàng mới 100% chất lượng .</p>
                            <div class="quantity-selector">
                                <button class="quantity-selector-item" onclick="decreaseQuantity()">-</button>
                                <input id="quantity" type="text" value="1" oninput="validateQuantity(this)" class="quantity-input">
                                <button class="quantity-selector-item" onclick="increaseQuantity()">+</button>
                            </div>                         
                            
                            <div class="row sm-gutter details-actions">
                                <button type="submit" class="details-actions__item add-to-cart__details">THÊM VÀO GIỎ HÀNG</button>
                                <button class="details-actions__item buy-now__details">MUA NGAY</button>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Tư vấn và giao hàng -->
                    <div class="col l-3 m-0 c-0">
                        <div class="support-section">
                            <ul class="support-list">
                                <li class="support-item">✅ Tư vấn tận tâm</li>
                                <li class="support-item">🚀 Giao hàng siêu tốc</li>
                                <li class="support-item">💳 Miễn phí thanh toán qua Visa, Master, JCB</li>
                                <li class="support-item">🔄 Đổi trả miễn phí trong 30 ngày</li>
                            </ul>
                            <div class="hotline">
                                <a href="tel:0375112571" class="telephone">Hotline: 0375 112 571</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="describe-details">
                    <h2 class="describe-details__title">Mô tả sản phẩm</h2>
                
                    <div class="describe-details__content" id="description-box">
                        <div class="description-html line-clamp" id="description-html">
                            {!! $product->description !!}
                        </div>
                        <button class="btn-toggle-description mt-3" onclick="toggleDescription()">Xem thêm</button>
                    </div>
                </div>
                

                    <div class="related-products">
                        <h2 class="related-products__title">Sản phẩm liên quan</h2>
                    </div>

                    <div class="home-product">
                        <div class="row sm-gutter">
                            @foreach($rproducts as $rproduct)
                                @php
                                    // Kiểm tra nếu sản phẩm có biến thể
                                    if ($rproduct->has_variants) {
                                        $variant = $rproduct->variants->sortBy('regular_price')->first(); // Lấy biến thể có giá thấp nhất
                                        $image = asset('uploads/products/' . $rproduct->image); // Giữ nguyên ảnh từ products
                                        $name = $rproduct->name; // Giữ nguyên tên từ products
                                        $regular_price = $variant ? $variant->regular_price : 0;
                                        $sale_price = $variant ? $variant->sale_price : 0;
                                        $sale = ($variant && $variant->regular_price > 0) ? round((($variant->regular_price - $variant->sale_price) / $variant->regular_price) * 100) : 0;
                                    } else {
                                        // Nếu không có biến thể, lấy từ bảng products
                                        $image = asset('uploads/products/' . $rproduct->image);
                                        $name = $rproduct->name;
                                        $regular_price = $rproduct->regular_price;
                                        $sale_price = $rproduct->sale_price;
                                        $sale = $rproduct->sale;
                                    }
                                @endphp
                    
                                <div class="col l-2 m-4 c-6">
                                    <a class="home-product-item" href="{{ route('shop.product.details', ['product_id' => $rproduct->id]) }}">
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
            </div>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       function changeImage(imageSrc, clickedElement) {
            // Đổi ảnh chính
            document.getElementById("main-image").src = imageSrc;

            // Xóa class active của tất cả thumbnail
            let thumbnails = document.querySelectorAll(".thumbnail");
            thumbnails.forEach(thumb => thumb.classList.remove("active"));

            // Thêm class active cho ảnh được chọn
            clickedElement.classList.add("active");
        }


        function increaseQuantity() {
            let quantityInput = document.getElementById("quantity");
            let currentValue = parseInt(quantityInput.value) || 1;
            quantityInput.value = currentValue + 1;
        }

        function decreaseQuantity() {
            let quantityInput = document.getElementById("quantity");
            let currentValue = parseInt(quantityInput.value) || 1;
            if (currentValue > 1) {
                quantityInput.value = currentValue - 1;
            }
        }

        function validateQuantity(input) {
            // Chỉ cho phép nhập số dương, không để trống
            let value = parseInt(input.value);
            if (isNaN(value) || value < 1) {
                input.value = 1;
            } else {
                input.value = value;
            }
        }

        var variants = @json($variants);
        document.addEventListener("DOMContentLoaded", function () {
        let sizeButtons = document.querySelectorAll(".variant-size-btn");
        let colorContainer = document.getElementById("color-options");

        function updateColors(selectedSize) {
        let availableVariants = variants.filter(v => v.size === selectedSize);
        let uniqueColors = [...new Set(availableVariants.map(v => v.color))];

        colorContainer.innerHTML = uniqueColors.map(color =>
            `<button class="variant-color-btn" data-color="${color}">${color}</button>`
        ).join('');

        // Gắn sự kiện click cho mỗi button màu
        document.querySelectorAll(".variant-color-btn").forEach(btn => {
            btn.addEventListener("click", function () {
                document.querySelectorAll(".variant-color-btn").forEach(b => b.classList.remove("active"));
                this.classList.add("active");

                let selectedSize = document.querySelector(".variant-size-btn.active")?.dataset.size;
                let selectedColor = this.dataset.color;
                updatePrice(selectedSize, selectedColor);
            });
        });

        // Tự động chọn nút đầu tiên
        const firstColorBtn = document.querySelector(".variant-color-btn");
        if (firstColorBtn) firstColorBtn.click();
    }


        function updatePrice(size, color) {
            let selectedVariant = variants.find(v => v.size === size && v.color === color);

            if (selectedVariant) {
                document.querySelector(".sale-price").textContent = numberWithDots(selectedVariant.sale_price) + "đ";
                document.querySelector(".regular-price").textContent = numberWithDots(selectedVariant.regular_price) + "đ";
                document.querySelector(".save-money").textContent = `Tiết kiệm: ${numberWithDots(selectedVariant.regular_price - selectedVariant.sale_price)}đ (${calculateDiscount(selectedVariant.regular_price, selectedVariant.sale_price)}%)`;
            }
        }

        function numberWithDots(x) {
            return parseInt(x).toLocaleString("vi-VN");
        }

        function calculateDiscount(regular, sale) {
            return regular > 0 ? Math.round(((regular - sale) / regular) * 100) : 0;
        }

        sizeButtons.forEach(btn => {
            btn.addEventListener("click", function () {
                sizeButtons.forEach(b => b.classList.remove("active"));
                this.classList.add("active");

                let selectedSize = this.dataset.size;
                updateColors(selectedSize);

                let selectedColorBtn = document.querySelector(".variant-color-btn.active");
                let selectedColor = selectedColorBtn ? selectedColorBtn.dataset.color : null;
                updatePrice(selectedSize, selectedColor);
            });
        });

       

        // Auto chọn button đầu tiên khi load
        if (sizeButtons.length > 0) {
            sizeButtons[0].click();
        }
    });

        document.addEventListener("DOMContentLoaded", function () {
        document.querySelector(".add-to-cart__details").addEventListener("click", function () {
            let productId = "{{ $product->id }}";
            let sizeBtn = document.querySelector(".variant-size-btn.active");
            let size = sizeBtn ? sizeBtn.dataset.size : "{{ $product->size }}";
            let colorBtn = document.querySelector(".variant-color-btn.active");
            let color = colorBtn ? colorBtn.dataset.color : "{{ $product->color }}";
            let quantity = document.getElementById("quantity").value;

            let data = {
                id: productId,
                size: size,
                color: color,
                quantity: quantity,
                _token: "{{ csrf_token() }}"
            };

            fetch("{{ route('cart.add') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                body: JSON.stringify(data)
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Cập nhật số trên icon giỏ hàng
                    document.querySelector(".js-cart-items-count").textContent = data.cartCount;

                    // Hiển thị SweetAlert2 thay cho alert()
                    Swal.fire({
                        title: "Đã thêm vào giỏ hàng!",
                        text: "Sản phẩm đã được thêm vào giỏ hàng của bạn.",
                        icon: "success",
                        showCancelButton: true,
                        confirmButtonText: "Xem giỏ hàng",
                        cancelButtonText: "Tiếp tục mua sắm",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('cart.index') }}";
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Không thể thêm sản phẩm vào giỏ hàng.",
                        icon: "error"
                    });
                }
            }).catch(error => {
                Swal.fire({
                    title: "Lỗi!",
                    text: "Có lỗi xảy ra, vui lòng thử lại sau.",
                    icon: "error"
                });
                console.error("Lỗi:", error);
            });
        });

        document.querySelector(".buy-now__details").addEventListener("click", function () {
        let productId = "{{ $product->id }}";
        let sizeBtn = document.querySelector(".variant-size-btn.active");
        let size = sizeBtn ? sizeBtn.dataset.size : "{{ $product->size }}";
        let colorBtn = document.querySelector(".variant-color-btn.active");
        let color = colorBtn ? colorBtn.dataset.color : "{{ $product->color }}";
        let quantity = document.getElementById("quantity").value;

        let data = {
            id: productId,
            size: size,
            color: color,
            quantity: quantity,
            _token: "{{ csrf_token() }}"
        };

        fetch("{{ route('cart.add') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify(data)
        }).then(response => response.json())
        .then(data => {
            if (data.success) {
                // Sau khi thêm vào giỏ hàng thành công, chuyển đến checkout
                window.location.href = "{{ route('cart.checkout') }}";
            } else {
                Swal.fire("Lỗi", data.message || "Không thể mua hàng", "error");
            }
        }).catch(error => {
            Swal.fire("Lỗi", "Đã xảy ra lỗi. Vui lòng thử lại!", "error");
        });
    });

});



    function toggleDescription() {
    const description = document.getElementById('description-html');
    const btn = document.querySelector('.btn-toggle-description');

    description.classList.toggle('expanded');
    description.classList.toggle('line-clamp');

    btn.innerText = description.classList.contains('expanded') ? 'Thu gọn' : 'Xem thêm';
    }

    </script>
@endsection