@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
    <h1>Votes</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item">Votes</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('vote.create') }}" class="btn btn-success">create new article</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableVote" class="table table-striped display" style="width:100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>End</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($votes as $i => $vote)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $vote['title'] }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($vote['start_vote'])) }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($vote['end_vote'])) }}</td>
                                    <td></td>
                                </tr>
                            @endforeach
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
        $("#tableVote").dataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });
    </script>
@endsection
