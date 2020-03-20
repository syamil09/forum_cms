@extends('layouts.app')

@section('title','Forum | Member')

@section('section_header')
<h1>Admin Company</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Admin Company</a></div>
  <div class="breadcrumb-item"><a href="#">Modules</a></div>
  <div class="breadcrumb-item">AdminCompany</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <a href="#" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i> Add Member</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">
                  #
                </th>
                <th width="10%">Photo</th>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  1
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-5.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                </td>
                <td>Create a mobile app</td>
                <td>2018-01-20</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>
                  2
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-5.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                </td>
                <td>Redesign homepage</td>
                <td>2018-04-10</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>
              <tr>
                <td>
                  3
                </td>
                <td>
                  <img alt="image" src="{{ asset('stisla/assets/img/avatar/avatar-1.png') }}" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                </td>
                <td>Backup database</td>
                <td>2018-01-29</td>
                <td>
                  <a title="" class="btn btn-info btn-action" data-toggle="tooltip" data-original-title="Detail"><i class="fas fa-info"></i></a>
                  <a title="" class="btn btn-warning btn-action" data-toggle="tooltip" data-original-title="Edit"><i class="fas fa-pencil-alt"></i></a>
                  <a title="" class="btn btn-danger btn-action" data-toggle="tooltip" data-original-title="Delete"><i class="fas fa-trash"></i></a>
                </td>
              </tr>

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
