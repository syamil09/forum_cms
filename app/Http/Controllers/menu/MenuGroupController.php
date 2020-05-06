<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuGroupController extends Controller
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
     * Display list Group Menu
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $token = Session::get('token');

        $GroupMenus = $this->get(env('GATEWAY_URL'). 'group-menu', $token);
        $GroupMenus = $this->replaceExistData($GroupMenus);
        return view('app.menu.menu_group.index', compact('GroupMenus'));
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
        $DateNotAvailable = $this->get(env('GATEWAY_URL') . 'vote/notAvailableDate', $token);
        $users = $this->replaceExistData($users);
        $DateNotAvailable = '"'. implode('","',$this->replaceExistData($DateNotAvailable)) . '"';
        return view('app.menu.menu_group.create', compact('users', 'DateNotAvailable'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->except('_token');

        $token = Session::get('token');
        $GroupMenu = $this->post(env('GATEWAY_URL') . 'group-menu/add', $data, $token);
        if ($GroupMenu['success']) {
            return redirect()->route('group-menu.index')->with('success', 'Success creating group menu');
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
        $token = Session::get('token');

        $GroupMenu = $this->get(env('GATEWAY_URL'). 'group-menu/edit/'.$id, $token);
        $GroupMenu = $this->replaceExistData($GroupMenu);
        return view('app.menu.menu_group.detail', compact('GroupMenu'));
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

        $GroupMenu = $this->get(env('GATEWAY_URL'). 'group-menu/edit/'.$id, $token);
        $GroupMenu = $this->replaceExistData($GroupMenu);

        return view('app.menu.menu_group.edit', compact('GroupMenu'));

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
        $token = Session::get('token');

        $GroupMenu = $this->post(env('GATEWAY_URL') . 'group-menu/update/'. $id, $data, $token);
        return redirect(route('group-menu.index'))->with('success', 'Success update group menu');
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

        $votes = $this->post(env('GATEWAY_URL') . 'group-menu/delete', $data, $token);
        return $votes;
    }
}
