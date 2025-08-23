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
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('entry.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                    <label for="type">Agent <span class="text-red">*</span></label>
                    <select class="form-control" name="agent_id" required>
                      <option value="">Please Select</option>
                      @foreach($all_agents as $agent)
                        <option value="{{ $agent->id }}">{{ $agent->name }}-({{ $agent->phone }})</option>
                      @endforeach
                    </select>
                    <span class="text-danger">{{ $errors->has('agent_id') ? $errors->first('agent_id') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="type">RL No <span class="text-red">*</span></label>
                    <select class="form-control" name="rl_no" required>
                      <option value="RL1717">RL1717</option>
                    </select>
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
                    <label for="type">Client <span class="text-red">*</span></label>
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
                    <input type="text" class="form-control" name="kopil_no" placeholder="Enter Kopil No" value="" required>
                    <span class="text-danger">{{ $errors->has('kopil_no') ? $errors->first('kopil_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">PC Ref No <span class="text-red">*</span></label>
                    <input type="number" class="form-control" name="pc_ref_no" placeholder="Enter PC Ref No" value="" required>
                    <span class="text-danger">{{ $errors->has('pc_ref_no') ? $errors->first('pc_ref_no') : '' }}</span>
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group">
                    <label for="type">Medical Report <span class="text-red">*</span></label>
                    <select class="form-control" name="medical_report" required>
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="type">GCC Medical Report <span class="text-red">*</span></label>
                    <select class="form-control" name="gcc_medical_report" required>
                      <option value="">Please Select</option>
                      <option value="FIT">FIT</option>
                      <option value="UNFIT">UNFIT</option>
                      <option value="other">Other</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Return Cause </label>
                    <textarea class="form-control" name="return_cause" placeholder="Enter Return Cause"></textarea>
                </div>

                <div class="form-group">
                    <label>Note </label>
                    <textarea class="form-control" name="note" placeholder="Enter Any Note"></textarea>
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
@endsection