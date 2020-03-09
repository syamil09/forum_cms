
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <span class="sidebar-brand d-flex align-items-center justify-content-center">
        <div class="sidebar-brand-icon">
          <i class="fas fa-mosque"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Mesjidku</div>
      </span>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
        <a class="nav-link" href="{{ url('/') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Interface
      </div>

      <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-users"></i>
          <span>Manage User</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Components:</h6>
            <a class="collapse-item" id="user-list" href="{{ url('account/user') }}">User List</a>
            <a class="collapse-item" id="privileges" href="{{ url('account/privileges') }}">User Priveleges</a>
            <a class="collapse-item" href="cards.html">Log Activity</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#site" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-cog"></i>
          <span>Manage Site</span>
        </a>
        <div id="site" class="collapse @if(Session::get('group') == 'general') {{'show'}} @endif" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item @if(Session::get('menu') == 'home') {{'active'}} @endif" href="{{ url('general/home-content') }}">Home Content</a>
            <a class="collapse-item @if(Session::get('menu') == 'contact') {{'active'}} @endif" href="{{ url('general/contact') }}">Contact</a>
            <a class="collapse-item @if(Session::get('menu') == 'about') {{'active'}} @endif" href="{{ url('general/about') }}">About Us</a>
            <a class="collapse-item @if(Session::get('menu') == 'city') {{'active'}} @endif" href="{{ url('general/city') }}">City List</a>
            <a class="collapse-item @if(Session::get('menu') == 'doa') {{'active'}} @endif" href="{{ url('general/doa') }}">Doa & Hadist</a>
            <a class="collapse-item @if(Session::get('menu') == 'news') {{'active'}} @endif" href="{{ url('general/news') }}">News</a>
          </div>
        </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#mesjid" aria-expanded="true" aria-controls="collapseUtilities">
          <i class="fas fa-fw fa-mosque"></i>
          <span>Mesjid</span>
        </a>
        <div id="mesjid" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Custom Utilities:</h6>
            <a class="collapse-item @if(Session::get('menu') == 'mesjid') {{'active'}} @endif" href="{{ url('mesjid/list') }}">Mesjid List</a>
            <a class="collapse-item @if(Session::get('menu') == 'kas') {{'active'}} @endif" href="{{ url('mesjid/kas') }}">Kas Mesjid</a>
            <a class="collapse-item @if(Session::get('menu') == 'kegiatan') {{'active'}} @endif" href="{{ url('mesjid/kegiatan') }}">Kegiatan Mesjid</a>
            <a class="collapse-item @if(Session::get('menu') == 'khutbah') {{'active'}} @endif" href="{{ url('mesjid/khutbah') }}">Khutbah Jumat</a>
            <a class="collapse-item @if(Session::get('menu') == 'ustadz') {{'active'}} @endif" href="{{ url('mesjid/ustadz') }}">Ustadz List</a>
          </div>
        </div>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ url('signout') }}">
          <i class="fas fa-fw fa-sign-out-alt"></i>
          <span>Log Out</span>
        </a>
      </li> 

    </ul>
