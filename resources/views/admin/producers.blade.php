@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Nhà cung cấp</h3>
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
                    <div class="text-tiny">Nhà cung cấp</div>
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
                <a class="tf-button style-1 w208" href="{{route('admin.producer.add')}}"><i
                        class="icon-plus"></i>Thêm mới</a>
            </div>
            <div class="wg-table table-all-user">
                <div class="table-responsive">
                    @if(Session::has('status'))
                        <p class="alert alert-success">{{Session::get('status')}}</p>
                    @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>STT</th>
                                <th>Tên nhà cung cấp</th>
                                <th>Hình ảnh</th>
                                <th>Slug</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($producers as $producer)
                            <tr>
                                <td>{{$producer->id}}</td>
                                <td>    
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{$producer->name}}</a>
                                    </div>
                                </td>
                                <td class="pname">
                                    <div class="image">
                                        <img src="{{asset('uploads/producers')}}/{{$producer->image}}" alt="{{$producer->name}}" class="image">
                                    </div>
                                </td>
                                <td>{{$producer->slug}}</td>
                                {{-- <td><a href="#" target="_blank">0</a></td> --}}
                                <td>
                                    <a href="javascript:void(0);" class="toggle-status" data-id="{{$producer->id}}" data-status="{{$producer->status}}">
                                        @if($producer->status == 'đang hợp tác')
                                            <i class="fa-solid fa-check text-success"></i>
                                        @else
                                            <i class="fa-solid fa-xmark text-danger"></i>
                                        @endif
                                    </a>
                                </td>
                                
                                
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{route('admin.producer.edit', ['id' => $producer->id])}}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{route('admin.producer.delete',['id' => $producer->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
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
                    {{ $producers->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
<script>
    $(document).ready(function() {
        $(".toggle-status").click(function() {
            let producerId = $(this).data("id");
            let currentStatus = $(this).data("status");
            let newStatus = (currentStatus === "đang hợp tác") ? "ngừng hợp tác" : "đang hợp tác";
            let iconElement = $(this).find("i");

            $.ajax({
                url: "{{ route('admin.producer.toggle_status') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: producerId,
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        // Cập nhật data-status
                        iconElement.parent().data("status", newStatus);
                        // Đổi icon
                        if (newStatus === "đang hợp tác") {
                            iconElement.removeClass("fa-xmark text-danger").addClass("fa-check text-success");
                        } else {
                            iconElement.removeClass("fa-check text-success").addClass("fa-xmark text-danger");
                        }
                    }
                }
            });
        });

        // Xử lý xóa nhà cung cấp
        $('.delete').on('click', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Bạn có chắc?",
                text: "Muốn xóa nhà cung cấp này",
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

@endsection
