@extends('layouts.app')

@section('title','Forum | Secretariat')

@section('section_header')
<h1>Secretariat</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">Secretariat</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('company/secretariat/create') }}" class="btn btn-lg btn-primary text-white rounded"><i
            class="fas fa-plus"></i>&nbsp Add Secretariat</a>
      </div>
      <div class="card-body">

        <div class="table-responsive">
          @if(session('success'))
          <div class="col-12 alert alert-success">{{session('success')}}</div>
          @endif
          @if(session('failed'))
          <div class="col-12 alert alert-danger">{{session('failed')}}</div>
          @endif
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <!-- <th class="text-center">#<th> -->
                <th>Community</th>
                <th>Address</th>
                <th>Longitude / Latitude</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($secretariat == null)
              <tr>
                <td class="text-center" colspan="4">{{$message}}</td>
              </tr>
              @else
              @foreach ($secretariat as $sec)
              <tr>
                <!-- <td>1</td> -->
                <td>{{ $sec['company']['full_name'] }} ({{ $sec['company']['company_name'] }})</td>
                <td>{!! $sec['address'] !!}</td>
                <td>{{ $sec['longitude'] }} / {{ $sec['latitude'] }}</td>
                <td class="text-center">
                  <a href="{{ url('company/secretariat/edit/').'/'.$sec['id'] }}" class="btn btn-warning btn-sm"><i
                      class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('company/secretariat/delete') }}" method="post" class="d-inline form-del">
                    @csrf
                    <input type="hidden" name="id" value="{{$sec['id']}}">
                    <button type="submit" class="btn btn-danger btn-sm delete"
                      onclick="return confirm('delete this data?');"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  @endsection