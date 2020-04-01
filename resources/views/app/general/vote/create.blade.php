@extends('layouts.app')

@section('title','Forum | Vote')

@section('section_header')
    <h1>Create Voting</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
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
                    <form method="POST" action="{{  route('vote.store') }}">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="title" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Start Voting</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="start_vote" type="text" class="form-control DateTimeVoting" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">End Voting</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="end_vote" type="text" class="form-control DateTimeVoting" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Candidate</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" style="width: 100%" name="candidates[]"
                                        multiple="multiple" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}"
                                                data-image="{{ $user['photo'] }}">{{ $user['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        {{--<div class="form-group row mb-4">--}}
                            {{--<label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>--}}
                            {{--<div class="col-sm-12 col-md-7">--}}
                                {{--<span class="text-danger">Note: Please make sure before click button create vote, you naver can't edit if voting--}}
                                {{--alerdy started</span>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>

                            <div class="text-md-left col-12 col-md-2 col-lg-2">
                                <a class="btn btn-secondary" href="{{ route('vote.index') }}">Cancel</a>
                                <button class="btn btn-primary">Create Vote</button>
                            </div>
                        </div>
                    </form>
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


        $(".select2").select2({
            templateResult: formatStateResult,
            templateSelection: formatState
        }).on("select2:select", function (evt) {
            var element = evt.params.data.element;
            var $element = $(element);

            $element.detach();
            $(this).append($element);
            $(this).trigger("change");
        });

        function formatStateResult(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var DataImage = $(opt.element).data('image');
            if (!DataImage) {
                return opt.text;
            } else {
                var $opt = $(
                    '<span><img class="rounded-circle" src="' + DataImage + '" alt="avatar" width="32px"> ' + opt.text + '</span>'
                );
                return $opt;
            }
        }
        function formatState(opt) {
            if (!opt.id) {
                return opt.text;
            }
            var DataImage = $(opt.element).data('image');
            if (!DataImage) {
                return opt.text;
            } else {
                var $opt = $(
                    '<span><img class="mr-2 rounded-circle" src="' + DataImage + '" alt="avatar" width="16px"> ' + opt.text + '</span>'
                );
                return $opt;
            }
        }


    </script>
@endsection
