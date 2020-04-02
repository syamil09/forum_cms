<?php

namespace App\Http\Controllers\mesjid;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Helpers\LogActivity;

class UstadzController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        session()->put('menu','Ustadz List');
        session()->put('group','Mesjid');

        $token = $request->session()->get('token');

        $response = $this->get(env('GATEWAY_URL').'ustadz', $token);

        $ustadz = ($response['success'] == false)?null:$response['data'];

        return view('app.mesjid.ustadz.index', ['ustadz' => $ustadz]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('app.mesjid.ustadz.create');
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
          'image' => 'required | mimes:png,jpeg,jpg | max:3072',
          'phone' => 'required',
        ]);

        $file = $request->file('image');
        $name_file = time()."_".$file->getClientOriginalName();
        $loc_file = public_path('UploadedFile/Ustadz');
        $file->move($loc_file, $name_file);

        $data = [
          'name' => $request['name'],
          'notes' => $request['notes'],
          'image' => $name_file,
          'email' => $request['email'],
          'phone' => $request['phone'],
        ];

        $response = $this->post(env('GATEWAY_URL').'ustadz/add', $data, $token);

        if ($response['success']) {
            LogActivity::addToLog('Added Data Ustadz');
            return redirect('mesjid/ustadz')->with('success', 'Data Created');
        }

        return redirect('mesjid/ustadz')->with('failed', 'Data Doesnt Created '.$response['message']);
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

      $response = $this->get(env('GATEWAY_URL').'ustadz/edit/'.$id, $token);
      $detail = $response['data'];

      return view('app.mesjid.ustadz.detail', compact('detail'));
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

      $response = $this->get(env('GATEWAY_URL').'ustadz/edit/'.$id, $token);
      $ustadz = $response['data'];

      return view('app.mesjid/ustadz/edit', compact('ustadz'));
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
        if($request['image'] != null)
        {
            $validator = Validator::make($request->all(),[
                'image' => 'required | mimes:png,jpg,jpeg, | max:2000',
            ]);

            if($validator->fails())
            {
                return redirect()->back()->withInput()->with('failed','image must be have extension : jpg,jpeg,png');
            }
            
            $file = $request->file('image');

            $name_file = time()."_".$file->getClientOriginalName();

            $loc_file = public_path('UploadedFile/Ustadz');

            $file->move($loc_file,$name_file);

            $data['image'] = $name_file;
            
        }
        // return $ data;
        $response = $this->post(env('GATEWAY_URL').'ustadz/update/'.$id, $data, $token);

        if($response['success'])
        {
            LogActivity::addToLog('Updated Data Ustadz');
            return redirect('mesjid/ustadz')->with('success','Data Updated');
        }else {
            return redirect('mesjid/ustadz')->with('failed','Data Doesnt Updated. '.$response['message']);
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
      $img = $this->get(env('GATEWAY_URL').'ustadz/edit/'.$request['id'],$token)['data'];
      File::delete('UploadedFile/Ustadz/'.$img['image']);

      $response = $this->post(env('GATEWAY_URL').'ustadz/delete', $request->all(), $token);
      // return $response;
      if ($response['success']) {
        LogActivity::addToLog('Deleted Data Ustadz');
        return redirect('mesjid/ustadz')->with('success', 'Data Deleted');
      }
      return redirect('mesjid/ustadz')->with('failed', 'Data Doesnt Deleted');
    }
}
