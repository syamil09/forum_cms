@extends('layouts.app')

@section('title','Forum | Store')

@section('section_header')
<h1>Store</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Company</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Store</a></div>
  <div class="breadcrumb-item">DetailStore</div>
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Name : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['name']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Logo</label>
            <div class="col-sm-12 col-md-7">
              <img src="{{$detail['logo']}}" alt="Thumbnail" class="img-fluid rounded">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Phone : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['phone']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Location : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['location']}}</label>
          </div>
          <!-- <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Maps : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3"></label>
          </div> -->
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <a href="{{url('company/store')}}" class="btn btn-secondary">Back</a>
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
