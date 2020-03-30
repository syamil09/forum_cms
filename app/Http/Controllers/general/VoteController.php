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
        $votes = $this->get(env('GATEWAY_URL') . 'vote', $token);
        return $votes;
        $votes = $this->replaceExistData($votes);

        return view('app/general/vote/index', compact('votes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token = Session::get('token');

        // Waiting user list by compnay
        $users = $this->get(env('GATEWAY_URL') . 'user', $token);
        $users = $this->replaceExistData($users);

        return view('app\general\vote\create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
