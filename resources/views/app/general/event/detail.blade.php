@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Event</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">General</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Event</a></div>
  <div class="breadcrumb-item">DetailEvent</div>
</div>
@endsection

@section('wrap_content')
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


    </style>
<div class="row">
  <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h4>Detail</h4>
        </div>
        <div class="card-body">
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Title : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['title']}}</label>
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
                <div class="preview-images-zone">
                    @foreach($event['image'] as $i => $image)
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event Start : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['event_start']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Event End : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['event_end']}}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Content : </label>
            <!-- <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple"></textarea>
            </div> -->
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-6">{!! $event['description'] !!}</label>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Location : </label>
            <label class="col-form-label text-md-left col-12 col-md-3 col-lg-3">{{$event['location']}}</label>
          </div>
          {{--<div class="form-group row mb-4">--}}
            {{--<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3 offset-1">Maps : </label>--}}
            {{--<label class="col-form-label text-md-left col-12 col-md-3 col-lg-3"></label>--}}
          {{--</div>--}}
                    <div class="form-group row mb-4">
                      <label class="col-form-label text-md-right col-12 col-md-3"></label>
                      <div class="col-sm-12 col-md-7">
                        <a href="{{url('general/event')}}" class="btn btn-secondary">Back</a>
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
