@extends('layouts.app')

@section('content')

<div class="app">
  <div class="app__container">
    <div class="grid wide">
      <div class="register-page">
        <form method="POST" action="{{ route('register') }}" name="register-form" class="register-form" novalidate="" enctype="multipart/form-data">
          @csrf
          <h1>ĐĂNG KÝ</h1>
      
          <input class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required="" autocomplete="name" type="text" placeholder="Tên đăng nhập">
          @error('name')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

          <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" required="" autocomplete="email">
          @error('email')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

          <input id="mobile" type="tel" class="@error('mobile') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" placeholder="Số điện thoại" required="" autocomplete="mobile">
          @error('mobile')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror

          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Mật khẩu" required="" autocomplete="new-password">
          @error('password')
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
          @enderror

          <input id="password-confirm" type="password" name="password_confirmation" placeholder="Nhập lại mật khẩu" required="" autocomplete="new-password">

          <input type="file" class="@error('avatar') is-invalid @enderror" name="avatar" accept="image/*">
          @error('avatar')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
          @enderror
      
          <button type="submit">Đăng ký</button>
      
          <div class="login-link">
            Đã có tài khoản, đăng nhập <a href="{{route('login')}}">tại đây</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
