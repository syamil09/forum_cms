@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Edit Item</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">EditItem</div>
</div>
<style>
  .btn_remove{
    margin: -72px 0px 0px 10px;
    position: relative;
    z-index: 10;
  }
</style>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Edit Item</h4>
      </div>
      <div class="card-body">
        @if(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
        <form method="POST" action="{{  url('company/shop/update/'.$shop['id']) }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
        @csrf
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Store</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="store_id">
                @if($store == null)
                <option>Add Store First</option>
                @else
                @foreach ($store as $str)
                  <option value="{{$str['id']}}" @if($shop['store_id'] == $str['id']) selected @endif>{{$str['name']}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" value="{{$shop['name']}}" name="name" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="category_id">
                @foreach ($category as $cat)
                  <option value="{{$cat['id']}}" @if($cat['id'] == $shop['category_id']) selected @endif>{{$cat['category']}}</option>
                @endforeach
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
            <div class="col-sm-12 col-md-7 row">
              <a href="#" class="btn btn-success btn-action add_btn"> <i class="fas fa-plus"></i> </a>
            </div>
          </div>
          <hr>
          <div class="form-group row photos">
            @foreach ($shop['photo'] as $i => $poto)
            <div class="col-sm-12 col-md-3 mb-2" data-idx="{{$i}}">
              <div id="image-preview" class="image-preview" style="background-image: url({{$poto}})">
                <label for="image-upload" class="image-label">Choose File</label>
                <input type="file" name="image[{{$i}}]" class="image-upload" id="image-upload" multiple />
              </div>
              @if($i > 0)<a href="#" class="btn btn-icon btn-sm btn-circle btn-danger btn_remove px-2"><i class="fas fa-times"></i></a>@endif
            </div>
            @endforeach
          </div>
          <hr>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="description" required>{{$shop['description']}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control" name="price" value="{{$shop['price']}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/shop')}}" class="btn btn-secondary">Cancel</a>
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
<script type="text/javascript">

  $(document).ready(function () {
    var wrapper = $(".photos");
    var add_btn = $(".add_btn");
    var last_idx = wrapper.children('div').last().data('idx');

    var x = last_idx + 1;
    $(add_btn).click(function(e) {
      e.preventDefault();
      $(wrapper).append(`
        <div class="col-sm-12 col-md-3 mb-2" data-idx="${x}">
          <div id="image-preview" class="image-preview">
            <label for="image-upload" class="image-label" id="image-label">Choose File</label>
            <input type="file" name="image[${x}]" class="image-upload" id="image-upload" multiple required />
          </div>
          <a href="#" class="btn btn-sm btn-danger btn_remove px-2">
            <i class="fas fa-times"></i>
          </a>
        </div>
        `);
      x++;

    });

    $(wrapper).on('click','.btn_remove',function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    });

    $.uploadPreview({
      input_field: ".photo",   // Default: .image-upload
      preview_box: ".preview",  // Default: .image-preview
      label_field: ".image-label",    // Default: .image-label
      label_default: "Choose File",   // Default: Choose File
      label_selected: "Change File",  // Default: Change File
      no_label: false,                // Default: false
      success_callback: null          // Default: null
    });

  });
</script>

<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
@endsection
