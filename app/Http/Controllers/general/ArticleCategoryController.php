<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class ArticleCategoryController extends Controller
{
    public function index(Request $req)
    {
      $token = $req->session()->get('token');

      $response = $this->get(env('GATEWAY_URL'). 'article_category', $token);
      $categories = ($response['success'])?$response['data']:null;
      $message = $response['message'];

      return view('app.general.article_category.index',compact('categories', 'message'));
    }

    public function create()
    {
        return view('app.general.article_category.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $token = $request->session()->get('token');
        $data = $request->all();
        $data['company_id'] = $request->company_id;
                
        $response = $this->post(env('GATEWAY_URL').'article_category/add',$data,$token);
        // return $data;
        if($response['success'])
        {
            return redirect('general/article_category')->with('success','Category created');
        }else {
            return redirect('general/article_category')->with('failed','Category Did Not Created ,'.$response['message']);
        }

    }

    public function show(Request $req, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL'). 'article/edit/'. $id, $token);
        $article = ($response['success'])?$response['data']:null;
        return view('app.general.article.detail', compact('article'));
    }

    public function edit(Request $req, $id)
    {
        $token      = $req->session()->get('token');
        $response   = $this->get(env('GATEWAY_URL').'article_category/edit/'.$id,$token);
        $edit       = ($response['success'])?$response['data']:null;

        return view('app.general.article_category.edit',compact('edit'));
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'category' => 'required',
        ]);

        $token = session()->get('token');
        $data = $request->all();
        $data['company_id'] = $request->company_id;
        
        $response = $this->post(env('GATEWAY_URL').'article_category/update/'.$id,$data,$token);
   
        if($response['success'])
        {
            return redirect('general/article_category')->with('success','Category Updated');
        }else {
            return redirect('general/article_category')->with('failed','Category Doesnt Updated. '.$response['message']);
        }
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'article_category/delete',$req->all(),$token);

        if($response['success'])
        {
            return redirect('general/article_category')->with('success','Category Deleted');
        }else {
            return redirect('general/article_category')->with('failed','Category Doesnt Deleted');
        }

    }
}
