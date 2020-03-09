@extends('layouts.app')

@section('title','Mesjidku | User List')

@section('heading')
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User List</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
</div>
@endsection

@section('wrap_content')
<div class="card shadow mb-4">
            <div class="card-header py-3">
              <a href="{{ url('account/user/create') }}" class="btn btn-success">+ add new user</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                @if(session('success'))
                <div class="alert alert-success">{{session('success')}}</div>
                @endif
                @if(session('failed'))
                <div class="alert alert-danger">{{session('failed')}}</div>
                @endif
                <table class="table" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>  
                      <th>Privileges</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Photo</th>
                      <th>Name</th>
                      <th>Username</th>
                      <th>Email</th>    
                      <th>Privileges</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <tr>
                      <td align="center">
                        <img width="100px" height="100px" src="{{ asset('UploadedFile/UserPhoto/1579681945_5dd50c951651b.jpg') }}" alt="Photo Profile" class="rounded">
                      </td>
                      <td>User1</td>
                      <td>User1</td>
                      <td>User1</td>      
                      <td>User1</td>
                      <td class="text-center">
                      	<a href="user/edit/1" class="btn btn-warning btn-sm">Edit</a>
                        <form action="user/delete" method="post" class="d-inline form-del">
                          @csrf
                          <input type="hidden" name="id" value="1">
                          <!-- <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure delete this data?');">Delete</button> -->
                          <button type="submit" class="btn btn-danger btn-sm delete">Delete</button>
                        </form>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

@endsection
