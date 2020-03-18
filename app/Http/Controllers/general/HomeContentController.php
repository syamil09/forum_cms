<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Helpers\LogActivity;

class HomeContentController extends Controller
{

    public function index(Request $req)
    {
        session()->put('menu','Home Content');
        session()->put('group','Manage Site');

        $token = $req->session()->get('token');
        
        $response = $this->get(env('GATEWAY_URL').'home',$token);
        $home = ($response['success'] == false)?null:$response['data'][0];
        $message = $response['message'];
        return view('app.general.home.index',compact('home','message'));
    }

    public function create()
    {
        return view('app.general.news.create');
    }


    public function store(Request $request)
    {
        
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'news/edit/'.$id,$token);
        $news       = $response['data'];
        return view('app.general.news.edit',compact('news'));
    }


    public function update(Request $request)
    {
        $token = session()->get('token');
        $id = $request['id'];
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
        ];

        $response = $this->post(env('GATEWAY_URL').'home/update/'.$id,$data,$token);
        // dd($response);
        if($response['success'])
        {
            LogActivity::addToLog('Updated Home Content');
            return redirect('general/home-content')->with('success','Data Saved');
        }else {
            return redirect('general/home-content')->with('failed','Data Doesnt Saved. '.$response['message']);
        }
    }

}

