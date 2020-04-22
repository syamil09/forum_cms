<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class EventController extends Controller
{

    public function index(Request $req)
    {
      $token = $req->session()->get('token');

      $response = $this->get(env('GATEWAY_URL'). 'event', $token);
      $events = ($response['success'])?$response['data']:null;
      $message = $response['message'];
      return view('app.general.event.index',compact('events', 'message'));
    }

    public function create()
    {
        return view('app.general.event.create');
    }


    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->except('image');
        
        $img[0]['name'] = 'image[]';
        $img[0]['contents'] = '';
        if ($request->has('image')) {
          foreach ($request['image'] as $i => $value) {
            $img[$i]['name'] = 'image[]';
            $img[$i]['contents'] = fopen($value, 'r');
            $img[$i]['filename'] = 'event.png';
            }
        }

        $response = $this->postMulti(env('GATEWAY_URL').'event/add',$data,$token,null,$img);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Added Data City');
            return redirect('general/event')->with('success','Event Created');
        }else {
            return redirect('general/event')->with('failed','Event Doesnt Created ,'.$response['message']);
        }

    }

    public function show(Request $req, $id)
    {
        $token    = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL'). 'event/edit/'. $id, $token);
        $event    = $response['success'] ? $response['data'] : null;

        return view('app.general.event.detail', compact('event'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'event/edit/'.$id,$token);
        $edit       = $response['success'] ? $response['data'] : null;
        if($edit != null) {
            $start               = date_create($edit['event_start']);
            $end                 = date_create($edit['event_end']);
            $edit['event_start'] = date_format($start,"Y-m-d");
            $edit['event_end']   = date_format($end,"Y-m-d");

        }

        return view('app.general.event.edit',compact('edit'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token', 'image');
        $token = session()->get('token');
        // return $data;

        $img[0]['name'] = 'image[]';
        $img[0]['contents'] = '';
        if ($request->has('image')) {
          foreach ($request['image'] as $i => $value) {
            $img[$i]['name'] = 'image[]';
            $img[$i]['contents'] = fopen($value, 'r');
            $img[$i]['filename'] = 'event.png';
            }
        }

        $response = $this->postMulti(env('GATEWAY_URL').'event/update/'.$id,$data,$token,null,$img);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Data City');
            return redirect('general/event')->with('success','Event Updated');
        }else {
            return redirect('general/event')->with('failed','Event Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'event/delete',$req->only('id'),$token);
        // dd($req->all());
        if($response['success'])
        {
            // LogActivity::addToLog('Deleted Data City');
            return redirect('general/event')->with('success','Event Deleted');
        }else {
            return redirect('general/event')->with('failed','Event Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
