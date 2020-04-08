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
        <div class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4>Participant List ({{ $totalParticipant }})</h4>
                </div>
                <div class="card-body scrollbox" id="scroll" style="height: 38vh; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                    <ul class="list-unstyled list-unstyled-border">
                        @forelse($votings as $voting)
                            <li class="media">
                                <img class="mr-3 rounded" src="{{ $voting['user']['photo'] }}" alt="product" width="55">
                                <div class="media-body">
                                    <div class="float-right"><div class="font-weight-600 text-muted text-small">{{ $voting['created_at'] }}</div></div>
                                    <div class="media-title">{{ $voting['user']['name'] }}</div>
                                    <div class="mt-1">
                                        Vote candidate {{ $voting['candidate']['name'] }}
                                    </div>
                                </div>
                            </li>
                        @empty
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-9">
            <div class="card">
                <div class="card-header">
                    <h4>Candidate</h4>
                </div>
                <div class="card-body" id="scroll">
                    <ul class="list-unstyled user-progress list-unstyled-border list-unstyled-noborder">
                        @foreach($candidates as $candidate)
                            @php($percentage = 0)

                            @php($thisTotal = count(collect($votings)->where('candidate_id', $candidate['user_id'])))
                            @if($thisTotal != 0)
                                @php($percentage = (100 / $totalParticipant) * $thisTotal)
                            @endif
                            <li class="media">
                                <img alt="image" class="mr-3 rounded-circle" src="{{ $candidate['user']['photo'] }}" width="50">
                                <div class="media-body">
                                    <div class="media-title">{{ $candidate['user']['name'] }}</div>
                                    <div class="progress-text">{{ $percentage . '%' }}</div>
                                    <div class="progress" data-height="6" style="height: 6px;">
                                        <div class="progress-bar bg-primary" data-width="{{ $percentage . '%' }}" style="width: {{ $percentage . '%' }};"></div>
                                    </div>
                                    <div data-total="{{ $thisTotal }}" id="votelist-{{ $candidate['user_id'] }}" class="scrollbox" style="display: none; overflow: hidden; outline: currentcolor none medium;" tabindex="2">
                                        <div class="row">
                                            @foreach(collect($votings)->where('candidate_id', $candidate['user_id']) as $voting)
                                                <div class="col-md-6 media mt-3">
                                                    <a class="pr-3" href="#">
                                                        <img class="mr-3 rounded-circle" src="{{ $voting['user']['photo'] }}" alt="Generic placeholder image" width="50">
                                                    </a>
                                                    <div class="media-body">
                                                        <div class="float-right"><div class="font-weight-600 text-muted text-small">{{ $voting['created_at'] }}</div></div>
                                                        <h5 class="mt-0">{{ $voting['user']['name'] }}</h5>
                                                        Vote candidate {{ $voting['candidate']['name'] }}
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                </div>

                                <div class="media-items">
                                    <div class="media-item">
                                        <div class="media-value">{{ $thisTotal }}</div>
                                        <div class="media-label">Votes</div>
                                    </div>
                                </div>

                                <div class="media-cta">
                                    <button href="#" class="btn btn-outline-primary" onclick="Votelist('votelist-{{ $candidate['user_id'] }}')">Detail</button>
                                </div>
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script_page')
    <script>
        $(".scrollbox").niceScroll({
            horizrailenabled:false
        });

        function Votelist(element) {
            var x = document.getElementById(element);
            if (x.style.display === "none" && x.getAttribute('data-total') != 0) {
                x.style.display = "block";
                x.style.height = '150px';
                x.niceScroll();
            } else {
                x.style.display = "none";
            }
        }
    </script>
@endsection
