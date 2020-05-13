@extends('layouts.app')

@section('title','Forum | Member')

@section('section_header')
<h1>Member Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('account/user/') }}">Member</a></div>
  <div class="breadcrumb-item">Detail Member</div>
</div>
@endsection

@section('wrap_content')
<div class="row justify-content-center">
	<div class="col-8">
		<div class="card">
			<div class="card-body">
				<div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Title :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$member['name']}}</label>
		          </div>
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Photo profile</b></label>
		            <div class="col-sm-12 col-md-7">
		              <img src="{{$member['photo']}}" alt="Thumbnail" class="img-fluid rounded">
		            </div>
		          </div>
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Username :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$member['username']}}</label>
		          </div>
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Email :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$member['email']}}</label>
		          </div>
		      
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Date of birth :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$member['date_birth']}}</label>
		          </div>
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>Phone number :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{ $member['phone'] }}</label>
		          </div>
		          <div class="form-group row mb-4">
		            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-2"><b>City :</b> </label>
		            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{ $member['city'] }}</label>
		          </div>
		          <a href="{{ url('account/user') }}" class="btn btn-secondary">Back</a>
			</div>
		</div>
	</div>
</div>
@endsection
