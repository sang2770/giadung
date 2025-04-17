@extends('layouts.app')
@section('content')

<div class="app">
    <div class="app__container">
        <div class="grid wide">

            <nav style="font-size: 1.6rem; padding-top: 20px">
                <span>
                    <a class="link-page" href="{{ url('/') }}">Trang chủ</a> > 
                    <span style="color: rgb(247, 143, 75)">Liên hệ</span>
                </span>
            </nav>

            <div class="contact-main">
                <div class="row sm-gutter app__content">
                    <div class="col l-6 m-0 c-0">
                        <h2 class="contact-title">AT STORE</h2>
                        <div class="contact-info">
                            <p><strong>📍 Địa chỉ:</strong> Đại học Cần Thơ, Ninh Kiều, Cần Thơ</p>
                            <p><strong>📧 Email:</strong> anthuan12t4@gmail.com</p>
                            <p><strong>📞 Hotline:</strong> 0375 112 571</p>
                        </div>

                        <div class="contact-form">
                            <h3>LIÊN HỆ VỚI CHÚNG TÔI</h3>
                            <form id="contactForm" method="POST">
                                @csrf
                                <input type="text" name="name" placeholder="Họ và tên" required>
                                <input type="email" name="email" placeholder="Email" required>
                                <input type="tel" name="phone" placeholder="Điện thoại*" required>
                                <textarea name="message" placeholder="Nội dung" required></textarea>
                                <button type="submit">Gửi thông tin</button>
                            </form>                   
                        </div>
                    </div>

                    <div class="col l-6 m-0 c-0">
                        <div class="map">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3916.523973636865!2d105.7660603147194!3d10.02993389283002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31a0881a9f0b1f4b%3A0x2f7d1e8f3e5b8e0!2zVHLGsOG7nW5nIMSQ4bqhaSBo4buNYyBD4bqnbiBUaMOt!5e0!3m2!1svi!2s!4v1614594862956!5m2!1svi!2s"
                                width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
        $("#contactForm").submit(function(e) {
            e.preventDefault(); // Ngăn chặn load lại trang
        
            $.ajax({
                url: "{{ route('contact.index') }}",
                method: "POST",
                data: $(this).serialize(), // Lấy dữ liệu form
                success: function(response) {
                    // Sử dụng thông báo từ phản hồi JSON
                    Swal.fire({
                        title: "Gửi thành công!",
                        text: response.message,  // Sử dụng thông báo từ phản hồi JSON
                        icon: "success",
                        confirmButtonText: "OK"
                    });
        
                    $("#contactForm")[0].reset(); // Xóa dữ liệu form sau khi gửi thành công
                },
                error: function(xhr) {
                    Swal.fire({
                        title: "Lỗi!",
                        text: "Có lỗi xảy ra, vui lòng thử lại.",
                        icon: "error",
                        confirmButtonText: "OK"
                    });
                }
            });
        });
    });
    </script>    
@endpush
