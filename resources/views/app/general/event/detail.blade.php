@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Event</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">General</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Event</a></div>
  <div class="breadcrumb-item">DetailEvent</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Detail</h4>
        </div>
        <div class="card-body">
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Title : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['title']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Thumbnail</label>
            <!-- <div class="col-sm-12 col-md-7">
            <div id="image-preview" class="image-preview">
            <label for="image-upload" id="image-label">Choose File</label>
            <input type="file" name="image" id="image-upload" />
              </div>
            </div> -->
            <div class="col-sm-12 col-md-7">
              <img src="{{$event['image'][0]}}" alt="Thumbnail" class="img-fluid rounded">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event Start : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['event_start']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event End : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['event_end']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Content : </label>
            <!-- <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple"></textarea>
            </div> -->
            <!-- <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!! $event['description'] !!}</label> -->
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Location : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['location']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Maps : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3"></label>
          </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <a href="{{url('general/event')}}" class="btn btn-secondary">Back</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

@endsection

@section('script_page')
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection
