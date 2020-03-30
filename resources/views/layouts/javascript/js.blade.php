  <!-- General JS Scripts -->
  <script src="{{ asset('stisla/assets/js/jquery-3.4.1.min.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/popper.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-4.3.1/dist/js/bootstrap.min.js') }}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

  <!-- JS Libraies -->
  <script src="{{ asset('stisla/node_modules/jquery-sparkline/jquery.sparkline.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/chart.js/dist/Chart.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/owl.carousel/dist/owl.carousel.min.js')}}"></script>
  <script src="{{ asset('stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/cleave.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/cleave.js/dist/addons/cleave-phone.us.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery-pwstrength/jquery.pwstrength.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/select2/dist/js/select2.full.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables/media/js/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/datatables.net-select-bs4/js/select.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/summernote/dist/summernote-bs4.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/selectric/public/jquery.selectric.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/jquery_upload_preview/assets/js/jquery.uploadPreview.min.js') }}"></script>
  <script src="{{ asset('stisla/node_modules/dropzone/dist/min/dropzone.min.js') }}"></script>

  <!-- Template JS File -->
  <script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

  <!-- Page Specific JS File -->
  <script src="{{ asset('stisla/assets/js/page/index.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/page/forms-advanced-forms.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/page/modules-datatables.js') }}"></script>
  <script src="{{ asset('stisla/assets/js/page/bootstrap-modal.js') }}"></script>
  <!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
  @yield('script_page')

  
  @if(session('fail'))
  <script>
    Swal.fire(
      'Access denied',
      'You do not have access rights to this menu',
      'error'
    );
  </script>
  @endif
