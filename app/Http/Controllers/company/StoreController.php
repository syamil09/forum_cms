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
        $company_id = session()->get('company_id');
        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'store?company_id='.$company_id, $token);
        $store    = $response['success'] ? $response['data'] : null;
        $message  = $response['message'];

        return view('app.company.store.index', compact('store', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $token = session()->get('token');
      $profile = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
      $profile = $profile['success'] ? $profile['data'] : null;
      $company = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $company['data'];
        return view('app.company.store.create', compact('profile', 'company'));
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
       
        if ($response['success']) {
            return redirect('company/store')->with('success', 'Data Created');
        }

        return redirect()->back()->with('failed', 'Data Doesnt Created, ' .$response['message']);
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

        $validate = Validator::make($request->all(),[
          'name' => 'required',
          'image' => 'max:3072',
          'phone' => 'required',
          'location' => 'required',
          'latitude' => 'required',
          'longitude' => 'required',
        ]);

        if ($validate->fails()) {
          return redirect()->back()->with('failed','Data Doesnt Updated, '. $validate->getMessageBag()->first());
        }
        // jika user ganti photo
        $logo['name'] = 'logo';
        $logo['contents'] = '';
        if($request['image'] != null)
        {
            $logo['contents'] = fopen($request->image, 'r');
            $logo['filename'] = 'logo.png';
        }
  
        $response = $this->postMulti(env('GATEWAY_URL').'store/update/'.$id, $data, $token, $logo);
         // dd($response);
        if($response['success'])
        {
            return redirect('company/store')->with('success','Data Updated');
        }else {
            return redirect()->back()->with('failed','Data Doesnt Updated, '. $response['message']);
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
