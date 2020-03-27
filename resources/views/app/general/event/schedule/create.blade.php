@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Create Schedule</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item"><a href="#">Event</a></div>
  <div class="breadcrumb-item">CreateSchedule</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Make Schedule</h4>
      </div>
      <div class="card-body">
        <form class="needs-validation" action="{{url('general/event/'.$event_id.'/schedule/store')}}" method="post" enctype="multipart/form-data">
          @csrf
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Date</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="date" value="{{old('date')}}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Time</label>
            <div class="col-sm-12 col-md-7">
              <input type="time" class="form-control" name="time" value="{{old('time')}}">
            </div>
          </div>
          <div class="form-group row mb-4">
            <div class="col-sm-12 col-md-4 offset-2">
              <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="{{old('latitude')}}">
            </div>
            <div class="col-sm-12 col-md-4">
              <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="{{old('longitude')}}">
            </div>
          </div>

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('general/event/'.$event_id.'/schedule')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create Schedule</button>
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
