<?php

namespace App\Http\Controllers\mesjid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\LogActivity;

class KasController extends Controller
{
    public function index(Request $request)
    {
        session()->put('menu','Kas Mesjid');
        session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        // $response = $this->get(env('GATEWAY_URL').'kas', $token);
        $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', $token);
        // $kas = ($response['success'] == false)?null:$response['data'];
        $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];

        return view('app.mesjid.kas.index', ['mesjid' => $mesjid]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $token = $request->session()->get('token');

      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', $token);
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];

      return view('app.mesjid.kas.create', compact('mesjid'));
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
          'mesjid_id' => 'required',
          'kas_date' => 'required',
          'kas_value' => 'required',
        ]);

        $response = $this->post(env('GATEWAY_URL').'kas/add', $request->all(), $token);
        
        if ($response['success']) {
          LogActivity::addToLog('Added Data Kas');
          return redirect('mesjid/kas')->with('success', 'Data Created');
        }

        return redirect('mesjid/kas')->with('failed', 'Data Doesnt Created.'. $response['message']);

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

        $response = $this->get(env('GATEWAY_URL').'kas', $token);
        $getmesjid = $this->get(env('GATEWAY_URL').'mesjid/edit/'.$id, $token);
        $kas = ($response['success'] == false)?null:$response['data'];
        // return $getmesjid;
        $mesjid = $getmesjid['data'];

        return view('app.mesjid.kas.detail', ['kas' => $kas, 'mesjid' => $mesjid]);
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

      $response = $this->get(env('GATEWAY_URL').'kas/edit/'.$id,$token);
      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', $token);
      $kas = $response['data'];
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];

      return view('app.mesjid.kas.edit', ['kas' => $kas, 'mesjid' => $mesjid]);
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

      $data = $request->except('_token');

      $response = $this->post(env('GATEWAY_URL').'kas/update/'.$id,$data,$token);
      if($response['success'])
      {
          LogActivity::addToLog('Updated Data Kas');
          return redirect('mesjid/kas')->with('success','Data Updated');
      }

        return redirect('mesjid/kas')->with('failed','Data Doesnt Updated. '.$response['message']);
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

        $response = $this->post(env('GATEWAY_URL').'kas/delete',$request->all(),$token);
        if ($response['success']) {
          LogActivity::addToLog('Deleted Data Kas');
          return redirect('mesjid/kas')->with('success', 'Data Deleted');
        }
        return redirect('mesjid/kas')->with('failed', 'Data Doesnt Deleted');
    }
}
