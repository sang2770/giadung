@extends('layouts.app')
@section('content')

<div class="app">
    <div class="app__container">
        <div class="grid wide">
          <div class="checkout-main">
            <div class="row sm-gutter app__content">
              <div class="col l-4 m-0 c-0">
                <div class="customer-info">
                  <h2>Thông tin nhận hàng</h2>
                  <input type="text" name="customer_name" placeholder="Họ và tên">
                  <input type="email" name="customer_email" placeholder="Email">
                  <input type="text" name="customer_phone" placeholder="Số điện thoại">
                  <select id="province" name="province">
                    <option value="">Chọn tỉnh/thành phố</option>
                  </select>
                  
                  <select id="district" name="district">
                      <option value="">Chọn quận/huyện</option>
                  </select>
                
                  <textarea name="address" placeholder="Địa chỉ cụ thể"></textarea>
                </div>
              </div>

              <div class="col l-3 m-0 c-0">
                <div class="shipping-payment">
                  <h2>Phương thức thanh toán</h2>
                  <label class="payment-option">
                      <input type="radio" name="payment_method" value="cod" required>
                      Thanh toán khi nhận hàng (COD)
                      <i class="fa-solid fa-money-bill payment-icon"></i>
                  </label>
                  <label class="payment-option">
                      <input type="radio" name="payment_method" value="bank_transfer" required>
                      Thanh toán online
                      <i class="fa-solid fa-money-check-dollar payment-icon"></i>
                  </label>
                </div>
              </div>

              <div class="col l-5 m-0 c-0">
                <div class="order-summary">
                  <h2>Đơn hàng ({{ $cartItems->count() }} sản phẩm)</h2>
                    @php
                        $subtotal = 0; // Tổng tiền sản phẩm
                        $discount = session('discount', 0); // Lấy giảm giá từ session, mặc định 0
                        $freeShippingProvinces = ['Sóc Trăng', 'Cần Thơ', 'Bạc Liêu', 'Cà Mau', 'Hậu Giang']; // Danh sách tỉnh miễn phí ship
                        $shippingAddress = request()->province ?? session('shipping_address', '');
                        $shippingFee = in_array($shippingAddress, $freeShippingProvinces) ? 0 : 40000; // Xác định phí ship
                    @endphp
                  @foreach($cartItems as $item)
                    @php
                        $itemTotal = $item->price * $item->qty;
                        $subtotal += $itemTotal;
                    @endphp
                  <div class="order-item">
                    <input type="hidden" class="product-id" value="{{ $item->id }}">
                      <div>
                        <img src="{{ asset('uploads/products/' . $item->options->image) }}" alt="{{ $item->name }}">
                          <div class="product-info">
                            <span>{{ $item->name }}</span>
                            <span>Size: {{ $item->options->size }}</span>
                            <span>Màu: {{ $item->options->color }}</span>
                        </div>
                      </div>
                      <span>{{ number_format($item->price, 0, ',', '.') }}đ x {{ $item->qty }}</span>
                  </div>
                  @endforeach
                  {{-- <div class="coupon-container">
                    <input type="text" class="coupon-input" placeholder="Nhập mã giảm giá">
                    <button class="apply-btn">Áp dụng</button>
                    </div> --}}

                    @if(!Session::has('coupon'))
                        <form action="{{route('cart.coupon.apply')}}" method="POST" class="position-relative bg-body">
                            <div class="coupon-container">
                        @csrf
                            <input class="coupon-input" type="text" name="coupon_code" placeholder="Mã giảm giá" value="">
                            <input class="btn-link apply-btn" type="submit" value="APPLY COUPON">
                            </div>
                        </form>
                    @else
                    <form action="{{route('cart.coupon.remove')}}" method="POST" class="position-relative bg-body">
                    @csrf
                    @method('DELETE')
                        <div class="coupon-container">
                            <input class="coupon-input" type="text" name="coupon_code" placeholder="Coupon Code" value="@if(Session::has('coupon')) {{Session::get('coupon')['code']}} @endif">
                            <input class="btn-link apply-btn" type="submit" value="REMOVE COUPON">
                        </div>
                    </form>
                    @endif

                  @if(Session::has('discounts'))
                  <p class="checkout-subtotal">
                    Tạm tính: <strong>{{ number_format($subtotal, 0, ',', '.') }}đ</strong>
                  </p>
                  <p class="checkout-subtotal">
                    Phí vận chuyển: <strong>{{ $shippingFee == 0 ? 'Miễn phí' : number_format($shippingFee, 0, ',', '.') . 'đ' }}</strong>
                  </p>

                    <div class="discount-container">
                        <p class="checkout-subtotal">
                            Giảm giá: <strong class="discount-amount">-{{ number_format(Session::get('discounts')['discount'], 0, ',', '.') }} đ</strong>
                        </p>
                    </div>
                 
                    <p class="checkout-subtotal">
                        Tổng cộng: 
                        <strong>
                            {{ number_format($subtotal + $shippingFee - (Session::get('discounts')['discount'] ?? 0), 0, ',', '.') }} đ
                        </strong>
                    </p>
                    
                  <div class="checkout-action">
                    <a class="link-page" href="{{ route ('cart.index') }}">< Quay lại trang giỏ hàng</a>
                    <button class="btn-order" id="btn-order">ĐẶT HÀNG</button>
                  </div>
                  @else
                  <p class="checkout-subtotal">
                    Tạm tính: <strong>{{ number_format($subtotal, 0, ',', '.') }}đ</strong>
                  </p>
                  <p class="checkout-subtotal">
                    Phí vận chuyển: <strong>{{ $shippingFee == 0 ? 'Miễn phí' : number_format($shippingFee, 0, ',', '.') . 'đ' }}</strong>
                  </p>
                    <p class="checkout-subtotal">
                        Tổng cộng: <strong>{{ number_format($subtotal + $shippingFee ) }}đ</strong>
                    </p>
                  <div class="checkout-action">
                    <a class="link-page" href="{{ route ('cart.index') }}">< Quay lại trang giỏ hàng</a>
                    <button class="btn-order" id="btn-order">ĐẶT HÀNG</button>
                  </div>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
    $(".increase-qty, .decrease-qty").on("click", function () {
    let button = $(this);
    let rowId = button.data("rowid");
    let action = button.hasClass("increase-qty") ? "increase" : "decrease";
    let quantityElement = button.siblings(".item-qty");
    let totalPriceElement = button.closest("tr").find(".total-price");

    $.ajax({
        url: `/cart/${action}-quantity/${rowId}`,
        type: "PUT",
        data: {
            _token: $('meta[name="csrf-token"]').attr("content")
        },
        success: function (response) {
            if (response.success) {
                quantityElement.text(response.newQuantity);

                // Cập nhật tổng giá từng sản phẩm
                let newTotalPrice = response.newQuantity * response.price;
                totalPriceElement.text(newTotalPrice.toLocaleString("vi-VN") + "đ");

                updateTotalPrice(); // Cập nhật tổng tiền cả giỏ hàng
            }
        },
        error: function (error) {
            console.log("Lỗi khi cập nhật số lượng", error);
        }
      });
    });

