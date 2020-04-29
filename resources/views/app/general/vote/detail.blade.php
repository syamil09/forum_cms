@extends('layouts.app')

@section('title','Forum | Vote')

@section('section_header')
    <h1>Detail Voting {{ $vote['title'] }}</h1>
    <div class="section-header-breadcrumb">
        <div class="breadcrumb-item active"><a href="/">Dashboard</a></div>
        <div class="breadcrumb-item"><a href="#">General</a></div>
        <div class="breadcrumb-item"><a href="{{ route('vote.index') }}">Vote</a></div>
        <div class="breadcrumb-item">Detail</div>
    </div>
@endsection

@section('wrap_content')
    @php($totalParticipant = count($votings))
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-3">
                            <h5>Participant List ({{ $totalParticipant }})</h5>
                            <div class="card-body scrollbox" style="height: 38vh; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                                <ul class="list-unstyled list-unstyled-border">
                                    @forelse($votings as $voting)
                                        <li class="media">
                                            <img class="mr-3 rounded" src="{{ $voting['user']['photo'] }}" alt="product"
                                                 width="55">
                                            <div class="media-body">
                                                <div class="float-right">
                                                    <div
                                                        class="font-weight-600 text-muted text-small">{{ \Carbon\Carbon::createFromDate($voting['created_at'])->diffForHumans(null, true) . ' ago'}}</div>
                                                </div>
                                                <div class="media-title">{{ $voting['user']['name'] }}</div>
                                                <div class="mt-1">
                                                    Vote candidate {{ $voting['candidate']['name'] }}
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li class="media">
                                            empty
                                        </li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-9">
                            <h5>Candidate</h5>
                            <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                                @foreach($candidates as $i => $candidate)
                                    @php($percentage = 0)

                                    @php($thisTotal = count(collect($votings)->where('candidate_id', $candidate['user_id'])))
                                    @if($thisTotal != 0)
                                        @php($percentage = (100 / $totalParticipant) * $thisTotal)
                                    @endif
                                    <li class="media">
                                        <img alt="image" class="mr-3 rounded-circle"
                                             src="{{ $candidate['user']['photo'] }}" width="50">
                                        <div class="media-body">
                                            <div class="media-title">{{ $candidate['user']['name'] }}</div>
                                            <div class="progress-text">{{ $percentage . '%' }}</div>
                                            <div class="progress" data-height="6" style="height: 6px;">
                                                <div class="progress-bar bg-primary"
                                                     data-width="{{ $percentage . '%' }}"
                                                     style="width: {{ $percentage . '%' }};"></div>
                                            </div>
                                        </div>

                                        <div class="media-items">
                                            <div class="media-item">
                                                <div class="media-value">{{ $thisTotal }}</div>
                                                <div class="media-label">Votes</div>
                                            </div>
                                        </div>

                                        <div class="media-cta">
                                            <button class="btn btn-primary" data-toggle="modal" data-target="#detail-vote-{{$i}}">Detail</button>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-lg-12 text-right">
                            <a class="btn btn-secondary" href="{{ route('vote.index') }}">Back</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
@endsection

@section('script_page')
    @foreach($candidates as $i => $candidate)
        @php($data = collect($votings)->where('candidate_id', $candidate['user_id']))
        @if($data->count() > 0)
            <div class="modal fade" tabindex="-1" role="dialog" id="detail-vote-{{$i}}" style="display: none;" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Users voting {{ $candidate['user']['name'] }}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body" style="height: 38vh; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                            <ul class="list-unstyled list-unstyled-border row" >
                                @foreach($data as $voting)
                                    <div class="col-md-6">
                                        <li class="media mt-2">
                                            <img class="mr-4 rounded" src="{{ $voting['user']['photo'] }}" alt="product" width="55px">
                                            <div class="media-body">
                                                <div class="media-title">{{ $voting['user']['name'] }}</div>
                                                <div class="small">
                                                    {{ \Carbon\Carbon::createFromDate($voting['created_at'])->diffForHumans(null, true) . ' ago' }}
                                                </div>
                                            </div>
                                        </li>
                                    </div>
                                @endforeach
                            </ul>
                        </div>
                        <div class="modal-footer bg-whitesmoke br">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach

    <script>
        $(".scrollbox").niceScroll({
            horizrailenabled:false
        });

        $('.modal').on('shown.bs.modal', function(e){
          $('.modal-body').niceScroll({
              autohidemode:false
          });
        }).on('hide.bs.modal', function(e){
          $('.modal-body').niceScroll().remove();
        });


    </script>
@endsection
