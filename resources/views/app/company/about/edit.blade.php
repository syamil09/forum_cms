@extends('layouts.app')

@section('title','Forum | Community')

@section('section_header')
<h1>About Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">AboutCommunity</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>About Community</h4>
      </div>
      <div class="card-body">
        @if ($about == null)
        <form method="POST" action="{{  url('company/about/add') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
        @else
        <form method="POST" action="{{  url('company/about/update/'.$about['company_id']) }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
        @endif
        @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Image</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" @if ($about != null) style="background-image: url({{$about['image']}});" @endif>
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">History</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="history">@if ($about != null){{$about['history']}} @endif</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">secretariat</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="@if ($about != null) {{$about['secretariat']}} @endif" name="secretariat">
            </div>
          </div>
          <div class="form-group row mb-4">
              <div class="col-sm-12 col-md-4 offset-2">
                <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="@if ($about != null) {{$about['latitude']}} @endif">
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="@if ($about != null) {{$about['longitude']}} @endif">
              </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/community')}}" class="btn btn-secondary">Cancel</a>
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
