<?php

namespace App\Http\Controllers\general;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class HighlightController extends Controller
{
    public function index(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL') . 'highlight', $token);
        $highlights = ($response['success']) ? $response['data'] : [];
        $message = $response['message'];
        // return $highlights;
        return view('app.general.highlight.index', compact('highlights', 'message'));
    }

    public function create()
    {
        $token = session()->get('token');

        $articles = $this->get(env('GATEWAY_URL') . 'article', $token)['data'];

        $events = $this->get(env('GATEWAY_URL') . 'event', $token)['data'];

        return view('app.general.highlight.create', compact('articles', 'events'));
    }


    public function store(Request $request)
    {
        $token = $request->session()->get('token');
        $data = $request->all();
        $data['company_id'] = $request->company_id;

        $response = $this->post(env('GATEWAY_URL') . 'highlight/add', $data, $token);
        
        if ($response['success']) {
            return redirect('general/highlight')->with('success', 'Highlight created');
        }

        return redirect('general/highlight')->with('failed', 'Highlight Doesnt Created ,' . $response['message']);
    }

    public function show(Request $req, $id)
    {
        $token = $req->session()->get('token');

        $response = $this->get(env('GATEWAY_URL') . 'highlight/show/' . $id, $token);
        $highlight = ($response['success']) ? $response['data'] : null;
        
        foreach ($highlight as $key => $value) {
            if ($value['module_name'] == 'article') {
                // $response = $this->get(env('GATEWAY_URL') . 'article/edit/' . $highlight['module_id'], $token);
                $article = $this->get(env('GATEWAY_URL') . 'article/edit/' . $value['module_id'], $token)['data'];
                return view('app.general.highlight.detail', compact('article', 'highlight'));
            } else {
                // $response = $this->get(env('GATEWAY_URL'). 'event/edit/'. $highlight['module_id'], $token);
                $event = $this->get(env('GATEWAY_URL') . 'event/edit/' . $value['module_id'], $token)['data'];
                return view('app.general.highlight.detail', compact('event', 'highlight'));
            }
        }                
    }
    
    public function delete(Request $req)
    {
        $token = $req->session()->get('token');
        $response = $this->post(env('GATEWAY_URL') . 'highlight/delete', $req->all(), $token);

        if ($response['success']) {
            return redirect('general/highlight')->with('success', 'Highlight Deleted');
        }

        return redirect('general/highlight')->with('failed', 'Highlight Doesnt Deleted');
    }
}
