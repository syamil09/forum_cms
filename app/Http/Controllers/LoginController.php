<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $response = $this->post(env('GATEWAY_URL').'admin/signin',$req->all());
        // dd($response);
        if($response['success'])
        {
            $privileges = $this->get(env('GATEWAY_URL').'user-privileges/show/'.$response['data']['id'],$response['token']);
            $dataSession = [
                'company_id'    => $response['data']['company_id'],
                'user_id'       => $response['data']['id'],
                'username'      => $response['data']['username'],
                'email'         => $response['data']['email'],
                'photo'         => $response['data']['photo'],
                'user_group_id' => $response['data']['user_group_id']
            ];
            $privileges = $privileges['success'] ? $privileges['data'] : [];
            // $req->session()->flush();
            $req->session()->put('token',$response['token']);
            $req->session()->put('data',$dataSession);
            $req->session()->put('privileges',$privileges);

            return redirect('/')->with('success','You are login');
        }
        return redirect('/login')->with('failed','Invalid email / password');

    }

    public function login()
    {
        return view('app.auth.login');
    }

    public function cekSession(Request $req)
    {
        if($req->session()->has('token'))
        {
            $profile = $this->get(env('GATEWAY_URL').'user/profile',session()->get('token'));
            // $dataProfile = $profile['data'];
            // $req->session()->put('username',$dataProfile['username']);
            // $req->session()->put('photo',$dataProfile['photo']);
            // $req->session()->put('data-user',$dataProfile);
            return view('app.dashboard');
        }else {
            return redirect('login');
        }
    }

    public function logout(Request $req)
    {
        $req->session()->flush();
        Cache::flush();
         return redirect('/');
    }

    public function token(Request $req)
    {
        if($req->session()->has('token'))
        {
            return $req->session()->get('token');
        }
        return 'token not provided';
    }

    public function profile()
    {

    }
    public function hash()
    {
        return Hash::make('superadmin123');
    }
}
