@extends('layouts.app')

@section('title','Forum | Events')

@section('section_header')
<h1>Events</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">WalkTehrough</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <!-- <th class="text-center">#<th> -->
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
                <!-- <td>1</td> -->
                <td>
                  <img src="{{ $wt['image'] }}" alt="walkthrough" style="height:100px;">
                </td>
                <td>{{ $wt['title'] }}</td>
                <td class="text-center">
                  <a href="event/detail/{{$wt['id']}}" class="btn btn-info btn-sm btn-action"><i class="fas fa-info"></i></a>
                  <a href="event/edit/{{$wt['id']}}" class="btn btn-warning btn-sm btn-action"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('general/event/delete') }}" method="post" class="d-inline form-del">
                    @csrf
                    <input type="hidden" name="id" value="{{$wt['id']}}">
                    <button type="submit" class="btn btn-danger btn-sm btn-action" onclick="return confirm('delete this data?');"><i class="fas fa-trash"></i></button>
                  </form>
                </td>
              </tr>
              @endforeach
              @endif
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-header">
        <!-- <h4>Basic DataTables</h4> -->
        <a href="{{ url('general/event/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Walktrough</a>
      </div>
    </div>
  </div>
</div>

@endsection
