<ul class="account-nav">
    <li><a href="{{route('user.infor')}}" class="menu-link menu-link_us-s">Thống kê</a></li>
    <li><a href="{{route('user.orders')}}" class="menu-link menu-link_us-s">Đơn hàng</a></li>
    <li><a href="account-address.html" class="menu-link menu-link_us-s">Addresses</a></li>
    <li><a href="account-details.html" class="menu-link menu-link_us-s">Account Details</a></li>
    <li>
        <form method="POST" action="{{route('logout')}}" id="logout-form">
            @csrf
            <a href="{{route('logout')}}" class="menu-link menu-link_us-s" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        </form>
    </li>
</ul>