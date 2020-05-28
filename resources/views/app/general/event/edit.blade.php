@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Events</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">General</a></div>
  <div class="breadcrumb-item"><a href="{{ url('general/event') }}">Event</a></div>
  <div class="breadcrumb-item">Edit Event</div>
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
                    <h4>Edit Event</h4>
                </div>
                <div class="card-body">
                    @if(session('failed'))
                        <div class="alert alert-danger">{{ session('failed') }}</div>
                    @endif
                    <form id="editEvent"  class="" action="{{url('general/event/update/'. $edit['id'])}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" value="{{$edit['title']}}" name="title">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event Start</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="startDate" class="form-control" name="event_start" value="{{$edit['event_start']}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Event End</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" id="endDate" class="form-control" name="event_end" value="{{$edit['event_end']}}" autocomplete="off">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Content</label>
                            <div class="col-sm-12 col-md-7">
                                <textarea class="summernote-simple" name="description">{{$edit['description']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Thumbnail</label>
                            <div class="col-sm-12 col-md-7">
                                <fieldset class="form-group">
                                    <a href="javascript:void(0)" onclick="$('#image').click()" class="btn btn-primary">Upload Image</a>
                                    <input type="file" id="image" name="image[]" style="display: none;" class="form-control" multiple autocomplete="off">
                                </fieldset>
                                <div class="preview-images-zone">
                                    @foreach($edit['image'] as $i => $image)
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
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Location</label>
                            <div class="col-sm-12 col-md-7">
                                <input type="text" class="form-control" name="location" value="{{$edit['location']}}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <div class="col-sm-12 col-md-3 offset-3">
                                <input type="text" name="latitude" class="form-control" placeholder="Latitude..." value="{{ $edit['latitude'] }}">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <input type="text" name="longitude" class="form-control" placeholder="Longitude..." value="{{ $edit['longitude'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <a href="{{url('general/event')}}" class="btn btn-secondary">Cancel</a>
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
    <script>
        $(document).ready(function () {

            $('#startDate').daterangepicker({
                locale: {format: 'YYYY-MM-DD'},
                singleDatePicker: true,
                minDate: new Date()
            }).on('apply.daterangepicker', function(ev, picker) {
                $('#endDate').daterangepicker({
                    locale: {format: 'YYYY-MM-DD'},
                    singleDatePicker: true,
                    minDate: picker.startDate.format('YYYY/MM/DD')
                });
            });

            $('#endDate').daterangepicker({
                locale: {format: 'YYYY-MM-DD'},
                singleDatePicker: true,
                minDate: new Date(),
            });

            document.getElementById('image').addEventListener('change', readImage, false);
            document.getElementById('image').addEventListener("activate", readImage, false);

            $(".preview-images-zone").sortable();

            $(document).on('click', '.image-cancel', function () {
                let no = $(this).data('no');
                $(".preview-image.preview-show-" + no).remove();
            });
        });

            var num = {{ count($edit['image']) }};

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
            $('#createArticle').valid();
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
        $('#editEvent').validate();
    </script>
@endsection
