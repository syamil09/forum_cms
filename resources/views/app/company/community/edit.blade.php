@extends('layouts.app')

@section('title','Forum | Company')

@section('section_header')
<h1>Edit Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">EditCommunity</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Community</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{  url('company/community/update/'.$company['id']) }}" class="needs-validation"
          novalidate="" enctype="multipart/form-data">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$company['company_name']}}" name="company_name">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Company Full Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$company['full_name']}}" name="full_name">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Logo</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" style="background-image: url({{$company['logo']}})">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="logo" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Background</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" style="background-image: url({{$company['background']}})">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="background" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">History</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="history">{{$company['history']}}</textarea>
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
