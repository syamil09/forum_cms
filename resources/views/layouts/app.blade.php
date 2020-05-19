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

  <script>
    $(document).ready(function() {

      $('table').DataTable().rows().iterator('row',function(context,index) {
        var node = $(this.row(index).node());

        node.find('.delete').each(function(i,item) {
          $(item).on('click', function(e) {
            e.preventDefault(); 
            let form = $(this).parent(); // storing the form
            console.log(form);
              swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                buttons: true,
              }).then(function(isConfirm) {
                console.log('confirm');
                if (isConfirm) {
                  form.submit();
                }
              });
          });
        });
      });
    });
    
  </script>
</body>
</html>
