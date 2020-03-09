<!DOCTYPE html>
<html lang="en">

<head>
  @section('title','Mesjidku | Login')
  @include('layouts.head.head')


</head>

<body class="bg-gradient-primary">

  <div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center" style="margin-top: auto;">

      <div class="col-xl-10 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6 d-none d-lg-block">
                <img src="{{ asset('sb-admin/img/masjid-login.jpg') }}" alt="" class="img-fluid mt-5 ml-4 rounded" style="">
              </div>
              <div class="col-lg-6">
                
                <div class="p-5">
                  @if(session('failed'))
                  <div class="alert alert-danger">{{session('failed')}}</div>
                  @endif
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Mesjidku</h1>
                  </div>
                  <form class="user" method="post" action="{{ url('signin') }}">
                    @csrf
                    <div class="form-group">
                      <input type="username" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" name="username" placeholder="Enter Username...">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="exampleInputPassword" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                      <div class="custom-control custom-checkbox small">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember Me</label>
                      </div>
                    </div>
                    <!-- <a href="index.html" class="btn btn-primary btn-user btn-block">
                      Login
                    </a> -->
                    <button type="submit" id="login" name="submit" class="btn btn-primary btn-user btn-block">Login</button>
                  </form>
                  <hr>
                  <!-- <div class="text-center">
                    <a class="small" href="forgot-password.html">Forgot Password?</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>

      </div>

    </div>

  </div>

@include('layouts.javascript.js')

@if(session('message'))
<script>
  Swal.fire(
  'Your session is expired!',
  'Please login again',
  'info'
  );
</script>
@endif

</body>

</html>
