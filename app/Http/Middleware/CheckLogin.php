<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class CheckLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!session()->has('token'))
        {
            return redirect('login');
        }
        $response = $this->get(env('GATEWAY_URL').'admin/profile',session()->get('token'));
        // dd($request);
        if($response['success'] == false)
        {
            session()->forget('token','menu','group');
            // Session::flush();
            return redirect('login')->with('message','Your Session is expired!');
        }
        return $next($request);
    }

    public function get($url,$token = null)
    {
        $client = new Client();

        $response = $client->get($url,[
            'headers' => [
                'Authorization' => $token == null?"":$token
            ]
        ]);

        $result = json_decode($response->getBody(),true);

        return $result;
    }
}
