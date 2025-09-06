@extends('admin.layout.default')
@section('title')
  Manage Passenger's
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Passenger's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('client.add') }}" class="btn btn-success">Add New</a>
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
                      <th>Gender</th>
                      <th>Photo</th>
                      <th>Passport</th>
                      <th>Passport No</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(!empty($users)){ 
                  	foreach ($users as $key => $user) { 
                  ?>
                    <tr>
                      	<td>{{ ++$key }}</td>
                        <td>
                          {{ $user->name }}<br>
                          <b>DOB</b>-{{ ($user->dob) ? $user->dob : 'N/A' }}
                        </td>
                        <td>{{ ($user->email) ? $user->email : 'N/A' }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ getGender($user->gender) }}</td>
                        <td>
                          <a href="{{ imageShow($user->image) }}" target="_blank">
                            <img height="50" width="60" src="{{ imageShow($user->image) }}" />
                          </a>
                        </td>
                        <td>
                          <a href="{{ imageShow($user->passport_doc) }}" target="_blank">
                            <img height="50" width="60" src="{{ imageShow($user->passport_doc) }}" />
                          </a>
                        </td>
                        <td>
                          {{ $user->passport_no }}<br>
                          <b>Expired Date:</b> {{ ($user->passport_expired_date) ? $user->passport_expired_date : 'N/A' }}<br>
                          <b>Original Passport Given:</b> {{  $user->is_original_passport_given }}
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
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('client.control',hashid_encode($user->id)) }}" >Inactive <i class="fa fa-times-circle fa-lg"></i></a> | 
                            @else
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('client.control',hashid_encode($user->id)) }}" >Active <i class="fa fa-check-circle fa-lg"></i></a> | 
                            @endif
                            <a href="{{ route('client.edit',hashid_encode($user->id))}}" style="color: green;" title="Edit">Edit <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
                            @if(!existed('entries', 'client_id', $user->id))
                              | <a href="{{ route('client.delete',hashid_encode($user->id))}}" style="color: red;" title="Delete" onclick="return confirm('Are you sure to delete this ?')" >Delete <i class="fa fa-trash-o fa-lg" style="color: red;"></i></a>
                            @endif
                        </td>
                    </tr>
                  <?php } } ?>
                </tbody>
              </table>        
        </div><!-- /.box-body -->
      </div><!-- /.box -->
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->
@endsection