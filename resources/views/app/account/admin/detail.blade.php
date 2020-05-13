@extends('layouts.app')

@section('title','Forum | Add Admin')

@section('section_header')
<h1>Admin Company / Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">ManageUser</a></div>
  <div class="breadcrumb-item"><a href="#">Admin</a></div>
  <div class="breadcrumb-item">EditAdmin</div>
</div>
@endsection

@section('wrap_content')
<div class="row justify-content-center text-left">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
          <div class="form-group">
						<label>Company / Community</label>
						<div class="row">
              <div class="col-md-1 offset-1">
                <img src="{{$data['company']['logo']}}" alt="logo" style="height: 50px;">
              </div>
              <div class="col-md-9 offset-1">{{$data['company']['full_name']}}</div>
            </div>
				  </div>
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
              <div class="col-sm-12 col-md-7">
                  <img src="{{$data['photo']}}" alt="photo" style="height: 100px">
              </div>
          </div>
          <div class="form-group">
            <label>Username : </label>
						<label>{{$data['username']}}</label>
				  </div>
					<div class="form-group">
						<label>Name : </label>
            <label>{{ $data['name']}}</label>
				  </div>
          <div class="form-group">
            <label>Email : </label>
            <label>{{$data['email']}}</label>
          </div>

        <a href="{{url('account/admin')}}" class="btn btn-secondary">Back</a>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>
@endsection
