<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class ContactController extends Controller
{

    public function index(Request $req)
    {
        session()->put('menu','Contact');
        session()->put('group','Manage Site');

        $token = $req->session()->get('token');
        
        $response = $this->get(env('GATEWAY_URL').'contact',$token);
        // return $response;
        $contact = ($response['success'] == false)?null:$response['data'][0];
        return view('app.general.contact.index',compact('contact'));
    }


    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);
        
        $token = session()->get('token');
        $id = $request['id'];
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
        ];
        $response = $this->post(env('GATEWAY_URL').'contact/update/'.$id,$data,$token);
        // return $response;
        if($response['success'])
        {
            LogActivity::addToLog('Updated Contact');
            return redirect('general/contact')->with('success','Data Saved');
        }else {
            return redirect('general/contact')->with('failed','Data Doesnt Saved. '.$response['message']);
        }
    }
}
