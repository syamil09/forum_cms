@extends('layouts.app')

@section('title','Forum | Member')

@section('section_header')
<h1>Member Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Modules</a></div>
  <div class="breadcrumb-item">MemberCompany</div>
</div>
@endsection

@section('wrap_content')
<div class="row justify-content-center">
	<div class="col-6">
		<div class="card">
			<div class="card-body">
				@if(session('failed'))
				<div class="alert alert-danger">{{ session('failed') }}</div>
				@endif
				<form action="{{ url('account/user/update').'/'.$member['id'] }}" method="POST" class="needs-validation" novalidate="" enctype="multipart/form-data">
					@csrf
					<div class="form-group">
						<label>Photo</label>
						<div class="col-sm-12 col-md-7">
			              <div id="image-preview" class="image-preview" style="background-image: url({{ $member['photo'] }});">
			                <label for="image-upload" id="image-label" class="image-label">Choose File</label>
			                <input type="file" name="photo" id="image-upload" class="image-upload" />
			              </div>
			            </div>
					</div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="{{ $member['name'] }}" required>
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" readonly class="form-control" name="username" value="{{ $member['username'] }}" required>
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" readonly class="form-control" name="email" value="{{ $member['email'] }}" required>
					</div>
					<!-- <div class="form-group">
						<label>Password</label>
						<input type="password" class="form-control" name="password" required>
				    </div> -->
				    <div class="form-group">
						<label>Date of birth</label>
						<input type="date" class="form-control" name="date_birth" value="{{ $member['date_birth'] }}">
					</div>
					<div class="form-group">
						<label>Phone number</label>
						<input type="text" class="form-control" name="phone" value="{{ $member['phone'] }}">
					</div>
					<div class="form-group">
						<label>City</label>
						<input type="text" class="form-control" name="city" value="{{ $member['city'] }}">
					</div>

					<a href="{{ url('account/user') }}" class="btn btn-secondary">Back</a>
					<button type="submit" class="btn btn-primary">Save Change</button>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
