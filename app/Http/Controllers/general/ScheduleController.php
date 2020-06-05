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
        $event   = $this->get(env('GATEWAY_URL').'event/edit/'.$event_id,session()->get('token'));   
        $event   = $event['success'] ? $event['data'] : null;

        return view('app.general.event.schedule.create', compact('event_id','event'));
    }


    public function store(Request $request, $event_id)
    {
        $token = $request->session()->get('token');
        $data = $request->all();
        $data['event_id'] = $event_id;
        if ($request->has('date')) {
            $dateTime = explode(' ', $request['date']);
            $data['date'] = $dateTime[0];
            $data['time'] = $dateTime[1];
        }

        $response = $this->post(env('GATEWAY_URL').'event/schedule/add',$data,$token);
        if ($response['success']) {
            // LogActivity::addToLog('Added Data City');
            return redirect('general/event/'.$event_id.'/schedule')->with('success','Schedule Event Created');
        } else {
            return redirect()->back()->with('failed','Schedule Event Doesnt Created ,'.$response['message'])->withInput();
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
        $token     = $req->session()->get('token');
        $response  = $this->get(env('GATEWAY_URL').'event/schedule/edit/'.$id,$token);
        $edit      = $response['success'] ? $response['data'] : null;
        $event     = $this->get(env('GATEWAY_URL').'event/edit/'.$event_id,session()->get('token'));   
        $event     = $event['success'] ? $event['data'] : null;

        return view('app.general.event.schedule.edit',compact('edit', 'event_id','event'));
    }


    public function update(Request $request, $event_id, $id)
    {
        $token = $request->session()->get('token');
        $data = $request->all();
        $data['event_id'] = $event_id;
        if ($request->has('date')) {
            $dateTime = explode(' ', $request['date']);
            $data['date'] = $dateTime[0];
            $data['time'] = $dateTime[1];
        }
        // dd($data);
        $response = $this->post(env('GATEWAY_URL').'event/schedule/update/'.$id,$data,$token);
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Data City');
            return redirect('general/event/'.$event_id.'/schedule')->with('success','Schedule Event Updated');
        }else {
            return redirect()->back()->with('failed','Schedule Event Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'event/schedule/delete',$req->all(),$token);

        if ($response['success']) {
            // LogActivity::addToLog('Deleted Data City');
            return redirect()->back()->with('success','Schedule Event Deleted');
        } else {
            return redirect()->back()->with('failed','Schedule Event Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
