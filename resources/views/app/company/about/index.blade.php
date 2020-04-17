@extends('layouts.app')

@section('title','Forum | Community')

@section('section_header')
<h1>Community</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">Community</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('company/community/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Community</a>
      </div>
      <div class="card-body">

        <div class="container-fluid row">
          @if(session('success'))
          <div class="col-12 alert alert-success">{{session('success')}}</div>
          @endif
          @if(session('failed'))
          <div class="col-12 alert alert-danger">{{session('failed')}}</div>
          @endif
          @if ($community == null)
          <div class="col-12 alert alert-secondary text-center">
            Not Company Created Yet
          </div>
          @else
          @foreach ($community as $com)
          <div class="col-md-3 card">
            <img src="" alt="logo" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title">{{$com['company_name']}}</h5>
              <!-- <p class="card-text"></p> -->
            </div>
            <div class="card-footer text-center">
              <a href="{{url('company/community/'.$com['id'].'/about')}}" class="btn btn-success btn-sm">About</a>
              <a href="{{url('company/community/detail/'.$com['id'])}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
              <a href="{{url('company/community/edit/'.$com['id'])}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
              <form action="{{ url('company/community/delete') }}" method="post" class="d-inline form-del">
                @csrf
                <input type="hidden" name="id" value="{{$com['id']}}">
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('delete this data?');"><i class="fas fa-trash"></i></button>
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
