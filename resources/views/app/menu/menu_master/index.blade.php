@extends('layouts.app')

@section('title','Forum | Menu')

@section('section_header')
    <h1>Menu Master</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">Menu</a></div>
        <div class="breadcrumb-item">Menu Master</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('master-menu.create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Voting</a>
                </div>
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
                    <div class="table-responsive">
                        <table id="tableMenu" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Name</th>
                                <th>Url</th>
                                <th>Menu Group</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($Menus as $i => $menu)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $menu['name'] }}</td>
                                    <td>{!! $menu['url'] !!}</td>
                                    <td>{!! $menu['menu_group']['icon'] . ' ' . $menu['menu_group']['name'] !!}</td>

                                    <td width="150px">
                                        {{--<div class="btn-group">--}}
                                            {{--<a href="{{ route('vote.show', $menu['id']) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>--}}
                                        {{--</div>--}}
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="{{route('master-menu.edit', $menu['id'])}}"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <button onclick="delConfirm('{{ route('master-menu.destroy', $menu['id']) }}')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="6">Empty</td>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script_page')
    <script>
        $(".alert").delay(5000).slideUp(200, function() {
            $(this).alert('close');
        });
        $("#tableMenu").dataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": true,
        });


        function delConfirm(url) {
            swal({
                title: "Delete Confirmation?",
                text: "Once deleted, you will not be able to recover this record!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            url: url,
                            type: 'POST',
                            data: {
                                _method:'DELETE',
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'JSON',
                            beforeSend: function () {
                            },
                            success: function (data) {

                                var icon = "success";

                                if (data.success === false) {
                                    icon = 'error'
                                }

                                swal("Deleted!", {
                                    icon: icon,
                                    text: data.message
                                });


                                location.reload();

                            },
                            error: function (error) {
                                swal("Delete Failed !", {
                                    icon: "error",
                                    title: "Delete Failed !",
                                    text: error
                                });
                            }
                        });

                    } else {
                        swal("Your record is safe!");
                    }
                });
        }
    </script>
@endsection
