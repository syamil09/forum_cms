<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
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

    public function postMulti($url,$input=[],$token=null,$image = '',$arr = '')
    {
        foreach ($input as $key => $value) {
            $json['name'] = $key;
            $json['contents'] = $value;
            $data[] = $json;
        }
        
        if($arr != '') {
            foreach ($arr as $key => $value) {
                // $json['name'] = $value['name'].'[]';
                // $json['contents'] = $value['contents'];
                $data[] = $value;
            }
        }

        if($image != '') {
            $data[] = $image;
        }
        // dd($data);
        $client = new Client();
        $response = $client->post($url,[
            'multipart' => $data,
            'headers' => [
                'Authorization' =>  $token == null?"":$token,
                // 'content-type' => 'application/x-www-form-urlencoded'
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
    	$result = json_decode($response->getBody(),true);

    	return $result;
    }

}
