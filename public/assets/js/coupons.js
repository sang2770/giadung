$(document).ready(function () {
    // Áp dụng mã giảm giá
    $('#apply-coupon').click(function () {
        let coupon_code = $('#coupon_code').val();
        $.ajax({
            url: "{{ route('cart.coupon.apply') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                coupon_code: coupon_code
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Đã có lỗi xảy ra. Vui lòng thử lại!");
            }
        });
    });

    // Xóa mã giảm giá
    $('#remove-coupon').click(function () {
        $.ajax({
            url: "{{ route('cart.coupon.remove') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                _method: "DELETE"
            },
            success: function (response) {
                if (response.success) {
                    location.reload();
                } else {
                    alert(response.message);
                }
            },
            error: function () {
                alert("Đã có lỗi xảy ra. Vui lòng thử lại!");
            }
        });
    });
});