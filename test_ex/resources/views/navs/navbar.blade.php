
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

@include('navs.mesage') 
