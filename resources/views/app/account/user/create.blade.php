@extends('layouts.app')

@section('title','Mesjidku | Add User')

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h1 mb-0 text-gray-800">Add new user</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@endsection

@section('wrap_content')
<div class="card col-md-10 offset-md-1 shadow">
	<div class="card-body">
		@if(session('failed'))
		<div class="alert alert-danger">{{ session('failed') }}</div>
		@endif
		<form action="store" method="post" enctype="multipart/form-data">
			@csrf
			<div class="form-group">
				<label for="">Username</label>
				<input type="text" name="username" class="form-control @error('username')is-invalid @enderror" value="{{old('username')}}">
				@error('username')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
			<div class="form-group">
				<label for="">Password</label>
				<input type="password" name="password" class="form-control @error('password')is-invalid @enderror" value="{{old('password')}}">
				@error('password')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
			<div class="form-group">
				<label for="">Confirm Password</label>
				<input type="password" name="repassword" class="form-control @error('repassword')is-invalid @enderror" value="{{old('repassword')}}">
				@error('repassword')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" name="name" class="form-control @error('name')is-invalid @enderror" value="{{old('name')}}">
				@error('name')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" name="email" class="form-control @error('email')is-invalid @enderror" value="{{old('email')}}">
				@error('email')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
			<div class="form-group">
				<label for="">Photo</label>
				<input type="file" name="photo" class="form-control @error('password')is-invalid @enderror" value="{{old('password')}}">
				@error('photo')
	            <div class="invalid-feedback">{{$message}}</div>
	            @enderror
			</div>
				<!-- <div class="form-group">
					<label for="">Photo</label>
					<div class="custom-file">
				    <input type="file" class="custom-file-input" id="validatedCustomFile" required value="photo">
				    <label class="custom-file-label" for="validatedCustomFile">Choose a photo...</label>
				    <div class="invalid-feedback">Example invalid custom file feedback</div>
			  		</div>
				</div> -->
			
			<div class="text-center mt-3">
				<button type="submit" class="btn btn-primary">Add User</button>
				<!-- <button type="submit" class="btn btn-danger">Reset</button> -->
				<a href="{{ url('account/user') }}" class="btn btn-secondary">Back</a>
			</div>
		</form>

		<!-- <form class="needs-validation" method="post" action="store" novalidate>
			@csrf
		  <div class="form-row">
		  	<div class="col-md-6">
			    <div class=" mb-3">
			      <label for="validationCustom01">Username</label>
			      <input type="text" class="form-control" id="validationCustom01" placeholder="" value="" required name="username">
			      <div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the username
			      </div>
			    </div>
			    <div class=" mb-3">
			      <label for="validationCustom02">Password</label>
			      <input type="text" class="form-control" id="validationCustom02" placeholder="" value="" required name="password">
			      <div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the password
			      </div>
			    </div>
			    <div class=" mb-3">
			      <label for="validationCustom02">Confirm Password</label>
			      <input type="text" class="form-control" id="validationCustom02" placeholder="" value="" required name="repassword">
			      <div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the Confirm password
			      </div>
			    </div>
			  
			    <div class=" mb-3">
			      <label for="validationCustom02">Photo</label>
			      <div class="custom-file">
					  <input type="file" class="custom-file-input" id="customFile" name="photo">
					  <label class="custom-file-label" for="customFile">Choose file</label>
					</div>
			    </div>
			</div>

			<div class="col-md-6">
				<div class=" mb-3">
			      <label for="validationCustom02">Name</label>
			      <input type="text" class="form-control" id="validationCustom02" placeholder="" value="" required name="name">
			      <div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the name
			      </div>
			    </div>
			    <div class=" mb-3">
			      <label for="validationCustom02">Email</label>
			      <input type="text" class="form-control" id="validationCustom02" placeholder="" value="" required name="email">
			      <div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the email
			      </div>
			    </div>
			  
			    <div class=" mb-3">
			      <label for="validationCustom0">User Privileges</label>
			      <select class="custom-select" name="privileges">
					  <option></option>
					  <option value="Admin">Admin</option>
					  <option value="Super Admin">Super Admin</option>
					</select>
					<div class="valid-feedback">
			        Looks good!
			      </div>
			      <div class="invalid-feedback">
			        Please fill the userprivileges
			      </div>
			    </div>
			</div>
		</div>
		  <button class="btn btn-primary" type="submit">Submit form</button>
		</form> -->
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