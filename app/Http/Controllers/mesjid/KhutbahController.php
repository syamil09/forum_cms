<?php

namespace App\Http\Controllers\mesjid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\LogActivity;

class KhutbahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        session()->put('menu','Khutbah Jumat');
        session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'khutbah', $token);
        $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', $token);
        $getustadz = $this->get(env('GATEWAY_URL').'ustadz', $token);
        $khutbah = ($response['success'] == false)?null:$response['data'];
        $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];
        $ustadz = ($getustadz['success'] == false)?null:$getustadz['data'];
        // return $ustadz;

        return view('app.mesjid.khutbah.index', ['khutbah' => $khutbah, 'mesjid' => $mesjid, 'ustadz' => $ustadz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', session()->get('token'));
      $getustadz = $this->get(env('GATEWAY_URL').'ustadz', session()->get('token'));
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];
      $ustadz = ($getustadz['success'] == false)?null:$getustadz['data'];

      return view('app.mesjid.khutbah.create', ['mesjid' => $mesjid, 'ustadz' => $ustadz]);
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
          'date' => 'required',
          'mesjid_id' => 'required',
          'ustadz_id' => 'required'
        ]);

        $response = $this->post(env('GATEWAY_URL').'khutbah/add', $request->all(), $token);
// return $response;
        if ($response['success']) {
          LogActivity::addToLog('Added Data Khutbah');
          return redirect('mesjid/khutbah')->with('success', 'Data Created');
        }

        return redirect('mesjid/khutbah')->with('failed', 'Data Doesnt Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

      $response = $this->get(env('GATEWAY_URL').'khutbah/edit/'.$id,$token);

      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', session()->get('token'));
      $getustadz = $this->get(env('GATEWAY_URL').'ustadz', session()->get('token'));
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];
      $ustadz = ($getustadz['success'] == false)?null:$getustadz['data'];

      $khutbah = $response['data'];
      return view('app.mesjid.khutbah.edit',['khutbah' => $khutbah, 'mesjid' => $mesjid, 'ustadz' => $ustadz]);
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

      $response = $this->post(env('GATEWAY_URL').'khutbah/update/'.$id,$data,$token);
      // return $response;
      if($response['success'])
      {
        LogActivity::addToLog('Updated Data Khutbah');
        return redirect('mesjid/khutbah')->with('success','Data Updated');
      }

        return redirect('mesjid/khutbah')->with('failed','Data Doesnt Updated. '.$response['message']);
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
      $response = $this->post(env('GATEWAY_URL').'khutbah/delete', $request->all(), $token);
      // return $response;
      if ($response['success']) {
        LogActivity::addToLog('Deleted Data Khutbah');
        return redirect('mesjid/khutbah')->with('success', 'Data Deleted');
      }
      return redirect('mesjid/khutbah')->with('failed', 'Data Doesnt Deleted');
    }
}
