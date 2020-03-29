<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class ScheduleController extends Controller
{

    public function index(Request $req, $event_id)
    {
      $token = $req->session()->get('token');

      $response = $this->get(env('GATEWAY_URL'). 'event/schedule?event_id='. $event_id, $token);
      $schedules = ($response['success'])?$response['data']:null;
      $message = $response['message'];
      return view('app.general.event.schedule.index',compact('schedules', 'message', 'event_id'));
    }

    public function create($event_id)
    {
        return view('app.general.event.schedule.create', compact('event_id'));
    }


    public function store(Request $request, $event_id)
    {
        $token = $request->session()->get('token');
        $data = $request->all();
        $data['event_id'] = $event_id;

        $response = $this->post(env('GATEWAY_URL').'event/schedule/add',$data,$token);
        // return $response;
        if($response['success'])
        {
            // LogActivity::addToLog('Added Data City');
            return redirect('general/event/'.$event_id.'/schedule')->with('success','Schedule Event Created');
        }else {
            return redirect('general/event/'.$event_id.'/schedule')->with('failed','Schedule Event Doesnt Created ,'.$response['message']);
        }

    }

    public function show(Request $req, $event_id, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL'). 'event/schedule/edit/'. $id, $token);
        $schedule = ($response['success'])?$response['data']:null;

        return view('app.general.event.schedule.detail', compact('schedule', 'event_id'));
    }

    public function edit(Request $req, $event_id, $id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'event/schedule/edit/'.$id,$token);
        $edit       = ($response['success'])?$response['data']:null;
        return view('app.general.event.schedule.edit',compact('edit', 'event_id'));
    }


    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $token = session()->get('token');
        // return $data;
        $response = $this->post(env('GATEWAY_URL').'event/update/'.$id,$data,$token);
        // dd($response);
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Data City');
            return redirect('general/event'.$event_id.'/schedule')->with('success','Schedule Event Updated');
        }else {
            return redirect('general/event'.$event_id.'/schedule')->with('failed','Schedule Event Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'event/ schedule/delete',$req->all(),$token);

        if($response['success'])
        {
            // LogActivity::addToLog('Deleted Data City');
            return redirect('general/event'.$event_id.'/schedule')->with('success','Schedule Event Deleted');
        }else {
            return redirect('general/event'.$event_id.'/schedule')->with('failed','Schedule Event Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
