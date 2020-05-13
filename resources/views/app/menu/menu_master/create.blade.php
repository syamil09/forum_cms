@extends('layouts.app')

@section('title','Forum | Menu')

@section('section_header')
    <h1>Create Menu Master</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Menu</a></div>
        <div class="breadcrumb-item"><a href="{{ route('master-menu.index') }}">Menu Master</a></div>
        <div class="breadcrumb-item">Create</div>
    </div>
@endsection

@section('wrap_content')
    {{-- Style Validation --}}
    <style>
        .has-error .select2-selection{
            border: 1px solid #FF0000;
            border-radius: 4px;
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
                </div>
                <div class="card-body">
                    <form id="createMenu" method="POST" action="{{  route('master-menu.store') }}">
                        @csrf
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Name</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="name" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Url</label>
                            <div class="col-sm-12 col-md-7">
                                <input name="url" type="text" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Group Menu</label>
                            <div class="col-sm-12 col-md-7">
                                <select class="form-control select2-icon" name="group_id" required>
                                    <option value="" data-icon=""> -- Select One -- </option>
                                    @foreach($GroupMenus as $groupMenu)
                                        <option value="{{ $groupMenu['id'] }}" data-icon="{{ $groupMenu['icon'] }}">{{ $groupMenu['name'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row mb-4">
                            <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3"></label>
                            <div class="col-sm-12 col-md-7">
                                <a class="btn btn-secondary" href="{{ route('master-menu.index') }}">Cancel</a>
                                <button id="btnSubmit" class="btn btn-primary">Create Menu</button>
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
        $('#createMenu').validate();
    </script>
    {{-- End Valiidatoor --}}
    <script>
        function formatText (icon) {
            return $('<span> ' + $(icon.element).data('icon') + '</i> ' + icon.text + '</span>');
        };

        $('.select2-icon').select2({
            width: "100%",
            templateSelection: formatText,
            templateResult: formatText
        }).on("select2:select", function (evt) {
            $(this).valid();
        });
        $('#createMenu').valid();
    </script>
@endsection
