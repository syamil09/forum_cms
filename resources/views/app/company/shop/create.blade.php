@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Post Item</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">CreateItem</div>
</div>
<style>
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
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Create Item</h4>
      </div>
      <div class="card-body">
        <form method="POST" action="{{  url('company/shop/store') }}" id="createShop" novalidate="" enctype="multipart/form-data">
          @csrf
        @if(session('failed'))
        <div class="alert alert-danger">{{ session('failed') }}</div>
        @endif
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Store</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="store_id">
                @if($store == null)
                <option disabled value="">Add Store First</option>
                @else
                @foreach ($store as $str)
                  <option value="{{$str['id']}}">{{$str['name']}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{old('name')}}" required>
              @error('name')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Category</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="category_id">
                @if($category == null)
                <option disabled value="">Add Category First</option>
                @else
                @foreach ($category as $cat)
                  <option value="{{$cat['id']}}">{{$cat['category']}}</option>
                @endforeach
                @endif
              </select>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Photo</label>
            <div class="col-sm-12 col-md-7">
              <fieldset class="form-group">
                  <a href="javascript:void(0)" onclick="$('#image').click()" class="btn btn-primary">Upload Image</a>
                  <input type="file" id="image" name="image[]" style="display: none;" class="form-control" multiple required autocomplete="off">
              </fieldset>
              <div class="preview-images-zone"></div>
            </div>
            <div class="col-sm-12 col-md-7">
              @error('image')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple @error('description') is-invalid @enderror" name="description" required>{{old('description')}}</textarea>
            </div>
            <div class="col-sm-12 col-md-7">
              @error('description')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}" required>
              @error('price')
              <div class="invalid-feedback">{{$message}}</div>
              @enderror
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/shop')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create</button>
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
<script>
    $(document).ready(function () {
        document.getElementById('image').addEventListener('change', readImage, false);
        document.getElementById('image').addEventListener("activate", readImage, false);

        $(".preview-images-zone").sortable();

        $(document).on('click', '.image-cancel', function () {
            let no = $(this).data('no');
            $(".preview-image.preview-show-" + no).remove();
        });
    });

    var num = 0;

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
                });

                picReader.readAsDataURL(file);
            }
            // $("#image").val(files);
            console.log(files);
        } else {
            console.log('Browser not support');
        }
        $('#createShop').valid();
    }
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
        $('#createShop').validate();
        $('#createShop').valid();
    </script>
    {{-- End Valiidatoor --}}

<!-- <script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script> -->
@endsection
