@extends('layouts.app')

@section('title','Forum | Vote')

@section('section_header')
    <h1>Edit Voting</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item"><a href="{{ route('vote.index') }}">Vote</a></div>
        <div class="breadcrumb-item">Edit</div>
    </div>
@endsection

@section('wrap_content')

    {{-- Style Validation --}}
    <style>
        .has-error .select2-selection{
            border: 1px solid #FF0000;
            border-radius: 4px;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
            background-repeat: no-repeat;
            background-position: center right calc(.375em + .1875rem);
            background-size: calc(.75em + .375rem) calc(.75em + .375rem);
        }

        .is-invalid {
            color: red;
        }
    </style>
    {{-- End Style Validation --}}

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Set up voting</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{  route('vote.update', $vote['id']) }}">
                        @csrf
                        <input type="hidden" name="_method" value="PATCH">
                        <input name="company_id" type="text" class="form-control" value="{{ $vote['company_id'] }}" hidden>

                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Title</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="title" type="text" class="form-control" value="{{ $vote['title'] }}" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Voting Period</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="voting_period" type="text" class="form-control rangeDateTimes" value="{{ $vote['start_vote'] . ' - ' . $vote['end_vote'] }}">
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Candidate</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2" style="width: 100%" name="candidates[]" multiple="multiple" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user['id'] }}" data-image="{{ $user['photo'] }}" {{ $user['selected'] }}>{{ $user['name'] }}</option>
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

                            <div class="text-md-left col-12 col-md-7">
                                <a class="btn btn-secondary" href="{{ route('vote.index') }}">Cancel</a>
                                <button class="btn btn-primary">Update Vote</button>
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
        $.validator.setDefaults({
            errorElement: "span",
            errorClass: "is-invalid",
            // 	validClass: 'stay',
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
        $('#createVote').validate();
    </script>
    {{-- End Valiidatoor --}}
    <script>
        var disabledArr = [{!! $DateNotAvailable !!}];

        $('.rangeDateTimes').daterangepicker({
            timePicker: true,
            timePicker24Hour: true,
            minDate: new Date(),
            locale: {
                format: 'D-M-Y H:mm'
            },
            isInvalidDate: function(arg){
                // Prepare the date comparision
                var thisMonth = arg._d.getMonth()+1;   // Months are 0 based
                if (thisMonth<10){
                    thisMonth = "0"+thisMonth; // Leading 0
                }
                var thisDate = arg._d.getDate();
                if (thisDate<10){
                    thisDate = "0"+thisDate; // Leading 0
                }
                var thisYear = arg._d.getYear()+1900;   // Years are 1900 based

                var thisCompare = thisYear +"-"+ thisMonth +"-"+ thisDate;

                if($.inArray(thisCompare,disabledArr)!=-1){
                    return true; //arg._pf = {userInvalidated: true};
                }
            }
        }, function (start, end) {
            var startDateTime = start.format('YYYY-MM-DD H:m');
            var endDateTime = end.format('YYYY-MM-DD H:m');
            if (startDateTime === endDateTime) {
                alert('Please don\'t set end time same value with start time');
                $(this).reset();
            }
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
