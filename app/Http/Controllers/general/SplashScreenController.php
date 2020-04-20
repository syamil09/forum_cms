<?php

namespace App\Http\Controllers\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SplashScreenController extends Controller
{
    public function index()
    {
        $token = session()->get('token');
        $response = $this->get(env('GATEWAY_URL').'splash-screen', $token);

        return view('app.general.splashscreen.index', $response['data']);
    }

    public function store(Request $request)
    {
        $data = $request->only('imageBase64');
        $token = session()->get('token');

        $response = $this->post(env('GATEWAY_URL') . 'splash-screen', $data, $token);

        return redirect()->back()->with('success', 'Splash Screen Logo Updated');
    }
}
