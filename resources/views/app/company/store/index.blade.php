@extends('layouts.app')

@section('title','Forum | Store')

@section('section_header')
<h1>Shop Store</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Community</a></div>
  <div class="breadcrumb-item">Store</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- <h4>Basic DataTables</h4> -->
        <a href="{{ url('company/store/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Store</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          @if(session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
          @endif
          @if(session('failed'))
          <div class="alert alert-danger">{{session('failed')}}</div>
          @endif
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <!-- <th class="text-center">#<th> -->
                <th>Name</th>
                <th>Logo</th>
                <th>Phone</th>
                <th>Location</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($store == null)
              <tr>
                <td class="text-center" colspan="4">{{$message}}</td>
              </tr>
              @else
              @foreach ($store as $str)
              <tr>
                <!-- <td>1</td> -->
                <td>{{ $str['name'] }}</td>
                <td>
                  <img src="{{ $str['logo'] }}" alt="logo" style="height: 50px;">
                </td>
                <td>{{ $str['phone'] }}</td>
                <td>{{ $str['location'] }}</td>
                <td class="text-center">
                  <a href="store/detail/{{$str['id']}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                  <a href="store/edit/{{$str['id']}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('company/store/delete') }}" method="post" class="d-inline form-del">
                    @csrf
                    <input type="hidden" name="id" value="{{$str['id']}}">
                    <button type="submit" class="btn btn-danger btn-sm delete"><i class="fas fa-trash"></i></button>
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
</div>

@endsection
