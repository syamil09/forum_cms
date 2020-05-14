<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;

class UserGroupController extends Controller
{

    public function index(Request $req)
    {
        // return session()->get('data-user')['user_group_id'];
        $token      = $req->session()->get('token');    
        $response   = $this->get(env('GATEWAY_URL').'user-group',$token);
        $datas      = $response['success'] ? $response['data'] : null;
 
        return view('app.account.user_group.index',compact('datas'));
    }

    public function create()
    {
        return view('app.account.user_group.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);

        $token = $request->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'user-group/add',$request->except('_token'),$token);

        if ($response['success']) {
            return redirect('account/privileges')->with('success','Data '.$response['data']['name'].' Created');
        }
            return redirect('account/privileges')->with('failed','Data '.$response['data']['name'].' Doesnt Created,'.$response['message']);
    
    }
    public function storePrivileges(Request $request)
    {
        $token    = $request->session()->get('token');
        $id       = $request['user_group_id'];

        $request['view']    = Arr::exists($request,'view')   ? $request['view']   : [];
        $request['add']     = Arr::exists($request,'add')    ? $request['add']    : [];
        $request['edit']    = Arr::exists($request,'edit')   ? $request['edit']   : [];
        $request['delete']  = Arr::exists($request,'delete') ? $request['delete'] : [];
        $request['other']   = Arr::exists($request,'other')  ? $request['other']  : [];

        $user = $this->get(env('GATEWAY_URL').'user-privileges/info-user/'.$id,$token);
        $user = $user['success'] ? $user['data'] : []; 
        $menu = $this->get(env('GATEWAY_URL').'menu',$token);

        foreach($menu['data'] as $i => $val)
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
        
        foreach($menu['data'] as $i => $val)
        {
            $data = [
                'user_group_id' => $id,
                'menu_id' => $request['menu_id'][$i],
                'view'    => $request['view'][$i],
                'add'     => $request['add'][$i],
                'edit'    => $request['edit'][$i],
                'delete'  => $request['delete'][$i],
                'other'   => $request['other'][$i]

            ];

            $checkExist = collect($user)->where('menu_id',$val['id'])->first();
            if (!empty($user) && !empty($checkExist)) {
                $response = $this->post(env('GATEWAY_URL').'user-privileges/update/'.$checkExist['id'],$data,$token);
                $newMenu[] = $response['data'];
            }
            else {
                $response = $this->post(env('GATEWAY_URL').'user-privileges/add',$data,$token);
                $newMenu[] = $response['data'];
            }
            
        }
   
        if ($response['success']) {
            // if (session()->get('data-user')['user_group_id'] == $request['user_group_id']) {
            //     $request->session()->put('privileges',$newMenu);
            // }
            
            return redirect('account/privileges')->with('success','Data Saved');
        } else {
            return redirect('account/privileges')->with('failed','Data Doesnt Saved,'.$response['message']);
        }
        
    }

    public function show($id)
    {
        $token = session()->get('token');
        $userPrivileges = $this->get(env('GATEWAY_URL').'user-privileges/info-user/'.$id,$token);
        $menuPrivileges = $this->get(env('GATEWAY_URL').'menu/privileges',$token);

        $data = $userPrivileges['success'] == false ? null : $userPrivileges['data'];
        $menu = $menuPrivileges['success'] == false ? null : $menuPrivileges['data'];

        return view('app.account.privileges.privileges',compact('data','menu','id'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'user-group/edit/'.$id,$token);
        $privileges = $response['data'];

        return view('app.account.privileges.edit',compact('privileges'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token');

        $token = $request->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'user-group/update/'.$id,$data,$token);
      
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
   
        if($response['success'])
        {
            return redirect()->back()->with('success','Data '.$response['data']['name'].' Deleted');
        }else {
            return redirect()->back()->with('failed','Data Doesnt Deleted');
        }

    }

}
