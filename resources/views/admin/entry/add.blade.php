@extends('admin.layout.default')
@section('title')
  Create New Entry
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Entry</h3>
            <div class="box-tools pull-right">
               <a href="{{ route('entry.index') }}" class="btn btn-success">View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('entry.store') }}" method="post" name="form" enctype="multipart/form-data" onsubmit="return(validate())" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                    <label for="type">Agent <span class="text-red">*</span></label>
                    <select class="form-control" name="agent_id" required>
                      @foreach($all_agents as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('agent_id') ? $errors->first('agent_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="type">RL No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="rl_no" placeholder="Enter RL No" value="{{ old('rl_no') }}" required>
                    <span class="text-danger">{{ $errors->has('rl_no') ? $errors->first('rl_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="type">Country <span class="text-red">*</span></label>
                    <select class="form-control" name="country" required>
                      <option value="">Please Select</option>
                      @foreach($all_countries as $country)
                        <option value="{{ $country->con_name }}">{{ $country->con_name }}</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('country') ? $errors->first('country') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="type">Passenger <span class="text-red">*</span></label>
                    <select class="form-control" name="client_id" required>
                      <option value="">Please Select</option>
                      @foreach($all_clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}-({{ $client->phone }})</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('client_id') ? $errors->first('client_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Kopil No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="kopil_no" placeholder="Enter Kopil No" value="{{ old('kopil_no') }}" required>
                    <span class="text-danger">{{ $errors->has('kopil_no') ? $errors->first('kopil_no') : '' }}</span>
                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                    <label for="password">PC Ref No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="pc_ref_no" placeholder="Enter PC Ref No" value="{{ old('pc_ref_no') }}" required>
                    <span class="text-danger">{{ $errors->has('pc_ref_no') ? $errors->first('pc_ref_no') : '' }}</span>
                </div>
                
                <div class="form-group">
                    <label for="type">Medical Report</label>
                    <select class="form-control" id="medical_report" name="m_r" onchange="medical_toggle()">
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="mmm_report" name="medical_report" placeholder="Enter Reason" value="" style="display:none; margin-top:2px;">
                </div>

                <div class="form-group">
                    <label for="type">GCC Medical Report <span class="text-red">*</span></label>
                    <select class="form-control" id="gcc_m_report" name="gcc_m_r" required onchange="gccMedicalToggle()">
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="gcc_report" name="gcc_medical_report" placeholder="Enter Reason" value="" style="display:none; margin-top:2px;">
                </div>

                <div class="form-group">
                    <label>Note </label>
                    <textarea class="form-control" name="note" placeholder="Enter Any Note">{{ old('note') }}</textarea>
                </div>
              </div>

            </div>

            <div class="row">
              <div class="col-md-12">
                <div>
                  <button style="width:100%" type="submit" name="submit" class="btn btn-success"><i class="fa fa-bookmark" aria-hidden="true"></i> Save Data</button>
                </div>
              </div>
            </div>

          </form>         
          </div><!-- /.box-body -->
        </div><!-- /.box -->
      @endisset
      @isset($edit)
        
      @endisset
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script>
    function medical_toggle() {
      var m_report = $("#medical_report").val();
      if(m_report == 'other'){
        document.getElementById("mmm_report").style.display = "block";
        $("#mmm_report").val('');
      }else{
        document.getElementById("mmm_report").style.display = "none";
        $("#mmm_report").val(m_report);
      }
    }

    function gccMedicalToggle() {
      var gcc_report = $("#gcc_m_report").val();
      if(gcc_report == 'other'){
        document.getElementById("gcc_report").style.display = "block";
        $("#gcc_report").val('');
      }else{
        document.getElementById("gcc_report").style.display = "none";
        $("#gcc_report").val(gcc_report);
      }
    }

    function validate(){
      if(document.form.m_r.value == 'other' || document.form.gcc_m_r.value == 'other'){
        if($("#mmm_report").val() == '' || $("#gcc_report").val() == ''){
          alert("Required field can't be Empty");
          document.getElementById("mmm_report").focus();
          document.getElementById("gcc_report").focus();
          return false;
        }
      }
      return true;
    }
  </script>
@endsection