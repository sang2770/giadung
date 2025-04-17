@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Chỉnh sửa Tin tức</h3>
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
                    <a href="{{route('admin.contents')}}">
                        <div class="text-tiny">Danh sách Tin tức</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Chỉnh sửa Tin tức</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.content.update')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" name="id" value="{{$content->id}}" />
                <fieldset class="name">
                    <div class="body-title">Title <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Nhập title" name="title" tabindex="0" value="{{ $content->title}}" aria-required="true" required="">
                </fieldset>
                @error('title') <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Introtext <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Nhập introtext" name="introtext" tabindex="0" value="{{ $content->introtext}}" aria-required="true" required="">
                </fieldset>
                @error('introtext') <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset class="name">
                    <div class="body-title">Fulltext <span class="tf-color-1">*</span></div>
                    <textarea class="flex-grow" id="editor" name="fulltext" placeholder="Nhập fulltext" required>{{ old('fulltext', $content->fulltext) }}</textarea>

                </fieldset>
                @error('fulltext') <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset>
                    <div class="body-title">Hình ảnh <span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        @if($content->image)
                        <div class="item" id="imgpreview">
                            <img src="{{asset('uploads/contents')}}/{{$content->image}}" class="effect8" alt=""/>
                        </div>
                        @endif
                        <div class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Tải hình ảnh lên</span>
                                <input type="file" id="myFile" name="image">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('image') <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <fieldset class="category">
                    <div class="body-title">Status</div>
                    <div class="select flex-grow">
                        <select class="" name="status">
                            <option>Select</option>
                            <option value="1" @if($content->status=="1") selected @endif>Active</option>
                            <option value="0" @if($content->status=="0") selected @endif>Inactive</option>
                        </select>
                    </div>
                </fieldset>
                @error('status') <span class="alert alert-danger text-center">{{$message}}</span> @enderror

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Cập nhật</button>
                </div>
            </form>
        </div>
        <!-- /new-category -->
    </div>
    <!-- /main-content-wrap -->
</div>

@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor');
</script>
    <script>
        $(function(){
            $("#myFile").on("change",function(e){
                const photoInp = $("#myFile");
                const [file] = this.files;
                if(file){
                    $("#imgpreview img").attr('src',URL.createObjectURL(file));
                    $("#imgpreview").show();
                }
            });

        });

    
    </script>
@endpush