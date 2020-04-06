<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class ShopController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        // session()->put('menu','Mesjid List');
        // session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'shop/item', $token);
        // return $response;

        $shops = ($response['success'] == false)?null:$response['data'];
        $getcategory = $this->get(env('GATEWAY_URL').'shop/category',$token);
        $category = ($getcategory['success'] == false)?null:$getcategory['data'];
        $message = $response['message'];

        return view('app.company.shop.index', compact('shops', 'category', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $token = $request->session()->get('token');
      $getcategory = $this->get(env('GATEWAY_URL').'shop/category',$token);
      $category = ($getcategory['success'] == false)?null:$getcategory['data'];
        return view('app.company.shop.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // return $request->all();
        $token = $request->session()->get('token');
        $data = $request->except('image');
        $photo['name'] = 'photo';
        $photo['contents'] = '';
        if($request->has('image')) {
            $photo['contents'] = fopen($request->image, 'r');
            $photo['filename'] = 'shop.png';
        }

        // dd($photo);
        $response = $this->postMulti(env('GATEWAY_URL').'shop/item/add', $data, $token, $photo);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Added Data Mesjid');
            return redirect('company/shop')->with('success', 'Data Created');
        } else {
          return redirect('company/shop')->with('failed', 'Data Doesnt Created.');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
      $token = $request->session()->get('token');

      $response = $this->get(env('GATEWAY_URL').'shop/item/edit/'.$id, $token);
      $detail = $response['data'];
      $category = $this->get(env('GATEWAY_URL').'shop/category',$token);
      $category = ($category['success'])?$category['data']:null;

      return view('app.company.shop.detail', compact('detail','category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      $token = $request->session()->get('token');
      $response = $this->get(env('GATEWAY_URL').'shop/item/edit/'.$id,$token);
      $shop = $response['data'];
      $getcategory = $this->get(env('GATEWAY_URL').'shop/category',$token);
      $category = ($getcategory['success'] == false)?null:$getcategory['data'];
      return view('app.company.shop.edit',compact('shop', 'category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $token = $request->session()->get('token');

      $data = $request->except('_token','image');

      $photo['name'] = "photo";
      $photo['contents'] = '';
      if ($request->image != null) {
        $photo['contents'] = fopen($request->image,'r');
        $photo['filename'] = 'shop.png';
      }

      $response = $this->postMulti(env('GATEWAY_URL').'shop/item/update/'.$id,$data,$token,$photo);
      // return $response;
      if($response['success'])
      {
        // LogActivity::addToLog('Updated Data Mesjid');
        return redirect('company/shop')->with('success','Data Updated');
      }else {
          return redirect('company/shop')->with('failed','Data Doesnt Updated.');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $req)
    {
        $token = $req->session()->get('token');

        $response = $this->post(env('GATEWAY_URL').'shop/item/delete', $req->all(), $token);
        // return $response;
        if ($response['success']) {
            // LogActivity::addToLog('Deleted Data Mesjid');
          return redirect('company/shop')->with('success', 'Data Deleted');
        } else {
        return redirect('company/shop')->with('failed', 'Data Doesnt Deleted');
        }
    }
}
