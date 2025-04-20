@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Danh sách phiếu nhập</h3>
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
                    <div class="text-tiny">Phiếu nhập</div>
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
                <a class="tf-button style-1 w208" href="{{route('admin.import.add')}}"><i
                        class="icon-plus"></i>Thêm mới</a>
            </div>
            <div class="wg-table table-all-user">
                @if(Session::has('status'))
                    <p id="alert-message" class="alert alert-success">
                        {{ Session::get('status') }}
                    </p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên người nhập</th>
                            <th>Số lô hàng</th>
                            <th>Tổng sản phẩm</th>
                            <th>Tổng tiền nhập</th>
                            <th>Ngày nhập</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- @foreach ($purchaseOrders as $purchaseOrder)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $purchaseOrder->imported_by }}</td>
                                <td>{{ $purchaseOrder->batch_code }}</td>
                                <td>{{ $purchaseOrder->total_quantity }}</td>
                                <td>{{ number_format($purchaseOrder->total_amount, 0, ',', '.') }} đ</td>
                                <td class="action">
                           
                        </tr>
                    @endforeach --}}
                    </tbody>
                </table>
            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{-- {{$contacts->links('pagination::bootstrap-5')}} --}}
            </div>
        </div>
    </div>
</div>

@endsection
@push('scripts')
<script>
        $(document).ready(function() {
        // Xử lý xóa slide
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Bạn có chắc?",
                text: "Muốn xóa tin tức này",
                type: "warning",
                buttons: ["Không", "Có"],
                confirmButtonColor: '#dc3545'
            }).then(function(result) {
                if (result) {
                    form.submit();
                }
            });
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(function() {
            var alertBox = document.getElementById('alert-message');
            if (alertBox) {
                alertBox.remove(); // Xóa thông báo sau 3 giây
            }
        }, 3000);
    });
</script>
@endpush