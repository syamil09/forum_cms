@extends('layouts.app')

@section('title','Mesjidku | Add User')

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit user</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@endsection

@section('wrap_content')
<div class="card col-md-10 offset-md-1 shadow">
	<div class="card-body">
		@if(session('failed'))
		<div class="alert alert-danger">{{ session('failed') }}</div>
		@endif
		<form action="{{ url('account/user/update/') }}/{{$user['id']}}" class="" enctype="multipart/form-data" method="post">
			@csrf
			<div class="form-group">
				<label for="">Username</label>
				<input type="text" class="form-control" name="username" value="{{ $user['username'] }}">
			</div>
			<div class="form-group pass">
				<label for="">Password</label>
				<input type="password" class="form-control" id="pass1" name="password">
			</div>
			<div class="form-group pass">
				<label for="">Confirm Password</label>
				<input type="password" class="form-control" id="pass2" name="repassword">
			</div>
			<a href="#" class="btn btn-success mb-2" id="changepass">Change Password</a>
			<div class="form-group">
				<label for="">Name</label>
				<input type="text" class="form-control" name="name" value="{{ $user['name'] }}">
			</div>
			<div class="form-group">
				<label for="">Email</label>
				<input type="email" class="form-control" name="email" value="{{ $user['email'] }}">
			</div>
			<div class="form-group">
				<label for="">Photo</label>
				<div class="form-row">
					<img width="200px" class="rounded mr-2" src="{{ url('/UploadedFile/UserPhoto/'.$user['photo']) }}" alt="Photo Profile">
					
					<input type="file" name="photo" class="form-control col-md-7">
				</div>
				
			</div>
			<div class="form-group">
				<label for="">User Group Privileges</label>
				<select name="privileges" id="" class="form-control">
					<option value="">Please Select</option>
					@foreach($privileges as $opt)
					<option value="{{ $opt['id'] }}" @if($user['privileges'] == $opt['name']) selected @endif>{{ $opt['name'] }}</option>
					@endforeach
				</select>
			</div>
			<div class=" text-center mt-3">
				<button type="submit" id="btn-update" class="btn btn-primary">Update</button>
				<button type="submit" class="btn btn-danger">Reset</button>
				<a href="{{ url('/account/user') }}" class="btn btn-secondary">Back</a>
			</div>
		</form>
	</div>
</div>
@endsection

@section('script')
<script>
	$(document).ready(function () {
		$('.pass').css({"display":"none"});

		$('#changepass').click(function () {
			$("input[name*='password']").val('');
			let txt = $(".pass").is(':hidden') ? 'Unchange Password' : 'Change Password';
			$("#changepass").text(txt);
     		$(".pass").slideToggle();
		});

	});
</script>
@endsection