// Cập nhật số lượng trên giỏ hàng
    function updateCartCount(count) {
        $(".js-cart-items-count").text(count);
    }
// Xóa sản phẩm trong giỏ hàng
    $(document).off("click", ".remove-cart").on("click", ".remove-cart", function () {
    let button = $(this);
    let rowId = button.closest("tr").find(".increase-qty").data("rowid");
    let row = button.closest("tr");

    Swal.fire({
        title: "Bạn có chắc?",
        text: "Muốn xóa sản phẩm này",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#6c757d",
        confirmButtonText: "Có",
        cancelButtonText: "Không"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `/cart/remove/${rowId}`,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content")
                },
                success: function (response) {
                    if (response.success) {
                        row.fadeOut(300, function () {
                            $(this).remove();
                            updateTotalPrice();

                            // Kiểm tra nếu không còn sản phẩm nào, reload trang
                            if ($(".cart-table__body tr").length === 0) {
                                location.reload();
                            }
                        });

                        Swal.fire({
                            title: "Đã xóa!",
                            text: "Sản phẩm đã được xóa khỏi giỏ hàng.",
                            icon: "success",
                            timer: 2000,
                            showConfirmButton: false
                        });
                    }
                },
                error: function (error) {
                    console.log("Lỗi khi xóa sản phẩm", error);
                }
            });
        }
    });
});

