@extends('layouts.app')

@section('title','Forum | Event Gallery')

@section('section_header')
<h1>Event Gallery</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item"><a href="#">Events</a></div>
  <div class="breadcrumb-item">Gallery</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <!-- <h4>Basic DataTables</h4> -->
        <button class="btn btn-lg btn-primary text-white rounded" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>&nbsp Add Photo</button>
      </div>
      <div class="card-body">
        <div class="container">
          @if(session('success'))
          <div class="alert alert-success">{{session('success')}}</div>
          @endif
          @if(session('failed'))
          <div class="alert alert-danger">{{session('failed')}}</div>
          @endif
          <div class="row">
            <div class="col-md-8 offset-2 row">
              @if ($galleries == null)
              <div class="text-center col-md-12 alert alert-secondary">
                No Photo Add Yet
              </div>
              @else
              @foreach ($galleries as $g)
              <div class=" card col-md-3">
                <img src="{{ $g['photo'] }}" alt="event photo" class="card-img-top rounded img-fluid">
                <form action="{{ url('general/event/'.$event_id.'/gallery/delete') }}" method="POST">
                  @csrf
                  <input type="hidden" name="id" value="{{ $g['id'] }}">
                  <button class="btn btn-sm btn-danger mt-1" type="submit">Delete</button>
                </form>
              </div>
              @endforeach
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add Photos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form class="needs-validation" action="{{url('general/event/'.$event_id.'/gallery/store')}}" method="post" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-9 offset-2">
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image[]" id="image-upload" multiple />
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i></button>
      </div>
      </form>
  <!--     <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="{{url('general/event/'.$event_id.'/gallery/store')}}" class="dropzone" id="mydropzone" enctype="multipart/form-data">
                @csrf
                <div class="fallback">
                  <input name="image[]" type="file" multiple />
                  
                </div>
                
              
            </div>
            <div class="modal-footer">
              <button type="button" id="uploadfiles" class="btn btn-primary"><i class="fas fa-plus"></i>&nbspAdd to Gallery</button>
            </div>
            </form>
          </div>
        </div> -->
      </div>
    </div>
  </div>
</div>
@section('script_page')
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
<!-- <script src="{{ asset('stisla/assets/js/page/components-multiple-upload.js') }}"></script> -->
<script>
  Dropzone.autoDiscover = false;

var myDropzone = new Dropzone(".dropzone", { 
   autoProcessQueue: false,
   parallelUploads: 10 ,// Number of files process at a time (default 2)
   url:"{{ url('general/event/'.$event_id.'/gallery/store') }}",
});

$('#uploadfiles').click(function(){
   myDropzone.processQueue();
});
</script>
@endsection
