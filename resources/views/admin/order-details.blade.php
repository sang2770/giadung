@extends('layouts.admin')
@section('content')
    
<style>
    .table-transaction>tbody>tr:nth-of-type(odd) {
        --bs-table-accent-bg: #fff !important;
    }
</style>
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Chi tiết đơn hàng</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Thống kê</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Chi tiết đơn hàng</div>
                </li>
            </ul>
        </div>


        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Thông tin đơn hàng</h5>
                </div>
                <a class="tf-button style-1 w208" href="{{route('admin.orders')}}">Trở về</a>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>STT</th>
                        <td>{{$order->id}}</td>
                        <th>Hình thức thanh toán</th>
                        <td>{{$transaction->mode}}</td>
                        <th>Zip Code</th>
                        <td>{{$order->zip}}</td>
                    </tr>
                    <tr>
                        <th>Ngày đặt đơn</th>
                        <td>{{$order->created_at}}</td>
                        <th>Ngày giao đơn</th>
                        <td>{{$order->delivered_date}}</td>
                        <th>Ngày hủy đơn</th>
                        <td>{{$order->canceled_date}}</td>
                    </tr>
                    <tr>
                        <th>Trạng thái đơn hàng</th>

                        <td>
                            <select class="form-select update-order-status" data-order-id="{{ $order->id }}">
                                <option value="pending"    {{ $order->status == 'pending'    ? 'selected' : '' }}>Chưa xác nhận</option>
                                <option value="confirmed"  {{ $order->status == 'confirmed'  ? 'selected' : '' }}>Đã xác nhận</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Chuẩn bị hàng</option>
                                <option value="shipped"    {{ $order->status == 'shipped'    ? 'selected' : '' }}>Đang giao</option>
                                <option value="delivered"  {{ $order->status == 'delivered'  ? 'selected' : '' }}>Giao thành công</option>
                                <option value="canceled"   {{ $order->status == 'canceled'   ? 'selected' : '' }}>Hủy đơn</option>
                                <option value="returned"   {{ $order->status == 'returned'   ? 'selected' : '' }}>Khách trả hàng</option>
                            </select>
                        </td>

                        <th>Tổng tiền</th>
                        <td>{{ number_format($order->subtotal, 0, ',', '.') }} đ</td>
                        <th>Phí vận chuyển</th>
                        <td>{{ number_format($order->shipping_fee, 0, ',', '.') }} đ</td>
                    </tr>
                    <tr>
                        <th>Giảm giá</th>
                        <td>{{ number_format($order->discount, 0, ',', '.') }} đ</td>
                        <th>Tổng</th>
                        <td>{{ number_format($order->total, 0, ',', '.') }} đ</td>
                    </tr>                
                </table>
            </div>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <h5>Sản phẩm đã đặt</h5>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th class="text-center">Hình ảnh</th>
                            <th class="text-center">Tên</th>
                            <th class="text-center">Giá</th>
                            <th class="text-center">Số lượng</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Danh mục</th>
                            <th class="text-center">Nhà cung cấp</th>
                            <th class="text-center">Options</th>
                            <th class="text-center">Return Status</th>
                            <th class="text-center">Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orderItems as $item)
                        <tr>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/products/thumbnails')}}/{{$item->product->image}}" alt="{{$item->product->name}}" class="image">
                                </div>
                            </td>
                            <td>
                                <div class="name">
                                    <a href="{{route('shop.product.details',['product_id'=>$item->product->id])}}" target="_blank"
                                        class="body-title-2">{{$item->product->name}}</a>
                                </div>
                            </td>
                            <td class="text-center">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                            <td class="text-center">{{$item->quantity}}</td>
                            <td class="text-center">{{$item->product->SKU}}</td>
                            <td class="text-center">{{$item->product->category->name}}</td>
                            <td class="text-center">{{$item->product->producer->name}}</td>
                            <td class="text-center">{{$item->options}}</td>
                            <td class="text-center">{{$item->rstatus == 0 ? "No":"Yes"}}</td>
                            <td class="text-center">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="icon-eye"></i>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{$orderItems->links('pagination::bootstrap-5')}}
            </div>
        </div>

        <div class="wg-box mt-5">
            <h5>Thông tin người nhận</h5>
            <div class="my-account__address-item col-md-6">
                <div class="my-account__address-item__detail">
                    <p>{{$order->customer_name}}</p>
                    <p>{{ $order->address }}, {{ $order->districtInfo->name ?? '---' }}, {{ $order->provinceInfo->name ?? '---' }}</p>        
                    <p>Số điện thoại : {{$order->customer_phone}}</p>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        $(".update-order-status").change(function () {
            console.log("Đã chạy sự kiện .change()"); // Kiểm tra xem có vào đây không
            
            let orderId   = $(this).data("order-id");
            let newStatus = $(this).val();
            console.log("Trạng thái gửi lên:", newStatus); // THÊM VÀO ĐÂY

            $.ajax({
                url: "{{ route('admin.order.status.update') }}", 
                type: "PUT",
                data: {
                    order_id: orderId,
                    order_status: newStatus,
                    _token: "{{ csrf_token() }}"
                },
                success: function (response) {
                    console.log("AJAX success", response); 
                    Swal.fire("Thành công!", "Cập nhật trạng thái đơn hàng thành công!", "success");
                },
                error: function (error) {
                    console.log("AJAX error", error);
                    Swal.fire("Lỗi!", "Không thể cập nhật trạng thái!", "error");
                }
            });
        });
    });
</script>


@endsection