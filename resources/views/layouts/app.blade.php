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
      // select to for select company
      $('#navbar-company').select2();

      // preview image
      $.uploadPreview({
        input_field: ".image-upload",   // Default: .image-upload
        preview_box: ".image-preview",  // Default: .image-preview
        label_field: ".image-label",    // Default: .image-label
        label_default: "Choose File",   // Default: Choose File
        label_selected: "Change File",  // Default: Change File
        no_label: false,                // Default: false
        success_callback: null          // Default: null
      });

      // set session company_id
      $('#navbar-company').on('change',function(e) {
        var company = $(this).find('option:selected');
        var wrap_company = $('#wrap_company');

        $.ajax({
          url: "{{ url('set_company_id') }}",
          type: 'POST',
          data: {
            _token: '{{ csrf_token() }}',
            company_id: company.val(),
            company_name: company.text()
          },
          dataType: 'JSON',
          beforeSend: function() {
            wrap_company.append(`
              <div class="spinner-border text-light ml-2 loader_company" role="status">
                <span class="sr-only">Loading...</span>
              </div>`);
          },
          success: function(data) {
            $('.loader_company').remove();

            if (data.company_id == null) {
              swal({
                icon:'info',
                title:'Please select company'
              });
              setInterval(function(){
                location.reload()
              },2000);
              
            } else {
              swal({
                title:`company ${data.company_name} selected`,
                icon:'success'
              });
              setInterval(function(){
                location.reload()
              },2000);
            }
            
            console.log(data);
          },
          error: function(error) {
            $('.loader_company').remove();

            swal({
                icon:'error',
                title:'Server Error',
              });
            console.log(error);

          }
        });
      
      });

      // validation delete
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
