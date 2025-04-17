@extends('layouts.app')
@section('content')
<div class="app">
  <div class="app__container">
    <div class="grid wide">
      <h1 style="text-align: center;">Thông tin tài khoản</h1>
        <div class="inforuser">
          <div class="row justify-content-center">
            <form action="{{ route('user.update') }}" method="POST" enctype="multipart/form-data">
              @csrf
              @method('POST')
              
              <div class="form-group">
                <label for="name">Tên</label>
                <input style="margin-left: 60px" type="text" class="form-control" id="name" name="name" value="{{ old('name', auth()->user()->name) }}">
              </div>
  
              <div class="form-group">
                <label for="email">Email</label>
                <input style="margin-left: 50px" type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}">
              </div>
  
              <div class="form-group">
                <label for="phone">Số điện thoại</label>
                <input style="margin-left: 6px" type="text" class="form-control" id="mobile" name="mobile" value="{{ old('mobile', auth()->user()->mobile) }}">
              </div>

              <div class="form-group">
                <label for="avatar">Ảnh đại diện</label><br>
                <div style="display: flex; align-items: center; gap: 20px;">
                  @if(auth()->user()->avatar)
                    <img id="avatarPreview" src="{{ asset(auth()->user()->avatar) }}" alt="Avatar" class="imginforuser" width="100">
                  @else
                    <img id="avatarPreview" src="#" alt="Avatar Preview" style="display: none;" width="100">
                  @endif
                  
                  <input type="file" class="form-control-file" id="avatar" name="avatar" accept="image/*" onchange="previewImage(event)">
                </div>
              </div>
              
  
              <div class="inforaction">
                <a class="inforaction__link" href="{{route('user.password.reset')}}">Đổi mật khẩu</a>
                <button type="submit" class="btn btn--primary">Cập nhật</button>
              </div>
            </form>
          </div>
        </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function () {
      const preview = document.getElementById('avatarPreview');
      preview.src = reader.result;
      preview.style.display = 'block';
    };
    reader.readAsDataURL(event.target.files[0]);
  }

  // Hiển thị thông báo thành công từ session
  @if (session('success'))
    Swal.fire({
      icon: 'success',
      title: 'Thành công',
      text: '{{ session('success') }}',
      timer: 3000,
      showConfirmButton: false
    });
  @endif

  // Hiển thị lỗi (nếu có)
  @if ($errors->any())
    Swal.fire({
      icon: 'error',
      title: 'Lỗi',
      html: `{!! implode('<br>', $errors->all()) !!}`
    });
  @endif
</script>
@endpush

