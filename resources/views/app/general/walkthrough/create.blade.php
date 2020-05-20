@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Create Walktrough</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">CreateWalkthrough</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Add Walktrough</h4>
      </div>
      <div class="card-body">
        <form class="" action="{{url('general/walkthrough/store')}}" method="post" enctype="multipart/form-data">
          @csrf
          @if($profile['company_id'] == null)
            <div class="form-group row mb-4">
              <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">company_id</label>
              <div class="col-sm-12 col-md-7">
                <select class="form-control selectric" name="company_id">
                @if($company == null)
                  <option>Add Company First</option>
                @else
                  @foreach ($company as $com)
                    <option value="{{$com['id']}}">{{$com['company_name']}}</option>
                  @endforeach
                @endif
                </select>
              </div>
            </div>
          @endif
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="title" value="{{old('title')}}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="description">{{old('description')}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">image</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview">
                <label for="image-upload" class="image-label" id="image-label">Choose File</label>
                <input type="file" name="image" class="image-upload" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('general/walkthrough')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Add Walktrough</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script_page')
<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
@endsection
