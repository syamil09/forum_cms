<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class UserController extends Controller
{

    public function index(Request $req)
    {
        $id = session()->get('data')['company_id'];
        $token = session()->get('token');
        $route = 'user/';
        $route = $id != null ? $route.'member?company_id='.$id : $route;
        $response = $this->get(env('GATEWAY_URL'). $route, $token);
        $members  = ($response['success'])?$response['data']:null;

        return view('app.account.user.index',compact('members', 'id'));
    }

    public function create()
    {
        return view('app.account.user.create');
    }


    public function store(Request $request)
    {
        $data = $request->all();
        $token = $request->session()->get('token');
        $com_id = $request->session()->get('data')['company_id'];
        $data['company_id'] = $com_id;

        $validator = Validator::make($request->all(),[
            'username'    => 'required',
            'password'    => 'required',
            // 'repassword'  => 'required',
            'name'        => 'required',
            'email'       => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();
        }

        // if($request->password != $request->repassword)
        // {
        //     return redirect('account/user/create')->with('failed','Password Doesnt Match');
        // }

        $response = $this->post(env('GATEWAY_URL').'user/add',$data,$token);

        if($response['success'])
        {
            return redirect('account/user')->with('success','Data '.$response['data']['username'].' Created');
        }else {
            return redirect()->back()->with('failed','Data Doesnt Created,'.$response['message']);
        }

    }

    public function show(Request $req,$id)
    {
        $token    = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'user/edit/'.$id,$token);
        $member   = $response['success'] ? $response['data'] : null;

        return view('app.account.user.detail',compact('member'));
    }

    public function edit(Request $req,$id)
    {
        $token    = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'user/edit/'.$id,$token);
        $member   = ($response['success'])?$response['data']:null;
        return view('app.account.user.edit',compact('member'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token','photo');
        $token = session()->get('token');

        $validator = Validator::make($request->all(),[
            'username'    => 'required',
            'email'       => 'required|email',
        ]);

        $img['name'] = 'photo';
        $img['contents'] = '';
        if ($request->has('photo')) {
            $img['contents'] = fopen($request->photo, 'r');
            $img['filename'] = 'photo.png';
        }
        $response = $this->postMulti(env('GATEWAY_URL') . 'user/update/'.$id, $data, $token, $img);

        if($response['success'])
        {
            // LogActivity::addToLog('Updated Data User');
            return redirect('account/user')->with('success','Data '.$response['data']['username'].' Updated');
        }else {
            return redirect('account/user')->with('failed','Data Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->post(env('GATEWAY_URL').'user/delete',$req->all(),$token);

        if($response['success'])
        {
            // LogActivity::addToLog('Deleted Data User');
            return redirect('account/user')->with('success','Data Deleted');
        }else {
            return redirect('account/user')->with('failed','Data Doesnt Deleted');
        }

    }

}
