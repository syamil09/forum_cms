@extends('layouts.app')

@section('title','Forum | Add User Group')

@section('section_header')
<h1>Add User Group</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Modules</a></div>
  <div class="breadcrumb-item">AddUserGroup</div>
</div>
@endsection

@section('wrap_content')
<div class="row justify-content-center">
	<div class="col-8">
		<div class="card">
			<div class="card-body">
				@if(session('failed'))
				<div class="alert alert-danger">{{ session('failed') }}</div>
				@endif
				<form action="{{ route('user-group.store') }}" method="POST" class="needs-validation" novalidate="">
					@csrf
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="escription" id="" cols="30" rows="30" class="form-control" required></textarea>
					</div>

					<button type="submit" class="btn btn-primary">Add Member</button>
					<a href="{{ route('user-group.index') }}" class="btn btn-secondary">Back</a>
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