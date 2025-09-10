@extends('admin.layout.default')
@section('title')
  Manage Manpower List
@endsection
@section('content')
  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <h3 class="box-title">Manage Manpower List's</h3>
          <div class="box-tools pull-right">
            <a href="{{ route('entry.add') }}" class="btn btn-success">Add New</a>
          </div>
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
                          <td>{{ $data->gcc_medical_report }}</td>
                          <td>{{ $data->created_at }}</td>
                          <td>
                              <span class="badge btn-warning">MANPOWER</span><br><br>
                              <button class="btn btn-default" id="next_stage_modal" data-toggle="modal" data-id="{{ $data->id }}" data-manpower="{{ $data->manpower_date }}" data-target="#staticBackdrop">Next Stage</button>
                          </td>
                          <td>
                              <a href="{{ route('manpower.details',hashid_encode($data->id)) }}" style="color: green;" title="Details">View <i class="fa fa-eye fa-lg" style="color: green;"></i></a> | 

                              <a href="#" style="color: black;" id="log_modal" data-toggle="modal" data-id="{{ $data->id }}" data-target="#staticBackdrop2" title="Log" >Log <i class="fa fa-info fa-lg" style="color: black;"></i></a>
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
                          <form action="{{ route('manpower.nextStage') }}" method="post" name="form" enctype="multipart/form-data" onsubmit="return(validate())">
                          @csrf

                            <input type="hidden" class="form-control" value="" id="myInput" name="id">
                            <input type="hidden" class="form-control" value="" id="manpowerDate" name="manpower_date">
                            <div class="form-group">
                              <label for="type">Next Stage<span class="text-red">*</span></label>
                              <select class="form-control" name="status" required>
                                <option value="0">Please Select</option>
                                <option value="COLLECT">Ready to Collect</option>
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
    <!-- Log Modal HTML -->
    <div id="staticBackdrop2" class="modal fade" data-backdrop="static">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title">Log</h4>
                </div>
                <div class="modal-body">
                  <div id="show_log">
                
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
          var manpower_date = $(this).data("manpower");
          $("#myInput").val(entry_id);
          $("#manpowerDate").val(manpower_date);
      });

      function validate(){
        if(document.form.status.value == '0'){
          alert("Select Next Stage")
          return false;
        }else if(document.form.manpower_date.value == ''){
          alert("Manpower Date Empty")
          return false;
        }
        return true;
      }

      $(document).on("click","#log_modal",function () {
          var entry_id = $(this).data("id");
            $.ajax({
              url:"{{route("embassy.log")}}",
              type:"get",
              dataType:"json",
              data:{"entry_id":entry_id},
              beforeSend:function(){
                  $("#overlay").fadeIn(300);　
                },
              success:function(data){
                  $("#show_log").html(data.html);
                  $("#overlay").fadeOut(300);
              },
              error:function (e) {
                  $.Notification.autoHideNotify('error', 'top right',"Something Wrong. Please try again");
                  $("#overlay").fadeOut(300);
              }
          });
      });
    </script>

@endsection