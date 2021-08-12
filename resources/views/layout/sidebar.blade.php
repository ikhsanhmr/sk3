<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">SK3</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">SK3</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li>
        <a href="{{ route('dashboard') }}" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Starter</li>
      <li>
        <a href="{{ route('jadwal') }}" class="nav-link"><i class="fas fa-calendar-alt"></i> <span>Jadwal</span></a>
      </li>
      <li>
        <a href="{{ route('evinden') }}" class="nav-link"><i class="fas fa-book"></i> <span>Eviden</span></a>
      </li>
      <li>
        <a href="{{route('unit')}}" class="nav-link"><i class="fas fa-columns"></i> <span>Unit</span></a>
      </li>
      <li>
        <a class="nav-link" href="{{route('user')}}"><i class="far fa-user"></i> <span>User</span></a>
      </li>
    </ul>
  </aside>
</div>
