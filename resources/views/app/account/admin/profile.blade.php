@extends('layouts.app')

@section('title','Forum | Profile')

@section('section_header')
<h1>Profile</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">ManageUser</a></div>
  <div class="breadcrumb-item"><a href="#">Admin</a></div>
  <div class="breadcrumb-item">Profile</div>
</div>
@endsection

@section('wrap_content')
<div class="row justify-content-center">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
        @if(session('failed'))
        <div class="alert alert-danger">
          {{session('failed')}}
        </div>
        @endif
        @if(session('success'))
        <div class="alert alert-success">
          {{session('success')}}
        </div>
        @endif
				<form action="{{url('account/admin/uprof/'. $profile['id'])}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          @csrf
          <div class="form-group text-center">
            <img src="{{ $profile['photo'] }}" alt="photo" style="height:200px;">
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Change Photo</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" style="height: 200px; width:200px;">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group">
						<label>Company / Community</label>
            <select class="form-group selectric" name="company_id" disabled>
              @if($profile['company_id'] != null)
              @foreach($company as $com)
              <option value="{{$com['id']}}" @if($com['id'] == $profile['company_id']) selected @endif>{{$com['company_name']}}</option>
              @endforeach
              @else
              <option selected disabled>-- SELECT COMPANY / COMMUNITY --</option>
              @endif
            </select>
				  </div>
          <div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="{{$profile['username']}}" required>
				  </div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{$profile['name']}}" required>
				  </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{$profile['email']}}">
          </div>
          <div class="form-group">
						<label>Old Password</label>
						<input type="password" name="oldpassword" class="form-control">
				  </div>
				  <div class="form-group">
						<label>New Password</label>
						<input type="password" name="password" class="form-control">
				  </div>
				  <div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="confirm" class="form-control">
				  </div>

            <!-- <a href="{{url('account/admin')}}" class="btn btn-secondary">Cancel</a> -->
            <button type="submit" class="btn btn-primary">Save Change</button>
				</form>
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
