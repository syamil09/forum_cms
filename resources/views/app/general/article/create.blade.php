@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Create Post</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">CreateArticle</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Write Your Post</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{  url('general/article/store') }}" class="needs-validation" novalidate="">
          @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="title">
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="category">
                  <option value="review">Review</option>
                  <option value="tips & trick">Tips & Trick</option>
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="content">{{old('content')}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
            </div>
          </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control inputtags" name="tag" value="satu, dua, tiga">
            </div>
          </div>
          <!-- <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric">
                <option>Publish</option>
                <option>Draft</option>
                <option>Pending</option>
              </select>
            </div>
          </div> -->
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('general/article')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create Post</button>
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
