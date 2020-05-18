@extends('layouts.app')

@section('title','Forum | Add Admin')

@section('section_header')
<h1>Admin Company / Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">ManageUser</a></div>
  <div class="breadcrumb-item"><a href="#">Admin</a></div>
  <div class="breadcrumb-item">AddAdmin</div>
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
				<form action="{{url('account/admin/store')}}" method="POST" class="" novalidate enctype="multipart/form-data">
          @csrf
          <div class="form-group">
						<label>Company / Community</label>
						<select class="form-group selectric" name="company_id">
              <option disabled selected>-- SELECT COMPANY / COMMUNITY --</option>
              @foreach($company as $com)
              <option value="{{$com['id']}}">{{$com['company_name']}}</option>
              @endforeach
            </select>
				  </div>
          <div class="form-group">
            <label>User Group</label>
            <select class="form-group select2 selectric" name="user_group_id">
              <option disabled selected>-- SELECT USER GROUP --</option>
              @forelse($userGroups as $userGroup)
              <option value="{{ $userGroup['id'] }}">{{ $userGroup['name'] }}</option>
              @empty
              <option value="">User Group Empty</option>
              @endforelse
            </select>
          </div>
          <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
              <div class="col-sm-12 col-md-7">
                  <div id="image-preview" class="image-preview">
                      <label for="image-upload" id="image-label">Choose File</label>
                      <input type="file" name="image" id="photo" required />
                  </div>
              </div>
          </div>
          <div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" value="{{old('username')}}">
				  </div>
					<div class="form-group">
						<label>Name</label>
						<input type="text" name="name" class="form-control" value="{{old('name')}}">
				  </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{old('email')}}">
          </div>
				  <div class="form-group">
						<label>password</label>
						<input type="password" name="password" class="form-control">
				  </div>
				  <div class="form-group">
						<label>Confirm Password</label>
						<input type="password" name="confirm" class="form-control">
				  </div>
            <a href="{{url('account/admin')}}" class="btn btn-secondary">Cancel</a>
            <button type="submit" class="btn btn-primary">Add Admin</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection

@section('script_page')
<script>
$.uploadPreview({
            input_field: "#photo",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });
</script>

<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>


@endsection
