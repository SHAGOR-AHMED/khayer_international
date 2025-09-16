@extends('admin.layout.default')
@section('title')
  Manage Expense
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Expense's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('expense.report') }}" target="_blank" style="float: left; font-size: 20px; padding-right:5px;"><i class="fa fa-file-pdf-o"></i></a>
            <a href="{{ route('expense.add') }}" class="btn btn-success btn-sm"> <i class="fa fa-plus"></i>&nbsp;Add New</a>
          </div>
        </div>
        <div class="box-body color-black">
              <table id="members_list_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>Trans. Date</th>
                      <th>Expense From</th>
                      <th>Amount</th>
                      <th>Description</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($allData))
                  	@foreach ($allData as $key => $data)
                      <tr>
                          <td>{{ sprintf("%02d", ++$key); }}</td>
                          <td>{{ $data->transaction_date }}</td>
                          <td>
                            {{ $data->bank->bank_name }}
                            @if($data->image)
                              <a href="{{ asset($data->image) }}" target='_blank'><i class='fa fa-eye'></i></a>
                            @endif
                          </td>
                          <td>{{ bd_money_format($data->amount) }}</td>
                          <td>
                            {{ $data->description }}
                            <a href="#entry' . $data->id . '" role="button" class="btn btn-warning btn-xs" data-toggle="modal">Log</a>
                            <div id="entry' . $data->id . '" class="modal fade">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">X</button>
                                    <h4 id="myModalLabel1"> Log </h4>
                                  </div>
                                  <div class="modal-body">
                                    {{ $data->log }}
                                  </div>
                                </div>
                              </div>
                            </div>
                          </td>
                          <td>
                            @if($data->status == 'Active')
                              <span class="badge btn-success">Active</span>
                            @else
                              <span class="badge btn-danger">Inactive</span>
                            @endif
                          </td>
                          <td>
                              <a href="{{ route('expense.edit',hashid_encode($data->id)) }}" style="color: green;" title="Edit">Edit <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
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