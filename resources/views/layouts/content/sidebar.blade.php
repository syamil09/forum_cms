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
            <li class="{{ (request()->is('/')) ? 'active' : '' }}">
                <a href="{{ url('/') }}" class="nav-link"><i class=" fas fa-fire"></i><span>Dashboard</span></a>
            </li>
            <li class="menu-header">Starter</li>
            @php($GroupMenus = new \App\Helpers\Menu())
            @foreach($GroupMenus->list(true) as $GroupMenu)
                @if($GroupMenu['totalMenu'] > 0)
                <li class="nav-item dropdown wrap-menu">
                    <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"> {!! $GroupMenu['icon'] !!}<span>{{ $GroupMenu['name'] }}</span></a>
                    <ul class="dropdown-menu">
                        @foreach($GroupMenu['menu'] as $menu)
                            @if($menu['view'] == 1)
                                <li class="{{ (request()->is($menu['url'].'*')) ? 'active' : '' }}">
                                    <a class="submenu nav-link" href="{{ url($menu['url']) }}">{{ $menu['name'] }}</a>
                                </li>
                            @endif
                        @endforeach
                    </ul>
                </li>
                @endif
            @endforeach
            {{--<li class="nav-item dropdown">--}}
            {{--<a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-users"></i> <span>Manage--}}
            {{--Users</span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a class="nav-link" href="{{ url('account/user/') }}">Member Company</a></li>--}}
            {{--<li><a class="nav-link" href="{{ url('account/admin/') }}">Admin Company</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="nav-item dropdown">--}}
            {{--<a href="#" class="nav-link has-dropdown"><i class="fas fa-th"></i> <span>General</span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a class="nav-link" href="{{ url('general/article/') }}">Article</a></li>--}}
            {{--<li><a class="nav-link" href="{{ url('general/article_category/') }}">Article Category</a></li>--}}
            {{--<li><a class="nav-link" href="{{ url('general/event/') }}">Event</a></li>--}}
            {{--<li><a class="nav-link" href="{{ url('general/vote') }}">Vote</a></li>--}}
            {{--<!-- <li><a class="nav-link" href="{{ url('general/splashscreen') }}">Splash Screen</a></li> -->--}}
            {{--<li><a class="nav-link" href="{{ url('general/walkthrough') }}">Walk Through</a></li>--}}
            {{--<li><a class="nav-link" href="{{ url('general/highlight') }}">Highlight</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="nav-item dropdown">--}}
            {{--<a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Companies</span></a>--}}
            {{--<ul class="dropdown-menu">--}}
            {{--<li><a class="nav-link" href="{{url('company/community')}}">Community</a></li>--}}
            {{--<li><a class="nav-link" href="{{url('company/secretariat')}}">Secretariat</a></li>--}}
            {{--<li><a class="nav-link" href="{{url('company/shop')}}">Shop</a></li>--}}
            {{--<li><a class="nav-link" href="{{url('company/store')}}">Store</a></li>--}}
            {{--</ul>--}}
            {{--</li>--}}
            {{--</ul>--}}

            <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                    <i class="fas fa-rocket"></i> Documentation
                </a>
            </div>
        </ul>
    </aside>
</div>

@section('script_page')
    <script>
      $(document).ready(function () {

        $('.wrap-menu').each(function(idx,item) {
          var count_menu = $(item).find('.submenu').length;
          if (count_menu === 0) {
            $(item).css({"display":"none"});
          }

          var active_menu = $(item).find('.active');
          if (active_menu.length > 0) {
            $(item).addClass('active');
            $(item).find('.dropdown-menu').addClass('d-block');
          }
          console.log(active_menu);
        });
        

      });

    </script>
@endsection
