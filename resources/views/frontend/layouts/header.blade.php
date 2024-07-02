<header>
    <div class="logo">
        <a href="{{ route('home') }}" class="rounded-image">
        <img src="{{ asset('images/Logo.png') }}" width="100px" >
    </a>
    </div>
    <div class="choice">
        <ul>
        <a class="{{'active'}}" style="cursor: pointer">คอร์สเรียนยอดนิยม</a>
        <a class="{{'active'}}" style="cursor: pointer">คอร์สเรียนใหม่</a>
        <a class="{{'active'}}" style="cursor: pointer">หมวดหมู่คอร์สเรียน</a>
        <a href="{{ route('teachers.index') }}" class="{{'active'}}" style="cursor: pointer">ผู้สอน</a>
        @auth
            @if(auth()->user()->role == 'user')
                <a href="{{ route('user.dashboard') }}">บัญชีของฉัน</a>
            @endif
            @if(auth()->user()->role == 'teacher')
                <a href="{{ route('teacher.dashboard') }}">บัญชีของฉัน</a>
            @endif
        @endauth
    </ul>
    </div>
    @if (Route::has('login'))
        @guest
        <div class="logout" style="margin-left: 27%">
            <a href="{{ route('login') }}"  >
                Sign In
                <i class='bx bx-log-out'></i>
            </a>
        </div>
        @endguest
        @auth
        <div class="logout m-2" >
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();" style="margin-left: 305%" class="dropdown-item has-icon text-dark">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </form>
        </div>
        @endauth
    @endif
</header>
