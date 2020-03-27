@extends('layouts.app')

@section('title','Forum | Schedule Event')

@section('section_header')
<h1>Event Schedule</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item"><a href="#">Events</a></div>
  <div class="breadcrumb-item">Schedule</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- <h4>Basic DataTables</h4> -->
        <a href="{{ url('general/event/'.$event_id.'/schedule/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Schedule</a>
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
                <th>Date</th>
                <th>Time</th>
                <th>Title</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
              @if ($schedules == null)
              <tr>
                <td class="text-center" colspan="4">{{$message}}</td>
              </tr>
              @else
              @foreach ($schedules as $sch)
              <tr>
                <!-- <td>1</td> -->
                <td>{{ $sch['date'] }}</td>
                <td>{{ $sch['time'] }}</td>
                <td>{{ $sch['title'] }}</td>
                <td class="text-center">
                  <a href="schedule/detail/{{$sch['id']}}" class="btn btn-info btn-sm btn-action"><i class="fas fa-info"></i></a>
                  <a href="schedule/edit/{{$sch['id']}}" class="btn btn-warning btn-sm btn-action"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('general/event/'.$event_id.'/schedule/delete') }}" method="post" class="d-inline form-del">
                    @csrf
                    <input type="hidden" name="id" value="{{$sch['id']}}">
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
    </div>
  </div>
</div>

@endsection
