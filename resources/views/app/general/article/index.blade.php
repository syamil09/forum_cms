@extends('layouts.app')

@section('title','Forum | Article')

@section('section_header')
<h1>Article</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="#">General</a></div>
  <div class="breadcrumb-item">Article</div>
</div>
@endsection

@section('wrap_content')
<div class="row">
  <div class="col-12">
    <!-- <div class="card">
      <div class="card-header">
        <a href="{{ url('general/article/create') }}" class="btn btn-lg btn-primary text-white rounded"><i class="fas fa-plus"></i>&nbsp Add Article</a>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-striped" id="table-1">
            <thead>
              <tr>
                <th class="text-center" width="5%">
                  #
                </th>
                <th width="10%">Title</th>
                <th>views</th>
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
    </div> -->
    <div class="card">
                  <div class="card-header">
                    <h4>Basic DataTables</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Task Name</th>
                            <th>Progress</th>
                            <th>Members</th>
                            <th>Due Date</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>
                              1
                            </td>
                            <td>Create a mobile app</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Wildan Ahdian">
                            </td>
                            <td>2018-01-20</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              2
                            </td>
                            <td>Redesign homepage</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="0%">
                                <div class="progress-bar" data-width="0"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Nur Alpiana">
                              <img alt="image" src="../assets/img/avatar/avatar-3.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hariono Yusup">
                              <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Bagus Dwi Cahya">
                            </td>
                            <td>2018-04-10</td>
                            <td><div class="badge badge-info">Todo</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              3
                            </td>
                            <td>Backup database</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="70%">
                                <div class="progress-bar bg-warning" data-width="70%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                              <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Hasan Basri">
                            </td>
                            <td>2018-01-29</td>
                            <td><div class="badge badge-warning">In Progress</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                          <tr>
                            <td>
                              4
                            </td>
                            <td>Input data</td>
                            <td class="align-middle">
                              <div class="progress" data-height="4" data-toggle="tooltip" title="100%">
                                <div class="progress-bar bg-success" data-width="100%"></div>
                              </div>
                            </td>
                            <td>
                              <img alt="image" src="../assets/img/avatar/avatar-2.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Rizal Fakhri">
                              <img alt="image" src="../assets/img/avatar/avatar-5.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Isnap Kiswandi">
                              <img alt="image" src="../assets/img/avatar/avatar-4.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Yudi Nawawi">
                              <img alt="image" src="../assets/img/avatar/avatar-1.png" class="rounded-circle" width="35" data-toggle="tooltip" title="Khaerul Anwar">
                            </td>
                            <td>2018-01-16</td>
                            <td><div class="badge badge-success">Completed</div></td>
                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
  </div>
</div>

@endsection
