<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | A Khayer International</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <!-- Bootstrap -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  </head>
  <style>
    .fa.fa-eye {
      position: relative;
      top: -27px;
      left: 250px;
    }
  </style>
  <body>
    <div class="container-fluid">
        <div class="row">
          <div class="banner">
            <div class="banner_overlay hidden-xs"><span>A Khayer International</span></div>
            <div class="banner_overlay visible-xs"><span>A Khayer International</span></div>
          </div>
        </div>
        
        <div class="row login_form_area">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10 col-lg-offset-3 col-md-offset-3 col-sm-offset-3 col-xs-offset-1">
              <div class="row login_bg">

                <div class="col-lg-6 col-md-6">
                    <img src="{{ asset('admin/img/logo.png') }}" class="img-responsive hidden-xs center-block">
                </div>
                
                @if($errors->any())
								  @foreach($errors->all() as $error)
								    <span class="invalid-feedback" role="alert">
								      <strong>{{ $error }}</strong>
								    </span>
								  @endforeach
								@endif

                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12" style="margin-top:35px">
                  <form id="login_panel" action="{{ route('login') }}" method="post">
										@csrf
                      <div class="form-group">
                        <label for="username" class="col-sm-3 hidden-md control-label">Email</label>
                        <div class="col-sm-9">
                          <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                        </div>
                        @if ($errors->has('email'))
										      <span class="invalid-feedback" role="alert">
										        <strong>{{ $errors->first('email') }}</strong>
										      </span>
										    @endif
                      </div><br><br>
                      <div class="form-group">
                        <label for="password" class="col-sm-3 hidden-md control-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control pass" id="password" name="password" placeholder="******">
                        </div>
                        <a href="javascript:void(0)" id="password_text"><i class="fa fa-eye"></i></a>
                      </div><br><br>
                      @if ($errors->has('password'))
									      <span class="invalid-feedback" role="alert">
									        <strong>{{ $errors->first('password') }}</strong>
									      </span>
									    @endif
                      <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-8">
                          <button type="submit" class="btn btn-default" name="login">Sign in</button>
                        </div>
                      </div>
                      
                    </form>
                </div>                
              </div>
          </div>
        </div>
    </div>

     @include('sweetalert::alert')

    <!-- footer -->
    <footer class="footer">
      <div class="container-fluid">
        <span class="text-muted">
          <strong>Copyright &copy; <?= date('Y'); ?> <a href="https://khayerint.com/">A khayer International</a>.</strong> All rights reserved.</a>
        </span>
        <span class="pull-right"> <a href="http://wanitbd.com/">{{ developed_by() }}</a></span>
      </div>
    </footer>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="{{ asset('admin/js/bootstrap.min.js') }}"></script>
  <script type="text/javascript">
      $(document).ready(function(){
            $("#password_text").on("click",function(){
                var x = document.getElementById("password");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            });
        });
		</script>
  </body>
</html>