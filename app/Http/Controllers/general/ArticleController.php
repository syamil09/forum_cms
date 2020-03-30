<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class ArticleController extends Controller
{

    public function index(Request $req)
    {
      $token = $req->session()->get('token');

      $response = $this->get(env('GATEWAY_URL'). 'article', $token);
      $articles = ($response['success'])?$response['data']:null;
      $message = $response['message'];
      return view('app.general.article.index',compact('articles', 'message'));
    }

    public function create()
    {
        return view('app.general.article.create');
    }


    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->except('tags','image','_token');

        $request['tags'] = explode(',',$request->tags);
        foreach ($request['tags'] as $key => $value) {
            $json['name'] = 'tags';
            $json['contents'] = $value;
            $tags[] = $json;
        }

        $img['name'] = 'image[]';
        $img['contents'] = fopen($request['image'],'r');
        $img['filename'] = 'photo.png';

        $response = $this->postMulti(env('GATEWAY_URL').'article/add',$data,$token,$img,$tags);
        // return $response;
        if($response['success'])
        {
            return redirect('general/article')->with('success','Data created');
        }else {
            return redirect('general/city')->with('failed','Data Doesnt Created ,'.$response['message']);
        }

    }

    public function show(Request $req, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL'). 'article/edit/'. $id, $token);
        $article = ($response['success'])?$response['data']:null;
        return view('app.general.article.detail', compact('article'));
    }

    public function edit(Request $req,$id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'article/edit/'.$id,$token);
        $edit       = ($response['success'])?$response['data']:null;
        if($edit != null && $edit['tags'] != null) {
            $edit['tags'] = implode(',', $edit['tags']);
        }
        // dd($edit);
        return view('app.general.article.edit',compact('edit'));
    }


    public function update(Request $request, $id)
    {
        $token = session()->get('token');
        $data = $request->except('tags','image','_token');

        $request['tags'] = explode(',',$request->tags);
        foreach ($request['tags'] as $key => $value) {
            $json['name'] = 'tags[]';
            $json['contents'] = $value;
            $tags[] = $json;
        }

        $img['name'] = 'image';
        $img['contents'] = null;
        if($request->image != null) {
            $img['contents'] = fopen($request->image,'r');
            $img['filename'] = 'photo.png';
        }

        $response = $this->postMulti(env('GATEWAY_URL').'article/update/'.$id,$data,$token,$img,$tags);
   
        if($response['success'])
        {
            // LogActivity::addToLog('Updated Data City');
            return redirect('general/article')->with('success','Data Updated');
        }else {
            return redirect('general/article')->with('failed','Data Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        dd('hapus');
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'article/delete',$req->all(),$token);

        if($response['success'])
        {
            // LogActivity::addToLog('Deleted Data City');
            return redirect('general/article')->with('success','Data Deleted');
        }else {
            return redirect('general/article')->with('failed','Data Doesnt Deleted');
        }

    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
