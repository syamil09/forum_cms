@extends('layouts.app')

@section('title','Forum | Member')

@section('section_header')
<h1>Admin Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Admin Company</a></div>
  <div class="breadcrumb-item"><a href="#">Modules</a></div>
  <div class="breadcrumb-item">AdminCompany</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{url('account/admin/create')}}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i> Add Admin</a>
      </div>
      <div class="card-body">
        @if(session('failed'))
        <div class="alert alert-danger">{{session('failed')}}</div>
        @endif
        @if(session('success'))
        <div class="container alert alert-success alert-dismissible" role="alert">
          {{session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th>Company / Community</th>
                <th width="10%">Photo</th>
                <th>Username</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($admin as $adm)
              <tr>
                <td>{{ $adm['company']['full_name'] }}</td>
                <td>
                  <img src="{{ $adm['photo'] }}" alt="photo" class="rounded" style="width: 50px;">
                </td>
                <td>{{ $adm['username'] }}</td>
                <td>{{ $adm['role'] }}</td>
                <td>
                  <!-- <a class="btn btn-info btn-sm text-white" href="{{url('account/admin/detail/'. $adm['id']) }}"><i class="fas fa-info"></i></a> -->
                  <a title="" class="btn btn-warning btn-sm text-white" href="{{url('account/admin/edit/'. $adm['id']) }}"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('account/admin/delete') }}" method="post" class="d-inline form-del">
                      @csrf
                      <input type="hidden" name="id" value="{{$adm['id']}}">
                      <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @empty
              <tr>
                <td>Data Empty</td>
              </tr>
              @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
