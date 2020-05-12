<?php

namespace App\Http\Controllers\menu;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MenuController extends Controller
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
        $Menus = $this->get(env('GATEWAY_URL') . 'menu', $token);
        $Menus = $this->replaceExistData($Menus);
        return view('app.menu.menu_master.index', compact('Menus'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token = Session::get('token');

        $GroupMenus = $this->get(env('GATEWAY_URL'). 'group-menu', $token);
        $GroupMenus = $this->replaceExistData($GroupMenus);

        return view('app.menu.menu_master.create', compact('GroupMenus'));
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
        $Menu = $this->post(env('GATEWAY_URL') . 'menu/add', $data, $token);

        if ($Menu['success']) {
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

        $Menu = $this->get(env('GATEWAY_URL') . 'menu/edit/' . $id, $token);
        $Menu = $this->replaceExistData($Menu);
        return view('app.menu.menu_master.detail', compact('Menu'));
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

        $Menu = $this->get(env('GATEWAY_URL') . 'menu/edit/' . $id, $token);
        $Menu = $this->replaceExistData($Menu);

        $GroupMenus = $this->get(env('GATEWAY_URL'). 'group-menu', $token);
        $GroupMenus = $this->replaceExistData($GroupMenus);

        return view('app.menu.menu_master.edit', compact('Menu', 'GroupMenus'));

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
        $data = $request->except(['_token', '_method']);
        $token = Session::get('token');

        $Menu = $this->post(env('GATEWAY_URL') . 'menu/update/' . $id, $data, $token);
        return $Menu;
        return redirect(route('master-menu.index'))->with('success', 'Success update menu');
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

        $votes = $this->post(env('GATEWAY_URL') . 'menu/delete', $data, $token);
        return $votes;
    }
}
