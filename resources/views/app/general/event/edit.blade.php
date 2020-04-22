@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Events</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">General</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Event</a></div>
  <div class="breadcrumb-item">Edit Event</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Event</h4>
      </div>
      <div class="card-body">
        <form class="" action="{{url('general/event/update/'. $edit['id'])}}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$edit['title']}}" name="title">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event Start</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="event_start" value="{{$edit['event_start']}}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event End</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="event_end" value="{{$edit['event_end']}}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple">{{$edit['description']}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview" style="background-image: url({{ $edit['image'][0] }});">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image[]" id="image-upload" multiple />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$edit['location']}}">
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
              <a href="{{url('general/event')}}" class="btn btn-secondary">Cancel</a>
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
