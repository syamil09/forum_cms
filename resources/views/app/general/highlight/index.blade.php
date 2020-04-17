@extends('layouts.app')

@section('title','Forum | Highlight')

@section('section_header')
<h1>Highlight</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">General</a></div>
    <div class="breadcrumb-item">Highlight</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <a href="{{ url('general/highlight/create') }}" class="btn btn-lg btn-primary text-white rounded"><i
                        class="fas fa-plus"></i>&nbsp Add Highlight</a>
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
                                <th>#</th>
                                <th>Title</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($highlights as $i => $highlight)
                            <tr>
                                <td>{{ ++$i }}</td>
                                @if ($highlight['module_name'] == 'article')
                                <td>{{ $highlight['article']['title'] }}</td>
                                @else
                                <td>{{ $highlight['event']['title'] }}</td>
                                @endif
                                <td class="text-center">
                                    <a href="highlight/detail/{{$highlight['id']}}" class="btn btn-info"><i
                                            class="fas fa-info"></i></a>
                                    <form action="{{ url('general/highlight/delete') }}" method="post"
                                        class="d-inline form-del">
                                        @csrf
                                        <input type="hidden" name="id" value="{{$highlight['id']}}">
                                        <button type="submit" class="btn btn-danger delete"
                                            onclick="return confirm('delete this data?');"><i
                                                class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center" colspan="6">{{$message}}</td>
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