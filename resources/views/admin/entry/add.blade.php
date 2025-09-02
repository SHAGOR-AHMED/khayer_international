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
                    <label for="type">Agent Name<span class="text-red">*</span></label>
                    <select class="form-control liveSearch" name="agent_id" required>
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
                    <select class="form-control" name="country_name" id="country_name" required onchange="globalToggle('country_name','country')">
                      <option value="">Please Select</option>
                      <option value="SAUDI ARABIA">SAUDI ARABIA</option>
                      <option value="MALAYASIA">MALAYASIA</option>
                      <option value="DUBAI">DUBAI</option>
                      <option value="SINGAPORE">SINGAPORE</option>
                      <option value="KUWAIT">KUWAIT</option>
                      <option value="PNG">PNG</option>
                      <option value="ITALY">ITALY</option>
                      <option value="PORTUGAL">PORTUGAL</option>
                      <option value="QATAR">QATAR</option>
                      <option value="other">OTHER</option>
                    </select>
                    <input type="text" class="form-control" id="country" name="country" placeholder="Please Specify..." value="" style="display:none; margin-top:2px;">
                    <span class="text-danger">{{ $errors->has('country') ? $errors->first('country') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="type">Passenger Name<span class="text-red">*</span></label>
                    <select class="form-control liveSearch" name="client_id" required>
                      <option value="">Please Select</option>
                      @foreach($all_clients as $client)
                        <option value="{{ $client->id }}">{{ $client->name }}-({{ $client->passport_no }})</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('client_id') ? $errors->first('client_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="Name">Profession <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="profession" placeholder="Enter Profession" value="{{ old('profession') }}" required>
                    <span class="text-danger">{{ $errors->has('profession') ? $errors->first('profession') : '' }}</span>
                </div>
                
                <div class="form-group">
                    <label for="type">Processing<span class="text-red">*</span></label>
                      <select class="form-control" id="processing_time" name="processing_time" onchange="globalToggle('processing_time','visa_processing')">
                      <option value="">Please Select</option>
                      <option value="B2B">B2B</option>
                      <option value="Direct">Direct</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="visa_processing" name="processing" placeholder="Please Specify..." value="" style="display:none; margin-top:2px;">
                    <span class="text-danger">{{ $errors->has('processing') ? $errors->first('processing') : '' }}</span>
                </div>
                
                <div class="form-group">
                    <label for="type">Office Visa<span class="text-red">*</span></label>
                    <select class="form-control" id="ofc_visa" name="ofc_visa" onchange="globalToggle('ofc_visa','visa_type')">
                      <option value="">Please Select</option>
                      <option value="3 Month">3 Month</option>
                      <option value="12 Month">12 Month</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="visa_type" name="office_visa" placeholder="Please Specify..." value="" style="display:none; margin-top:2px;">
                    <span class="text-danger">{{ $errors->has('office_visa') ? $errors->first('office_visa') : '' }}</span>
                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                    <label for="password">PC Ref No</label>
                    <input type="text" class="form-control" name="pc_ref_no" placeholder="Enter PC Ref No" value="{{ old('pc_ref_no') }}">
                </div>

                <div class="form-group">
                    <label for="Name">Sponsor No </label>
                    <input type="text" class="form-control" name="sponsor_no" placeholder="Enter Sponsor No" value="{{ old('sponsor_no') }}">
                </div>
                
                <div class="form-group">
                    <label for="type">Test Medical Report</label>
                    <select class="form-control" id="medical_report" name="m_r" onchange="globalToggle('medical_report','mmm_report')">
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="mmm_report" name="medical_report" placeholder="Please Specify..." value="" style="display:none; margin-top:2px;">
                </div>

                <div class="form-group">
                    <label for="type">GCC Medical Report <span class="text-red">*</span></label>
                    <select class="form-control" id="gcc_m_report" name="gcc_m_r" required onchange="globalToggle('gcc_m_report','gcc_report')">
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                    <input type="text" class="form-control" id="gcc_report" name="gcc_medical_report" placeholder="Please Specify..." value="" style="display:none; margin-top:2px;">
                </div>

                <div class="form-group">
                    <label>Note </label>
                    <textarea rows="8" class="form-control" name="note" placeholder="Enter Any Note">{{ old('note') }}</textarea>
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
                 
    function globalToggle(para1, para2) {
      var report = $("#" + para1).val();

      if (report === 'other') {
        $("#" + para2).show().val('');
      } else {
        $("#" + para2).hide().val(report);
      }
    }

    function validate(){
      if(document.form.m_r.value == 'other' || document.form.gcc_m_r.value == 'other' || document.form.ofc_visa.value == 'other' || document.form.processing_time.value == 'other' || document.form.country_name.value == 'other'){
        if($("#country").val() == ''){
          alert("Country field can't be Empty");
          $("#country").focus();
          return false;
        }else if($("#mmm_report").val() == ''){
          alert("Medical Report field can't be Empty");
          $("#mmm_report").focus();
          return false;
        }else if($("#gcc_report").val() == ''){
          alert("GCC Report field can't be Empty");
          $("#gcc_report").focus();
          return false;
        }else if($("#visa_type").val() == ''){
          alert("Visa Type field can't be Empty");
          $("#visa_type").focus();
          return false;
        }else if($("#visa_processing").val() == ''){
          alert("Processing field can't be Empty");
          $("#visa_processing").focus();
          return false;
        }
      }
      return true;
    }

  </script>

@endsection