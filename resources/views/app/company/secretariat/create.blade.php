@extends('layouts.app')

@section('title','Forum | Secretariat')

@section('section_header')
<h1>Create Secretariat</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">Create Secretariat</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Create Community</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{  url('company/secretariat/add') }}" class="needs-validation" novalidate=""
          enctype="multipart/form-data">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Community</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="company_id">
                @foreach($communities as $community)
                <option value="{{ $community['id'] }}">{{ $community['full_name'] }} ({{ $community['company_name'] }})
                </option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Address</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="address">{{old('address')}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Longitude</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="longitude">
              @error('longitude')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Latitude</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="latitude">
              @error('latitude')
              <div class="alert alert-danger">{{ $message }}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/secretariat')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script_page')
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection