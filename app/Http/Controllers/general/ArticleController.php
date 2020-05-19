<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ArticleController extends Controller
{

    public function index(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL') . 'article?sort=desc', $token);
        $articles = ($response['success']) ? $response['data'] : [];
        $message = $response['message'];

        return view('app.general.article.index', compact('articles', 'message'));
    }

    public function create()
    {
        $token = session()->get('token');
        $categorys = $this->get(env('GATEWAY_URL') . 'article_category', $token)['data'];
        $profile = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
        $profile = $profile['success'] ? $profile['data'] : null;
        $company = $this->get(env('GATEWAY_URL'). 'company', $token);
        $company = $company['data'];
        return view('app.general.article.create', compact('categorys', 'profile', 'company'));
    }


    public function store(Request $request)
    {
        $token = $request->session()->get('token');

        $data = $request->except('image', '_token');
        if (!empty($data['tags'])) {
            $data['tags'] = json_encode($data['tags'], true);
        }

        $img['name'] = 'image';
        $img['contents'] = '';

        if ($request->has('image')) {
            $img['contents'] = fopen($request->image, 'r');
            $img['filename'] = 'photo.png';
        }
        $response = $this->postMulti(env('GATEWAY_URL') . 'article/add', $data, $token, $img);
        // return $response;
        if ($response['success']) {
            return redirect('general/article')->with('success', 'Data created');
        }
        return redirect()->back()->with('failed', 'Data Doesnt Created ,' . collect($response['message'])->first()[0]);
    }

    public function show(Request $req, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL') . 'article/edit/' . $id, $token);
        $article = ($response['success']) ? $response['data'] : null;
        return view('app.general.article.detail', compact('article'));
    }

    public function edit(Request $req, $id)
    {
        $token = $req->session()->get('token');
        $response = $this->get(env('GATEWAY_URL') . 'article/edit/' . $id, $token);
        $categorys = $this->get(env('GATEWAY_URL') . 'article_category', $token)['data'];
        $edit = ($response['success']) ? $response['data'] : null;
   
        return view('app.general.article.edit', compact('edit', 'categorys'));
    }


    public function update(Request $request, $id)
    {
        $token = session()->get('token');
        $data = $request->except('image', '_token');
        if (!empty($data['tags'])) {
            $data['tags'] = json_encode($data['tags'], true);
        }

        if ($request->has('image')) {
            $img['name'] = 'image';
            $img['contents'] = '';
            $img['contents'] = fopen($request->image, 'r');
            $img['filename'] = 'photo.png';
            $response = $this->postMulti(env('GATEWAY_URL') . 'article/update/' . $id, $data, $token, $img);
        } else {
            $response = $this->post(env('GATEWAY_URL') . 'article/update/' . $id, $data, $token);
        }

        if ($response['success']) {
            return redirect('general/article')->with('success', 'Data Updated');
        }
        return redirect()->back()->with('failed', 'Data Doesnt Updated. ' . $response['message']);
    }

    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL') . 'article/delete', $req->all(), $token);

        if ($response['success']) {
            // LogActivity::addToLog('Deleted Data City');
            return redirect('general/article')->with('success', 'Data Deleted');
        }

        return redirect('general/article')->with('failed', 'Data Doesnt Deleted');
    }

}

// https://drive.google.com/file/d/0B3tiTbadc-HgTGdQajNWSlNYVGs/view
