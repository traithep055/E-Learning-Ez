<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="{{route('admin.dashboard')}}">EZ Academy</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{route('admin.dashboard')}}">EZ</a>
      </div>
      <ul class="sidebar-menu">
        <li class="dropdown active" style="margin-top: 8%">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>แอดมิน</span></a>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span style="font-size: 17px">จัดการหมวดหมู่</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.category.index')}}" style="font-size: 15px">หมวดหมู่หลัก</a></li>
            <li><a class="nav-link" href="{{route('admin.sub-category.index')}}" style="font-size: 15px">หมวดหมู่ย่อย</a></li>
          </ul>
        </li>
        {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-passport"></i> <span style="font-size: 17px">ใบประกาศณียบัตร</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.scorecriteria.index')}}" style="font-size: 15px">เกณฑ์ใบประกาศณียบัตร</a></li>
          </ul>
        </li> --}}
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span style="font-size: 17px">แพ็คเกจ-คูปอง</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.coupons.index')}}" style="font-size: 15px">คูปอง</a></li>
            <li><a class="nav-link" href="{{route('admin.package.index')}}" style="font-size: 15px">แพ็คเกจ</a></li>

          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-book"></i> <span style="font-size: 17px">รายงานทั้งหมด</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.all-course')}}"style="font-size: 15px">จำนวนคอร์สเรียน</a></li>
            <li><a class="nav-link" href="{{route('admin.bill-report')}}"style="font-size: 15px">รายงานการซื้อคอร์ส</a></li>
            <li><a class="nav-link" href="{{route('admin.cert-report')}}"style="font-size: 15px">ผู้ที่ได้รับประกาศณียบัตร</a></li>

          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-user"></i> <span style="font-size: 17px">ควบคุมผู้ใช้งาน</span></a>
          <ul class="dropdown-menu">
            <li class=""><a class="nav-link" href="{{route('admin.managebecome_teacher')}}"style="font-size: 15px">คำขอต้องการเป็นผู้สอน</a></li>
            <li class=""><a class="nav-link" href="{{route('admin.all_users')}}"style="font-size: 15px">ข้อมูลบัญชีผู้ใช้ทั้งหมด</a></li>

          </ul>
        </li>

        {{-- <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>Layout</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="layout-default.html">Default Layout</a></li>
            <li><a class="nav-link" href="layout-transparent.html">Transparent Sidebar</a></li>
            <li><a class="nav-link" href="layout-top-navigation.html">Top Navigation</a></li>
          </ul>
        </li> --}}

        {{-- <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li> --}}

      </ul>


    </aside>
  </div>
