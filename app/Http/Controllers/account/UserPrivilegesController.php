<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class UserPrivilegesController extends Controller
{

    public function index(Request $req)
    {
        session()->put('menu','User Privileges');
        session()->put('group','Manage User');
        // return session()->get('data-user')['user_group_id'];
        $token      = $req->session()->get('token');    
        $response   = $this->get(env('GATEWAY_URL').'user-group',$token);
        $privileges = $response['data'];

        return view('app.account.privileges.index',compact('privileges'));
    }

    public function create()
    {
        return view('app.account.privileges.create');
    }

    public function store(Request $request)
    {
        // $validate = Validator::make($request->all(),[
        //     'name' => 'required',
        //     'description' => 'required'
        // ]);

        // if($validate->fails())
        // {
        //     return redirect()->back()->with('failed','Please, fill in all the fields');
        // }
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $token = $request->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'user-group/add',$request->except('_token'),$token);
        // return $validate;

        if($response['success'])
        {
            return redirect()->back()->with('success','Data '.$response['data']['name'].' Created');
        }
            return redirect('account/privileges')->with('failed','Data '.$response['data']['name'].' Doesnt Created,'.$response['message']);
    
    }
    public function storePrivileges(Request $request)
    {
        // return $request->all();
        $token    = $request->session()->get('token');
        $id       = $request['user_id'];

        $request['view']    = (Arr::exists($request,'view'))?$request['view']:[];
        $request['add']     = (Arr::exists($request,'add'))?$request['add']:[];
        $request['edit']    = (Arr::exists($request,'edit'))?$request['edit']:[];
        $request['delete']  = (Arr::exists($request,'delete'))?$request['delete']:[];
        $request['other']   = (Arr::exists($request,'other'))?$request['other']:[];
        // return $request->all();
        $user = $this->get(env('GATEWAY_URL').'user-privileges/info-user/'.$id,$token);
        
        for($i=0;$i<14;$i++)
        {
            if(!Arr::exists($request['add'],$i)) {
                $request['add'] = array_add($request['add'],$i,'0');
            }

            if(!Arr::exists($request['view'],$i)) {
                $request['view'] = array_add($request['view'],$i,'0');
            }

            if(!Arr::exists($request['edit'],$i)) {
                $request['edit'] = array_add($request['edit'],$i,'0');
            }

            if(!Arr::exists($request['delete'],$i)) {
                $request['delete'] = array_add($request['delete'],$i,'0');
            }

            if(!Arr::exists($request['other'],$i)) {
                $request['other'] = array_add($request['other'],$i,'0');
            }
        }
        // dd($request->all());
        $data = $request->except('_token');
        
        for($i=0;$i<14;$i++)
        {
            $data = [
                'user_id' => $id,
                'menu_id' => $request['menu_id'][$i],
                'view'    => $request['view'][$i],
                'add'     => $request['add'][$i],
                'edit'    => $request['edit'][$i],
                'delete'  => $request['delete'][$i],
                'other'   => $request['other'][$i]

            ];

            if($user['success'] == true)
            {
                $response = $this->post(env('GATEWAY_URL').'user-privileges/update/'.$user['data'][$i]['id'],$data,$token);
                // return $user['data'][$i]['id'];
            }
            else {
                $response = $this->post(env('GATEWAY_URL').'user-privileges/add',$data,$token);
            }
            
        }
        
        // return $request->all();

        if($response['success'])
        {
            // if(session()->get('data-user')['user_group_id'] == $id )
            // {
            //     session()->put('privileges',$response['data']);
                
            // }
            return redirect('account/privileges')->with('success','Data Saved');
        }else {
            return redirect('account/privileges')->with('failed','Data Doesnt Saved,'.$response['message']);
        }
        
    }

    public function show($id)
    {
        $token = session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'user-privileges/info-user/'.$id,$token);
        $data = ($response['success'] == false)?null:$response['data'];
        // return $data;
        // if($response['success'])
        // {
        //     return redirect('account/privileges');
        // }
        return view('app.account.privileges.privileges',compact('data','id'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'user-group/edit/'.$id,$token);
        $privileges = $response['data'];
        // return $response;
        return view('app.account.privileges.edit',compact('privileges'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        if($request['name'])
        $token = $request->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'user-group/update/'.$id,$data,$token);
        // dd($response);
        if($response['success'])
        {
            return redirect('account/privileges')->with('success','Data '.$response['data']['name'].' Updated');
        }else {
            return redirect('account/privileges')->with('failed','Data '.$response['data']['name'].' Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'user-group/delete',$req->all(),$token);
        return $response;
        if($response['success'])
        {
            return redirect('privileges/user')->with('success','Data '.$response['data']['name'].' Deleted');
        }else {
            return redirect('privileges/user')->with('failed','Data Doesnt Deleted');
        }

    }

}
