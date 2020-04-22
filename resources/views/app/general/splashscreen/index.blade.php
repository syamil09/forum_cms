@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
    <h1>Splash Screen</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item">Article</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session('success'))
                        <div class="container alert alert-success alert-dismissible" role="alert">
                            {{session('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                    @if(session('failed'))
                        <div class="alert alert-danger">{{session('failed')}}</div>
                    @endif
                    <form method="POST" action="{{ route('SplashScreen.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row mb-12">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Splash Screen</label>
                            <div class="col-sm-12 col-md-7 has-error">
                                <div class="image-preview">
                                    <img id="upload-Preview" src="{{ $file }}" style="width: 250px; height: 250px; position: absolute">
                                    <label for="photoInput" id="image-label">Choose File</label>
                                    <input id="upload-Image" onchange="loadImageFile()" type="file" name="image"/>
                                </div>
                                <input id="imageBase64" type="text" name="imageBase64" hidden>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <a onclick="history.back()" class="btn btn-secondary">Back</a>
                                <a onclick="$('#upload-Preview').attr({src: '{{ $file }}'}); $('#submit').prop('disabled', true);" class="btn btn-warning">Reset</a>
                                <button id="submit" type="submit" class="btn btn-primary" disabled>Update</button>
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
        $(".alert").delay(5000).slideUp(200, function() {
            $(this).alert('close');
        });

        var fileReader = new FileReader();
        var filterType = /^(?:image\/bmp|image\/cis\-cod|image\/gif|image\/ief|image\/jpeg|image\/jpeg|image\/jpeg|image\/pipeg|image\/png|image\/svg\+xml|image\/tiff|image\/x\-cmu\-raster|image\/x\-cmx|image\/x\-icon|image\/x\-portable\-anymap|image\/x\-portable\-bitmap|image\/x\-portable\-graymap|image\/x\-portable\-pixmap|image\/x\-rgb|image\/x\-xbitmap|image\/x\-xpixmap|image\/x\-xwindowdump)$/i;

        fileReader.onload = function (event) {
            var image = new Image();

            image.onload = function () {
                var canvas = document.createElement("canvas");
                var context = canvas.getContext("2d");

                // Force width and height
                canvas.width = 250;
                canvas.height = 250;

                context.drawImage(image,
                    0,
                    0,
                    image.width,
                    image.height,
                    0,
                    0,
                    canvas.width,
                    canvas.height
                );
                // Force set to jpeg and quality 80%
                var img = canvas.toDataURL("image/jpeg", 80);
                $('#upload-Preview').attr({src: img});
                $('#imageBase64').val(img);

            };
            image.src = event.target.result;
        };

        var loadImageFile = function () {
            var uploadImage = document.getElementById("upload-Image");

            //check and retuns the length of uploded file.
            if (uploadImage.files.length === 0) {
                return;
            }

            //validate only image extensions
            var uploadFile = document.getElementById("upload-Image").files[0];
            if (!filterType.test(uploadFile.type)) {
                alert("Please select a valid image.");
                return;
            }

            fileReader.readAsDataURL(uploadFile);
            $('#submit').prop('disabled', false);
        };

    </script>
@endsection
