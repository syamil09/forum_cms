@extends('layouts.app')

@section('title','Forum | Member')

@section('section_header')
<h1>Member Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Member</a></div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('account/user/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i> Add Member</a>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @elseif(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">
                  #
                </th>
                <th width="10%">Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @if($members == null)
              <tr>
                <td colspan="5" align="center">No member</td>
              </tr>
              @else
              @foreach($members as $member)
              <tr>
                <td>
                  {{$loop->iteration}}
                </td>
                <td>
                  <img alt="image" src="{{ $member['photo'] }}" class="rounded-circle" width="35" data-toggle="tooltip" title="{{$member['name']}}">
                </td>
                <td>{{ $member['name'] }}</td>
                <td>{{ $member['email'] }}</td>
                <td>
                  <a href="{{ url('account/user/detail').'/'.$member['id'] }}" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail">
                    <i class="fas fa-info"></i>
                  </a>
                  <a href="{{ url('account/user/edit').'/'.$member['id'] }}" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('account/user/delete') }}" method="POST" class="d-inline">
                    @csrf
                    <input type="hidden" name="id" value="{{ $member['id'] }}">
                    <button type="submit" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete" onclick="return confirm('delete this data?');">
                      <i class="fas fa-trash"></i>
                    </button>
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
