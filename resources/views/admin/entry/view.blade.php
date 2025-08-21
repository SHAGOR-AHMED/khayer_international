@extends('admin.layout.default')
@section('title')
  Manage All Entry List
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage All Entry List's</h3>
          <div class="box-tools pull-right"></div>
        </div>
        <div class="box-body color-black">
              <table id="members_list_table" class="table table-bordered table-striped">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>REF/Agent</th>
                      <th>BD Office</th>
                      <th>Country</th>
                      <th>Client Details</th>
                      <th>Kopil No</th>
                      <th>PC Ref No</th>
                      <th>Medical Report</th>
                      <th>GCC Medical Report</th>
                      <th>Entry Date</th>
                      <th>Status</th>
                      <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  @if(!empty($allData))
                  	@foreach ($allData as $key => $data)
                      <tr>
                          <td>{{ ++$key }}</td>
                          <td>{{ $data->agent->name }}</td>
                          <td>{{ $data->rl_no }}</td>
                          <td>{{ $data->country }}</td>
                          <td>
                            <b>Name:</b> {{ $data->user->name }}<br>
                            <b>Mobile No:</b> {{ $data->user->phone }}<br>
                            <b>DOB:</b> {{ $data->user->dob }}<br>
                            <b>Passport No:</b> {{ $data->user->passport_no }}<br>
                            <b>Expired Date:</b> {{ $data->user->passport_expired_date }}
                          </td>
                          <td>{{ $data->kopil_no }}</td>
                          <td>{{ $data->pc_ref_no }}</td>
                          <td>{{ $data->medical_report }}</td>
                          <td>{{ $data->gcc_medical_report }}</td>
                          <td>{{ $data->created_at }}</td>
                          <td>
                            @if($data->status == 'PENDING')
                              <span class="badge btn-success">PENDING</span>
                            @else
                              <span class="badge btn-primary">DELIVERED</span>
                            @endif
                          </td>
                          <td>
                              <a href="{{ route('entry.edit',$data->id)}}" style="color: green;" title="Edit">View <i class="fa fa-pencil-square fa-lg" style="color: green;"></i></a>
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