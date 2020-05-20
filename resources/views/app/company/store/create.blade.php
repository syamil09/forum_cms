@extends('layouts.app')

@section('title','Forum | Store')

@section('section_header')
<h1>Create Store</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">CreateStore</div>
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
        <h4>Create Store</h4>
      </div>
      <div class="card-body">
        <form id="createEvent" class="" action="{{url('company/store/store')}}" method="post" enctype="multipart/form-data">
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="name" value="{{old('name')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Logo</label>
            <div class="col-sm-12 col-md-7">
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image" id="image-upload" />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Phone</label>
            <div class="col-sm-12 col-md-7">
              <input type="tel" class="form-control" name="phone" value="{{old('phone')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
            <div class="col-sm-12 col-md-7">
              <input type="text" class="form-control" name="location" value="{{old('location')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
              <div class="col-sm-12 col-md-4 offset-2">
                <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="{{old('latitude')}}" required>
              </div>
              <div class="col-sm-12 col-md-4">
                <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="{{old('longitude')}}" required>
              </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
            <div class="col-sm-12 col-md-7">
              <a href="{{url('company/store')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create Store</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('script_page')
{{-- Valiidatoor --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.1/dist/jquery.validate.min.js"></script>
    <script>
      $.uploadPreview({
            input_field: "#image-upload",   // Default: .image-upload
            preview_box: "#image-preview",  // Default: .image-preview
            label_field: "#image-label",    // Default: .image-label
            label_default: "Choose File",   // Default: Choose File
            label_selected: "Change File",  // Default: Change File
            no_label: false,                // Default: false
            success_callback: null          // Default: null
        });
      
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
        $('#createEvent').validate();
        $('#createEvent').valid();
    </script>
    {{-- End Valiidatoor --}}
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection
