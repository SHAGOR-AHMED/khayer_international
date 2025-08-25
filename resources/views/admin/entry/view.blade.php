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
              <table id="members_list_table" class="table table-bordered table-striped example">
                <thead>
                  <tr>
                      <th>SN</th>
                      <th>REF/Agent</th>
                      <th>BD Office</th>
                      <th>Country</th>
                      <th>Client Details</th>
                      <th>Kopil No</th>
                      <th>PC Ref No</th>
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
                            <b>DOB:</b> {{ ($data->user->dob) ? $data->user->dob : 'N/A'}}<br>
                            <b>Passport No:</b> {{ $data->user->passport_no }}<br>
                            <b>Expired Date:</b> {{ $data->user->passport_expired_date }}
                          </td>
                          <td>{{ $data->kopil_no }}</td>
                          <td>{{ $data->pc_ref_no }}</td>
                          <td>{{ $data->gcc_medical_report }}</td>
                          <td>{{ $data->created_at }}</td>
                          <td>
                            @if($data->is_returned == 'YES')
                              <span class="badge btn-danger">RETURNED</span><br><br>
                            @else
                              @if($data->status == 'PENDING')
                              <span class="badge btn-primary">PENDING</span><br><br>
                              @elseif($data->status == 'EMBASSY')
                                <span class="badge btn-info">EMBASSY</span><br><br>
                              @elseif($data->status == 'MANPOWER')
                                <span class="badge btn-warning">MANPOWER</span><br><br>
                              @elseif($data->status == 'DELIVERED')
                                <span class="badge btn-success">DELIVERED</span><br><br>
                              @endif
                              <button class="btn btn-default" id="next_stage_modal" data-toggle="modal" data-id="{{ $data->id }}" data-target="#staticBackdrop">Next Stage</button>
                            @endif
                          </td>
                          <td>
                              <a href="{{ route('entry.details',$data->id)}}" style="color: green;" title="Details">View <i class="fa fa-eye fa-lg" style="color: green;"></i></a> | 

                              <a href="#" style="color: black;" title="Log" >Log <i class="fa fa-info fa-lg" style="color: black;"></i></a>
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

  <!-- Next Stage Modal HTML -->
    <div id="staticBackdrop" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Next Stage</h4>
                </div>
                <div class="modal-body">

                    <div class="box-body">
                      <div class="row">
                        <div class="col-md-12">
                          <form action="{{ route('entry.nextStage') }}" method="post" name="form" enctype="multipart/form-data" onsubmit="return(validate())">
                          @csrf

                            <input type="hidden" class="form-control" value="" id="myInput" name="id">
                            <div class="form-group">
                              <label for="type">Next Stage<span class="text-red">*</span></label>
                              <select class="form-control" name="status" required>
                                <option value="0">Please Select</option>
                                <option value="EMBASSY">EMBASSY</option>
                                <option value="MANPOWER">MANPOWER</option>
                                <option value="DELIVERED">DELIVERED</option>
                              </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">OK</button>
                            </div>

                          </form> 
                        </div>
                      </div>
                    </div>

                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
      $(document).on("click", "#next_stage_modal", function () {
          var entry_id = $(this).data("id");
          $("#myInput").val(entry_id);
      });

      function validate(){
          if(document.form.status.value == '0'){
              alert("Required field can't be Empty")
              return false;
          }
          return true;
      }
    </script>

@endsection