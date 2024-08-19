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
            <a class="{{ 'active' }}" style="cursor: pointer">ยอดนิยม</a>
            <a class="{{ 'active' }}" style="cursor: pointer">คอร์สใหม่</a>
            <a class="{{ 'active' }}" style="cursor: pointer">หมวดหมู่</a>
            <a href="{{ route('teachers.index') }}" class="{{ 'active' }}" style="cursor: pointer; width: 5%">ผู้สอน</a>
            @auth
                @if (auth()->user()->role == 'user')
                    <a href="{{ route('user.dashboard') }}" style="cursor: pointer; width: 10%">บัญชีของฉัน</a>
                @endif
                @if (auth()->user()->role == 'teacher')
                    <a href="{{ route('teacher.dashboard') }}">บัญชีของฉัน</a>
                @endif
            @endauth
             <div class="card-search">
                <form action="{{ route('courses.index') }}" class="search-body" method="GET" id="search-form">
                    <div class="input-group" style="margin-top:-10%">
                        <input type="text" class="form-control" name="searchcard" id="search-body"
                            placeholder="ค้นหาคอร์สเรียน">
                    </div>
                </form>
            </div>
            {{-- login-singin --}}
            @if (Route::has('login'))
                @guest
                    <div class="logout">
                        <a href="{{ route('login') }}">
                            เข้าสู่ระบบ
                            <i class='bx bx-log-out'></i>
                        </a>
                    </div>
                @endguest
                @auth
                    <form method="POST" action="{{ route('logout') }}" >
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                            class="dropdown-item has-icon text-dark logout-link" style="cursor: pointer; width: 100%">
                            <i class="fas fa-sign-out-alt"></i>
                            ออกจากระบบ
                        </a>
                    </form>
                @endauth
            @endif
        </ul>
    </div>
</header>
