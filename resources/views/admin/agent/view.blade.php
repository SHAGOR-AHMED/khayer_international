@extends('admin.layout.default')
@section('title')
  Manage Agent
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Agent's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('agent.add') }}" class="btn btn-success">Add New</a>
          </div>
        </div>
        <div class="box-body color-black">
              <table id="members_list_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Phone</th>
                      <th>Balance</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($allData))
                  	@foreach ($allData as $key => $data)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $data->name }}</td>
                          <td>{{ $data->email }}</td>
                          <td>{{ $data->phone }}</td>
                          <td>{{ $data->balance }}</td>
                          <td>
                              <a href="{{ imageShow($data->image) }}" target="_blank">
                                <img height="50" width="60" src="{{ imageShow($data->image) }}" />
                              </a>
                          </td>
                          <td>
                            @if($data->status == 1)
                              <span class="badge btn-success">Active</span>
                            @else
                              <span class="badge btn-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                              @if($data->status == 1)
                                  <a onclick="return confirm('Are You Sure?')" href="{{ route('agent.control',hashid_encode($data->id)) }}" >Inactive <i class="fa fa-times-circle fa-lg"></i></a> | 
                              @else
                                  <a onclick="return confirm('Are You Sure?')" href="{{ route('agent.control',hashid_encode($data->id)) }}" >Active <i class="fa fa-check-circle fa-lg"></i></a> | 
                              @endif
                              <a href="{{ route('agent.edit',hashid_encode($data->id)) }}" style="color: green;" title="Edit">Edit <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
                              @if(!existed('entries', 'agent_id', $data->id))
                                | <a href="{{ route('agent.delete',hashid_encode($data->id))}}" style="color: red;" title="Delete" onclick="return confirm('Are you sure to delete this ?')" >Delete <i class="fa fa-trash fa-lg" style="color: red;"></i></a>
                              @endif
                          </td>
                      </tr>
                    @endforeach
                  @endif
                </tbody>
              </table>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection