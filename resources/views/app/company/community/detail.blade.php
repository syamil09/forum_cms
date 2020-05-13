@extends('layouts.app')

@section('title','Forum | Company')

@section('section_header')
<h1>Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">DetailCommunity</div>
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
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Company Name : </label>
          <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['company_name']}}</label>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Company Full Name : </label>
          <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['full_name']}}</label>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">History : </label>
          <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!!$detail['history']!!}</label>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Logo</label>
          <div class="col-sm-12 col-md-7">
            <img src="{{$detail['logo']}}" alt="image" style="height:150px">
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Background</label>
          <div class="col-sm-12 col-md-7">
            <img src="{{$detail['background']}}" alt="image" style="height:200px">
          </div>
        </div>
        <div class="form-group row mb-4">
          <label class="col-form-label text-md-right col-12 col-md-3"></label>
          <div class="col-sm-12 col-md-7">
            <a href="{{url('company/community')}}" class="btn btn-secondary">Back</a>
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
