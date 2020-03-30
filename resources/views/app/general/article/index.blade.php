@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Article</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">Article</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="{{ url('general/article/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Article</a>
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
                <th>Title</th>
                <th>Views</th>
                <th>Category</th>
                <th class="text-center">Action</th>
              </tr>
            </thead>
            <tbody>
            @if($articles == null)
              <tr>
                <td class="text-center" colspan="4">{{$message}}</td>
              </tr>
            @else
              @foreach ($articles as $article)
              <tr>
                            <!-- <td>1</td> -->
                <td>{{ $article['title'] }}</td>
                <td>
                  @if($article['views'] == null)
                    {{ 0 }}
                  @else
                    {{ $article['views'] }}
                  @endif
                </td>
                <td>{{ $article['category'] }}</td>
                <td class="text-center">
                  <a href="article/detail/{{$article['id']}}" class="btn btn-info btn-sm"><i class="fas fa-info"></i></a>
                  <a href="{{ url('general/article/edit/').'/'.$article['id'] }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil-alt"></i></a>
                  <form action="{{ url('general/article/delete') }}" method="post" class="d-inline form-del">
                  @csrf
                    <input type="hidden" name="id" value="{{$article['id']}}">
                    <button type="submit" class="btn btn-danger btn-sm delete" onclick="return confirm('delete this data?');"><i class="fas fa-trash"></i></button>
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
