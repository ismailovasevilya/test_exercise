@if (auth()->check())
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
        <p>LOGOUT</p>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endif
{{-- @else --}}
{{-- <a class="nav-link"
        href="{{ !auth()->check() ||!auth()->user()->isAdmin()? route('getMenu'): route('adminGetMenu') }}">
        <p>FOOD & DRINK</p>
    </a> --}}

{{-- <a class="nav-link nav-icon" href="{{ route('myOrders') }}">
        <p class="order-p">ORDERS
            @if (auth()->check() && auth()->user()->orders)
                <i class="card-icon fas fa-cart-plus ml-1"></i>
                <span class="span-icon">{{ count(auth()->user()->orders) }}</span>
            @endif
        </p>
    </a> --}}
{{-- @endif

@guest
    <a class="nav-link" href="/login">
        <p>SIGN IN</p>
    </a>

    <a class="nav-link" href="/register">
        <p>REGISTER</p>
    </a>
@else
    <a class="nav-link" href="{{ route('logout') }}"
        onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
        <p>LOGOUT</p>
    </a>
    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
@endguest --}}
