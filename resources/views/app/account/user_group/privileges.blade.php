@extends('layouts.app')

@section('title','Forum | User Group')

@section('section_header')
<h1>User Group</h1>
<div class="section-header-breadcrumb">
  <div class="breadcrumb-item active"><a href="{{ url('/') }}">Dashboard</a></div>
  <div class="breadcrumb-item"><a href="{{ route('user-group.index') }}">UserGroup</a></div>
  <div class="breadcrumb-item"><a href="#">Privileges</a></div>
</div>
@endsection

@section('wrap_content')
<div class="card col-md-10 offset-md-1 shadow">
  <div class="card-body table-responsive">
    @if(session('failed'))
    <div class="alert alert-danger">{{ session('failed') }}</div>
    @endif
    <form action="{{ route('user-group.privileges.store') }}" method="post">
      @csrf
      <table class="table table-striped table-bordered">
        <thead>
          <tr>
            <th>Menu Name</th>
            <th align="center">View</th>
            <th align="center">Add</th>
            <th align="center">Edit</th>
            <th align="center">Delete</th>
            <th align="center">Other</th>
          </tr>
        </thead>
        <tbody>
          @php
            $i = 0;
          @endphp
          @forelse($groupMenu as $key => $value)
          <tr>
            <td colspan="6">{{ $value['name'] }}</td>
          </tr>
          @foreach($value['menu'] as $idx => $val)
          <tr><?php $status = collect($privileges)->where('menu_id',$val['id'])->first(); ?>
            
            <td style="padding-left: 35px">{{ $val['name'] }}
              <input type="hidden" name="menu_id[]" value="{{ $val['id'] }}">
              <input type="hidden" name="user_group_id" value="{{ $id }}">
            </td>
            <td align="center">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="view[{{ $i }}]" value="1" class="custom-control-input" id="view{{ $i }}" 
                  @if($privileges != null && !empty($status) && $status['view'] == '1') checked @endif>
                <label class="custom-control-label" for="view{{ $i }}"></label>
              </div> 
            </td>
            <td align="center">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="add[{{ $i }}]" value="1" class="custom-control-input" id="add{{ $i }}" 
                  @if($privileges != null && !empty($status) && $status['add'] == '1') checked @endif>
                <label class="custom-control-label" for="add{{ $i }}"></label>
              </div> 
            </td>
            <td align="center">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="edit[{{ $i }}]" value="1" class="custom-control-input" id="edit{{ $i }}" 
                  @if($privileges != null && !empty($status) && $status['edit'] == '1') checked @endif>
                <label class="custom-control-label" for="edit{{ $i }}"></label>
              </div> 
            </td>
            <td align="center">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="delete[{{ $i }}]" value="1" class="custom-control-input" id="delete{{ $i }}" 
                  @if($privileges != null && !empty($status) && $status['delete'] == '1') checked @endif>
                <label class="custom-control-label" for="delete{{ $i }}"></label>
              </div> 
            </td>
            <td align="center">
              <div class="custom-control custom-checkbox">
                  <input type="checkbox" name="other[{{ $i }}]" value="1" class="custom-control-input" id="other{{ $i }}" 
                  @if($privileges != null && !empty($status) && $status['other'] == '1') checked @endif>
                <label class="custom-control-label" for="other{{ $i }}"></label>
              </div> 
            </td>
          </tr>
          @php $i++ @endphp
          @endforeach

          @empty
          <tr>
            <td colspan="6">Data empty</td>
          </tr>
          @endforelse
        </tbody>
        
      </table>
      <div class="text-center mt-3">
        <button type="submit" class="btn btn-primary">Save Change</button>
        <a href="{{ url('account/privileges') }}" class="btn btn-secondary">Back</a>
      </div>
    </form>
  </div>
</div>
@endsection
