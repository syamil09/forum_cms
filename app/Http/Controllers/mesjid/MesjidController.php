<?php

namespace App\Http\Controllers\mesjid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use File;
use App\Helpers\LogActivity;

class MesjidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        session()->put('menu','Mesjid List');
        session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'mesjid', $token);
        $get_ustadz = $this->get(env('GATEWAY_URL').'ustadz',$token);
        // return $response;

        $mesjid = ($response['success'] == false)?null:$response['data'];
        $ustadz = ($get_ustadz['success'] == false)?null:$get_ustadz['data'];

        return view('app.mesjid.list.index', compact('mesjid','ustadz'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $token = session()->get('token');
        $ustadz = $this->get(env('GATEWAY_URL').'ustadz',$token)['data'];
        // dd($ustadz);
        return view('app.mesjid.list.create',compact('ustadz'));
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

        $validator = Validator::make($request->all(),[
          'name' => 'required',
          'image' => 'required | mimes:png,jpeg,jpg | max:3072',
          'responsible_person_id' => 'required',
          'city' => 'required',
          'address' => 'required',
          // 'location' => 'required',
          'phone' => 'required',
          'latitude' => 'required',
          'longitude' => 'required',
        ]);

        if ($validator->fails()) {
            // return redirect()->back()->with('failed','image must be have extension : jpg,jpeg,png')->withInput();
            return redirect()->back()->with('failed',$validator->getMessageBag()->first())->withInput();
        }


            $file = $request->file('image');

            $name_file = time()."_".$file->getClientOriginalName();

            $loc_file = public_path('UploadedFile/Mesjid');

            $file->move($loc_file,$name_file);

            $data = [
                'name' => $request['name'],
                'description' => $request['description'],
                'image' => $name_file,
                'responsible_person_id' => $request['responsible_person_id'],
                'city' => $request['city'],
                'address' => $request['address'],
                'location' => '',
                'phone' => $request['phone'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
            ];

        // dd($data);
        $response = $this->post(env('GATEWAY_URL').'mesjid/add', $data, $token);
        // return $response;
        if ($response['success']) {
            LogActivity::addToLog('Added Data Mesjid');
            return redirect('mesjid/list')->with('success', 'Data Created');
        }

        return redirect('mesjid/list')->with('failed', 'Data Doesnt Created.');
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

      $response = $this->get(env('GATEWAY_URL').'mesjid/edit/'.$id, $token);
      $detail = $response['data'];
      $ustadz = $this->get(env('GATEWAY_URL').'ustadz/edit/'.$detail['responsible_person_id'],$token)['data'];
    
      return view('app.mesjid.list.detail', compact('detail','ustadz'));
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
      $response = $this->get(env('GATEWAY_URL').'mesjid/edit/'.$id,$token);
      $mesjid = $response['data'];
      $ustadz = $this->get(env('GATEWAY_URL').'ustadz',$token)['data'];
      return view('app.mesjid.list.edit',compact('mesjid','ustadz'));
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

      $data = [
                'name' => $request['name'],
                'description' => $request['description'],
                'responsible_person_id' => $request['responsible_person_id'],
                'city' => $request['city'],
                'address' => $request['address'],
                'location' => '-',
                'phone' => $request['phone'],
                'latitude' => $request['latitude'],
                'longitude' => $request['longitude'],
            ];

        // jika user ganti photo
        if($request['image'] != null)
        {
            $validator = Validator::make($request->all(),[
                'image' => 'required | mimes:png,jpg,jpeg, | max:2000',
            ]);

            $img = $this->get(env('GATEWAY_URL').'mesjid/edit/'.$id,$token)['data'];
            File::delete('UploadedFile/Mesjid/'.$img['image']);

            if($validator->fails())
            {
                return redirect()->back()->withInput()->with('failed','image must be have extension : jpg,jpeg,png');
            }

            $file = $request->file('image');

            $name_file = time()."_".$file->getClientOriginalName();

            $loc_file = public_path('UploadedFile/Mesjid');

            $file->move($loc_file,$name_file);

            $data['image'] = $name_file;

        }

      $response = $this->post(env('GATEWAY_URL').'mesjid/update/'.$id,$data,$token);
      // dd($response);
      if($response['success'])
      {
        LogActivity::addToLog('Updated Data Mesjid');
        return redirect('mesjid/list')->with('success','Data Updated');
      }else {
          return redirect('mesjid/list')->with('failed','Data Doesnt Updated. '.$response['message']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $req)
    {
        $token = $req->session()->get('token');
        $img = $this->get(env('GATEWAY_URL').'mesjid/edit/'.$req['id'],$token)['data'];
        File::delete('UploadedFile/Mesjid/'.$img['image']);

        $response = $this->post(env('GATEWAY_URL').'mesjid/delete', $req->all(), $token);
        // return $response;
        if ($response['success']) {
            LogActivity::addToLog('Deleted Data Mesjid');
          return redirect('mesjid/list')->with('success', 'Data Deleted');
        }
        return redirect('mesjid/list')->with('failed', 'Data Doesnt Deleted');
    }
}
