<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class DoaController extends Controller
{

    public function index(Request $req)
    {
        session()->put('menu','Doa & Hadist');
        session()->put('group','Manage Site');

        $token = $req->session()->get('token');
        
        $response = $this->get(env('GATEWAY_URL').'doa-hadits',$token);
        $doa = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];
        return view('app.general.doa.index',compact('doa','message'));
    }

    public function create()
    {
        return view('app.general.doa.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'doa_name' => 'required',
            'doa_type' => 'required',
            'content'  => 'required'
        ]);
        
        $token = $request->session()->get('token');

        $response = $this->post(env('GATEWAY_URL').'doa-hadits/add',$request->all(),$token);
        // return $response;
        if($response['success'])
        {
            LogActivity::addToLog('Added Data Doa');
            return redirect('general/doa')->with('success','Data '.$response['data']['doa_name'].' Created');
        }else {
            return redirect('general/doa')->with('failed','Data Doesnt Created ,'.$response['message']);
        }
        
    }

    public function show($id)
    {
        $token      = session()->get('token');
        $doa   = $this->get(env('GATEWAY_URL').'doa-hadits/edit/'.$id,$token);
        return view('app.general.doa.detail',compact('doa'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $doa   = $this->get(env('GATEWAY_URL').'doa-hadits/edit/'.$id,$token);
        
        return view('app.general.doa.edit',compact('doa'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $token = session()->get('token');
        // return $request->all();
        $response = $this->post(env('GATEWAY_URL').'doa-hadits/update/'.$id,$data,$token);
        // dd($response);
        if($response['success'])
        {
            LogActivity::addToLog('Updated Data Doa');
            return redirect('general/doa')->with('success','Data '.$response['data']['doa_name'].' Updated');
        }else {
            return redirect('general/doa')->with('failed','Data '.$response['data']['doa_name'].' Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'doa-hadits/delete',$req->all(),$token);
        
        if($response['success'])
        {
            LogActivity::addToLog('Deleted Data Doa');
            return redirect('general/doa')->with('success','Data Deleted');
        }else {
            return redirect('general/doa')->with('failed','Data Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
