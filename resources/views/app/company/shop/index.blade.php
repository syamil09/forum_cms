@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Shop</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">Shop</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('company/shop/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Item</a>
      </div>
      <div class="card-body">

        <div class="container-fluid row">
          @if(session('success'))
          <div class="col-12 alert alert-success">{{session('success')}}</div>
          @endif
          @if(session('failed'))
          <div class="col-12 alert alert-danger">{{session('failed')}}</div>
          @endif
          @if ($shops == null)
          <div class="col-12 alert alert-secondary text-center">
            No Item in Shop
          </div>
          @else
          @foreach ($shops as $shop)
          <div class="col-md-3 card">
            <img src="{{$shop['photo'][0]}}" alt="photo" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{$shop['name']}}</h5>
              <p class="card-text btn btn-outline-secondary btn-sm">{{$shop['category']['category']}}</p>
              <div class="form-group row mb-1">
                <div class="col-sm-12 col-md-1 text-md-right">
                  <img src="{{$shop['store']['logo']}}" alt="logo store" style="height:20px">
                </div>
                <label class="col-form-label text-md-left col">{{$shop['store']['name']}}</label>
              </div>
            </div>
            <div class="card-footer text-center">
              <a href="{{url('company/shop/detail/'.$shop['id'])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
              <a href="{{url('company/shop/edit/'.$shop['id'])}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
              <form action="{{ url('company/shop/delete') }}" method="post" class="d-inline delete">
                @csrf
                <input type="hidden" name="id" value="{{$shop['id']}}">
                <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>
              </form>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
    </div>
</div>

@endsection
