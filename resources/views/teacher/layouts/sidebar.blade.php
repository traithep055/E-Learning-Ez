<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="{{route('teacher.dashboard')}}" class="dash_logo"><img src="{{asset('images/logo.png')}}" alt="logo" class="img-fluid" width="100" height="200"></a>
    <ul class="dashboard_link">
      <li><a class="active" href="{{route('teacher.dashboard')}}" style="margin-top: 5%"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{route('teacher.courses.index')}}"><i class="far fa-address-book"></i> คอร์สของฉัน</a></li>
      <li><a href="{{ route('teacher.course-students') }}"><i class="fas fa-solid fa-user"></i> ข้อมูลผู้เรียน</a></li>
      <li><a href="{{route('teacher.course-payment')}}"><i class="fas fa-solid fa-receipt"></i> ข้อมูลการชำระเงิน</a></li>
      <li><a href="{{route('teacher.course-certificate')}}"><i class="fas fa-solid fa-passport"></i> ผู้ที่ได้รับใบประกาศ</a></li>
      <li><a href="{{route('teacher.profile')}}"><i class="far fa-user"></i> โปรไฟล์</a></li>
      <li>
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{route('logout')}}" onclick="event.preventDefault();
          this.closest('form').submit();"><i class="far fa-sign-out-alt"></i>ออกจากระบบ</a>
      </form>
      </li>
    </ul>
  </div>