// Cập nhật giá tổng
    function updateTotalPrice() {
    let total = 0;
        $(".total-price").each(function () {
            let priceText = $(this).text().replace("đ", "").replace(/\./g, "").trim();
            let price = parseInt(priceText);
            if (!isNaN(price)) {
                total += price;
            }
        });

        $(".cart-total-price").text(total.toLocaleString("vi-VN") + "đ");
    }
        updateTotalPrice();
    });


    // Click đặt hàng
    $(document).ready(function () {
        $("#btn-order").on("click", function () {
            let cartItems = [];

            $(".order-item").each(function () {
                let item = {
                    product_id: $(this).find(".product-id").val(), // Lấy ID từ input hidden
                    product_name: $(this).find(".product-info span:first").text(), // Lấy tên sản phẩm
                    price: parseInt($(this).find("span:last").text().replace("đ", "").replace(/\./g, "").trim()), // Lấy giá
                    quantity: parseInt($(this).find("span:last").text().split("x")[1].trim()), // Lấy số lượng
                    size: $(this).find(".product-info span:eq(1)").text().replace("Size: ", ""), // Lấy size
                    color: $(this).find(".product-info span:eq(2)").text().replace("Màu: ", "") // Lấy màu
                };
                cartItems.push(item);
            });

            // Lấy thông tin phí vận chuyển, giảm giá, tổng cộng từ giao diện
            let subtotal = parseInt($(".checkout-subtotal strong:first").text().replace("đ", "").replace(/\./g, "").trim()) || 0;
            let shippingFee = $(".checkout-subtotal strong:eq(1)").text().includes("Miễn phí") ? 0 : parseInt($(".checkout-subtotal strong:eq(1)").text().replace("đ", "").replace(/\./g, "").trim()) || 0;
            let discount = $(".discount-amount").length ? parseInt($(".discount-amount").text().replace("-", "").replace("đ", "").replace(/\./g, "").trim()) || 0 : 0;
            let total = parseInt($(".checkout-subtotal strong:last").text().replace("đ", "").replace(/\./g, "").trim()) || 0;

            let orderData = {
                _token: $('meta[name="csrf-token"]').attr("content"),
                customer_name: $("input[name='customer_name']").val(),
                customer_email: $("input[name='customer_email']").val(),
                customer_phone: $("input[name='customer_phone']").val(),
                province: $("select[name='province']").val(),
                district: $("select[name='district']").val(),
                address: $("textarea[name='address']").val(),
                payment_method: $("input[name='payment_method']:checked").val(),
                cart_items: cartItems, // Danh sách sản phẩm
                subtotal: subtotal,
                shipping_fee: shippingFee,
                discount: discount,
                total: total
            };

            $.ajax({
                url: "/checkout",
                type: "POST",
                contentType: "application/json",
                data: JSON.stringify(orderData),
                success: function (response) {
                    Swal.fire({
                        title: "Thành công!",
                        text: "Đơn hàng của bạn đã được đặt.",
                        icon: "success"
                    }).then(() => {
                        window.location.href = "/gio-hang";
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Vui lòng kiểm tra lại thông tin đặt hàng.",
                        icon: "error"
                    });
                }
            });
        });
    });



    $(document).ready(function () {
        // Load tỉnh/thành phố khi trang tải
        $.get('/get-provinces', function (data) {
            data.forEach(function (province) {
                $('#province').append(`<option value="${province.id}">${province.name}</option>`);
            });
        });

        // Khi chọn tỉnh/thành phố, load quận/huyện
        $('#province').change(function () {
            let provinceId = $(this).val();
            $('#district').html('<option value="">Chọn quận/huyện</option>');

            if (provinceId) {
                $.get(`/get-districts/${provinceId}`, function (data) {
                    data.forEach(function (district) {
                        $('#district').append(`<option value="${district.id}">${district.name}</option>`);
                    });
                });
            }
        });
    });

    $(document).ready(function () {
        // Danh sách tỉnh được miễn phí ship
        let freeShippingProvinces = ['Sóc Trăng', 'Cần Thơ', 'Bạc Liêu', 'Cà Mau', 'Hậu Giang'];

        // Mặc định hiển thị phí vận chuyển là "-"
        $(".checkout-subtotal strong:eq(1)").text("-");

        // Khi chọn tỉnh/thành phố, kiểm tra phí ship
        $('#province').change(function () {
            let selectedProvince = $("#province option:selected").text().trim(); // Lấy tên tỉnh
            let shippingFee = selectedProvince && freeShippingProvinces.includes(selectedProvince) ? 0 : (selectedProvince ? 40000 : null); // Xác định phí ship

            // Cập nhật giao diện phí vận chuyển
            let shippingText = shippingFee === null ? "-" : (shippingFee === 0 ? 'Miễn phí' : shippingFee.toLocaleString('vi-VN') + 'đ');
            $(".checkout-subtotal strong:eq(1)").text(shippingText);

            // Cập nhật tổng cộng nếu đã chọn tỉnh
            if (shippingFee !== null) {
                let subtotal = parseInt($(".checkout-subtotal strong:first").text().replace("đ", "").replace(/\./g, "").trim()) || 0;
                let discount = $(".discount-amount").length ? parseInt($(".discount-amount").text().replace("-", "").replace("đ", "").replace(/\./g, "").trim()) || 0 : 0;
                let total = subtotal + shippingFee - discount;
                $(".checkout-subtotal strong:last").text(total.toLocaleString('vi-VN') + 'đ');
            } else {
                $(".checkout-subtotal strong:last").text("-");
            }
        });
    });


</script>
@endpush