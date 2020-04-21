<div class="main-sidebar">
  <aside id="sidebar-wrapper">
    <div class="sidebar-brand">
      <a href="index.html">Forum</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="index.html">St</a>
    </div>
    <ul class="sidebar-menu">
      <li class="menu-header">Dashboard</li>
      <li class=" active">
        <a href="{{ url('/') }}" class="nav-link><i class=" fas fa-fire"></i><span>Dashboard</span></a>
      </li>
      <li class="menu-header">Starter</li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Manage
            Users</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('account/user/') }}">Member Company</a></li>
          <li><a class="nav-link" href="{{ url('account/admin/') }}">Admin Company</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>General</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{ url('general/article/') }}">Article</a></li>
          <li><a class="nav-link" href="{{ url('general/article_category/') }}">Article Category</a></li>
          <li><a class="nav-link" href="{{ url('general/event/') }}">Event</a></li>
          <li><a class="nav-link" href="{{ url('general/vote') }}">Vote</a></li>
          <li><a class="nav-link" href="{{ url('general/splashscreen') }}">Splash Screen</a></li>
          <li><a class="nav-link" href="{{ url('general/walkthrough') }}">Walk Through</a></li>
          <li><a class="nav-link" href="{{ url('general/highlight') }}">Highlight</a></li>
        </ul>
      </li>
      <li class="nav-item dropdown">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Companies</span></a>
        <ul class="dropdown-menu">
          <li><a class="nav-link" href="{{url('company/community')}}">Community</a></li>
          <li><a class="nav-link" href="{{url('company/shop')}}">Shop</a></li>
        </ul>
      </li>
    </ul>

    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
      <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
        <i class="fas fa-rocket"></i> Documentation
      </a>
    </div>
  </aside>
</div>