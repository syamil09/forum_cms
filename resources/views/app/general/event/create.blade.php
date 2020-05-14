@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Create Event</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">CreateEvent</div>
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
        <h4>Create Event</h4>
      </div>
      <div class="card-body">
        <form id="createEvent" class="" action="{{url('general/event/store')}}" method="post" enctype="multipart/form-data">
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
              <input type="text" class="form-control" name="title" value="{{old('title')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event Start</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="event_start" value="{{old('event_start')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event End</label>
            <div class="col-sm-12 col-md-7">
              <input type="date" class="form-control" name="event_end" value="{{old('event_end')}}" required>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple" name="description" required>{{old('description')}}</textarea>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
            <div class="col-sm-12 col-md-7">
              <a href="#" class="btn btn-success btn-action add_btn"> <i class="fas fa-plus"></i> </a>
            </div>
          </div>
          <hr>
          <div class="form-group row photos">
            <div class="col-sm-12 col-md-3 mt-3">
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image[0]" id="image-upload" multiple required />
              </div>
            </div>
          </div>
          <hr>
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
              <a href="{{url('general/event')}}" class="btn btn-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary">Create Event</button>
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

    var x = 1;
    $(add_btn).click(function(e) {

      e.preventDefault();
      $(wrapper).append(`
        <div class="col-sm-12 col-md-3 mt-3">
          <div id="image-preview${x}" class="image-preview">
            <label for="image-upload" id="image-label${x}">Choose File</label>
            <input type="file" name="image[${x}]" id="image-upload${x}" multiple required />
          </div>
          <a href="#" class="btn btn-sm btn-danger btn_remove px-2">X</a>
        </div>
        `);

      x++;

    });

    $(wrapper).on('click','.btn_remove',function(e) {
      e.preventDefault();
      $(this).parent('div').remove();
      x--;
    });

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
        $('#createEvent').validate();
        $('#createEvent').valid();
    </script>
    {{-- End Valiidatoor --}}

<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection
