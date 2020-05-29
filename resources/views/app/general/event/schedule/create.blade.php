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
          @if(session('failed'))
            <div class="alert alert-danger">{{ session('failed') }}</div>
          @endif
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="description" required>{{old('description')}}</textarea>
            </div>
          </div>
<!--           <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Date</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="date" value="{{old('date')}}">
            </div>
          </div> -->
<!--           <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Time</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" id="time" name="time" value="{{old('time')}}">
            </div>
          </div> -->
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Date Time</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" id="start" class="form-control" name="date" value="{{old('date')}}" required autocomplete="off">
            </div>
          </div>
          <div class="form-group row mb-4">
            <div class="col-sm-12 col-md-3 offset-3">
              <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="{{old('latitude')}}" required>
            </div>
            <div class="col-sm-12 col-md-3">
              <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="{{old('longitude')}}" required>
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
<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
<script>
  $(document).ready(function() {

    var disabledArr = ["{{ date('Y-m-d',strtotime($event['event_end'].'+1 days')) }}"];
    $('#start').daterangepicker({
      startDate: "{{ date('Y/m/d',strtotime($event['event_start'])) }}",
      minDate: "{{ date('Y/m/d',strtotime($event['event_start'])) }}",
      maxDate: "{{ date('Y/m/d',strtotime($event['event_end'].'+1 days')) }}",
      locale: {format: 'YYYY-MM-DD hh:mm'},
      singleDatePicker: true,
      timePicker: true,
      timePicker24Hour: true,
      drops: 'up',
      isInvalidDate: function(ele) {
        var currDate = moment(ele._d).format('YYYY-MM-DD');
        return disabledArr.indexOf(currDate) != -1;
      }

    });
  });
</script>
@endsection
