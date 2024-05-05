<div class="menu" style=" width:25%; margin-left:40px">
    <div class="text-menu style="width: 100%;>
        <a class="link text-white justify-content-center align-items-center"
            href="{{ url('') }}" style="width: 100%;">
            <span class="link-text">คอร์สเรียนใหม่</span>
        </a>
    </div>
    <div class="text-menu mb-3">
        <a class="link text-white justify-content-center align-items-center"
            href="{{ url('') }}" style="width: 100%;">
            <div style="width: 100%;">
                <span class="link-text">คอร์สเรียนทั้งหมด</span>
            </div>
        </a>
    </div>
    {{-- เส้นขีด --}}
    <div class="divider" style="width: 100%;"></div>
    {{-- ตัวกรอง-ตัวล้าง --}}
    <div class="row mt-3" style="width: 100%;">
        <div class="filter col-md-4">
            <span>ตัวกรอง</span>
        </div>
        <div class="clearn col-md-8 ">
            <button class="btn"
                style="width: 85%; font-size:15px; margin-left:15%; color: red; margin-top: -10px">
                ล้างตัวกรอง
            </button>
        </div>
    </div>
    <div class="category-text m1-3" style="width: 100%;">
        <span>หมวดหมู่</span>
        <div class="dropdown">
            <button class="btn dropdown-toggle btn-outline-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; font-size:15px; margin-left:-1%">
                หมวดหมู่ทั้งหมด
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
    </div>
    <div class="category-text mb-3" style="width: 100%;">
        <span>หมวดหมู่ย่อย</span>
        <div class="dropdown">
            <button class="btn dropdown-toggle btn-outline-dark" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="color: black; font-size:15px; margin-left:-1%">
                หมวดหมู่ย่อยทั้งหมด
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="#">Action</a></li>
                <li><a class="dropdown-item" href="#">Another action</a></li>
                <li><a class="dropdown-item" href="#">Something else here</a></li>
            </ul>
        </div>
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
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
            <label class="form-check-label" for="flexCheckChecked">
                2,100 - 3,000 บาท
        </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
            <label class="form-check-label" for="flexCheckChecked">
                3,100 - 4,000 บาท
        </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" >
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