<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta name="author" content="surfside media" />
    <link rel="shortcut icon" href="{{ asset ('assets/images/favicon.ico') }}" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/modern-normalize/0.7.0/modern-normalize.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:ital,wght@0,300;0,400;0,700;1,300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset ('assets/css/fontawesome-free-5.13.1-web/css/all.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset ('assets/css/base.css ') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('assets/css/main.css ') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('assets/css/gird.css ') }}" type="text/css" />
    <link rel="stylesheet" href="{{ asset ('assets/css/responsive.css ') }}" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastify-js/1.12.0/toastify.min.js"></script>

        @stack('styles')
</head>

<body>
  <header class="header">
    <div class="grid wide">
        <nav class="header__navbar hide-on-tablet-and-mobile">

            <div class="col l-2" style="display: flex; justify-content: center; align-items: center;">
                <a class="header__logo" href="">
                    <img src="{{ asset('assets/images/logo.jpg') }}" alt="" class="header__logo-img">
                </a>
            </div>
            

            <div class="col l-8">
                <div class="row sm-gutter">
                    <div class="header__search">
                        <div class="header__search-input-wrap">
                            <input type="text" class="header__search-input" id="search-input" placeholder="Nhập để tìm kiếm sản phẩm">
                            
                            <!-- Search history -->
                            <div class="header__search-history" id="search-history" style="display:none;">
                                <h3 class="header__search-history-heading">Lịch sử tìm kiếm</h3>
                                <ul class="header__search-history-list" id="history-list">
                                </ul>
                            </div>
                    
                            <!-- Gợi ý tìm kiếm -->
                            <div class="header__search-history" id="search-suggestions" style="display:none;">
                                <h3 class="header__search-history-heading">Gợi ý</h3>
                                <ul class="header__search-history-list" id="suggestion-list"></ul>
                            </div>
                        </div>
                    
                        <button class="header__search-btn">
                            <i class="header__search-btn-icon fas fa-search"></i>
                        </button>
                    </div>
                                    
                </div>

                <div class="row sm-gutter" style="display: flex; justify-content: center; align-items: center;">    
                    <nav class="header__menu">
                        <ul class="header__menu-list">
                            <li class="header__menu-item">
                                <a href="{{route('home.index')}}" class="header__menu-link active">Trang chủ</a>
                            </li>
                            <li class="header__menu-item">
                                <a href="{{route('introduce.index')}}" class="header__menu-link">Giới thiệu</a>
                            </li>
                            <li class="header__menu-item">
                                <a href="{{route('shop.index')}}" class="header__menu-link">Sản phẩm</a>
                            </li>
                            <li class="header__menu-item">
                                <a href="{{route('content.index')}}" class="header__menu-link">Tin tức</a>
                            </li>
                            <li class="header__menu-item">
                                <a href="{{route('contact.index')}}" class="header__menu-link">Liên hệ</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col l-2" >
                <div class="row sm-gutter" style="margin-top: 16px;">
                    <ul class="header__navbar-list">
                        @guest
                            <!-- Nếu chưa đăng nhập -->
                            <li class="header__navbar-item header__navbar-item--strong header__navbar-item--separate">
                                <a href="{{ route('register') }}">Đăng ký</a>
                            </li>
                            <li class="header__navbar-item header__navbar-item--strong">
                                <a href="{{ route('login') }}">Đăng nhập</a>
                            </li>
                        @else
                            <li class="header__navbar-item header__navbar-user" style="margin-left: 40px">
                                <img src="{{ asset('' . (Auth::user()->avatar ?? 'default-avatar.jpg')) }}" alt="" class="header__navbar-user-img">
                                <a href="{{ Auth::user()->role === 'ADM' ? route('admin.index') : route('user.index') }}" class="header-tools__item">
                                    <span class="header__navbar-user-name">{{ Auth::user()->name }}</span>
                                </a>
                            
                                <!-- Hiển thị menu tùy theo vai trò -->
                                <ul class="header__navbar-user-menu">
                                    <li class="header__navbar-user-item">
                                        <a href="{{ Auth::user()->role === 'ADM' ? route('admin.index') : route('user.index') }}">
                                            Tài khoản của tôi
                                        </a>
                                    </li>
                            
                                    @if(Auth::user()->role !== 'ADM')
                                        <li class="header__navbar-user-item">
                                            <a href="{{route('user.orders')}}">Đơn hàng đã mua</a>
                                        </li>
                                    @endif
                                    
                                    <li class="header__navbar-user-item">
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Đăng xuất
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>      
                        @endguest
                    </ul>
                </div>

                <div class="row sm-gutter">
                    <a href="{{ route('cart.index') }}">
                        <div class="header__cart">
                            <div class="header__cart-warp">
                                <i class="header__cart-icon fas fa-cart-plus"></i>
                                <span class="header__cart-notice js-cart-items-count">
                                    {{ Cart::instance('cart')->count() }}
                                </span>
                            </div>
                        </div>
                    </a>  
                </div>
            </div>  
    </div>
  </header>


    @yield('content')
  
  
    <footer class="footer">
      <div class="grid wide">
          <div class="row">
              <div class="col l-2-4 m-4 c-12 ">
                  <h3 class="footer__heading">Chăm sóc khách hàng</h3>
                  <ul class="footer-list">
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Trung tâm trợ giúp</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">An Thuận Mall</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Hướng dẫn mua hàng</a>
                      </li>
                  </ul>
              </div>
              <div class="col l-2-4 m-4 c-12">
                  <h3 class="footer__heading">Giới thiệu</h3>
                  <ul class="footer-list">
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Giới thiệu</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Tuyển dụng</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Điều khoản</a>
                      </li>
                  </ul>
              </div>
              <div class="col l-2-4 m-4 c-12">
                  <h3 class="footer__heading">Danh mục</h3>
                  <ul class="footer-list">
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Hàng độc</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Hàng lạ</a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">Hàng hiếm</a>
                      </li>
                  </ul>
              </div>
              <div class="col l-2-4 m-4 c-12">
                  <h3 class="footer__heading">Theo dõi</h3>
                  <ul class="footer-list">
                      <li class="footer-item">
                          <a href="" class="footer-item__link">
                              <i class="footer-item__icon fab fa-facebook"></i>
                              Facebook
                          </a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">
                              <i class="footer-item__icon fab fa-instagram"></i>
                              Instagram
                          </a>
                      </li>
                      <li class="footer-item">
                          <a href="" class="footer-item__link">
                              <i class=" footer-item__icon fab fa-linkedin"></i>
                              Linkedin
                          </a>
                      </li>
                  </ul>
              </div>
              <div class="col l-2-4 m-4 c-12">
                  <h3 class="footer__heading">Vào cửa hàng trên ứng dụng</h3>
                  <div class="footer__qr">
                      <img src="./assets/img/qr_code.png" alt="QR code" class="footer__qr-img">
                      <div class="footer__qr-apps">
                          <a href="" class="footer__qr-link">
                              <img src="./assets/img/google_play.png" alt="" class="footer__qr-download-img">
                          </a>
                          <a href="" class="footer__qr-link">
                              <img src="./assets/img/app_store.png" alt="" class="footer__qr-download-img">
                          </a>
                      </div>
                  </div>
              </div>
          </div>
          <div class="row"></div>
              <p class="footer__text">@2025 - Bản quyền thuộc về Công ty TNHH An Thuận</p>
          </div>
      </div>
  </footer>
  
    <div id="scrollTop" class="visually-hidden end-0"></div>
    <div class="page-overlay"></div>
  
    <script src="{{ asset('assets/js/plugins/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap-slider.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert.min.js') }}"></script>    
    <script src="{{ asset('assets/js/plugins/swiper.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/countdown.js') }}"></script>
    <script src="{{ asset('assets/js/theme.js') }}"></script>
    <script src="{{ asset('assets/js/search.js') }}"></script>
    <script src="{{ asset('assets/js/searchajax.js') }}"></script>
    @stack('scripts')
  </body>
</html>

