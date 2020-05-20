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
        $company_id = $req->session()->get('company_id');
        $token = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'walk_through?company_id='.$company_id,$token);
        $walkthrough = $response['success'] ? $response['data'] : null;
        $message = $response['message'];
      
        return view('app.general.walkthrough.index',compact('walkthrough', 'message'));
    }

    public function create()
    {
      $token = session()->get('token');
      $profile = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
      $profile = $profile['success'] ? $profile['data'] : null;
      $company = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $company['success'] ? $company['data'] : null;

      return view('app.general.walkthrough.create',compact('company','profile'));
    }

    public function store(Request $request)
    {
      $token = $request->session()->get('token');
      $data = $request->except('image');
      $data['company_id'] = session()->get('company_id');
      $img['name'] = 'image';
      $img['contents'] = '';

      if($request->has('image')) {
        $img['contents'] = fopen($request->image,'r');
        $img['filename'] = 'walkthrough.png';
      }

      $response = $this->postMulti(env('GATEWAY_URL').'walk_through/add',$data,$token,$img,'');
      // dd($response);
      if ($response['success']) {
          // LogActivity::addToLog('Added Data City');
          return redirect('general/walkthrough')->with('success','Walktrough Created');
      } else {
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
        $edit       = $response['success'] ? $response['data'] : null;
        $profile    = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
        $profile    = $profile['success'] ? $profile['data'] : null;
        $company    = $this->get(env('GATEWAY_URL'). 'company', $token);
        $company    = $company['success'] ? $company['data'] : null;

        return view('app.general.walkthrough.edit',compact('edit','profile','company'));
    }

    public function update(Request $request,$id)
    {
        $token = session()->get('token');
        $data = $request->except('image');

        $img['name'] = 'image';
        $img['contents'] = '';
        // dd($request->all());
        if($request->image != null) {
          // $img['name'] = 'image';
          $img['contents'] = fopen($request->image,'r');
          $img['filename'] = 'walkthrough.png';
        }
        $response = $this->postMulti(env('GATEWAY_URL').'walk_through/update/'.$id,$data,$token,$img);
        // dd($response);
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Contact');
            return redirect('general/walkthrough')->with('success','Data Saved');
        }else {
            return redirect('general/walkthrough')->with('failed','Data Doesnt Saved.');
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
