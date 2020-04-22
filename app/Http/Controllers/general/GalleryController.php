<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class GalleryController extends Controller
{

    public function index(Request $req, $event_id)
    {
      $token = $req->session()->get('token');

      $response = $this->get(env('GATEWAY_URL'). 'event/gallery/'.$event_id, $token);
      $galleries = ($response['success'])?$response['data']:null;
      $message = $response['message'];
      return view('app.general.event.gallery.index',compact('galleries', 'message', 'event_id'));
    }

    public function create($event_id)
    {
        return view('app.general.event.gallery.create', compact('event_id'));
    }


    public function store(Request $request, $event_id)
    {
        $token = $request->session()->get('token');
        $data = $request->except('image');
        $data['event_id'] = $event_id;
     
        $img[0]['name'] = 'image[]';
        $img[0]['contents'] = '';
        if ($request->has('image')) {
          foreach ($request['image'] as $i => $value) {
            $img[$i]['name'] = 'photo[]';
            $img[$i]['contents'] = fopen($value, 'r');
            $img[$i]['filename'] = 'photo.png';
            }
        }
        $response = $this->postMulti(env('GATEWAY_URL').'event/gallery/add',$data,$token,null,$img);
     
        if($response['success'])
        {
            // LogActivity::addToLog('Added Data City');
            return redirect('general/event/'.$event_id.'/gallery')->with('success','Gallery Event Created');
        }else {
            return redirect('general/event/'.$event_id.'/gallery')->with('failed','Gallery Event Doesnt Created ,'.$response['message']);
        }

    }

    public function show(Request $req, $event_id, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL'). 'event/gallery/edit/'. $id, $token);
        $gallery = ($response['success'])?$response['data']:null;

        return view('app.general.event.gallery.detail', compact('gallery', 'event_id'));
    }

    public function edit(Request $req, $event_id, $id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'event/gallery/edit/'.$id,$token);
        $edit       = ($response['success'])?$response['data']:null;
        return view('app.general.event.gallery.edit',compact('edit', 'event_id'));
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
            return redirect('general/event'.$event_id.'/gallery')->with('success','Gallery Event Updated');
        }else {
            return redirect('general/event'.$event_id.'/gallery')->with('failed','Gallery Event Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req,$event_id)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'event/gallery/delete',$req->all(),$token);
  
        if($response['success'])
        {
            // LogActivity::addToLog('Deleted Data City');
            return redirect('general/event/'.$event_id.'/gallery')->with('success','Photo in Gallery Event Deleted');
        }else {
            return redirect('general/event/'.$event_id.'/gallery')->with('failed','Photo in Gallery Event Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
