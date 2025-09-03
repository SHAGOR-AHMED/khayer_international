@extends('admin.layout.default')
@section('title')
  Create New Passenger
@endsection
@section('content')

  <div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
      @isset($add)
        <div class="box box-warning">
          <div class="box-header with-border">
            <h3 class="box-title">Create New Passenger</h3>
            <div class="box-tools pull-right">
              <a href="{{ route('client.index') }}" class="btn btn-success">View All</a>
            </div>
          </div>
          <div class="box-body">
          <form action="{{ route('client.store') }}" method="post" enctype="multipart/form-data" autocomplete="off">
          @csrf
            <div class="row">
              <div class="col-md-6">

                <div class="form-group">
                    <label for="Name">Passenger Name <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="name" placeholder="Enter Passenger Name" value="{{ old('name') }}" required>
                    <span class="text-danger">{{ $errors->has('name') ? $errors->first('name') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email') }}">
                </div>

                <div class="form-group">
                    <label for="password">Phone No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="phone" placeholder="Enter Phone No" value="{{ old('phone') }}" required>
                    <span class="text-danger">{{ $errors->has('phone') ? $errors->first('phone') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Date Of Birth</label>
                    <input type="text" class="form-control datepicker" name="dob" value="{{ old('dob') }}">
                </div>

                <div class="form-group">
                    <label for="gender">Gender <span class="text-red">*</span></label>
                    <select class="form-control" name="gender" required>
                      <option value="1">Male</option>
                      <option value="2">Female</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address <span class="text-red">*</span></label>
                    <textarea class="form-control" name="address" placeholder="Enter Address" required>{{ old('address') }}</textarea>
                    <span class="text-danger">{{ $errors->has('address') ? $errors->first('address') : '' }}</span>
                </div>

              </div>

              <div class="col-md-6">

                <div class="form-group">
                    <label>Passport No <span class="text-red">*</span></label>
                    <input type="text" class="form-control" name="passport_no" placeholder="Enter Passport No" value="{{ old('passport_no') }}" required>
                    <span class="text-danger">{{ $errors->has('passport_no') ? $errors->first('passport_no') : '' }}</span>
                </div>

                <div class="form-group">
                    <label for="password">Passport Expired Date <span class="text-red">*</span></label>
                    <input type="text" class="form-control datepicker" name="passport_expired_date" id="passport_expiry" value="{{ old('passport_expired_date') }}" onchange="checkExpiryDate(this)" required>

                    <span class="text-danger">{{ $errors->has('passport_expired_date') ? $errors->first('passport_expired_date') : '' }}</span>
                    <div id="expiry_message" style="margin-top: 5px; font-weight: bold;"></div>
                </div>

                <div class="form-group">
                    <label for="gender">Is Original Passport Given? <span class="text-red">*</span></label>
                    <select class="form-control" name="is_original_passport_given" required>
                      <option value="YES">YES</option>
                      <option value="NO">NO</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="address">Upload Photograph</label>
                    <input type="file" id="userfile" class="form-control" name="image" value="" onchange="getPreview('userfile','img_preview','none');">
                    <img src="<?= asset('admin/img/unknown.png'); ?>" style="width:100px; margin-top:5px" id="img_preview" class="img-responsive img-thumbnail"/><br>
                    <code>(Max photo size: 400x400, 512kb)</code>
                </div>

                <div class="form-group" id="pass_doc">
                    <label for="address">Upload Passport</label>
                    <input type="file" class="form-control" name="passport_doc" value="">
                    <code>(Max size: 512kb)</code>
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
    </section><!-- /.content -->
  </div><!-- /.content-wrapper -->

  <script>
    function checkExpiryDate(input) {
        let parts = input.value.split("-"); // dd-mm-yyyy
        if (parts.length !== 3) return;

        let day = parseInt(parts[0]);
        let month = parseInt(parts[1]) - 1; // JS months are 0-based
        let year = parseInt(parts[2]);

        let expiryDate = new Date(year, month, day);
        let today = new Date();
        today.setHours(0,0,0,0);

        let msgDiv = document.getElementById('expiry_message');

        if (expiryDate < today) {
            msgDiv.innerHTML = "❌ Passport is expired.";
            msgDiv.style.color = "red";
        } else {
            // Calculate difference in months & years
            let years = year - today.getFullYear();
            let months = month - today.getMonth();
            let days = day - today.getDate();

            if (days < 0) {
                months -= 1;
                days += new Date(today.getFullYear(), today.getMonth() + 1, 0).getDate();
            }
            if (months < 0) {
                years -= 1;
                months += 12;
            }

            let remaining = "";
            if (years > 0) remaining += years + " year" + (years > 1 ? "s " : " ");
            if (months > 0) remaining += months + " month" + (months > 1 ? "s " : " ");
            if (years === 0 && months === 0) remaining = days + " day(s) ";

            // Check if less than 6 months
            let totalMonths = years * 12 + months;
            if (totalMonths < 6) {
                msgDiv.innerHTML = "⚠️ Passport valid for " + remaining.trim() + " — Please renew soon.";
                msgDiv.style.color = "orange";
            } else {
                msgDiv.innerHTML = "✅ Passport is valid for " + remaining.trim();
                msgDiv.style.color = "green";
            }
        }
    }
  </script>

@endsection