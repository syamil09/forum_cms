@extends('layouts.app')

@section('title','Forum | Article Category')

@section('section_header')
<h1>Edit Category</h1>
<div class="section-header-breadcrumb">
    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
    <div class="breadcrumb-item"><a href="#">General</a></div>
    <div class="breadcrumb-item">Edit Category</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Category</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{  url('general/article_category/update/'.$edit['id']) }}"
                    class="needs-validation" novalidate="" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="company_id" value="{{$edit['company_id']}}">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category Name</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control" name="category" value="{{$edit['category']}}">
                            @error('category')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <a href="{{url('general/article_category')}}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">Change Category</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script_page')
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection