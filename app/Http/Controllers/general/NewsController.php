<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use App\Helpers\LogActivity;

class NewsController extends Controller
{

    public function index(Request $req)
    {
        session()->put('menu','News');
        session()->put('group','Manage Site');
        $token = $req->session()->get('token');
        
        $response = $this->get(env('GATEWAY_URL').'news',$token);
        // return $response;
        $news = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];
        return view('app.general.news.index',compact('news','message'));
    }

    public function create()
    {
        return view('app.general.news.create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'image' => 'required | mimes:png,jpeg,jpg | max:3072',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();          
        }

        $file = $request->file('image');
        $name_file = time().'_'.$file->getClientOriginalName();
        $ekstensi = $file->getClientOriginalExtension();
        $loc_file = public_path('UploadedFile/News');

        $file->move($loc_file,$name_file);

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'image' => $name_file,
            'date' => $request['date']
        ];

        $token = $request->session()->get('token');

        $response = $this->post(env('GATEWAY_URL').'news/add',$data,$token);
        // return $response;
        if($response['success'])
        {
            LogActivity::addToLog('Added Data News');
            return redirect('general/news')->with('success','Data '.$response['data']['name'].' Created');
        }else {
            return redirect('general/news/create')->with('failed','Data Doesnt Created ,'.$response['message']);
        }
        
    }

    public function show($id)
    {
        $token      = session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'news/edit/'.$id,$token);
        $news       = $response['data'];
        return view('app.general.news.detail',compact('news'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'news/edit/'.$id,$token);
        $news       = $response['data'];
        return view('app.general.news.edit',compact('news'));
    }


    public function update(Request $request, $id)
    {
        $token = session()->get('token');

        $data = [
            'name' => $request['name'],
            'description' => $request['description'],
            'date' => $request['date']
        ];

        if($request['image'] != null)
        {
            $validator = Validator::make($request->all(),[
                'image' => 'required | mimes:png,jpeg,jpg | max:3072',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->with('failed',$validator->getMessageBag()->first());        
            }

            $file = $request->file('image');
            $name_file = time().'_'.$file->getClientOriginalName();
            $loc_file = public_path('UploadedFile/News');
            $file->move($loc_file,$name_file);

            $data['image'] = $name_file;
        }        
        
        $response = $this->post(env('GATEWAY_URL').'news/update/'.$id,$data,$token);

        if($response['success'])
        {
            LogActivity::addToLog('Updated Data News');
            return redirect('general/news')->with('success','Data '.$response['data']['name'].' Updated');
        }else {
            return redirect('general/news')->with('failed','Data '.$response['data']['name'].' Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'news/delete',$req->all(),$token);
        
        if($response['success'])
        {
            LogActivity::addToLog('Deleted Data News');
            return redirect('general/news')->with('success','Data '.$req['name'].' Deleted');
        }else {
            return redirect('general/news')->with('failed','Data '.$req['name'].' Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
