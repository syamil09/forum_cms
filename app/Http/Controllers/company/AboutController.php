<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Helpers\LogActivity;

class AboutController extends Controller
{

    public function index(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'about/',$token);
        $about = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];
        return view('app.company.about.index',compact('about','message'));
    }

    public function create()
    {
        return view('app.company.news.create');
    }

    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->except('image');
        $img['name'] = 'image';
        $img['contents'] = '';
        if ($request->has('image')) {
          $img['contents'] = fopen($request->image, 'r');
          $img['filename'] = 'about.png';
        }

        // dd($data);
        $response = $this->postMulti(env('GATEWAY_URL').'about/add', $data, $token, $img);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Added Data Mesjid');
            return redirect('company/community')->with('success', 'About Saved');
        } else {
          return redirect('company/community')->with('failed', 'About Doesnt Saved.'. $response['message']);
        }

    }

    public function edit(Request $req, $id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'about/edit/'.$id,$token);
        $about      = ($response['success'])?$response['data']:null;
        return view('app.company.about.edit',compact('about', 'id'));
    }


    public function update(Request $request, $id)
    {
        $token = session()->get('token');
        $data = $request->except('image');

        $img['name'] = "image";
        $img['contents'] = '';
        if ($request->image != null) {
          $img['contents'] = fopen($request->image,'r');
          $img['filename'] = 'about.png';
        }

        $response = $this->postMulti(env('GATEWAY_URL').'about/update/'.$id,$data,$token, $img);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Updated About Us');
            return redirect('company/community')->with('success','Data Saved');
        }else {
            return redirect('company/community')->with('failed','Data Doesnt Saved.');
        }
    }

}
