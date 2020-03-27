@extends('layouts.app')

@section('title','Forum | Events')

@section('section_header')
<h1>Events</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">Events</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <!-- <div class="card">
      <div class="card-header">
        <a href="{{ url('general/article/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Article</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">
                  #
                </th>
                <th width="10%">Title</th>
                <th>views</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  1
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-5.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                </td>
                <td>Create a mobile app</td>
                <td>2018-01-20</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>
                  2
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-5.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                </td>
                <td>Redesign homepage</td>
                <td>2018-04-10</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>
                  3
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                </td>
                <td>Backup database</td>
                <td>2018-01-29</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div> -->
    <div class="card">
                  <div class="card-header">
                    <!-- <h4>Basic DataTables</h4> -->
                    <a href="{{ url('general/event/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Event</a>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <!-- <th class="text-center">#<th> -->
                            <th>Title</th>
                            <th>Location</th>
                            <th>Start</th>
                            <th class="text-center">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          @if ($events == null)
                          <tr>
                            <td class="text-center" colspan="4">{{$message}}</td>
                          </tr>
                          @else
                          @foreach ($events as $event)
                          <tr>
                            <!-- <td>1</td> -->
                            <td>{{ $event['title'] }}</td>
                            <td>{{ $event['location'] }}</td>
                            <td>{{ $event['event_start'] }}</td>
                            <td class="text-center">
                              <a href="event/detail/{{$event['id']}}" class="btn btn-info btn-sm btn-action"><i class="fas fa-info"></i></a>
                              <a href="event/edit/{{$event['id']}}" class="btn btn-warning btn-sm btn-action"><i class="fas fa-pencil-alt"></i></a>
                              <form action="{{ url('general/event/delete') }}" method="post" class="d-inline form-del">
                                @csrf
                                <input type="hidden" name="id" value="{{$event['id']}}">
                                <button type="submit" class="btn btn-danger btn-sm btn-action"><i class="fas fa-trash"></i></button>
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
