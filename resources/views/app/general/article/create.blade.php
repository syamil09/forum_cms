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
{{-- Style Validation --}}
    <style>
        .is-invalid {
            color: red;
        }
    </style>
{{-- End Style Validation --}}
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Write Your Post</h4>
            </div>
            <div class="card-body">
                @if(session('failed'))
                    <div class="alert alert-danger">{{session('failed')}}</div>
                @endif
                <form method="POST" action="{{  url('general/article/store') }}" class="" id="createArticle"
                      novalidate="" enctype="multipart/form-data">
                    @csrf
                    @if($profile['company_id'] == null)
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">company_id</label>
                      <div class="col-sm-12 col-md-7">
                        <select class="form-control selectric" name="company_id">
                          @if($company == null)
                          <option>Add Company First</option>
                          @else
                          @foreach ($company as $com)
                            <option value="{{$com['id']}}">{{$com['company_name']}}</option>
                          @endforeach
                          @endif
                        </select>
                      </div>
                    </div>
                    @endif
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required>
                            @error('title')
                    	      <div class="invalid-feedback">{{$message}}</div>
                    	      @enderror
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control selectric @error('title') is-invalid @enderror" name="category_id">
                                @foreach($categorys as $category)
                                    <option value="{{ $category['id'] }}">{{ $category['category'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                        <div class="col-sm-12 col-md-7">
                            <textarea class="summernote-simple" name="content" required>{{old('content')}}</textarea>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                        <div class="col-sm-12 col-md-7">
                            <div id="image-preview" class="image-preview">
                                <label for="image-upload" id="image-label">Choose File</label>
                                <input type="file" name="image" id="image-upload" required />
                            </div>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tags</label>
                        <div class="col-sm-12 col-md-7">
                            <select name="tags[]" class="select2" style="width: 100%;" multiple="multiple"></select>
                        </div>
                    </div>
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
    </script>
    {{-- Valiidatoor --}}
        <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
        <script>
             $.validator.setDefaults({
                errorElement: "span",
                errorClass: "is-invalid",
                //  validClass: 'stay',
                highlight: function (element, errorClass, validClass) {
                    $(element).addClass(errorClass);
                    $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
                },
                unhighlight: function (element, errorClass, validClass) {
                    $(element).removeClass(errorClass);
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
                },
                errorPlacement: function (error, element) {
                    if (element.parent('.input-group').length) {
                        error.insertAfter(element.parent());
                    } else if (element.hasClass('select2')) {
                        error.insertAfter(element.next('span'));
                    } else {
                        error.insertAfter(element);
                    }
                }
            });
            $('#createArticle').validate();
            $('#createArticle').valid();
        </script>
        {{-- End Valiidatoor --}}

@endsection
