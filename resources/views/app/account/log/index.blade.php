@extends('layouts.app')

@section('title','Forum | Log')

@section('section_header')
<h1>Log</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">Account</a></div>
    <div class="breadcrumb-item">Log</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
    <div class="col-12">
        <div class="card">
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
                                <th>#</th>
                                <th>Date</th>
                                <th>User Module</th>
                                <th>User Name</th>
                                <th>IP</th>
                                <th>Agent</th>
                                <th>Method</th>
                                <th>URL</th>
                                <th>Payload</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($logs as $i => $log)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $log['created_at'] }}</td>
                                <td>{{ $log['user_module'] }}</td>
                                @if ($log['user_module'] == 'admin')
                                <td>{{ $log['admin']['username'] }}</td>
                                @elseif ($log['user_module'] == 'member')
                                <td>{{ $log['member']['username'] }}</td>
                                @else
                                <td>Unidentified</td>
                                @endif
                                <td>{{ $log['ip'] }}</td>
                                <td>{{ $log['agent'] }}</td>
                                <td>{{ $log['method'] }}</td>
                                <td>{{ $log['url'] }}</td>
                                <td style="max-width:200px;">{{ $log['payload'] }}</td>
                                <td class="text-center" width="20%">
                                    <form action="{{ url('account/activity/delete') }}" method="post"
                                        class="d-inline form-del">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$log['id']}}">
                                        <button type="submit" class="btn btn-danger delete"
                                            onclick="return confirm('delete this data?');"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6"></td>
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