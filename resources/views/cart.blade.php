@extends('layouts.app')
@section('content')
<style>
  .quantity-selector__cart {
    display: flex;
    align-items: center;
    /* gap: 5px; */
}

.quantity-selector-item {
    font-size: 1.8rem;
    border: none;
    background-color: #f5f5f5;
}

.quantity-selector-item:hover {
    cursor: pointer;
}

.quantity-input {
    width: 60px;
    height: 30px;
    text-align: center;
    /* border: 1px solid #f5f5f5; */
    background: #f5f5f5;
    outline: none;
}
</style>
  <div class="app">
    <div class="app__container">
        <div class="grid wide">
          <div class="cart-main">
            <nav style="font-size: 1.6rem; padding-top: 20px">
              <span>
                  <a class="link-page" href="{{ url('/') }}">Trang chủ</a> > 
                  <span style="color: rgb(247, 143, 75)">Giỏ hàng</span>
              </span>
            </nav>
            @if ($items->count() > 0)
              <div class="row sm-gutter app__content">
                <div class="col l-9 m-0 c-0">
                  <h2 style="margin: 0; text-align: center; font-size: 2rem; padding-bottom: 10px">Giỏ hàng của bạn</h2>
                    <table class="cart-table">
                      <thead class="cart-table__head">
                        <tr>
                          <th>Ảnh</th>
                          <th>Tên sản phẩm</th>
                          <th>Giá</th>
                          <th>Số lượng</th>
                          <th>Tổng</th>
                          <th></th>
                        </tr>
                      <tbody class="cart-table__body">
                        @foreach($items as $item)
                          <tr>
                            <td>
                              <a href="{{ route('shop.product.details', ['product_id' => $item->model->id]) }}">
                                  <img class="cart-table__img" 
                                       src="{{ asset('uploads/products/' . $item->model->image) }}" 
                                       alt="{{ $item->name }}">
                              </a>
                          </td>
                            <td>
                              <div class="cart-product-info">
                                <a class="cart-product-info__name" href="{{ route('shop.product.details', ['product_id' => $item->model->id]) }}">
                                  <span><strong>{{$item->name}}</strong></span>
                                </a>
                                <div class="cart-product-variants">
                                  @if($item->options->size) <!-- Kiểm tra nếu có size -->
                                      <span>Size: {{ $item->options->size }}</span> | 
                                  @endif
                                  @if($item->options->color) <!-- Kiểm tra nếu có màu -->
                                      <span>Màu: {{ $item->options->color }}</span>
                                  @endif
                              </div>
                              </div>
                            </td>
                            <td>{{ number_format($item->price, 0, ',', '.') }}đ</td>
                            <td>
                              <button class="decrease-qty" data-rowid="{{ $item->rowId }}">-</button>
                              <span class="item-qty">{{ $item->qty }}</span>
                              <button class="increase-qty" data-rowid="{{ $item->rowId }}">+</button>
                            </td>
                            <td class="total-price">{{ number_format($item->price * $item->qty, 0, ',', '.') }}đ</td>
                            <td>
                              <form method="POST" action="{{route('cart.item.remove',['rowId'=>$item->rowId])}}">
                                @csrf
                                @method('DELETE')
                                  <a href="javascript:void(0)" class="remove-cart">
                                    <svg width="10" height="10" viewBox="0 0 10 10" fill="#767676" xmlns="http://www.w3.org/2000/svg">
                                      <path d="M0.259435 8.85506L9.11449 0L10 0.885506L1.14494 9.74056L0.259435 8.85506Z" />
                                      <path d="M0.885506 0.0889838L9.74057 8.94404L8.85506 9.82955L0 0.97449L0.885506 0.0889838Z" />
                                    </svg>
                                  </a>
                              </form>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>

                    @if ($items->count() > 1) 
                        <form id="empty-cart-form" action="{{ route('cart.empty') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit">Xóa hết</button>
                        </form>
                    @endif
                </div>


                <div class="col l-3 m-0 c-0">
                  <div class="cart-information">
                    <h3 class="cart-information__title">Thông tin đơn hàng</h3>
                      <div class="cart-information__items">
                        <span class="cart-information__price"><strong>Tổng tiền: </strong><span class="cart-total-price"></span></span>
                        <p class="cart-information__item">Phí vận chuyển sẽ được tính ở trang thanh toán.</p>
                        <p class="cart-information__item">Bạn cũng có thể nhập mã giảm giá ở trang thanh toán.</p>
                      </div>
                      <div class="cart-information__action">
                        <a href="{{route ('shop.index')}}"><button class="btn btn-top">Tiếp tục mua hàng</button></a>
                        <a href="{{route('cart.checkout')}}"><button class="btn btn-bottom">Thanh toán</button></a>
                      </div>
                  </div>
                </div>
              </div>
            @else
            <div style="text-align: center; margin-top: 50px">
              <img src="https://bizweb.dktcdn.net/100/479/509/themes/897806/assets/no-cart.png?1677998172667" alt="">
              <h2>Không có sản phẩm nào trong giỏ hàng !</h2>
              <a href="{{ route('home.index') }}">
                  <button class="btn btn--disabled">Mua ngay</button>
              </a>
            </div>
            @endif
          </div>
        </div>
    </div>
  </div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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


    function updateCartCount(count) {
        $(".js-cart-items-count").text(count);
    }

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


    updateTotalPrice(); // Cập nhật tổng tiền ngay khi trang tải
});


</script>
@endpush