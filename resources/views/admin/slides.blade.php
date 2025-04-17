@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Danh sách Slides</h3>
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
                    <div class="text-tiny">Slides</div>
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
                <a class="tf-button style-1 w208" href="{{route('admin.slide.add')}}"><i
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
                            <th>Hình ảnh</th>
                            <th>Tagline</th>
                            <th>Title</th>
                            <th>Link</th>
                            <th>Trạng thái</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($slides as $slide)
                        <tr>
                            <td>{{$slide->id}}</td>
                            <td class="pname">
                                <div class="image">
                                    <img src="{{asset('uploads/slides')}}/{{$slide->image}}" alt="" class="{{$slide->title}}">
                                </div>
                            </td>
                            <td>{{$slide->tagline}}</td>
                            <td>{{$slide->title}}</td>
                            <td>{{$slide->link}}</td>
                            <td>
                                <span class="badge {{ $slide->status == 1 ? 'bg-success' : 'bg-danger' }}">
                                    {{ $slide->status == 1 ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <div class="list-icon-function">
                                    <a href="{{route('admin.slide.edit',['id'=>$slide->id])}}">
                                        <div class="item edit">
                                            <i class="icon-edit-3"></i>
                                        </div>
                                    </a>
                                    <form action="{{route('admin.slide.delete',['id'=>$slide->id])}}" method="POST">
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
                    {{$slides->links('pagination::bootstrap-5')}}
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
                text: "Muốn xóa slide này",
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