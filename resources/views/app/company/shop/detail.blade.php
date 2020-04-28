@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Detail Item</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">DetailItem</div>
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Photo</label>
            <div class="col-sm-12 col-md-7">
              @foreach($detail['photo'] as $photo)
              <div class="col-sm-4">
                <img src="{{$photo}}" alt="photo" style="height:270px">
              </div>
              @endforeach
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Name : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['name']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Category : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['category']['category']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Description : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!! $detail['description'] !!}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Price : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['price']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Phone : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['store']['phone']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Location : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['store']['location']}}</label>
          </div>
          <div class="form-group row mb-4">
            <div class="col-sm-12 col-md-4 text-md-right">
              <img src="{{$detail['store']['logo']}}" alt="logo store" style="height:50px">
            </div>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$detail['store']['name']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/shop')}}" class="btn btn-secondary">Back</a>
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
