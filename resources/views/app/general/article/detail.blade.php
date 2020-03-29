@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Article</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">DetailArticle</div>
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Title : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$article['title']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Category : </label>
            <!-- <div class="col-sm-12 col-md-7">
              <select class="form-control selectric">
                  <option value="review">Review</option>
                  <option value="tips & trick">Tips & Trick</option>
              </select>
            </div> -->
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$article['category']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Content : </label>
            <!-- <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple"></textarea>
            </div> -->
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6"><?= $article['content']; ?></label>
          </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Thumbnail</label>
                      <!-- <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" name="image" id="image-upload" />
                        </div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <img src="{{$article['image']}}" alt="Thumbnail" style="height:270px">
                      </div>
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Tags : </label>
                      <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">
                        @foreach ($article['tags'] as $tag)
                        <span class="badge badge-primary">{{ $tag }}</span>
                        @endforeach
                      </label>
                      <!-- <div class="col-sm-12 col-md-7">
                        <input type="text" class="form-control inputtags">
                      </div> -->
                    </div>
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <a href="{{url('general/article')}}" class="btn btn-secondary">Back</a>
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
