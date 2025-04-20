@extends('layouts.admin')
@section('content')

<style>
    .product-import-list {
        display: flex;
        flex-direction: column; /* Hiển thị các block theo chiều dọc */
        gap: 15px; /* Khoảng cách giữa các block */
        align-items: start; /* Căn lề trái cho các block */
    }
</style>

<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Thêm phiếu nhập</h3>
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
                    <a href="{{route('admin.imports')}}">
                        <div class="text-tiny">Danh sách phiếu nhập</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Thêm phiếu nhập</div>
                </li>
            </ul>
        </div>
        <!-- new-category -->
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{ route('admin.import.store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <fieldset class="name">
                    <div class="body-title">Người nhập hàng <span class="tf-color-1">*</span></div>
                    <input id="supplier_name" class="flex-grow" type="text" placeholder="Tên người nhập hàng" name="supplier_name" tabindex="0" aria-required="true" required="">
                </fieldset>
                @error('supplier_name') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Số lô hàng <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Số lô hàng" name="batch_number" id="batch_number" tabindex="0" aria-required="true" required="">
                </fieldset>                
                @error('batch_number') <span class="alert alert-danger text-center">{{ $message }}</span> @enderror



                <div class="product-import-list" style="align-items: start;">
                    <div class="product-import-item">
                        <fieldset class="name">
                            <div class="body-title">Danh mục sản phẩm <span class="tf-color-1">*</span></div>
                            <select name="category_id[]" class="category-select">
                                <option value="">-- Chọn danh mục --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </fieldset>
                
                        <fieldset class="name">
                            <div class="body-title">Sản phẩm <span class="tf-color-1">*</span></div>
                            <select name="product_id[]" class="product-select">
                                <option value="">-- Chọn sản phẩm --</option>
                            </select>
                        </fieldset>
                
                        <div class="variant-fields" style="display: none; margin-left: 3px;">
                            <fieldset class="name">
                                <div class="body-title">Size</div>
                                <select name="size[]" class="size-select"></select>
                            </fieldset>
                            <fieldset class="name">
                                <div class="body-title">Color</div>
                                <select name="color[]" class="color-select"></select>
                            </fieldset>
                        </div>
                
                        <fieldset class="name">
                            <div class="body-title">Số lượng <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Nhập số lượng" name="quantity[]" required="">
                        </fieldset>
                
                        <fieldset class="name">
                            <div class="body-title">Giá nhập <span class="tf-color-1">*</span></div>
                            <input class="flex-grow" type="text" placeholder="Giá nhập" name="import_price[]" required="">
                        </fieldset>
                        <button type="button" class="remove-product" style="background-color: rgb(255, 77, 77); color: white; margin-top: 10px; padding: 10px;">
                            Xóa
                        </button>
                        <hr>
                    </div>
                </div>
                
                <fieldset class="name">
                    <button type="button" id="add-product" style="background-color: rgb(74, 168, 223);">
                        + Thêm sản phẩm
                    </button>
                </fieldset>

                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Lưu</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
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

            $("input[name='name']").on("change",function(){
                $("input[name='slug']").val(StringToSlug($(this).val()));
            });

        });

        function StringToSlug(text){
            return Text.toLowerCase()
            .replace(/[^\w ]+/g,"")
            .replace(/ +/g,"-");
        }


        $(document).ready(function () {
    // Load sản phẩm khi chọn danh mục
    $('.category-select').on('change', function () {
        let categoryId = $(this).val();
        let productSelect = $('.product-select');
        productSelect.html('<option>Đang tải...</option>');

        $.ajax({
            url: '/admin/products/by-category/' + categoryId,
            method: 'GET',
            success: function (data) {
                productSelect.empty().append('<option value="">-- Chọn sản phẩm --</option>');
                data.forEach(product => {
                    productSelect.append(`<option value="${product.id}">${product.name}</option>`);
                });
            }
        });
    });

    // Check nếu sản phẩm có biến thể => hiển thị size & color
    $('.product-select').on('change', function () {
        let productId = $(this).val();
        if (!productId) return;

        $.ajax({
            url: '/admin/products/check-variants/' + productId,
            method: 'GET',
            success: function (res) {
                if (res.has_variants) {
                    $('.variant-fields').show();
                    // Load size + color
                    loadVariants(productId);
                } else {
                    $('.variant-fields').hide();
                }
            }
        });
    });

    function loadVariants(productId) {
        $.ajax({
            url: '/admin/products/variants/' + productId,
            method: 'GET',
            success: function (data) {
                let sizeSelect = $('.size-select').empty();
                let colorSelect = $('.color-select').empty();
                data.sizes.forEach(s => sizeSelect.append(`<option value="${s}">${s}</option>`));
                data.colors.forEach(c => colorSelect.append(`<option value="${c}">${c}</option>`));
            }
        });
    }

    // Thêm sản phẩm vào danh sách trong form
        $('#add-item').on('click', function () {
            // Copy block sản phẩm hiện tại, reset input, thêm vào danh sách
            let currentBlock = $('.form-new-product').clone();
            currentBlock.find('input, select').val('');
            currentBlock.find('.variant-fields').hide();
            $('#product-list').append(currentBlock);
        });
    });


    $(document).ready(function () {
        // Khi nhấn nút "Thêm sản phẩm"
        $('#add-product').on('click', function () {
            // Sao chép block sản phẩm đầu tiên
            let newProductBlock = $('.product-import-item:first').clone();

            // Reset giá trị các input và select
            newProductBlock.find('input, select').val('');
            newProductBlock.find('.variant-fields').hide();

            newProductBlock.find('.remove-product').show();

            // Thêm block mới vào danh sách
            $('.product-import-list').append(newProductBlock);
        });

        
        $(document).on('click', '.remove-product', function () {
            let productBlocks = $('.product-import-item');
            if (productBlocks.length > 1) {
                // Chỉ xóa nếu không phải block đầu tiên
                $(this).closest('.product-import-item').remove();
            } else {
                alert('Không thể xóa block đầu tiên!');
            }
        });
        $('.product-import-item:first .remove-product').hide();
        // Load sản phẩm khi chọn danh mục
        $(document).on('change', '.category-select', function () {
            let categoryId = $(this).val();
            let productSelect = $(this).closest('.product-import-item').find('.product-select');
            productSelect.html('<option>Đang tải...</option>');

            $.ajax({
                url: '/admin/products/by-category/' + categoryId,
                method: 'GET',
                success: function (data) {
                    productSelect.empty().append('<option value="">-- Chọn sản phẩm --</option>');
                    data.forEach(product => {
                        productSelect.append(`<option value="${product.id}">${product.name}</option>`);
                    });
                }
            });
        });

        // Hiển thị size và color nếu sản phẩm có biến thể
        $(document).on('change', '.product-select', function () {
            let productId = $(this).val();
            let variantFields = $(this).closest('.product-import-item').find('.variant-fields');

            if (!productId) return;

            $.ajax({
                url: '/admin/products/check-variants/' + productId,
                method: 'GET',
                success: function (res) {
                    if (res.has_variants) {
                        variantFields.show();
                        loadVariants(productId, variantFields);
                    } else {
                        variantFields.hide();
                    }
                }
            });
        });

        // Load size và color
        function loadVariants(productId, variantFields) {
            $.ajax({
                url: '/admin/products/variants/' + productId,
                method: 'GET',
                success: function (data) {
                    let sizeSelect = variantFields.find('.size-select').empty();
                    let colorSelect = variantFields.find('.color-select').empty();
                    data.sizes.forEach(s => sizeSelect.append(`<option value="${s}">${s}</option>`));
                    data.colors.forEach(c => colorSelect.append(`<option value="${c}">${c}</option>`));
                }
            });
        }
    });
    </script>
@endpush