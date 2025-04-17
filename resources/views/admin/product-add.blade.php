@extends('layouts.admin')
@section('content')

<div class="main-content-inner">
    <!-- main-content-wrap -->
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thêm sản phẩm</h3>
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
                    <a href="{{route('admin.products')}}">
                        <div class="text-tiny">Sản phẩm</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm sản phẩm</div>
                </li>
            </ul>
        </div>
        <!-- form-add-product -->
        <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data" action="{{route('admin.product.store')}}">
            @csrf
            <div class="wg-box">
                <fieldset class="name">
                    <div class="body-title mb-10">Tên sản phẩm <span class="tf-color-1">*</span>
                    </div>
                    <input class="mb-10" type="text" placeholder="Nhập tên sản phẩm" name="name" tabindex="0" value="{{old('name')}}" aria-required="true" required="">
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}} @enderror

                <div class="gap22 cols">
                    <fieldset class="category">
                        <div class="body-title mb-10">Danh mục <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="category_id">
                                <option>Chọn danh mục</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    @error('category_id') <span class="alert alert-danger text-center">{{$message}} @enderror


                    <fieldset class="brand">
                        <div class="body-title mb-10">Nhà sản xuất <span class="tf-color-1">*</span>
                        </div>
                        <div class="select">
                            <select class="" name="producer_id">
                                <option>Chọn nhà sản xuất</option>
                                @foreach($producers as $producer)
                                <option value="{{$producer->id}}">{{$producer->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </fieldset>
                    @error('producer_id') <span class="alert alert-danger text-center">{{$message}} @enderror

                </div>

                <fieldset class="shortdescription">
                    <div class="body-title mb-10">Mô tả ngắn</div>
                    <textarea class="mb-10 ht-150" name="short_description" placeholder="Mô tả ngắn về sản phẩm" tabindex="0">{{ old('short_description') }}</textarea>
                </fieldset>
                @error('short_description') <span class="alert alert-danger text-center">{{$message}} @enderror

                <fieldset class="description">
                    <div class="body-title mb-10">Mô tả <span class="tf-color-1">*</span></div>
                    <textarea class="mb-10" id="editor" name="description" placeholder="Mô tả sản phẩm" tabindex="0" required>{{ old('description') }}</textarea>
                </fieldset>
                @error('description')<span class="alert alert-danger text-center">{{ $message }}</span> @enderror

                <fieldset>
                    <div class="body-title">Ảnh chính<span class="tf-color-1">*</span>
                    </div>
                    <div class="upload-image flex-grow">
                        <div class="item" id="imgpreview" style="display:none">
                            <img src="../../../localhost_8000/images/upload/upload-1.png" class="effect8" alt="">
                        </div>
                        <div id="upload-file" class="item up-load">
                            <label class="uploadfile" for="myFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                <input type="file" id="myFile" name="image" accept="image/*">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('image') <span class="alert alert-danger text-center">{{$message}} @enderror

            </div>
            <div class="wg-box">
                
                <fieldset>
                    <div class="body-title mb-10">Ảnh phụ</div>
                    <div class="upload-image mb-16">
                        <div id="galUpload" class="item up-load">
                            <label class="uploadfile" for="gFile">
                                <span class="icon">
                                    <i class="icon-upload-cloud"></i>
                                </span>
                                <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                <input type="file" id="gFile" name="images[]" accept="image/*" multiple="">
                            </label>
                        </div>
                    </div>
                </fieldset>
                @error('images') <span class="alert alert-danger text-center">{{$message}} @enderror

            {{-- FORM ĐANG SỬA --}}
            <div class="variant-row">
                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Mã sản phẩm <span class="tf-color-1">*</span></div>
                        <input class="mb-10" type="text" placeholder="Nhập mã sản phẩm" name="SKU" value="{{ old('SKU') }}" required>
                    </fieldset>
                    @error('SKU') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
            
                    <fieldset class="name">
                        <div class="body-title mb-10">Sản phẩm có biến thể?</div>
                        <input type="hidden" name="has_variants" value="0">
                        <input type="checkbox" id="has_variants" name="has_variants" value="1">
                    </fieldset>
                </div>
            
                <!-- Nếu không có biến thể -->
                <div id="no-variant-fields">
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Màu sắc <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" name="color" placeholder="Nhập màu sắc" value="{{ old('color') }}">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Kích thước <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" name="size" placeholder="Nhập kích thước" value="{{ old('size') }}">
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Số lượng <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="number" name="quantity" placeholder="Nhập số lượng" value="{{ old('quantity') }}" required>
                        </fieldset>                        
                    </div>
                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Giá nhập <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="number" name="import_price" placeholder="Nhập giá nhập" value="{{ old('import_price') }}" required>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Giá bán <span class="tf-color-1">*</span></div>
                            <input class="mb-10" type="number" name="regular_price" placeholder="Nhập giá bán" value="{{ old('regular_price') }}" required>
                        </fieldset>
                        <fieldset class="name">
                            <div class="body-title mb-10">Giảm giá (%)</div>
                            <input class="mb-10" type="number" name="sale" placeholder="Nhập % giảm giá" value="{{ old('sale') }}">
                        </fieldset>
                    </div>
                </div>
            
                <!-- Nếu có biến thể -->
                <div id="variant-fields" style="display: none;">
                    <div id="variant-container">
                        <div class="variant-row">
                            <input type="text" name="sizes[]" placeholder="Kích thước (VD: 16cm, 30x40cm)">
                            <input type="text" name="colors[]" placeholder="Màu sắc (VD: Đỏ, Xanh)">
                            <input type="number" name="quantities[]" placeholder="Số lượng">
                            <input type="number" name="import_prices[]" placeholder="Giá nhập">
                            <input type="number" name="regular_prices[]" placeholder="Giá bán">
                            <input type="number" name="sales[]" placeholder="% Giảm giá">
                            <button type="button" class="btn btn-danger remove-variant">X</button>
                        </div>
                    </div>
                    <button type="button" class="btn btn-success add-variant">Thêm biến thể</button>
                </div>
            </div>
            

                <div class="cols gap22">
                    <fieldset class="name">
                        <div class="body-title mb-10">Trạng thái</div>
                        <div class="select mb-10">
                            <select class="" name="stock_status">
                                <option value="instock">Còn hàng</option>
                                <option value="outofstock">Hết hàng</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('stock_status') <span class="alert alert-danger text-center">{{$message}} @enderror

                    <fieldset class="name">
                        <div class="body-title mb-10">Nổi bật</div>
                        <div class="select mb-10">
                            <select class="" name="featured">
                                <option value="0">Không</option>
                                <option value="1">Có</option>
                            </select>
                        </div>
                    </fieldset>
                    @error('featured') <span class="alert alert-danger text-center">{{$message}} @enderror

                </div>
                <div class="cols gap10">
                    <button class="tf-button w-full" type="submit">Thêm</button>
                </div>
            </div>
        </form>
        <!-- /form-add-product -->
    </div>
    <!-- /main-content-wrap -->
</div>

@endsection
@push('scripts')
<script src="https://cdn.ckeditor.com/4.20.0/full/ckeditor.js"></script>
<script src="{{asset ('assets/js/editor.js') }}"></script>
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

            $("#gFile").on("change",function(e){
                const photoInp = $("#gFile");
                const gphotos = this.files;
                $.each(gphotos,function(key,val){
                    $("#galUpload").prepend(`<div class="item gitems"><img src="${URL.createObjectURL(val)}" /></div>`);
                });
                
            });

            $("input[name='name']").on("change",function(){
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });

        });

        function StringToSlug(text){
            return Text.toLowerCase()
            .replace(/[^\w ]+/g,"")
            .replace(/ +/g,"-");
        }

        


        document.getElementById('has_variants').addEventListener('change', function () {
            let isChecked = this.checked;

            document.getElementById('no-variant-fields').style.display = isChecked ? 'none' : 'block';
            document.getElementById('variant-fields').style.display = isChecked ? 'block' : 'none';

            // Khi ẩn input đơn giản, loại bỏ required
            document.querySelectorAll('#no-variant-fields input').forEach(input => {
                if (isChecked) {
                    input.removeAttribute('required');
                } else {
                    input.setAttribute('required', 'true');
                }
            });

            // Khi hiện input biến thể, thêm required nếu cần
            document.querySelectorAll('#variant-fields input').forEach(input => {
                if (isChecked) {
                    input.setAttribute('required', 'true');
                } else {
                    input.removeAttribute('required');
                }
            });
        });

        document.querySelector('.add-variant').addEventListener('click', function () {
            let variantContainer = document.getElementById('variant-container');
            let newRow = document.createElement('div');
            newRow.classList.add('variant-row');
            newRow.innerHTML = `
                <input type="text" name="sizes[]" placeholder="Kích thước (VD: 16cm, 30x40cm)" required>
                <input type="text" name="colors[]" placeholder="Màu sắc (VD: Đỏ, Xanh)" required>
                <input type="number" name="quantities[]" placeholder="Số lượng" required>
                <input type="number" name="import_prices[]" placeholder="Giá nhập" required>
                <input type="number" name="regular_prices[]" placeholder="Giá bán" required>
                <input type="number" name="sales[]" placeholder="% Giảm giá">
                <button type="button" class="btn btn-danger remove-variant">X</button>
            `;
            variantContainer.appendChild(newRow);
        });

        document.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-variant')) {
                let variantContainer = document.getElementById('variant-container');
                event.target.parentElement.remove();

                if (variantContainer.children.length === 0) {
                    document.getElementById('has_variants').checked = false;
                    document.getElementById('no-variant-fields').style.display = 'block';
                    document.getElementById('variant-fields').style.display = 'none';

                    document.querySelectorAll('#no-variant-fields input').forEach(input => {
                        input.setAttribute('required', 'true');
                    });
                }
            }
        });

        document.querySelector('form').addEventListener('submit', function(event) {
            document.querySelectorAll('input[required], textarea[required], select[required]').forEach(input => {
                if (input.offsetParent === null) {
                    input.removeAttribute('required');
                }
            });
        });
    </script>
    
@endpush