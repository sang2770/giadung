@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Tất cả sản phẩm</h3>
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
                    <div class="text-tiny">Tất cả sản phẩm</div>
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
                <a class="tf-button style-1 w208" href="{{route('admin.product.add')}}"><i
                        class="icon-plus"></i>Thêm mới</a>
            </div>
            <div class="table-responsive">
                @if(Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Giá nhập</th>
                            <th>Giá bán</th>
                            <th>Sale</th>
                            <th>Mã SP</th>
                            <th>Danh mục</th>
                            <th>Nhà sản xuất</th>
                            <th>Số lượng</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td>
                                <div class="name">
                                    <a href="#" class="body-title-2">{{$product->name}}</a>
                                </div>
                            </td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/products/thumbnails')}}/{{$product->image}}" alt="{{$product->name}}" class="image">
                                </div>
                            </td>
                            <td>{{ number_format($product->import_price, 0, ',', '.') }} đ</td>
                            <td>{{ number_format($product->regular_price, 0, ',', '.') }} đ</td>
                            <td>{{$product->sale}} %</td>
                            <td>{{$product->SKU}}</td>
                            <td>{{$product->category->name}}</td>
                            <td>{{$product->producer->name}}</td>
                            {{-- <td>{{$product->featured == 0 ? "No":"Yes"}}</td> --}}
                            {{-- <td>{{$product->stock_status}}</td> --}}
                            <td>{{$product->quantity}}</td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{route('admin.product.edit', ['id'=>$product->id])}}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{route('admin.product.delete', ['id'=>$product->id])}}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="item text-danger delete">
                                            <i class="icon-trash-2"></i>
                                        </div>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                {{$products->links('pagination::bootstrap-5')}} 
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        // Xử lý xóa sản phẩm
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Bạn có chắc?",
                text: "Muốn xóa sản phẩm này",
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
</script>
@endpush