$(document).ready(function () {
    // Khi thay đổi checkbox danh mục
    $('.category-list input[type="checkbox"]').change(function () {
        filterProducts();
    });

    // Khi click vào nút lọc (Mới nhất, Phổ biến, Bán chạy)
    $('.home-filter__btn').click(function () {
        $('.home-filter__btn').removeClass('btn--primary'); // Xóa class active khỏi tất cả
        $(this).addClass('btn--primary'); // Thêm class active vào nút được chọn

        filterProducts(); // Gọi hàm lọc
    });

    // Khi chọn giá trị sắp xếp trong dropdown
    $('.seclect-input__item a').click(function (e) {
        e.preventDefault();
        $('.seclect-input__item a').removeClass('active');
        $(this).addClass('active');

        filterProducts(); // Gọi hàm lọc
    });

    function filterProducts() {
        let categories = $('.category-list input[name="categories[]"]:checked')
            .map(function () { return this.value; }).get().join(',');

        let order = $('.home-filter__btn.btn--primary').index(); // Lấy index của nút đang active
        let sort_by = $('.seclect-input__item a.active').attr('data-sort'); // Lấy giá trị sort_by

        $.ajax({
            url: "{{ route('shop.index') }}",
            type: "GET",
            data: {
                categories: categories,
                order: order,
                sort_by: sort_by,
                _token: "{{ csrf_token() }}"
            },
            success: function (response) {
                $('.home-product .row').html(response.html); // Load lại danh sách sản phẩm
            },
            error: function () {
                alert('Có lỗi xảy ra! Vui lòng thử lại.');
            }
        });
    }
});