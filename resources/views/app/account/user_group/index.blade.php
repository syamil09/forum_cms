@extends('layouts.app')

@section('title','Forum | User Group')

@section('section_header')
<h1>User Group</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">UserGroup</a></div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ route('user-group.create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i> Add User Group</a>
      </div>
      <div class="card-body">
        @if(session('success'))
        <div class="container alert alert-success alert-dismissible" role="alert">
          {{session('success')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @elseif(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">No</th>
                <th width="20%">Name</th>
                <th >Description</th>
                <th width="20%">Action</th>
              </tr>
            </thead>
            <tbody>
              @if($datas == null)
              <tr>
                <td colspan="5" align="center">No member</td>
              </tr>
              @else
              @foreach($datas as $data)
              <tr>
                <td class="text-center">{{$loop->iteration}}</td>
                <td>{{ $data['name'] }}</td>
                <td>{!! $data['description'] !!}</td>
                <td>
                  <a href="{{ url('account/user/detail').'/'.$data['id'] }}" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Privileges">
                    <i class="fas fa-info"></i>
                  </a>
                  <a href="{{ route('user-group.edit',$data['id']) }}" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ route('user-group.destroy',$data['id']) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{ $data['id'] }}">
                    <button type="submit" class="btn btn-danger btn-action delete" data-toggle="tooltip" data-original-title="Delete" ">
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
