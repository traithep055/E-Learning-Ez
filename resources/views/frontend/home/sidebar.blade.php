@php
    $categories = \App\Models\Category::where('status', true)
        ->with([
            'subCategory' => function ($query) {
                $query->where('status', true);
            },
        ])
        ->get();
@endphp
<div class="menu">
    <div class="relative_contect d-flex">
        <div class="wsus_menu_category_bar">
            <i class="far fa-bars"></i>
        </div>
        <ul class="wsus_menu_cat_item show_home toggle_menu">
            @foreach ($categories as $category)
                <li><a class="{{ count($category->subCategory) > 0 ? 'wsus__droap_arrow' : '' }}"
                        href="{{ route('courses.index', ['category' => $category->slug]) }}"> {{ $category->name }} </a>
                    <ul class="wsus_menu_cat_droapdown">
                        @foreach ($category->subCategory as $subCategory)
                            <li><a href="{{ route('courses.index', ['subcategory' => $subCategory->slug]) }}">{{ $subCategory->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
        {{-- <div class="drop-search col-md-2 my-3 mt-0" style="margin-left: 50%">
            <div class="dropdown">
                <button class="btn dropdown-toggle btn-outline-dark" type="button" id="dropdownMenuButton1"
                    aria-expanded="false">
                    ทั้งหมด
                </button>
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="#">ล่าสุด</a></li>
                    <li><a class="dropdown-item" href="#">เก่าสุด</a></li>
                    <li><a class="dropdown-item" href="#">ทั้งหมด</a></li>
                </ul>
            </div>
        </div> --}}
    </div>
    {{-- เส้นขีด --}}
    <div class="divider" style="width: 100%;"></div>
    {{-- ตัวกรอง-ตัวล้าง --}}
    <div class="row mt-3" style="width: 100%;">
        <div class="clearn">
            <p class="btn "
                style="font-size:15px; color: rgba(255, 16, 16, 0.513); margin-top: -10px;margin-left: 100px">
                ล้างตัวกรอง
            </p>
        </div>
    </div>
    <div class="text-menu style="width: 100%;>
        <a class="link text-white justify-content-center align-items-center" href="{{ url('') }}"
            style="width: 100%;">
            <span class="link-text">คอร์สเรียนใหม่</span>
        </a>
    </div>
    <div class="text-menu mb-3">
        <a class="link text-white justify-content-center align-items-center" href="{{ url('') }}"
            style="width: 100%;">
            <div style="width: 100%;">
                <span class="link-text">คอร์สเรียนทั้งหมด</span>
            </div>
        </a>
    </div>
    {{-- เส้นขีด --}}
    <div class="divider"></div>
    {{-- ชั่วโมง --}}
    <div class="price mt-3 mb-3">
        <span>ราคาคอร์ส</span>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                1,000 - 2,000 บาท
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">
                2,100 - 3,000 บาท
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">
                3,100 - 4,000 บาท
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked">
            <label class="form-check-label" for="flexCheckChecked">
                4,100 บาท ขึ้นไป
            </label>
        </div>
    </div>
    {{-- เส้นขีด --}}
    <div class="divider"></div>
    {{-- ระดับ --}}
    <div class="level mt-3">
        <span>ระดับ</span>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                ระดับพื้นฐาน
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
            <label class="form-check-label" for="flexCheckDefault">
                ระดับขั้นสูง
            </label>
        </div>
    </div>

</div>
