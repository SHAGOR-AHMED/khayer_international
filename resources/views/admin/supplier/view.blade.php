@extends('admin.layout.default')
@section('title')
  Manage Supplier
@endsection
@section('content')

@php
use App\Models\SupplierLedger;
@endphp

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Supplier's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('supplier.add') }}" class="btn btn-success">Add New</a>
          </div>
        </div>
        <div class="box-body color-black">
              <table id="members_list_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>Office Name</th>
                      <th>Phone</th>
                      <th>Address</th>
                      <th>Current Balance</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($allData))
                  	@foreach ($allData as $key => $data)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $data->office_name }}</td>
                          <td>{{ ($data->phone) ? $data->phone : 'N/A' }}</td>
                          <td>{{ $data->address }}</td>
                          <td>{{ $data->balance }}</td>
                          <td>
                            @if($data->status == 1)
                              <span class="badge btn-success">Active</span>
                            @else
                              <span class="badge btn-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                              @if($data->status == 1)
                                  <a onclick="return confirm('Are You Sure?')" href="{{ route('supplier.control',hashid_encode($data->id)) }}" >Inactive <i class="fa fa-times-circle fa-lg"></i></a> | 
                              @else
                                  <a onclick="return confirm('Are You Sure?')" href="{{ route('supplier.control',hashid_encode($data->id)) }}" >Active <i class="fa fa-check-circle fa-lg"></i></a> | 
                              @endif
                              <a href="{{ route('supplier.edit',hashid_encode($data->id)) }}" style="color: green;" title="Edit">Edit <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
                              @if(SupplierLedger::where('supplier_id',$data->id)->count() <= 1)
                                | <a href="{{ route('supplier.delete',hashid_encode($data->id))}}" style="color: red;" title="Delete" onclick="return confirm('Are you sure to delete this ?')" >Delete <i class="fa fa-trash fa-lg" style="color: red;"></i></a>
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