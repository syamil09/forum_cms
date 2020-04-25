<?php

namespace App\Http\Controllers\company;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'store', $token);
        $store = ($response['success'] == false)?null:$response['data'];
        $message = $response['message'];

        return view('app.company.store.index', compact('store', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.company.store.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $token = $request->session()->get('token');

        $request->validate([
          'name' => 'required',
          'image' => 'max:3072',
          'phone' => 'required',
          'location' => 'required',
          'latitude' => 'required',
          'longitude' => 'required',
        ]);

        $logo['name'] = 'logo';
        $logo['contents'] = '';
        if ($request->hasFile('image')) {
          $logo['contents'] = fopen($request->image, 'r');
          $logo['filename'] = 'logo.png';
        }

        $data = $request->except('image');

        $response = $this->postMulti(env('GATEWAY_URL').'store/add', $data, $token, $logo);
// return $response;
        if ($response['success']) {
            return redirect('company/store')->with('success', 'Data Created');
        }

        return redirect('company/store')->with('failed', 'Data Doesnt Created. ' .$response['message']);
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

      $response = $this->get(env('GATEWAY_URL').'store/edit/'.$id, $token);
      $detail = $response['data'];

      return view('app.company.store.detail', compact('detail'));
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

      $response = $this->get(env('GATEWAY_URL').'store/edit/'.$id, $token);
      $edit = $response['data'];

      return view('app.company.store.edit', compact('edit'));
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

        // jika user ganti photo
        $logo['name'] = 'logo';
        $logo['contents'] = '';
        if($request['image'] != null)
        {
            $logo['contents'] = fopen($request->image, 'r');
            $logo['filename'] = 'logo.png';
        }
        // return $ data;
        $response = $this->postMulti(env('GATEWAY_URL').'store/update/'.$id, $data, $token, $logo);
        // return $response;
        if($response['success'])
        {
            return redirect('company/store')->with('success','Data Updated');
        }else {
            return redirect('company/store')->with('failed','Data Doesnt Updated. ');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
      $token = $request->session()->get('token');

      $response = $this->post(env('GATEWAY_URL').'store/delete', $request->all(), $token);
      // return $response;
      if ($response['success']) {
        return redirect('company/store')->with('success', 'Data Deleted');
      }
      return redirect('company/store')->with('failed', 'Data Doesnt Deleted');
    }
}
