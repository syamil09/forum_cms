@extends('layouts.app')

@section('title','Forum | Detail Member')

@section('section_header')
<h1>Member Company / Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">ManageUser</a></div>
  <div class="breadcrumb-item"><a href="#">Admin</a></div>
  <div class="breadcrumb-item">Member</div>
</div>
@endsection

@section('wrap_content')

<div class="row justify-content-center text-left">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Photo</label>
              <div class="col-sm-12 col-md-7">
                  <img src="{{$member['photo']}}" alt="photo" style="height: 100px">
              </div>
          </div>
          <div class="form-group">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Username : </label>
						<label>{{$member['username']}}</label>
				  </div>
					<div class="form-group">
						<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Name : </label>
            <label>{{ $member['name']}}</label>
				  </div>
          <div class="form-group">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Email : </label>
            <label>{{$member['email']}}</label>
          </div>
          <div class="form-group">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Birthday : </label>
            <label>{{$member['date_birth']}}</label>
          </div>
          <div class="form-group">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">Phone : </label>
            <label>{{$member['phone']}}</label>
          </div>
          <div class="form-group">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2">City : </label>
            <label>{{$member['city']}}</label>
          </div>

        <a href="{{url('account/user')}}" class="btn btn-secondary">Back</a>
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
