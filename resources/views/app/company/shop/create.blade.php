@extends('layouts.app')

@section('title','Forum | Shop')

@section('section_header')
<h1>Post Item</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">Company</a></div>
  <div class="breadcrumb-item">CreateItem</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h4>Create Item</h4>
      </div>
      <div class="card-body">
        @error('image')
        <div class="alert alert-danger">
          {{$message}}
        </div>
        @enderror
        <form method="POST" action="{{  url('company/shop/store') }}" class="needs-validation" novalidate="" enctype="multipart/form-data">
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
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Store</label>
            <div class="col-sm-12 col-md-7">
              <select class="form-control selectric" name="store_id">
                @if($store == null)
                <option>Add Store First</option>
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
                <option>Add Category First</option>
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
              <div id="image-preview" class="image-preview">
                <label for="image-upload" id="image-label">Choose File</label>
                <input type="file" name="image[]" id="image-upload" multiple required />
              </div>
            </div>
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Description</label>
            <div class="col-sm-12 col-md-7">
              <textarea class="summernote-simple @error('description') is-invalid @enderror" name="description">{{old('description')}}</textarea>
            </div>
            @error('description')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
          </div>
          <div class="form-group row mb-4">
            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Price</label>
            <div class="col-sm-12 col-md-7">
              <input type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{old('price')}}">
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
<script src="{{ asset('stisla/assets/js/page/features-post-create.js') }}"></script>
@endsection
