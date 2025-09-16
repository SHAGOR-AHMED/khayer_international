@extends('admin.layout.default')
@section('title')
  Manage Bank
@endsection
@section('content')

@php
use App\Models\BankLedger;
@endphp

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Bank's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('bank.add') }}" class="btn btn-success"> <i class="fa fa-plus"></i>&nbsp;Add New</a>
          </div>
        </div>
        <div class="box-body color-black">
              <table id="members_list_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>Bank Name</th>
                      <th>Account Name</th>
                      <th>Acount No</th>
                      <th>Current Balance</th>
                      <th>Remarks</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($allData))
                  	@foreach ($allData as $key => $data)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $data->bank_name }}</td>
                          <td>{{ $data->account_name }}</td>
                          <td>{{ $data->account_no }}</td>
                          <td>{{ bd_money_format($data->account_balance) }}</td>
                          <td>{{ $data->bank_remarks }}</td>
                          <td>
                            @if($data->bank_status == 'ACTIVE')
                              <span class="badge btn-success">Active</span>
                            @else
                              <span class="badge btn-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                            @if($data->id != 1)
                              @if($data->bank_status == 'ACTIVE')
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('bank.control',hashid_encode($data->id)) }}" >Inactive <i class="fa fa-times-circle fa-lg"></i></a> | 
                              @else
                                <a onclick="return confirm('Are You Sure?')" href="{{ route('bank.control',hashid_encode($data->id)) }}" >Active <i class="fa fa-check-circle fa-lg"></i></a> | 
                              @endif
                                <a href="{{ route('bank.edit',hashid_encode($data->id)) }}" style="color: green;" title="Edit">Edit <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
                              @if(BankLedger::where('bank_id',$data->id)->count() <= 1)
                                | <a href="{{ route('bank.delete',hashid_encode($data->id))}}" style="color: red;" title="Delete" onclick="return confirm('Are you sure to delete this ?')" >Delete <i class="fa fa-trash fa-lg" style="color: red;"></i></a>
                              @endif
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
