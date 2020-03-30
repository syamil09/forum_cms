<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class WalkthroughController extends Controller
{

    public function index(Request $req)
    {
        // session()->put('menu','Contact');
        // session()->put('group','Manage Site');

        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'walk_through',$token);
        // return $response;
        $walkthrough = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];
        return view('app.general.walkthrough.index',compact('walkthrough', 'message'));
    }

    public function create()
    {
      return view('app.general.walkthrough.create');
    }

    public function store(Request $request)
    {
      $token = $request->session()->get('token');
      $data = $request->all();

      $response = $this->post(env('GATEWAY_URL').'walk_through/add',$data,$token);
      // return $response;
      if($response['success'])
      {
          // LogActivity::addToLog('Added Data City');
          return redirect('general/walkthrough')->with('success','Walktrough Created');
      }else {
          return redirect('general/walkthrough')->with('failed','Walktrough Doesnt Created ,'.$response['message']);
      }
    }

    public function show(Request $req, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL'). 'walk_through/edit/'. $id, $token);
        $walkthrough = ($response['success'])?$response['data']:null;

        return view('app.general.walkthrough.detail', compact('walkthrough'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'walk_through/edit/'.$id,$token);
        $edit       = ($response['success'])?$response['data']:null;
        return view('app.general.walkthrough.edit',compact('edit'));
    }

    public function update(Request $request)
    {
        $token = session()->get('token');
        $data = [
            'title' => $request['title'],
            'content' => $request['content'],
        ];
        $response = $this->post(env('GATEWAY_URL').'contact/update/'.$id,$data,$token);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Contact');
            return redirect('general/contact')->with('success','Data Saved');
        }else {
            return redirect('general/contact')->with('failed','Data Doesnt Saved. '.$response['message']);
        }
    }

    public function delete(Request $request)
    {
      $token = session()->get('token');
      $response = $this->post(env('GATEWAY_URL'). 'walk_through/delete', $request->all(), $token);
      if ($response['success']) {
        return redirect('general/walkthrough')->with('success', 'Data Deleted');
      } else {
        return redirect('general/walkthrough')->with('failed', 'Data Doesnt Deleted');
      }
    }
}
