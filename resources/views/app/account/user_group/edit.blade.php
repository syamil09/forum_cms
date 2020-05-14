@extends('layouts.app')

@section('title','Forum | Edit User Group')

@section('section_header')
<h1>Edit User Group</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">ManageUser</a></div>
  <div class="breadcrumb-item">EditUserGroup</div>
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
				<form action="{{ route('user-group.update',$data['id']) }}" method="POST" class="needs-validation" novalidate="">
					@csrf
					@method('PATCH')
					<div class="form-group">
						<label>Name</label>
						<input type="text" class="form-control" name="name" value="{{ $data['name'] }}" required>
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="description" id=""  class="summernote-simple form-control @error('description') is-invalid @enderror" required>{{ $data['description'] }}</textarea>
					</div>

					<a href="{{ route('user-group.index') }}" class="btn btn-secondary">Back</a>
					<button type="submit" class="btn btn-primary">Save Change</button>
					
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
