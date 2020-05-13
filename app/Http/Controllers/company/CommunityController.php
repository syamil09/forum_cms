<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class CommunityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // session()->put('menu','Mesjid List');
        // session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'company', $token);
        // $getuser = $this->get(env('GATEWAY_URL').'user/member?company_id='.$id,$token);
        // return $response;

        $community = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];

        return view('app.company.community.index', compact('community', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.company.community.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->except(['logo', 'background']);

        if ($request->has('logo')) {
          $img[0]['name'] = 'logo';
          $img[0]['contents'] = fopen($request->logo, 'r');
          $img[0]['filename'] = 'company.png';
        }

        if ($request->has('background')) {
          $img[1]['name'] = 'background';
          $img[1]['contents'] = fopen($request->background, 'r');
          $img[1]['filename'] = 'company_background.png';
        }

        // dd($img);
        $response = $this->postMulti(env('GATEWAY_URL').'company/add', $data, $token, $img);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Added Data Mesjid');
            return redirect('company/community')->with('success', 'Data Created');
        } else {
          return redirect('company/community')->with('failed', 'Data Doesnt Created.'. $response['message']);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $token = $request->session()->get('token');

      $response = $this->get(env('GATEWAY_URL').'company/edit/'.$id, $token);
      $detail = $response['data'];
      $about = $this->get(env('GATEWAY_URL').'about/edit/'.$id,$token);
      $about = ($about['success'])?$about['data']:null;

      return view('app.company.community.detail', compact('detail','about'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $token = $request->session()->get('token');
      $response = $this->get(env('GATEWAY_URL').'company/edit/'.$id,$token);
      $company = $response['data'];
      
      return view('app.company.community.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $token = $request->session()->get('token');

      $data = $request->except(['logo', 'background']);
        if ($request->has('logo')) {
            $img['name'] = 'logo';
            $img['contents'] = '';
            $img['contents'] = fopen($request->logo, 'r');
            $img['filename'] = 'company.png';
            $response = $this->postMulti(env('GATEWAY_URL') . 'company/update/' . $id, $data, $token, $img);
        } else {
            $response = $this->post(env('GATEWAY_URL') . 'company/update/' . $id, $data, $token);
        }

      // dd($data);
      if($response['success'])
      {
        // LogActivity::addToLog('Updated Data Mesjid');
        return redirect('company/community')->with('success','Data Updated');
      }else {
          return redirect('company/community')->with('failed','Data Doesnt Updated. '.$response['message']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->post(env('GATEWAY_URL').'company/delete', $req->all(), $token);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Deleted Data Mesjid');
          return redirect('company/community')->with('success', 'Data Deleted');
        } else {
        return redirect('company/community')->with('failed', 'Data Doesnt Deleted');
        }
    }
}
