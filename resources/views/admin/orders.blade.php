@extends('layouts.admin')
@section('content')
    
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Danh sách đơn hàng</h3>
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
                        <div class="text-tiny">Đơn hàng</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                    tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:70px">STT</th>
                                    <th class="text-center">Tên khách hàng</th>
                                    <th class="text-center">SDT</th>
                                    <th class="text-center">Tổng</th>
                                    <th class="text-center">Trạng thái</th>
                                    <th class="text-center">Ngày đặt</th>
                                    <th class="text-center">Tổng sản phẩm</th>
                                    <th class="text-center">Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orders as $order)
                                <tr>
                                    <td class="text-center">{{$order->id}}</td>
                                    <td class="text-center">{{$order->customer_name}}</td>
                                    <td class="text-center">{{$order->customer_phone}}</td>
                                    <td class="text-center">{{ number_format($order->total, 0, ',', '.') }} đ</td>
                                    <td>
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
                                            <span class="text-center">Chưa xác nhận</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{$order->created_at}}</td>
                                    <td class="text-center">{{$order->orderItems->count()}}</td>
                                    <td class="text-center">
                                        <a href="{{route('admin.order.details', ['order_id' => $order->id])}}">
                                            <div class="list-icon-function view-icon">
                                                <div class="item eye">
                                                    <i class="icon-eye"></i>
                                                </div>
                                            </div>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{$orders->links('pagination::bootstrap-5')}}
            </div>
        </div>
    </div>
</div>

@endsection