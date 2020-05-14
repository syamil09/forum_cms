@extends('layouts.app')

@section('title','Forum | Group Menu')

@section('section_header')
    <h1>Group Menu</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Menu</a></div>
        <div class="breadcrumb-item"><a href="{{ route('group-menu.index') }}">Group Menu</a></div>
        <div class="breadcrumb-item">Detail Group Menu</div>
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
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Name : </label>
                        <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$GroupMenu['name']}}</label>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Icon : </label>
                        <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{!! $GroupMenu['icon'] !!}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script_page')
    <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection
