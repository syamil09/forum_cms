@extends('layouts.app')

@section('title','Forum | Vote')

@section('section_header')
    <h1>Votes</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item">Votes</div>
    </div>
@endsection

@section('wrap_content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <a href="{{ route('vote.create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Voting</a>
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
                        <table id="tableVote" class="table table-striped" style="width:100%">
                            <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th>Title</th>
                                <th>Start</th>
                                <th>End</th>
                                <th>Candidates</th>
                                <th>Total Voter</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($votes as $i => $vote)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{ $vote['title'] }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($vote['start_vote'])) }}</td>
                                    <td>{{ date('d-m-Y H:i', strtotime($vote['end_vote'])) }}</td>
                                    <td>
                                        @foreach($vote['candidates'] as $candidate)
                                            <img class="mr-2 rounded-circle" src="{{$candidate['user']['photo']}}" alt="" width="16px" height="16px">
                                            {{$candidate['user']['name']}} ({{ $candidate['voter'] }}) <br>
                                        @endforeach
                                    </td>
                                    <td>{{ $vote['total_voter'] }}</td>

                                    <td width="150px">
                                        <div class="btn-group">
                                            <a href="{{ route('vote.show', $vote['id']) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <a class="btn btn-warning" href="{{route('vote.edit', $vote['id'])}}"><i class="fa fa-edit"></i></a>
                                        </div>
                                        <div class="btn-group">
                                            <button onclick="delConfirm('{{ route('vote.destroy', $vote['id']) }}')" type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="7">Empty</td>
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

        $("#tableVote").dataTable({
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
