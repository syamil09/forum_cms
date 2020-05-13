<?php

namespace App\Http\Controllers\account;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LogActivityController extends Controller
{
    public function index(Request $request)
    {
        $token = $request->session()->get('token');
        $response = $this->get(env('GATEWAY_URL') . 'log/index', $token);
        $logs = ($response['success']) ? $response['data'] : [];
        $message = $response['message'];

        return view('app.account.log.index', compact('logs', 'message'));
    }

    public function delete(Request $request)
    {
        $token = $request->session()->get('token');
        $response = $this->post(env('GATEWAY_URL').'log/delete',$request->all(),$token);

        if($response['success'])
        {
            return redirect('account/activity')->with('success','Log Deleted');
        }else {
            return redirect('account/activity')->with('failed','Log Doesnt Deleted');
        }
    }
}
