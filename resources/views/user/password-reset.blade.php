@extends('layouts.app')
@section('content')
<div class="app">
  <div class="app__container">
    <div class="grid wide">
      <h1 style="text-align: center;">Đổi mật khẩu</h1>
        <div class="inforuser">
          <div class="row justify-content-center">
            <form action="{{ route('user.password.update') }}" method="POST">
                @csrf
                @method('POST')
              
                <div class="form-group">
                  <label for="current_password">Mật khẩu cũ</label>
                  <input style="margin-left: 60px" type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
              
                <div class="form-group">
                  <label for="new_password">Mật khẩu mới</label>
                  <input style="margin-left: 50px" type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
              
                <div class="form-group">
                  <label for="new_password_confirmation">Nhập lại mật khẩu mới</label>
                  <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation" required>
                </div>
              
                <div class="inforaction">
                  <a class="inforaction__link" href="{{ route('user.index') }}">Trở về</a>
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

