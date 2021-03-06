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

        $company_id = session()->get('company_id');
        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'shop/item?company_id='.$company_id, $token);
        $shops    = $response['success'] == false ? null : $response['data'];
        $message  = $response['message'];

        return view('app.company.shop.index', compact('shops', 'message'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $token = $request->session()->get('token');
      $profile = $this->get(env('GATEWAY_URL'). 'admin/profile', $token);
      $profile = $profile['success'] ? $profile['data'] : null;
      $company_id = $profile['company_id'] !== null ? $profile['company_id'] : session()->get('company_id');
      $getcategory = $this->get(env('GATEWAY_URL').'shop/category',$token);
      $category = ($getcategory['success'] == false)?null:$getcategory['data'];
      $getstore = $this->get(env('GATEWAY_URL'). 'store?company_id='. $company_id, $token);
      $store = $getstore['success']  == false ? null : $getstore['data'];
      $company = $this->get(env('GATEWAY_URL'). 'company', $token);
      $company = $company['data'];
        return view('app.company.shop.create', compact('category', 'store', 'profile', 'company'));
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

        $photo[0]['name'] = 'photo[]';
        $photo[0]['contents'] = '';
        if($request->has('image')) {
          foreach ($request['image'] as $key => $value) {
            $photo[$key]['name'] = 'photo[]';
            $photo[$key]['contents'] = fopen($value, 'r');
            $photo[$key]['filename'] = 'shop.png';
          }
        }

        $response = $this->postMulti(env('GATEWAY_URL').'shop/item/add', $data, $token, null, $photo);
        // dd($response);
        if ($response['success']) {
            // LogActivity::addToLog('Added Data Mesjid');
            return redirect('company/shop')->with('success', 'Data Created');
        } else {
          return redirect()->back()->with('failed', 'Data Doesnt Created, '. collect($response['message'])->first()[0]);
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

      return view('app.company.shop.detail', compact('detail'));
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
      $shop = $response['success'] ? $response['data'] : null;
      $getcategory = $this->get(env('GATEWAY_URL').'shop/category',$token);
      $category = ($getcategory['success'] == false)?null:$getcategory['data'];
      $getstore = $this->get(env('GATEWAY_URL'). 'store', $token);
      $store = $getstore['success']  == false ? null : $getstore['data'];

      if ($shop && $shop['berat'] != null) {
        $weightExplode = explode(' ', $shop['berat']);
        $shop['berat'] = $weightExplode[0];
      }
      // dd($shop);
      return view('app.company.shop.edit',compact('shop', 'category', 'store'));
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
      $data  = $request->except('_token','image','totalImage');
    
      $photo[0]['name'] = 'photo[]';
      $photo[0]['contents'] = '';
      if($request->has('image')) {
        foreach ($request['image'] as $key => $value) {
          $photo[$key]['name'] = 'photo[]';
          $photo[$key]['contents'] = fopen($value, 'r');
          $photo[$key]['filename'] = 'shop.png';
        }
      }
      $data['imageView'] = !empty($data['imageView']) ? json_encode($data['imageView'], true) : null;

      $response = $this->postMulti(env('GATEWAY_URL').'shop/item/update/'.$id,$data,$token, null, $photo);
   
      if ($response['success']) {
        return redirect('company/shop')->with('success','Data Updated');
      } else {
          return redirect()->back()->with('failed','Data Doesnt Updated.'. collect($response['message'])->first()[0]);
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
