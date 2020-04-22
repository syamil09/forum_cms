<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use App\Helpers\LogActivity;

class SecretariatController extends Controller
{

    public function index(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'secretariat/',$token);
        $secretariat = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];
        return view('app.company.secretariat.index',compact('secretariat','message'));
    }

    public function create()
    {
        $token = session()->get('token');
        $communities = $this->get(env('GATEWAY_URL') . 'company', $token)['data'];
        return view('app.company.secretariat.create', compact('communities'));
    }

    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->all();

        // dd($data);
        $response = $this->post(env('GATEWAY_URL').'secretariat/add', $data, $token);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Added Data Mesjid');
            return redirect('company/secretariat')->with('success', 'Secretariat Saved');
        } else {
          return redirect('company/secretariat')->with('failed', 'Secretariat Doesnt Saved.'. $response['message']);
        }

    }

    public function edit(Request $req, $id)
    {
        $token = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'secretariat/edit/'.$id,$token);
        $secretariat = $response['data'];
        return view('app.company.secretariat.edit',compact('secretariat'));
    }


    public function update(Request $request, $id)
    {
        $token = $request->session()->get('token');
        $data = $request->all();

        $response = $this->post(env('GATEWAY_URL').'secretariat/update/'.$id,$data,$token);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Updated About Us');
            return redirect('company/secretariat')->with('success','Data Saved');
        }else {
            return redirect('company/secretariat')->with('failed','Data Doesnt Saved.');
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL') . 'secretariat/delete', $req->all(), $token);

        if ($response['success']) {
            return redirect('company/secretariat')->with('success', 'Secretariat Deleted');
        }

        return redirect('company/secretariat')->with('failed', 'Secretariat Doesnt Deleted');
    }

}
