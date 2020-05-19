<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class AdminController extends Controller
{

    public function index(Request $request)
    {
      $token = $request->session()->get('token');
      $getadmin = $this->get(env('GATEWAY_URL'). 'admin', $token);
      $admin = $getadmin['success'] ? $getadmin['data'] : [];
      $message = $getadmin['message'];

      $userGroups = $this->get(env('GATEWAY_URL').'user-group',$token);
      $userGroups = $userGroups['success'] ? collect($userGroups['data']) : null;

      foreach ($admin as $key => $value) {
        if ($userGroups && count($getadmin) > 0) {
          $userGroup = $userGroups->where('id',$value['user_group_id'])->map(function($data) {
            return collect($data)->only('name')->first();
          })->first();
          $admin[$key]['role'] = $userGroup;
        }
      }

        return view('app.account.admin.index', compact('admin', 'message'));
    }

    public function create(Request $request)
    {
      $token = session()->get('token');
      $getcompany = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $getcompany['success'] ? $getcompany['data'] : null;
      $userGroups = $this->get(env('GATEWAY_URL').'user-group',$token);
      $userGroups = $userGroups['success'] ? $userGroups['data'] : [];

        return view('app.account.admin.create', compact('company','userGroups'));
    }


    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->except('confirm', 'image');
        $validator = Validator::make($request->all(),[
            'username'    => 'required',
            'password'    => 'required',
            'name'        => 'required',
            'email'       => 'required | email',
            'image' => 'max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed',$validator->getMessageBag()->first());
        }

        if ($request->password != $request->confirm) {
            return redirect()->back()->with('failed','Password Doesnt Match');
        }

        $photo['name'] = 'photo';
        $photo['contents'] = '';
        if ($request->hasFile('image')) {
          $photo['contents'] = fopen($request->image,'r');
          $photo['filename'] = 'Photo.png';
        }

        $response = $this->postMulti(env('GATEWAY_URL').'admin/add',$data,$token, $photo);

        if($response['success'])
        {
            return redirect('account/admin')->with('success','Data Admin Created');
        }else {
            return redirect('account/admin')->with('failed','Data Admin Doesnt Created, '. $response['message']);
        }

    }

    public function show($id)
    {
      $token = session()->get('token');
      $data = $this->get(env('GATEWAY_URL'). 'admin/edit/'. $id, $token);
      $data = $data['success'] ? $data['data'] : null;
      if ($data == null) {
        return redirect('account/admin')->with('failed', 'Data Admin Not Found');
      }
        return view('app.account.admin.detail', compact('data'));
    }

    public function edit(Request $req,$id)
    {
      $token = session()->get('token');
      $data = $this->get(env('GATEWAY_URL'). 'admin/edit/'. $id, $token);
      $data = $data['success'] ? $data['data'] : null;
      $getcompany = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $getcompany['data'];

      $userGroups = $this->get(env('GATEWAY_URL').'user-group',$token);
      $userGroups = $userGroups['success'] ? $userGroups['data'] : [];

      if ($data == null) {
        return redirect('account/admin')->with('failed', 'Data Admin Not Found');
      }
        return view('app.account.admin.edit', compact('data','company','userGroups'));
    }


    public function update(Request $request, $id)
    {
        // dd('ok');
        $data = $request->except('_token','oldpassword', 'confirm', 'image', 'password');
        $token = session()->get('token');

        // jika merubah password tapi tidak sama saat confirm password
        if ($request->oldpassword != null || $request->password != null || $request->confirm != null) {
          $cekpass = $this->post(env('GATEWAY_URL'). 'admin/'.$id. '/cekpass', $request->only('oldpassword'), $token);
          if ($cekpass['success'] == false) {
            return redirect('account/admin/edit/'.$request['company_id'])->with('failed','Old Password is Wrong');
          }
          if($request->password != $request->confirm)
          {
            return redirect('account/admin/edit/'.$request['company_id'])->with('failed','Password Doesnt Match');
          }
          $data['password'] = $request->password;
        }

        // jika user ganti photo
        $photo['name'] = 'photo';
        $photo['contents'] = '';
        if($request->hasFile('image'))
        {
            $validator = Validator::make($request->all(),[
                'image' => 'max:3072',
            ]);
            if($validator->fails())
            {
                // return redirect()->back()->withInput()->with('failed','image must be have extension : jpg,jpeg,png');
                return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();
            }
            $photo['contents'] = fopen($request->image, 'r');
            $photo['filename'] = 'photo.png';
        }

        $response = $this->postMulti(env('GATEWAY_URL').'admin/update/'.$id,$data,$token,$photo);
        // return $response;
        if($response['success'])
        {
            return redirect('account/admin')->with('success','Data Updated');
        }else {
            return redirect('account/admin')->with('failed','Data Doesnt Updated.'. $response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'admin/delete',$req->all(),$token);

        if($response['success'])
        {
            return redirect('account/admin')->with('success','Data Deleted');
        }else {
            return redirect('account/admin')->with('failed','Data Doesnt Deleted');
        }

    }

    public function profile(Request $request)
    {
      $token = session()->get('token');
      $profile = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
      $profile = $profile['data'];
      $getcompany = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $getcompany['data'];

      return view('app.account.admin.profile', compact('profile', 'company'));
    }

    public function uprof(Request $request, $id)
    {
        // dd('ok');
        $data = $request->except('_token','oldpassword', 'confirm', 'image', 'password');
        $token = session()->get('token');
        // $userGroup = $this->get(env('GATEWAY_URL').'user-group/edit/'.$request['privileges']    ,$token);

        // $privileges = $userGroup['data']['name'];

        // jika merubah password tapi tidak sama saat confirm password
        if ($request->oldpassword != null || $request->password != null || $request->confirm != null) {
          $validate = Validator::make($request->all(), [
            'oldpassword' => 'required',
            'password' => 'required',
            'confirm' => 'required',
          ]);
          if ($validate->fails()) {
            return redirect()->back()->with('failed', $validate->getMessageBag()->first());
          }
          $cekpass = $this->post(env('GATEWAY_URL'). 'admin/'.$id. '/cekpass', $request->only('oldpassword'), $token);
          if ($cekpass['success'] == false) {
            return redirect('account/admin/profile')->with('failed','Old Password is Wrong');
          }
          if($request->password != $request->confirm)
          {
            return redirect('account/admin/profile')->with('failed','Password Doesnt Match');
          }
          $data['password'] = $request->password;
        }

        // jika user ganti photo
        $photo['name'] = 'photo';
        $photo['contents'] = '';
        if($request->hasFile('image'))
        {
            $validator = Validator::make($request->all(),[
                'image' => 'max:3072',
            ]);
            if($validator->fails())
            {
                // return redirect()->back()->withInput()->with('failed','image must be have extension : jpg,jpeg,png');
                return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();
            }
            $photo['contents'] = fopen($request->image, 'r');
            $photo['filename'] = 'photo.png';
        }

        // return $data;
        $response = $this->postMulti(env('GATEWAY_URL').'admin/update/'.$id,$data,$token,$photo);
        // return $response;
        if($response['success'])
        {
            return redirect('account/admin/profile')->with('success','Data Updated');
        }else {
            return redirect('account/admin/profile')->with('failed','Data Doesnt Updated.'. $response['message']);
        }
    }

}
