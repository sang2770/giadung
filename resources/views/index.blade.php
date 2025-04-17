@extends('layouts.app')
@section('content')
<div class="app">
  <div class="app__container">
    <div class="grid wide">
      {{-- Slide --}}
      <div class="slide">
        <!-- Slider chính -->
        <div class="main-slider">
          <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                  @foreach ($slides as $slide)
                    <div class="swiper-slide"><img src="{{ asset ('uploads/slides')}}/{{$slide->image}}" alt="Slide 1"></div>
                  @endforeach
            </div>
                <div class="swiper-pagination"></div>
            </div>     
        </div>
    
        <!-- Danh sách sản phẩm nhỏ bên phải -->
        <div class="slider-list">
            <div class="slider-item">
                <img src="./assets/images/banner/banner.jpg" alt="Product 1">
                
            </div>
            <div class="slider-item">
                <img src="./assets/images/banner/banner1.jpg" alt="Product 2">
                
            </div>
            <div class="slider-item">
                <img src="./assets/images/banner/slider_1.jpg" alt="Product 3">
                
            </div>
        </div>
    </div>
      {{-- End Slide --}}
      {{-- Sản phẩm mới --}}

      <div class="new-product">
        <div class="new-product__title" style="background-color: rgb(210, 237, 255); padding: 2px; border-radius: 5px; margin-bottom: 10px;">
            <h1 style="text-align: center;">Sản phẩm mới</h1>
        </div>
        <div class="home-product">
            <div class="row sm-gutter">
                @foreach($newProducts as $product)
                    @php
                        // Kiểm tra nếu sản phẩm có biến thể
                        if ($product->has_variants) {
                            $variant = $product->variants->sortBy('regular_price')->first();
                            $image = asset('uploads/products/' . $product->image);
                            $name = $product->name;
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
        
                    <div class="col l-2 m-4 c-6">
                        <div class="home-product-item">
                        <a class="home-product-item__link" href="{{ route('shop.product.details', ['product_id' => $product->id]) }}">
                            <!-- Hiển thị hình ảnh sản phẩm -->
                            <div class="home-product-item__img" style="background-image: url('{{ $image }}');"></div>
        
                            <!-- Hiển thị tên sản phẩm -->
                            <h4 class="home-product-item__name">{{ $name }}</h4>
                        </a>
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
                                <div class="home-product-item__buy add-to-cart-btn"
                                    data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-image="{{ $product->image }}"
                                    data-price="{{ $product->has_variants ? $product->variants->min('sale_price') : $product->sale_price }}"
                                    data-quantity="1">
                                    <i class="fa-solid fa-cart-shopping" style="font-size: 1rem"></i>
                                </div>
                            </div>
        
                            <!-- Hiển thị % giảm giá từ CSDL -->
                            @if($sale > 0)
                                <div class="home-product-item__sele-off">
                                    <span class="home-product-item__sele-off-percent">{{ number_format($sale, 0, ',', '.') }}%</span>
                                    <span class="home-product-item__sele-off-label">GIẢM</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="show">
                <a style="text-decoration: none;" href="{{ route('shop.index') }}" class="show-more">Xem thêm ></a>
            </div>
        </div>


        <div class="row" style="margin-bottom: 20px;">
            <div class="col l-4">
                <img src="{{asset ('assets/images/banner/img_three_banner_1.webp')}}" alt="">
            </div>
            <div class="col l-4">
                <img src="{{asset ('assets/images/banner/img_three_banner_2.webp')}}" alt="">
            </div>
            <div class="col l-4" style="margin-right: 0;">
                <img src="{{asset ('assets/images/banner/img_three_banner_3.webp')}}" alt="">
            </div>
        </div>


        <div class="new-product__title" style="background-color: rgb(210, 237, 255); padding: 2px; border-radius: 5px; margin-bottom: 10px;">
            <h1 style="text-align: center;">Sản phẩm khuyến mãi</h1>
        </div>
          <div class="home-product">
              <div class="row sm-gutter">
                  @foreach($saleProducts as $product)
                      @php
                          // Kiểm tra nếu sản phẩm có biến thể
                          if ($product->has_variants) {
                              $variant = $product->variants->sortBy('regular_price')->first();
                              $image = asset('uploads/products/' . $product->image);
                              $name = $product->name;
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
          
                      <div class="col l-2 m-4 c-6">
                          <div class="home-product-item">
                          <a class="home-product-item__link" href="{{ route('shop.product.details', ['product_id' => $product->id]) }}">
                              <!-- Hiển thị hình ảnh sản phẩm -->
                              <div class="home-product-item__img" style="background-image: url('{{ $image }}');"></div>
          
                              <!-- Hiển thị tên sản phẩm -->
                              <h4 class="home-product-item__name">{{ $name }}</h4>
                          </a>
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
                                  <div class="home-product-item__buy add-to-cart-btn"
                                      data-id="{{ $product->id }}"
                                      data-name="{{ $product->name }}"
                                      data-image="{{ $product->image }}"
                                      data-price="{{ $product->has_variants ? $product->variants->min('sale_price') : $product->sale_price }}"
                                      data-quantity="1">
                                      <i class="fa-solid fa-cart-shopping" style="font-size: 1rem"></i>
                                  </div>
                              </div>
          
                              <!-- Hiển thị % giảm giá từ CSDL -->
                              @if($sale > 0)
                                  <div class="home-product-item__sele-off">
                                      <span class="home-product-item__sele-off-percent">{{ number_format($sale, 0, ',', '.') }}%</span>
                                      <span class="home-product-item__sele-off-label">GIẢM</span>
                                  </div>
                              @endif
                          </div>
                      </div>
                  @endforeach
              </div>
              <div class="show">
                <a style="text-decoration: none;" href="{{ route('shop.index') }}" class="show-more">Xem thêm ></a>
            </div>
          </div>
    </div>
</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        var swiper = new Swiper(".mySwiper", {
            loop: true,
            autoplay: {
                delay: 5000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
        });
    });

    $(document).ready(function () {
    $(".add-to-cart-btn").off("click").on("click", function (e) {
        e.preventDefault();
        
        let productId = $(this).data("id");
        let productQuantity = $(this).data("quantity");

        $.ajax({
            url: "{{ route('cart.add') }}",
            type: "POST",
            data: {
                id: productId,
                quantity: productQuantity,
                _token: $('meta[name="csrf-token"]').attr("content")
            },
            success: function (response) {
                if (response.success) {
                    let currentCount = parseInt($(".js-cart-items-count").text());
                    $(".js-cart-items-count").text(currentCount + productQuantity);
                    
                    Swal.fire({
                        title: "Thành công!",
                        text: "Sản phẩm đã được thêm vào giỏ hàng.",
                        icon: "success",
                        confirmButtonColor: "#3085d6",
                        confirmButtonText: "OK"
                    });
                }
            },
            error: function (error) {
                console.log("Lỗi khi thêm sản phẩm vào giỏ", error);
            }
        });
    });
});





</script>
@endpush