<link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
<header>
    <div class="logo">
        <a href="{{ route('home') }}" class="rounded-image">
            <img src="{{ asset('images/Logo.png') }}" width="50%">
        </a>
    </div>
    {{-- choice --}}
    <div class="choice">
        <ul>
            <a class="{{ 'active' }}" style="cursor: pointer">คอร์สเรียนยอดนิยม</a>
            <a class="{{ 'active' }}" style="cursor: pointer">คอร์สเรียนใหม่</a>
            <a class="{{ 'active' }}" style="cursor: pointer">หมวดหมู่คอร์สเรียน</a>
            <a href="{{ route('teachers.index') }}" class="{{ 'active' }}" style="cursor: pointer">ผู้สอน</a>
            @auth
                @if (auth()->user()->role == 'user')
                    <a href="{{ route('user.dashboard') }}">บัญชีของฉัน</a>
                @endif
                @if (auth()->user()->role == 'teacher')
                    <a href="{{ route('teacher.dashboard') }}">บัญชีของฉัน</a>
                @endif
            @endauth
            <div class="card-search" style="margin-top:-25px; margin-left:31%">
                <form action="{{ route('courses.index') }}" class="search-body" method="GET" id="search-form">
                    <div class="input-group" style="margin-top:15%">
                        <input type="text" class="form-control" name="searchcard" id="search-body"
                            placeholder="ค้นหาคอร์สเรียน">
                        <button type="submit" class="btn-search">
                            <i class='bx bx-search'
                                style="color: rgb(0, 0, 0); font-size: 25px; position: absolute; top: 60%; transform: translateY(-50%);">
                            </i>
                        </button>
                    </div>
                </form>
            </div>
            {{-- login-singin --}}
            @if (Route::has('login'))
                @guest
                    <div class="logout">
                        <a href="{{ route('login') }}" style="margin-left: 800%">
                            Sign In
                            <i class='bx bx-log-out'></i>
                        </a>
                    </div>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="dropdown-item has-icon text-dark logout-link">
                            <i class="fas fa-sign-out-alt"></i>
                            Logout
                        </a>
                    </form>
                @endauth
            @endif
        </ul>
    </div>
</header>
