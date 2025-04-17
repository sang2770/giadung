@extends('layouts.app')
@section('content')

<style>
    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .625rem !important;
      background-color: #45a7e9 !important;
    }

    .table>tr>td {
      padding: 0.625rem 1.5rem .625rem !important;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #aee1f879;
    }

    .table> :not(caption)>tr>td {
      padding: .8rem 1rem !important;
    }
    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: rgb(255, 58, 58) !important;
    }

    .bg-back {
      background-color: rgb(180, 178, 178) !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }
    .image {
        max-width: 50px!important;
    }
    .title-content {
        padding: 20px 0;
    }
  </style>    

<div class="app">
    <div class="app__container">
        <div class="grid wide">
            <h1 style="text-align: center;">Chi tiết đơn hàng</h1>
            <div class="row">
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap title-content">
                        <div class="row" style="justify-content: space-between;">
                            <div class="col-6">
                                <h2>Thông tin đơn hàng</h2>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-sm bg-back" href="{{route('user.orders')}}">Trở về</a>
                            </div>
                        </div>
                    </div>
                    
                        <div class="infororder">
                            @if(Session::has('status'))
                                <p class="alert alert-success">{{Session::get('status')}}</p>
                            @endif
                            <table class="table table__infororder-details">
                                <thead>
                                    <tr>
                                        <th style="width: 40px">STT</th>
                                        <th class="text-center">Mã đơn hàng</th>
                                        <th class="text-center" style="width: 130px">Tổng tiền</th>
                                        <th class="text-center" style="width: 130px">Phí vận chuyển</th>
                                        <th class="text-center" style="width: 130px">Giảm giá</th>
                                        <th class="text-center" style="width: 130px">Tổng cộng</th>
                                        <th class="text-center" style="width: 130px">Ngày đặt</th>
                                        <th class="text-center">Hình thức thanh toán</th>
                                        <th class="text-center" style="width: 130px">Trạng thái đơn hàng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-center">{{ $orderPosition }}</td>
                                        <td class="text-center">{{$order->order_code}}</td>
                                        <td class="text-center">{{ number_format($order->subtotal, 0, ',', '.') }} đ</td>
                                        <td class="text-center">{{ number_format($order->shipping_fee, 0, ',', '.') }} đ</td>
                                        <td class="text-center">{{ number_format($order->discount, 0, ',', '.') }} đ</td>
                                        <td class="text-center">{{ number_format($order->total, 0, ',', '.') }} đ</td>
                                        <td class="text-center">{{$order->created_at}}</td>
                                        <td class="text-center">{{$transaction->mode}}</td>
                                        <td class="text-center">
                                            @if($order->status == 'confirmed')
                                                <span class="text-center">Đã xác nhận</span>
                                            @elseif($order->status == 'processing')
                                                <span class="text-center">Chuẩn bị hàng</span>
                                            @elseif($order->status == 'shipped')
                                                <span class="text-center">Đang giao</span>
                                            @elseif($order->status == 'delivered')
                                                <span class="text-center">Giao thành công</span>
                                            @elseif($order->status == 'canceled')
                                                <span class="text-center">Đơn bị hủy</span>
                                            @elseif($order->status == 'returned')
                                                <span class="text-center">Khách trả hàng</span>
                                            @else
                                                <span class="text-center">Chờ xác nhận</span>
                                            @endif
                                        </td>
                                    </tr>                  
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="wg-box">
                        <div class="row">
                            <div class="col-6">
                                <h2>Sản phẩm đã đặt</h2>
                            </div>
                        </div>
                            
                        <table class="table table__infororder-details">
                            <thead>
                                <tr>
                                    <th style="width: 140px; text-center">Hình ảnh</th>
                                    <th class="width: 200px; text-center">Tên sản phẩm</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Nhà cung cấp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)
                                <tr>
                                    <td class="pname" style="justify-items: center;">
                                        <div class="image">
                                            <img src="{{asset('uploads/products/thumbnails')}}/{{$item->product->image}}" alt="{{$item->product->name}}" class="image">
                                        </div>
                                    </td>  
                                    <td>
                                        <div class="name; text-center">
                                            <a style="text-decoration: none; color: var(--text-color);" href="{{route('shop.product.details',['product_id'=>$item->product->id])}}" target="_blank"
                                                class="body-title-2">{{$item->product->name}}</a>
                                        </div>
                                    </td>
                                    <td class="text-center" style="min-width: 100px">{{ number_format($item->price, 0, ',', '.') }} đ</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">{{$item->product->category->name}}</td>
                                    <td class="text-center">{{$item->product->producer->name}}</td>
                                </tr>
                                @endforeach                      
                            </tbody>
                        </table>
                        <div class="divider"></div>
                        <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                            {{$orderItems->links('pagination::bootstrap-5')}}
                        </div>
                    </div>
                </div>

                @if(in_array($order->status, ['pending', 'confirmed', 'processing']))
                <div class="btn-cancel-order">
                    <form action="{{route('user.order.cancel')}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="order_id" value="{{$order->id}}" />
                        <button type="button" class="btn bg-danger cancel-order">Hủy đơn hàng</button>
                    </form>
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
        $('.cancel-order').on('click', function (e) {
            e.preventDefault();
            let form = $(this).closest('form');

            Swal.fire({
                title: 'Bạn có chắc muốn hủy đơn hàng?',
                text: "Thao tác này không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Có, hủy đơn!',
                cancelButtonText: 'Không'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        // Nếu có flash message thành công từ session
        @if(session('canceled_success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session("canceled_success") }}',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                window.location.href = "{{ route('user.orders') }}";
            });
        @endif
    });
</script>
@endpush
