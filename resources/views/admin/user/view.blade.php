@extends('admin.layout.default')
@section('title')
  Manage User
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage User's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('user.add') }}" class="btn btn-success">Add New</a>
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
                      <th>Type</th>
                      <th>Image</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($users))
                  	@foreach ($users as $key => $user)
                      <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ ($user->phone) ? $user->phone : 'N/A' }}</td>
                        <td>{{ $user->type }}</td>
                        <td>
                          <a href="{{ imageShow($user->image) }}" target="_blank">
                            <img height="50" width="60" src="{{ imageShow($user->image) }}" />
                          </a>
                        </td>
                        <td>
                          @if($user->status == 1)
                            <span class="badge btn-success">Active</span>
                          @else
                            <span class="badge btn-danger">Inactive</span>
                          @endif
                        </td>
                        <td>
                            @if($user->status == 1)
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('user.control',hashid_encode($user->id)) }}" >Inactive <i class="fa fa-times-circle fa-lg"></i></a> | 
                            @else
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('user.control',hashid_encode($user->id)) }}" >Active <i class="fa fa-check-circle fa-lg"></i></a> | 
                            @endif

                            <a href="{{ route('user.delete',hashid_encode($user->id))}}" style="color: red;" title="Delete" onclick="return confirm('Are you sure to delete this ?')" >Delete <i class="fa fa-trash-o fa-lg" style="color: red;"></i></a>
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