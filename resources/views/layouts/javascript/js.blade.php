  <script src="{{ asset('sb-admin/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('js/popper.min.js') }}"></script>
  <script src="{{ asset('sb-admin/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Core plugin JavaScript-->
  <script src="{{ asset('sb-admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Custom scripts for all pages-->
  <script src="{{ asset('sb-admin/js/sb-admin-2.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('sb-admin/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('sb-admin/js/demo/chart-area-demo.js') }}"></script>
  <script src="{{ asset('sb-admin/js/demo/chart-pie-demo.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('sb-admin/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('sb-admin/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

  <!-- Page level custom scripts -->
  <script src="{{ asset('sb-admin/js/demo/datatables-demo.js') }}"></script>

  <!-- ckedtor -->
  <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>

  <!-- custom js -->
  <script src="{{ asset('js/url.js') }}"></script>
  <!-- sweetalert -->
  <script src="{{ asset('js/sweetalert2.js') }}"></script>
      <!-- select2 -->
  <script src="{{ asset('select2/js/select2.min.js') }}"></script>

  @if(session('fail'))
  <script>
    Swal.fire(
      'Access denied',
      'You do not have access rights to this menu',
      'error'
    );
  </script>
  @endif
  <script>
    $(document).ready(function () {
      $('.select').select2();
    });

    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    });
  </script>
