<!DOCTYPE html>
<html lang="en">
<head>
  @include('layouts.head.head')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>
      {{-- Navbar --}}
      @include('layouts.content.navbar')
      {{-- End Navbar --}}

      {{-- Navbar --}}
      @include('layouts.content.sidebar')
      {{-- End Navbar --}}

      <!-- Main Content -->
      <div class="main-content">
        <section class="section">
          @include('layouts.content.content')
        </section>
      </div>

      {{-- Footer --}}
      @include('layouts.content.footer')
      {{-- End Footer --}}
    </div>
  </div>

  <!-- General JS Scripts -->
  @include('layouts.javascript.js')
</body>
</html>
