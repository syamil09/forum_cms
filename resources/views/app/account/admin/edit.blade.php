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
<div class="row justify-content-center">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
        @if(session('failed'))
        <div class="alert alert-danger">
          {{session('failed')}}
        </div>
        @endif
				<form action="{{url('account/admin/update/'. $data['id'])}}" method="POST" class="needs-validation" novalidate enctype="multipart/form-data">
          @csrf
          <div class="form-group">
						<label>Company / Community</label>
						<select class="form-group selectric" name="company_id">
              <option disabled>-- SELECT COMPANY / COMMUNITY --</option>
              @foreach($company as $com)
              <option value="{{$com['id']}}" @if($com['id'] == $data['company_id']) selected @endif>{{$com['company_name']}}</option>
              @endforeach
            </select>
				  </div>
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
              <div class="col-sm-12 col-md-7">
                  <div id="preview" class="image-preview" style="background-image: url({{ $data['photo'] }});">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="image" id="photo" />
                  </div>
              </div>
          </div>
          <div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="{{$data['username']}}" required>
				  </div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{$data['name']}}" required>
				  </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{$data['email']}}" required>
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

            <a href="{{url('account/admin')}}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Save Change</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script')
<script type="text/javascript">
  $.uploadPreview({
    input_field: "#photo",   // Default: .image-upload
    preview_box: "#preview",  // Default: .image-preview
    label_field: "#image-label",    // Default: .image-label
    label_default: "Choose File",   // Default: Choose File
    label_selected: "Change File",  // Default: Change File
    no_label: false,                // Default: false
    success_callback: null          // Default: null
  });
</script>

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

<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
@endsection
