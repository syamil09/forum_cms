@extends('layouts.app')

@section('title','Forum | Highlight')

@section('section_header')
<h1>Highlight</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">General</a></div>
    <div class="breadcrumb-item">Detail Highlight</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Detail</h4>
            </div>
            <div class="card-body">
                @foreach ($highlight as $highlight)
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Title : </label>
                    @if ($highlight['module_name'] == 'article')
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['article']['title']}}</label>
                    @else
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['event']['title']}}</label>
                    @endif
                </div>
                @if ($highlight['module_name'] == 'article')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Category : </label>
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['article']['category']['category']}}</label>
                </div>
                @else
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                        <img src="{{$highlight['event']['image']}}" alt="Thumbnail" style="height:270px">
                    </div>
                </div>
                @endif
                @if ($highlight['module_name'] == 'article')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Content : </label>
                    <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!!
                        $highlight['article']['content']
                        !!}</label>
                </div>
                @else
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event Start : </label>
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['event']['event_start']}}</label>
                </div>
                @endif
                @if ($highlight['module_name'] == 'article')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Thumbnail</label>
                    <div class="col-sm-12 col-md-7">
                        <img src="{{$highlight['article']['image']}}" alt="Thumbnail" style="height:270px">
                    </div>
                </div>
                @else
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event End : </label>
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['event']['event_end']}}</label>
                </div>
                @endif
                @if ($highlight['module_name'] == 'article')
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Tags : </label>
                    <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">
                        @forelse ($highlight['article']['tags'] as $tag)
                        <span class="badge badge-primary">{{ $tag }}</span>
                        @empty
                        @endforelse
                    </label>
                </div>
                @else
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Content : </label>
                    <!-- <div class="col-sm-12 col-md-7">
                      <textarea class="summernote-simple"></textarea>
                    </div> -->
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{{$highlight['event']['description']}}</label>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Location : </label>
                    <label
                        class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$highlight['event']['location']}}</label>
                </div>
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Maps : </label>
                    <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3"></label>
                </div>
                @endif
                @endforeach
                <div class="form-group row mb-4">
                    <label class="col-form-label text-md-right col-12 col-md-3"></label>
                    <div class="col-sm-12 col-md-7">
                        <a href="{{url('general/highlight')}}" class="btn btn-secondary">Back</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script_page')
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection