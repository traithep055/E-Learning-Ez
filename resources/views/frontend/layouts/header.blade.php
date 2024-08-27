@php
    $categories = \App\Models\Category::where('status', true)
        ->with([
            'subCategory' => function ($query) {
                $query->where('status', true);
            },
        ])
        ->get();
@endphp
<link rel="stylesheet" href="{{ asset('frontend/css/header.css') }}">
<style>
    .choice ul {
        list-style: none;
        padding: 0;
        margin-right: 20%;
        /* display: flex;
        align-items: center; */
    }

    .choice ul>li {
        position: relative;
        margin-right: 10px;
        /* Added margin for spacing */
    }

    .choice ul>li>a {
        text-decoration: none;
        color: #000;
        padding: 1px;
        display: block;
        width: 60%;
    }

    .choice ul>li>a:hover {
        background-color: #f0f0f0;
    }

    #category-menu {
        display: none;
        position: absolute;
        background-color: #fff;
        border: 2px solid #fff;
        border-radius: 4px;
        list-style: none;
        padding: 0;
        margin: 0;
        z-index: 1000;
        width: 300px;
    }

    #category-menu.show {
        display: block;
    }

    .wsus__droap_arrow::after {
        content: ' ▼';
        font-size: 0.6em;
    }

    .wsus_menu_cat_item>li {
        position: relative;
    }

    .wsus_menu_cat_item>li>a {
        padding: 10px;
        display: block;
        background-color: #fff;
        text-decoration: none;
        color: #333;
    }

    .wsus_menu_cat_item>li>a:hover {
        background-color: #f9f9f9;
    }

    .wsus_menu_cat_droapdown {
        list-style: none;
        padding: 0;
        margin: 0;
        display: none;
        position: absolute;
        left: 100%;
        top: 0;
        background-color: #fff;
        border: 2px solid #fff;
        border-radius: 4px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        width: 200px;
    }

    .wsus_menu_cat_droapdown li {
        border-bottom: 1px solid #ddd;
    }

    .wsus_menu_cat_droapdown li:last-child {
        border-bottom: none;
    }

    .wsus_menu_cat_droapdown li a {
        padding: 10px 15px;
        display: block;
        color: #333;
        text-decoration: none;
    }

    .wsus_menu_cat_droapdown li a:hover {
        background-color: #f0f0f0;
    }

    .card-search {
        margin-left: 20px;
    }

    .input-group {
        display: flex;
    }

    .form-control {
        padding: 10px;
        width: 100%;
        z-index: 100;
        /* Increased z-index to ensure it's above other elements */
        position: relative;
        /* Added positioning to enable z-index to work */
    }


    .logout {
        margin-left: 20px;
    }

    .logout-link {
        display: flex;
        align-items: center;
    }

    .logout-link i {
        margin-right: 5px;
    }
</style>

<header>
    <div class="logo">
        <a href="{{ route('home') }}" class="rounded-image">
            <img src="{{ asset('images/Logo.png') }}" width="50%" alt="โลโก้">
        </a>
    </div>
    <div class="choice">
        <ul>
            <li><a href="{{ route('home') }}?sort=popular"
                    class="{{ request('sort') === 'popular' ? 'active' : '' }} ">ยอดนิยม</a></li>
            <li><a href="{{ route('home') }}?sort=latest"
                    class="{{ request('sort') === 'latest' ? 'active' : '' }}">คอร์สใหม่</a></li>
            <li>
                <a href="#" id="category-toggle" style="cursor: pointer;">หมวดหมู่</a>
                <ul class="wsus_menu_cat_item" id="category-menu">
                    @foreach ($categories as $category)
                        <li class="category-item">
                            <a href="{{ route('courses.index', ['category' => $category->slug]) }}"
                                class="{{ count($category->subCategory) > 0 ? 'wsus__droap_arrow' : '' }}">
                                {{ $category->name }}
                            </a>
                            @if (count($category->subCategory) > 0)
                                <ul class="wsus_menu_cat_droapdown">
                                    @foreach ($category->subCategory as $subCategory)
                                        <li>
                                            <a
                                                href="{{ route('courses.index', ['subcategory' => $subCategory->slug]) }}">
                                                {{ $subCategory->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </li>
            <li><a href="{{ route('teachers.index') }}" class="active">ผู้สอน</a></li>

            @auth
                @if (auth()->user()->role == 'user')
                    <li><a href="{{ route('user.dashboard') }}" style="margin-left: 10px; width: 50%;">โปรไฟล์</a>
                    </li>
                @endif
                @if (auth()->user()->role == 'teacher')
                    <li><a href="{{ route('teacher.dashboard') }}" style="margin-right: 10px; width: 50%;">โปรไฟล์</a>
                    </li>
                @endif
            @endauth
            <li>
                <div class="card-search">
                    <form action="{{ route('courses.index') }}" method="GET" id="search-form">
                        <div class="input-group" style="width: 200%; margin-left: 100%">
                            <input type="text" class="form-control" name="searchcard" id="search-body"
                                placeholder="ค้นหา">
                        </div>
                    </form>
                </div>
            </li>
            @if (Route::has('login'))
                @guest
                    <li class="logout">
                        <a href="{{ route('login') }}" style="margin-left: 180%; width: 60%">
                            เข้าสู่ระบบ
                            <i class='bx bx-log-out'></i>
                        </a>
                    </li>
                @endguest
                @auth
                    <li class="logout">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault(); this.closest('form').submit();" class="logout-link">
                                <i class="fas fa-sign-out-alt"></i>
                                ออกจากระบบ
                            </a>
                        </form>
                    </li>
                @endauth
            @endif
        </ul>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoryToggle = document.getElementById('category-toggle');
        const categoryMenu = document.getElementById('category-menu');

        if (categoryToggle && categoryMenu) {
            categoryToggle.addEventListener('click', function(event) {
                event.preventDefault();
                categoryMenu.classList.toggle('show');
            });
        } else {
            console.error('ไม่พบองค์ประกอบที่ต้องการ: category-toggle หรือ category-menu');
        }

        const categoryItems = document.querySelectorAll('.wsus_menu_cat_item > li');

        categoryItems.forEach(item => {
            const subMenu = item.querySelector('.wsus_menu_cat_droapdown');
            if (subMenu) {
                item.addEventListener('mouseover', () => {
                    subMenu.style.display = 'block';
                });
                item.addEventListener('mouseout', () => {
                    subMenu.style.display = 'none';
                });
            }
        });
    });
</script>
