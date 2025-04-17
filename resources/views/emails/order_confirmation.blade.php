<h2>Xin chào {{ $order->customer_name }},</h2>
<p>Cảm ơn bạn đã đặt hàng tại cửa hàng của chúng tôi.</p>
<p>Chi tiết đơn hàng:</p>
<ul>
    <li>Mã đơn hàng: {{ $order->id }}</li>
    <li>Người nhận: {{ $order->customer_name }}</li>
    <li>Email: {{ $order->customer_email }}</li>
    <li>Địa chỉ: {{ $order->address }}, {{ $order->district }}, {{ $order->province }}</li>
    <li>Phương thức thanh toán: {{ strtoupper($order->payment_method) }}</li>
    <li>Tổng tiền: {{ number_format($order->total, 0, ',', '.') }} VNĐ</li>
</ul>
<p>Cảm ơn bạn đã mua hàng!</p>
