<?php

namespace App\Http\Controllers\mesjid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      session()->put('menu','Kegiatan Mesjid');
      session()->put('group','Mesjid');

      $token = $request->session()->get('token');

      $response = $this->get(env('GATEWAY_URL').'kegiatan', $token);
      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', $token);
      // return $response;
      $mesjids = ($getmesjid['success'] == false)?null:$getmesjid['data'];
      $kegiatans = ($response['success'] == false)?null:$response['data'];
// return $mesjid;
      return view('app.mesjid.kegiatan.index', compact('kegiatans','mesjids'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', session()->get('token'));
      $getustadz = $this->get(env('GATEWAY_URL').'ustadz', session()->get('token'));
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];
      $ustadz = ($getustadz['success'] == false)?null:$getustadz['data'];
      return view('app.mesjid.kegiatan.create', ['mesjid' => $mesjid, 'ustadz' => $ustadz]);
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
          'description' => 'required',
          'photo' => 'required | mimes:png,jpeg,jpg | max:3072',
          'date' => 'required',
          'mesjid' => 'required',
        ]);

            $file = $request->file('photo');

            $name_file = time()."_".$file->getClientOriginalName();

            $loc_file = public_path('UploadedFile/Kegiatan');

            $file->move($loc_file,$name_file);

            $data = [
              'name' => $request['name'],
              'description' => $request['description'],
              'photo' => $name_file,
              'date' => $request['date'],
              'mesjid_id' => $request['mesjid'],
              'ustadz_id' => $request['ustadz'],
            ];

        $response = $this->post(env('GATEWAY_URL').'kegiatan/add', $data, $token);
// return $response;
        if ($response['success']) {
          LogActivity::addToLog('Added Data Kegiatan');
          return redirect('mesjid/kegiatan')->with('success', 'Data Created');
        }
        return redirect('mesjid/kegiatan')->with('failed', 'Data Doesnt Created. '.$response['message']);
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

      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', session()->get('token'));
      $getustadz = $this->get(env('GATEWAY_URL').'ustadz', session()->get('token'));
      $mesjid = $getmesjid['data'];
      $ustadz = $getustadz['data'];

      $response = $this->get(env('GATEWAY_URL').'kegiatan/edit/'.$id, $token);
      $detail = $response['data'];

      return view('app.mesjid.kegiatan.detail', compact('detail', 'mesjid', 'ustadz'));
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
      $response = $this->get(env('GATEWAY_URL').'kegiatan/edit/'.$id,$token);

      $getmesjid = $this->get(env('GATEWAY_URL').'mesjid', session()->get('token'));
      $getustadz = $this->get(env('GATEWAY_URL').'ustadz', session()->get('token'));
      $mesjid = ($getmesjid['success'] == false)?null:$getmesjid['data'];
      $ustadz = ($getustadz['success'] == false)?null:$getustadz['data'];

      $kegiatan = $response['data'];
      return view('app.mesjid.kegiatan.edit',compact('kegiatan','mesjid','ustadz'));
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
      // dd($request->all());
      $data = [
        'name' => $request['name'],
        'description' => $request['description'],
        'date' => $request['date'],
        'mesjid_id' => $request['mesjid_id'],
        'ustadz_id' => $request['ustadz_id']
      ];
      // dd($data);

      if($request->photo != null)
      {
          $validator = Validator::make($request->all(),[
            'photo' => 'required | mimes:png,jpeg,jpg | max:3072'
          ]);

          if($validator->fails())
          {
            return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput(); 
          }

          $img = $this->get(env('GATEWAY_URL').'kegiatan/edit/'.$id,$token)['data'];
          File::delete('UploadedFile/Kegiatan/'.$img['photo']);

          $file = $request->file('photo');

          $name_file = time()."_".$file->getClientOriginalName();

          $loc_file = public_path('UploadedFile/Kegiatan');

          $file->move($loc_file,$name_file);

          $data['photo'] = $name_file;
      }

      $response = $this->post(env('GATEWAY_URL').'kegiatan/update/'.$id,$data,$token);
      // return $response;
      if($response['success'])
      {
          LogActivity::addToLog('Updated Data Kegiatan');
          return redirect('mesjid/kegiatan')->with('success','Data Updated');
      }

        return redirect('mesjid/kegiatan')->with('failed','Data Doesnt Updated. '.$response['message']);
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
      $img = $this->get(env('GATEWAY_URL').'kegiatan/edit/'.$request['id'],$token)['data'];
      File::delete('UploadedFile/Kegiatan/'.$img['photo']);
      $response = $this->post(env('GATEWAY_URL').'kegiatan/delete', $request->all(), $token);
      // return $response;
      if ($response['success']) {
        LogActivity::addToLog('Deleted Data Kegiatan');
        return redirect('mesjid/kegiatan')->with('success', 'Data Deleted');
      }
      return redirect('mesjid/kegiatan')->with('failed', 'Data Doesnt Deleted '.$response['message']);
    }
}
