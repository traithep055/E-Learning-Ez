<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
      <div class="sidebar-brand">
        <a href="index.html">EZ Academy</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="index.html">St</a>
      </div>
      <ul class="sidebar-menu">
        <li class="menu-header">Dashboard</li>
        <li class="dropdown active">
          <a href="{{route('admin.dashboard')}}" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
        </li>
        <li class="menu-header">Starter</li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>จัดการประเภท</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.category.index')}}">ประเภท</a></li>  
            <li><a class="nav-link" href="{{route('admin.sub-category.index')}}">ประเภทย่อย</a></li>  
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-columns"></i> <span>จัดการเว็บไซต์</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.coupons.index')}}">คูปอง</a></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-book"></i> <span>รายงาน</span></a>
          <ul class="dropdown-menu">
            <li><a class="nav-link" href="{{route('admin.all-course')}}">คอร์ส</a></li>
            <li><a class="nav-link" href="{{route('admin.bill-report')}}">การซื้อคอร์ส</a></li>
            <li><a class="nav-link" href="{{route('admin.cert-report')}}">ใบประกาศณียบัตร</a></li>
            
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-solid fa-user"></i> <span>Manage Users</span></a>
          <ul class="dropdown-menu">
            <li class=""><a class="nav-link" href="{{route('admin.managebecome_teacher')}}">คำขอเป็นผู้สอน</a></li>
            <li class=""><a class="nav-link" href="{{route('admin.all_users')}}">ผู้ใช้ทั้งหมด</a></li>
            
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