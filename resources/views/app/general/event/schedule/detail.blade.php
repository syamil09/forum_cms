@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Event Schedule</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item"><a href="#">Event</a></div>
  <div class="breadcrumb-item">DetailSchedule</div>
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
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$schedule['title']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Description : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!! $schedule['description'] !!}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Date : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$schedule['date']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Time : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$schedule['time']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Maps : </label>
            <div class="col-sm-12 col-md-7">
              <div id="map" style="width:100%;">

              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('general/event/'.$event_id.'/schedule')}}" class="btn btn-secondary">Back</a>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
<input type="hidden" id="latitude" value="{{$schedule['latitude']}}">
<input type="hidden" id="longitude" value="{{$schedule['longitude']}}">

@endsection

@section('script_page')

<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>

<script type="text/javascript">
function initMap(){

  var latitude = document.getElementById('latitude').value;
  var longitude = document.getElementById('longitude').value;
  var latlng = {lat: parseFloat(latitude),lng: parseFloat(longitude)};
  // Map options
  var options = {
    zoom:18,
    center:latlng
  }

  // New map
  var map = new google.maps.Map(document.getElementById('map'), options);

  var marker = new google.maps.Marker({
    map: map,
    position: latlng,
  });


}
</script>

<script type="text/javascript" async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGHV1ICXvXBX_RPNiZL8d-xHwcPFdJ8Rs&callback=initMap"></script>
@endsection
