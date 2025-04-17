@extends('layouts.app')
@section('content')
<style>
    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .625rem !important;
      background-color: #61b7f0 !important;
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
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }
  </style>    

<div class="app">
    <div class="app__container">
      <div class="grid wide">
            <h1 style="text-align: center">Đơn hàng</h1>
            <div class="col l-12 m-12 c-12">
                <div class="inforaction">
                    <a class="inforaction__link" href="{{route('home.index')}}">Quay lại</a>
                </div>
            </div>
            <div class="row" style="margin-top: 10px; justify-content: center;">
                <table class="table table__infororder">
                    <thead>
                        <tr>
                            <th style="width: 40px">STT</th>
                            <th class="text-center">Tên người đặt</th>
                            <th class="text-center">Số lượng sản phẩm</th>
                            <th class="text-center">Tổng tiền</th>
                            <th class="text-center">Ngày đặt</th>
                            <th class="text-center">Trạng thái</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td class="text-center">{{ $orders->count() - $loop->index }}</td> 
                            <td class="text-center">{{$order->customer_name}}</td>
                            <td class="text-center">{{ $order->orderItems->count() ?? 0 }}</td> {{-- nếu có quan hệ --}}
                            <td class="text-center">{{ number_format($order->total, 0, ',', '.') }} đ</td>
                            <td class="text-center">{{$order->created_at}}</td>
                            <td class="text-center">
                                @switch($order->status)
                                    @case('confirmed') <span class="text-center">Đã xác nhận</span> @break
                                    @case('processing') <span class="text-center">Chuẩn bị hàng</span> @break
                                    @case('shipped') <span class="text-center">Đang giao</span> @break
                                    @case('delivered') <span class="text-center">Giao thành công</span> @break
                                    @case('canceled') <span class="text-center">Đơn bị hủy</span> @break
                                    @case('returned') <span class="text-center">Khách trả hàng</span> @break
                                    @default <span class="text-center">Chờ xác nhận</span>
                                @endswitch
                            </td>
                            <td class="text-center">
                                <a href="{{route('user.order.details',['order_id'=>$order->id])}}">
                                <div class="list-icon-function view-icon">
                                    <div class="item eye">
                                        <i class="fa fa-eye"></i>
                                    </div>                                        
                                </div>
                                </a>
                            </td>
                        </tr>
                        @endforeach                      
                    </tbody>
                </table>                
            </div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">                
                {{$orders->links('pagination::bootstrap-5')}}
            </div>
      </div>
    </div>
</div>

@endsection