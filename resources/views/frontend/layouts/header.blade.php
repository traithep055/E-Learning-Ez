<header>
    <img src="{{ asset('images/Logo.png') }}" class="rounded-image">
    <ul>
        <a {{-- href="{{ route('') }}"--}} class="{{ {{--  (request()->routeIs('')) ? --}} 'active' {{-- :'' --}} }}">คอร์สเรียนยอดนิยม</a>
        <a {{-- href="{{ route('') }}"--}} class="{{ {{--  (request()->routeIs('')) ? --}} 'active' {{-- :'' --}} }}">คอร์สเรียนใหม่</a>
        <a {{-- href="{{ route('') }}"--}} class="{{ {{--  (request()->routeIs('')) ? --}} 'active' {{-- :'' --}} }}">หมวดหมู่คอร์สเรียน</a>
        <a href="{{ route('user.dashboard') }}">บัญชีของฉัน</a>
    </ul>
    <div class="cart" style="margin-left: 40%">
        <box-icon style="cursor: pointer" name='cart-alt' type='solid' animation='tada' size='md' color='purple'></box-icon>
    </div>
    @if (Route::has('login'))
        @guest
        <div class="logout" style="margin-right: 0">
            <a href="{{ route('login') }}">
                Sign In
                <i class='bx bx-log-out'></i>
            </a>
        </div>
        @endguest
        @auth
        <div class="logout m-2">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </div>
        @endauth
    @endif
</header>
