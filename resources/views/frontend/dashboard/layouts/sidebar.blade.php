<div class="dashboard_sidebar">
    <span class="close_icon">
      <i class="far fa-bars dash_bar"></i>
      <i class="far fa-times dash_close"></i>
    </span>
    <a href="dsahboard.html" class="dash_logo"><img src="images/logo.png" alt="logo" class="img-fluid"></a>
    <ul class="dashboard_link">
      <li><a class="active" href="{{route('user.dashboard')}}"><i class="fas fa-tachometer"></i>Dashboard</a></li>
      <li><a href="{{route('home')}}"><i class="far fa-house"></i> หน้าหลัก</a></li>
      <li><a href="{{route('user.mycourse')}}"><i class="fas fa-solid fa-book"></i> การเรียนรู้ของฉัน</a></li>
      <li><a href="{{route('user.mycourse.review')}}"><i class="far fa-star"></i> รีวิวคอร์ส</a></li>
      <li><a href="dsahboard_wishlist.html"><i class="far fa-heart"></i> Wishlist</a></li>
      <li><a href="{{route('user.profile')}}"><i class="far fa-user"></i> โปรไฟล์</a></li>
      <li><a href="{{route('user.become_teacher')}}"><i class="far fa-gift-card"></i> ขอเป็นผู้สอน</a></li>
      {{-- <li><a href="dsahboard_address.html"><i class="fal fa-gift-card"></i> Addresses</a></li> --}}
      <li>
        
        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <a href="{{route('logout')}}" onclick="event.preventDefault();
          this.closest('form').submit();"><i class="far fa-sign-out-alt"></i> Log out</a>
      </form>
      </li>     
    </ul>
  </div>