@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
    <h1>Create Voting</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item"><a href="{{ route('vote.index') }}">Vote</a></div>
        <div class="breadcrumb-item">Create</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Set up voting</h4>
                </div>
                <div class="card-body">
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Voting</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control DateTimeVoting">
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">End Voting</label>
                        <div class="col-sm-12 col-md-7">
                            <input type="text" class="form-control DateTimeVoting">
                        </div>
                    </div>


                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Candidate</label>
                        <div class="col-sm-12 col-md-7">
                            <select class="form-control select2">
                                @if(!empty($users))
                                    @foreach($users as $user)
                                        <option> {{ $user->name }} </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="form-group row mb-4">
                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                        <div class="col-sm-12 col-md-7">
                            <button class="btn btn-primary">Create Post</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script_page')
    <script>
        $('.DateTimeVoting').daterangepicker({
            locale: {format: 'DD-MM-YYYY HH:mm'},
            singleDatePicker: true,
            timePicker: true,
            timePicker24Hour: true,
        });
    </script>
@endsection
