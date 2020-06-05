@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
    <h1>Edit Post</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="{{ url('general/article') }}">General</a></div>
        <div class="breadcrumb-item"><a href="{{ url('general/article') }}">Article</a></div>
        <div class="breadcrumb-item">EditArticle</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Your Post</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{  url('general/article/update/'.$edit['id']) }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
                        @csrf
                        @if(session('failed'))
                        <div class="alert alert-danger">{{ session('failed') }}</div>
                        @endif
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" value="{{$edit['title']}}" name="title">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control selectric" name="category_id">
                                    @foreach($categorys as $category)
                                        <option value="{{ $category['id'] }}" @if($category['id'] == $edit['category_id']) selected @endif>{{ $category['category'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" name="content">{{$edit['content']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <div id="image-preview" class="image-preview" style="background-image: url({{$edit['image']}});">
                                    <label for="image-upload" id="image-label">Choose File</label>
                                    <input type="file" name="image" id="image-upload" value="{{$edit['image']}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                            <div class="col-sm-12 col-md-7">

                                <select name="tags[]" class="select2" style="width: 100%;" multiple="multiple">
                                    @foreach($edit['tags'] as $tag)
                                        <option value="{{ $tag }}" selected> {{ $tag }}</option>
                                    @endforeach
                                </select>
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
                                <button type="submit" class="btn btn-primary">Save Changes</button>
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
        $(".select2").select2({
            tags: true
        });
        
        $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });

        function formatStateResult(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var DataImage = $(opt.element).data('image');
            if (!DataImage) {
                return opt.text;
            } else {
                var $opt = $(
                    '<span><img class="rounded-circle" src="' + DataImage + '" alt="avatar" width="32px"> ' + opt.text + '</span>'
                );
                return $opt;
            }
        }
        function formatState(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var DataImage = $(opt.element).data('image');
            if (!DataImage) {
                return opt.text;
            } else {
                var $opt = $(
                    '<span><img class="mr-2 rounded-circle" src="' + DataImage + '" alt="avatar" width="16px"> ' + opt.text + '</span>'
                );
                return $opt;
            }
        }
    </script>
@endsection
