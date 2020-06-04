@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Edit Item</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">EditItem</div>
</div>
@endsection

@section('wrap_content')
<style>
  .btn_remove{
    margin: -72px 0px 0px 10px;
    position: relative;
    z-index: 10;
  }
  .is-invalid {
    color: red;
  }

  .preview-images-zone {
    width: 100%;
    border: 1px solid #ddd;
    min-height: 90px;
    /* display: flex; */
    padding: 5px 5px 0px 5px;
    position: relative;
    overflow: auto;
  }

  .preview-images-zone > .preview-image:first-child {
    position: relative;
    margin-right: 5px;
  }

  .preview-images-zone > .preview-image {
    height: 90px;
    width: 90px;
    position: relative;
    margin-right: 5px;
    float: left;
    margin-bottom: 5px;
  }

  .preview-images-zone > .preview-image > .image-zone {
    width: 100%;
    height: 100%;
  }

  .preview-images-zone > .preview-image > .image-zone > img {
    width: 100%;
    height: 100%;
  }

  .preview-images-zone > .preview-image > .tools-edit-image {
    position: absolute;
    z-index: 100;
    color: #fff;
    bottom: 0;
    width: 100%;
    text-align: center;
    margin-bottom: 10px;
    display: none;
  }

  .preview-images-zone > .preview-image > .image-cancel {
    font-size: 18px;
    position: absolute;
    top: 0;
    right: 0;
    font-weight: bold;
    margin-right: 10px;
    cursor: pointer;
    display: none;
    z-index: 100;
  }

  .preview-image:hover > .image-zone {
    cursor: move;
    opacity: .5;
  }

  .preview-image:hover > .image-cancel {
    display: block;
  }
</style>
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
        <form id="editShop" method="POST" action="{{  url('company/shop/update/'.$shop['id']) }}" enctype="multipart/form-data">
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
<!--           <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
            <div class="col-sm-12 col-md-7 row">
              <a href="#" class="btn btn-success btn-action add_btn"> <i class="fas fa-plus"></i> </a>
            </div>
          </div> -->
<!--           <hr>
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
          <hr> -->

          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
            <div class="col-sm-12 col-md-7">
              <fieldset class="form-group">
                <a href="javascript:void(0)" onclick="$('#image').click()" class="btn btn-primary">Upload Image</a>
                <input type="file" id="image" name="image[]" style="display: none;" class="form-control" multiple autocomplete="off">
                <input type="text" id="totalImage" name="totalImage" style="display: none;" class="form-control" multiple>
              </fieldset>
              <div class="preview-images-zone">
              @foreach($shop['photo'] as $i => $image)
                <div class="preview-image preview-show-{{$i}}">
                  <div class="image-cancel" data-no="{{$i}}">x</div>
                  <div class="image-zone"><img id="pro-img-{{$i}}" src="{{ $image }}"></div>
                  <input type="text" name="imageView[]" style="display: none"  class="form-control" value="{{ $image }}">
                </div>
              @endforeach
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="description" required>{{$shop['description']}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Weight (gr)</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="berat" value="{{$shop['berat']}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">kondisi</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="kondisi">
                <option value="baru" @if($shop['kondisi'] === 'baru') selected @endif>Baru</option>
                <option value="bekas" @if($shop['kondisi'] === 'bekas') selected @endif>Bekas</option>
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Min. Pemesanan</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="min_pesanan" value="{{$shop['min_pesanan']}}" required>
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
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
<script type="text/javascript">
  var num = parseInt("{{ count($shop['photo']) }}",10);

  $(document).ready(function () {

    $.uploadPreview({
      input_field: ".photo",   // Default: .image-upload
      preview_box: ".preview",  // Default: .image-preview
      label_field: ".image-label",    // Default: .image-label
      label_default: "Choose File",   // Default: Choose File
      label_selected: "Change File",  // Default: Change File
      no_label: false,                // Default: false
      success_callback: null          // Default: null
    });

    document.getElementById('image').addEventListener('change', readImage, false);
    document.getElementById('image').addEventListener("activate", readImage, false);

    $(".preview-images-zone").sortable();

    $(document).on('click', '.image-cancel', function () {
      let no = $(this).data('no');
      $(".preview-image.preview-show-" + no).remove();
      num--;
      $('#totalImage').val(num);
      if (num == 0) {
        $('#totalImage').val('');
      }
    });

    function readImage() {
      if (window.File && window.FileList && window.FileReader) {
        files = event.target.files;
        var output = $(".preview-images-zone");
        for (let i = 0; i < files.length; i++) {
          var file = files[i];
          if (!file.type.match('image')) continue;

            var picReader = new FileReader();

            picReader.addEventListener('load', function (event) {
              var picFile = event.target;
              var html = '<div class="preview-image preview-show-' + num + '">' +
                              '<div class="image-cancel" data-no="' + num + '">x</div>' +
                              '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                              '</div>';
              output.append(html);
              num = num + 1;
              $('#totalImage').val(num);
              if (num == 0) {
                $('#totalImage').val('');
              }
            });

            picReader.readAsDataURL(file);
        }
            // $("#image").val(files);
                // console.log(files);

      } else {
          console.log('Browser not support');
      }
            // $('#createArticle').valid();
      }

      $.validator.setDefaults({
            errorElement: "span",
            errorClass: "is-invalid",
            ignore: [],
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
        $('#editShop').validate();
  });
</script>

<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
@endsection
