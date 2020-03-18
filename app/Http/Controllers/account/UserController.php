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
        return view('app.account.user.index');
    }

    public function create()
    {
        return view('app.account.user.create');
    }


    public function store(Request $request)
    {   

        $token = $request->session()->get('token');
        $validator = Validator::make($request->all(),[
            'username'    => 'required',
            'password'    => 'required',
            'repassword'  => 'required',
            'name'        => 'required',
            'email'       => 'required',
            'privileges'  => 'required',
            'photo' => 'required | mimes:png,jpeg,jpg, | max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();         
        }

        $userGroup = $this->get(env('GATEWAY_URL').'user-group/edit/'.$request['privileges'],$token);
        $privileges = $userGroup['data']['name'];

        if($request->password != $request->repassword)
        {
            return redirect('account/user/create')->with('failed','Password Doesnt Match');
        }

        $file = $request->file('photo');

        $name_file = time()."_".$file->getClientOriginalName();

        $loc_file = public_path('UploadedFile/UserPhoto');

        $file->move($loc_file,$name_file);


        $data = [
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => $request['password'],
            'name' => $request['email'],
            'user_group_id' => $request['privileges'],
            'privileges' => $privileges,
            'photo' => $name_file
        ];

        
        $response = $this->post(env('GATEWAY_URL').'user/add',$data,$token);

        if($response['success'])
        {
            LogActivity::addToLog('Added Data User');
            return redirect('account/user')->with('success','Data '.$response['data']['username'].' Created');
        }else {
            return redirect('account/user')->with('failed','Data '.$response['data']['username'].' Doesnt Created,'.$response['message']);
        }

    }

    public function show($id)
    {
        //
    }

    public function edit(Request $req,$id)
    {
        return view('app.account.user.edit');
    }


    public function update(Request $request, $id)
    {
        // dd('ok');
        $data = $request->except('_token','repassword');
        $token = session()->get('token');
        $userGroup = $this->get(env('GATEWAY_URL').'user-group/edit/'.$request['privileges']    ,$token);
        
        $privileges = $userGroup['data']['name'];

        // jika merubah password tapi tidak sama saat confirm password
        if($request->password != $request->repassword)
        {
            return redirect('account/user/edit/'.$id)->with('failed','Password Doesnt Match');
        }

        $data = [
                'username' => $request['username'],
                'email' => $request['email'],
                'password' => $request['password'],
                'name' => $request['email'],
                'user_group_id' => $request['privileges'],
                'privileges' => $privileges,
        ];

        // jika user ganti photo
        if($request->photo != null)
        {
            $validator = Validator::make($request->all(),[
                'photo' => 'required | mimes:png,jpeg,jpg | max:3072',
            ]);
            if($validator->fails())
            {
                // return redirect()->back()->withInput()->with('failed','image must be have extension : jpg,jpeg,png');
                return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();
            }
            
            $img = $this->get(env('GATEWAY_URL').'user/edit/'.$id,$token)['data'];
            File::delete('UploadedFile/UserPhoto/'.$img['photo']);

            $file = $request->file('photo');

            $name_file = time()."_".$file->getClientOriginalName();

            $loc_file = public_path('UploadedFile/UserPhoto');

            $file->move($loc_file,$name_file);

            $data['photo'] = $name_file;
            
        }

        // return $data;
        $response = $this->post(env('GATEWAY_URL').'user/update/'.$id,$data,$token);
        // dd($response);
        if($response['success'])
        {
            LogActivity::addToLog('Updated Data User');
            return redirect('account/user')->with('success','Data '.$response['data']['username'].' Updated');
        }else {
            return redirect('account/user')->with('failed','Data '.$response['data']['username'].' Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $img = $this->get(env('GATEWAY_URL').'user/edit/'.$req['id'],$token)['data'];
        File::delete('UploadedFile/UserPhoto/'.$img['photo']);
        $response = $this->post(env('GATEWAY_URL').'user/delete',$req->all(),$token);

        if($response['success'])
        {
            LogActivity::addToLog('Deleted Data User');
            return redirect('account/user')->with('success','Data Deleted');
        }else {
            return redirect('account/user')->with('failed','Data Doesnt Deleted');
        }

    }

}
