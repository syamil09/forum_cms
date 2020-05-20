@extends('layouts.app')

@section('title','Forum | Events')

@section('section_header')
<h1>WalkThrough</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">WalkThrough</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('general/walkthrough/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Walktrough</a>
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
                <th>Image</th>
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($walkthrough == null)
              <tr>
                <td class="text-center" colspan="4">{{$message}}</td>
              </tr>
              @else
              @foreach ($walkthrough as $wt)
              <tr>
                <td>
                  <img src="{{ $wt['image'] }}" alt="walkthrough" style="height:100px;">
                </td>
                <td>{{ $wt['title'] }}</td>
                <td class="text-center">
                  <a href="walkthrough/detail/{{$wt['id']}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                  <a href="walkthrough/edit/{{$wt['id']}}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('general/walkthrough/delete') }}" method="post" class="d-inline form-del">
                    @csrf
                    <input type="hidden" name="id" value="{{$wt['id']}}">
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

@section('script_page')
<script>
  $('table').dataTable();
</script>
@endsection