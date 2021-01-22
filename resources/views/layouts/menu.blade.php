
<header class="custom-header normal-header">
    <div class="container-fluid">
        <div class="menu">
            <div class="top-right links">

                @if(Auth::check())
                
                <a class="nav-link   {{ Request::is('cart') ? 'selected' : '' }}" href="{{route('cart')}}">Cart</a>
                <a class="nav-link   {{ Request::is('productsList') ? 'selected' : '' }}" href="{{route('productsList')}}">Products</a>
                   <a class="dropdown-item nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                    
                @else
                    <a class="nav-link   {{ Request::is('login') ? 'selected' : '' }}" href="{{route('login')}}">Login</a>
                @endif
                
            </div>
        </div>
    </div>
</header>