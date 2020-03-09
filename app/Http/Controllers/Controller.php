<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Bridge\PsrHttpMessage\Factory\HttpFoundationFactory;
use Symfony\Component\HttpFoundation\Response as SymfonyResponse;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function post($url,$data=[],$token=null)
    {
    	$client = new Client();
   		
    	$response = $client->post($url,[
    		'form_params' => $data,
    		'headers' => [
    			'Authorization' =>  $token == null?"":$token
    		]
    	]);

    	$result = json_decode($response->getBody(),true);

    	return $result;
    }

    public function get($url,$token = null)
    {
    	$client = new Client();

    	$response = $client->get($url,[
            'headers' => [
                'Authorization' => $token == null?"":$token
            ]
        ]);
        // $response = $client->get($url,[
        //     'headers' => [
        //         'Authorization' => 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpYXQiOjE1Nzk0MzAxNDUsImV4cCI6MTU3OTQzMzc0NSwiZGF0YSI6eyJpZCI6NiwidXNlcm5hbWUiOiJyYWthIn19.stCsqQtfxWR5aY0M8VH626Zr1QfNsXSVB4-BKFFT5V8'
        //     ]
        // ]);

        
    	$result = json_decode($response->getBody(),true);

    	return $result;
    }

}
