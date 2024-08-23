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
/* ปรับแต่งเมนูหลัก */
/* .choice ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    align-items: center;
} */

.choice ul > li {
    position: relative;
    margin-right: 0;
}

.choice ul > li > a {
    text-decoration: none;
    color: #000;
    padding: 10px;
    display: block;
}

.choice ul > li > a:hover {
    background-color: #f0f0f0;
}

/* ปรับแต่ง CSS สำหรับเมนูหมวดหมู่ */
#category-menu {
    display: none;
    position: absolute;
    background-color: #fff;
    border: 2px solid #fff; /* กำหนดสีกรอบเป็นสีขาว */
    border-radius: 4px; /* เพิ่มมุมมน */
    list-style: none;
    padding: 0;
    margin: 0;
    z-index: 1000;
    width: 300px; /* เพิ่มความกว้างของเมนูหมวดหมู่ */
}

#category-menu.show {
    display: block;
}

/* ปรับแต่งลูกศร */
.wsus__droap_arrow::after {
    content: ' ▼';
    font-size: 0.6em;
}

/* ปรับแต่งเมนูหมวดหมู่หลัก */
.wsus_menu_cat_item > li {
    position: relative;
}

.wsus_menu_cat_item > li > a {
    padding: 10px;
    display: block;
    background-color: #fff;
    border-bottom: 1px solid #ccc;
    text-decoration: none;
    color: #333;
}

.wsus_menu_cat_item > li > a:hover {
    background-color: #f9f9f9;
}

/* ปรับแต่งเมนูหมวดหมู่ย่อย */
.wsus_menu_cat_droapdown {
    list-style: none;
    padding: 0;
    margin: 0;
    display: none; /* เริ่มต้นซ่อนเมนูหมวดหมู่ย่อย */
    position: absolute;
    left: 100%; /* แสดงเมนูหมวดหมู่ย่อยทางด้านขวาของหมวดหมู่หลัก */
    top: 0;
    background-color: #fff;
    border: 2px solid #fff; /* กำหนดสีกรอบเป็นสีขาว */
    border-radius: 4px; /* เพิ่มมุมมน */
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

/* ปรับแต่งการจัดวางระยะห่างและตำแหน่งของปุ่มค้นหา */
.card-search {
    margin-left: 20px; /* ปรับระยะห่างของปุ่มค้นหา */
}

.input-group {
    display: flex;
}

.form-control {
    padding: 10px;
}

/* ปรับแต่งลิงก์เข้าสู่ระบบและออกจากระบบ */
.logout {
    margin-left: 20px; /* ปรับระยะห่างของลิงก์เข้าสู่ระบบและออกจากระบบ */
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
    {{-- เมนูหลัก --}}
    <div class="choice">
        <ul>
            <a href="#" class="active" style="cursor: pointer">ยอดนิยม</a>
            <a href="#" class="active" style="cursor: pointer">คอร์สใหม่</a>
            <li>
                <a href="#" class="active" id="category-toggle" style="cursor: pointer">หมวดหมู่</a>
                <!-- เมนูหมวดหมู่ -->
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
                                            <a href="{{ route('courses.index', ['subcategory' => $subCategory->slug]) }}">
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
            <a href="{{ route('teachers.index') }}" class="active" style="cursor: pointer">ผู้สอน</a>
            @auth
                @if (auth()->user()->role == 'user')
                    <a href="{{ route('user.dashboard') }}" style="cursor: pointer">บัญชีของฉัน</a>
                @endif
                @if (auth()->user()->role == 'teacher')
                    <a href="{{ route('teacher.dashboard') }}">บัญชีของฉัน</a>
                @endif
            @endauth
            <li>
                <div class="card-search">
                    <form action="{{ route('courses.index') }}" class="search-body" method="GET" id="search-form">
                        <div class="input-group">
                            <input type="text" class="form-control" name="searchcard" id="search-body" placeholder="ค้นหาคอร์สเรียน">
                        </div>
                    </form>
                </div>
            </li>
            {{-- ลิงก์เข้าสู่ระบบและออกจากระบบ --}}
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
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"
                               class="logout-link">
                                <i class="fas fa-sign-out-alt"></i>
                                ออกจากระบบ
                            </a>
                        </form>
                @endauth
            @endif
        </ul>
    </div>
</header>


<!-- JavaScript -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
    const categoryToggle = document.getElementById('category-toggle');
    const categoryMenu = document.getElementById('category-menu');

    if (categoryToggle && categoryMenu) {
        categoryToggle.addEventListener('click', function(event) {
            event.preventDefault(); // ป้องกันการกระทำเริ่มต้นของลิงก์
            categoryMenu.classList.toggle('show'); // สลับคลาส 'show' เพื่อแสดงหรือซ่อนเมนู
        });
    } else {
        console.error('ไม่พบองค์ประกอบที่ต้องการ: category-toggle หรือ category-menu');
    }

    // สลับการแสดงเมนูหมวดหมู่ย่อย
    const categoryItems = document.querySelectorAll('.wsus_menu_cat_item > li');

    categoryItems.forEach(item => {
        const subMenu = item.querySelector('.wsus_menu_cat_droapdown');
        if (subMenu) {
            item.addEventListener('mouseover', () => {
                subMenu.style.display = 'block'; // แสดงเมนูหมวดหมู่ย่อย
            });
            item.addEventListener('mouseout', () => {
                subMenu.style.display = 'none'; // ซ่อนเมนูหมวดหมู่ย่อย
            });
        }
    });
});

</script>


