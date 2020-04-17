@extends('layouts.app')

@section('title','Forum | Highlight')

@section('section_header')
<h1>Create Highlight</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">General</a></div>
    <div class="breadcrumb-item">Create Highlight</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Choose to be highlighted</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('general/highlight/store') }}" class="needs-validation"
                    novalidate="" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Module</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="module_name" id="module_name">
                                <option value="article">Article</option>
                                <option value="event">Event</option>
                            </select>
                        </div>
                    </div>
                    <div id="article_list" class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Article</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="module_id_article">
                                @foreach($articles as $article)
                                <option value="{{ $article['id'] }}">{{ $article['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="event_list" class="form-group row mb-4" hidden>
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric" name="module_id_event">
                                @foreach($events as $event)
                                <option value="{{ $event['id'] }}">{{ $event['title'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <a href="{{url('general/highlight')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Create Highlight</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script_page')
<script>
    $(function () {
        $("#module_name").change(function () {
            var val = $(this).val();
            if (val === "article") {
                $("#article_list").attr("hidden", false);
                $("#event_list").attr("hidden", true);
            }
            else if (val === "event") {
                $("#event_list").attr("hidden", false);
                $("#article_list").attr("hidden", true);
            }
        });
    });
</script>
@endsection