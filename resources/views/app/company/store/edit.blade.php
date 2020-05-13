@extends('layouts.app')

@section('title','Forum | Store')

@section('section_header')
<h1>Store</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('company/store') }}">Company</a></div>
  <div class="breadcrumb-item"><a href="{{ url('company/store') }}">Store</a></div>
  <div class="breadcrumb-item">Edit Store</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit</h4>
      </div>
      <div class="card-body">
        <form class="" action="{{url('company/store/update/'. $edit['id'])}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$edit['name']}}" name="name">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Logo</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" style="background-image: url({{ $edit['logo'] }});">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
            <div class="col-sm-12 col-md-7">
              <input type="tel" class="form-control" value="{{$edit['phone']}}" name="phone">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$edit['location']}}" name="location">
            </div>
          </div>
          <div class="form-group row mb-4">
              <div class="col-sm-12 col-md-4 offset-2">
                <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="{{ $edit['latitude'] }}">
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="{{ $edit['longitude'] }}">
              </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/store')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Save Changes</button>
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
