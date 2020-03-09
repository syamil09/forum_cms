<?php

namespace App\Http\Middleware;

use Closure;
use GuzzleHttp\Client;

class privileges
{

    public function handle($request, Closure $next)
    {
        if(!session()->has('token'))
        {
            return redirect('login');
        }
        // ambil url
        $fullUrl = $request->fullUrl();
        $url = explode('/', $fullUrl,4);
        $url2 = $url[3];
        // dd(session()->get('privileges'));
        $menu = $this->get(env('GATEWAY_URL').'menu',session()->get('token'))['data'];
        foreach (session()->get('privileges') as $key => $data) {
            
            $db = $menu[$key]['url'];

            if($url2 == $menu[$key]['url'] && $data['view'] == '0')
            {
                // echo $menu[$key]['url'].'-'.$data['view'].'-boleh<br>';
                return redirect()->back()->with('fail','fail');
            }

            if(strpos($url2,$db) !== false && strpos($url2,'create') !== false && $data['add'] == '0')
            {
                // echo $menu[$key]['url'].'-'.$data['add'].'-boleh<br>';
                return redirect()->back()->with('fail','fail');
            }

            if(strpos($url2,$db) !== false && strpos($url2,'edit') !== false && $data['edit'] == '0')
            {
                // echo "<script>alert('Acces denied');</script>";
                return redirect()->back()->with('fail','fail');
            }
            // dd($db);
        } 
        // dd(session()->get('privileges'));
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
