<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
{

    /**
     * Checking key data exist and replace them to other main variable
     *
     * @param mixed $datas
     * @param bool $multipe
     *
     * @return array|\stdClass
     */
    private function replaceExistData($datas, $multipe = true)
    {
        if (key_exists('data', $datas)) {
            $datas = $datas['data'];
        } else {
            $multipe ? $datas = [] : $datas = new \stdClass();
        }

        return $datas;
    }

    /**
     * Display list vote
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $token = Session::get('token');
        $company = session()->get('data')['company_id'] ? session()->get('data')['company_id'] : session()->get('company_id');
        $votes = $this->get(env('GATEWAY_URL') . 'vote', $token);

        if (key_exists('data', $votes)) {
            $companys = collect($votes['data'])->map(function ($data) {
                return $data['company_id'];
            })->unique();
            $users = [];
            foreach ($companys as $company) {
                $usersCompany = $this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token);
                if (key_exists('data', $usersCompany)) {
                    $users = array_merge($users, $usersCompany['data']);
                }
            }


            foreach ($votes['data'] as $iVote => $vote){
                foreach ($vote['candidates'] as $iCandidate => $candidate) {
                    $user = collect($users)->where('id', $candidate['user_id'])->map(function ($data) {
                        return collect($data)->only(['name','photo']);
                    })->first();
                    $votes['data'][$iVote]['candidates'][$iCandidate]['user'] = $user;
                }
            }
        }

        $votes = $this->replaceExistData($votes);
        // Descending
        rsort($votes);
        return view('app.general.vote.index', compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token = Session::get('token');

        $company = session()->get('data')['company_id'] ? session()->get('data')['company_id'] : session()->get('company_id');

        $users = $this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token);
        $DateNotAvailable = $this->get(env('GATEWAY_URL') . 'vote/notAvailableDate', $token);
        $users = $this->replaceExistData($users);
        $DateNotAvailable = '"'. implode('","',$this->replaceExistData($DateNotAvailable)) . '"';

        return view('app.general.vote.create', compact('users', 'DateNotAvailable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('voting_period');
        $votingPeriod =  explode(' - ', $request->voting_period);
        $data['start_vote'] = date('Y-m-d H:i:s', strtotime($votingPeriod[0]));
        $data['end_vote'] = date('Y-m-d H:i:s', strtotime($votingPeriod[1]));
        
        $token = Session::get('token');
        $votes = $this->post(env('GATEWAY_URL') . 'vote/add', $data, $token);
        if ($votes['success']) {
            return redirect()->route('vote.index')->with('success', $votes['message']);
        }
        return redirect()->route('vote.index')->with('failed', $votes['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $token = Session::get('token');
        $company = session()->get('data')['company_id'];

        $vote = $this->get(env('GATEWAY_URL') . 'vote/edit/' . $id, $token);
        $vote = $this->replaceExistData($vote);
        $candidates = $vote['candidates'];

        $votings = [];

        $users = $this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token);
        $users = collect($this->replaceExistData($users));

        foreach ($candidates as  $i => $candidate){
            $candidates[$i]['user'] = $users->where('id', $candidate['user_id'])->map(function ($data) {
                return collect($data)->only(['name', 'photo']);
            })->first();
        }

        if (key_exists('voting', $vote)) {
            $votings = $vote['voting'];
            foreach ($votings as  $i => $voting){
                $votings[$i]['user'] = $users->where('id', $voting['user_id'])->map(function ($data) {
                    return collect($data)->only(['name', 'photo']);
                })->first();
                $votings[$i]['candidate'] = $users->where('id', $voting['candidate_id'])->map(function ($data) {
                    return collect($data)->only(['name', 'photo']);
                })->first();
            }
        }
        return view('app.general.vote.detail', compact('vote','candidates','votings'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $token = Session::get('token');
        $company = session()->get('data')['company_id'];

        $vote = $this->get(env('GATEWAY_URL') . 'vote/edit/' . $id, $token);
        $vote = $this->replaceExistData($vote);
        $vote['start_vote'] = date('d-m-Y H:i', strtotime($vote['start_vote']));
        $vote['end_vote'] = date('d-m-Y H:i:s', strtotime($vote['end_vote']));
        $users = $this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token);
        $users = $this->replaceExistData($users);

        $selected = collect($users)->whereIn('id', array_column($vote['candidates'], 'user_id'))->map(function($data) {
            $data['selected'] = 'selected';
            return $data;
        })->toArray();

        $users = collect($users)->whereNotIn('id', array_column($vote['candidates'], 'user_id'))->map(function($data) {
            $data['selected'] = '';
            return $data;
        })->toArray();

        $users = array_merge($users, $selected);

        $thisDate = [];
        $period = new \DatePeriod(
            new \DateTime($vote['start_vote']),
            new \DateInterval('P1D'),
            new \DateTime(date('Y-m-d', strtotime($vote['end_vote']."+1 days")))
        );
        foreach ($period as $key => $value) {
            $thisDate[] = $value->format('Y-m-d');
        }
        $DateNotAvailable = $this->get(env('GATEWAY_URL') . 'vote/notAvailableDate', $token);
        $NewDateNot = [];
        if ($DateNotAvailable['success']) {
            $NewDateNot = array_diff($DateNotAvailable['data'], $thisDate);
            
        }
        // $DateNotAvailable = '"'. implode('","',$this->replaceExistData($DateNotAvailable)) . '"';
        $DateNotAvailable = '"'. implode('","',$NewDateNot) . '"';

        return view('app.general.vote.edit', compact('vote', 'users','DateNotAvailable'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->except(['_token','_method', 'voting_period']);
        $votingPeriod =  explode(' - ', $request->voting_period);
        $data['start_vote'] = date('Y-m-d H:i:s', strtotime($votingPeriod[0]));
        $data['end_vote'] = date('Y-m-d H:i:s', strtotime($votingPeriod[1]));

        $token = Session::get('token');
        $vote = $this->post(env('GATEWAY_URL') . 'vote/update/' . $id, $data, $token);

        if ($vote['success']) {
            return redirect()->route('vote.index')->with('success', $vote['message']);
        }
        return redirect()->route('vote.index')->with('failed', $vote['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data['id'] = $id;
        $token = Session::get('token');

        $votes = $this->post(env('GATEWAY_URL') . 'vote/delete', $data, $token);
        return $votes;
    }
}
