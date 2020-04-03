<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class VoteController extends Controller
{

    /**
     * Checking key data exist and replace them to the main variable
     *
     * @param $datas
     * @return mixed
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
        $company = session()->get('data')['company_id'];
        $votes = $this->get(env('GATEWAY_URL') . 'vote', $token);
        $users = collect($this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token)['data']);

        if (key_exists('data', $votes)) {
            foreach ($votes['data'] as $iVote => $vote){
                foreach ($vote['candidates'] as $iCandidate => $candidate) {
                    $user = $users->where('id', $candidate['user_id'])->first();
                    $votes['data'][$iVote]['candidates'][$iCandidate] = $user;
                }
            }
        }

        $votes = $this->replaceExistData($votes);
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

        $company = session()->get('data')['company_id'];

        $users = $this->get(env('GATEWAY_URL') . 'user/member?company_id=' . $company, $token);
        $users = $this->replaceExistData($users);

        return view('app.general.vote.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $data['start_vote'] = date('Y-m-d H:i:s', strtotime($data['start_vote']));
        $data['end_vote'] = date('Y-m-d H:i:s', strtotime($data['end_vote']));

        $token = Session::get('token');
        $votes = $this->post(env('GATEWAY_URL') . 'vote/add', $data, $token);

        if ($votes['success']) {
            return redirect()->route('vote.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

        return view('app.general.vote.edit', compact('vote', 'users'));

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
        $data = $request->except(['_token','_method']);
        $data['start_vote'] = date('Y-m-d H:i:s', strtotime($data['start_vote']));
        $data['end_vote'] = date('Y-m-d H:i:s', strtotime($data['end_vote']));

        $token = Session::get('token');
        $vote = $this->post(env('GATEWAY_URL') . 'vote/update/' . $id, $data, $token);

        return redirect(route('vote.index'));
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
