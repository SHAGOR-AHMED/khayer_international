<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.png') }}">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('admin/backend/bootstrap/css/bootstrap.min.css') }}">
    <!-- Bootstrap 5 -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('admin/backend/plugins/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('admin/css/ionicons.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('admin/backend/dist/css/AdminLTE.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('admin/backend/dist/css/skins/_all-skins.min.css') }}">
    <!-- date picker -->
    <link rel="stylesheet" href="{{ asset('admin/css/bootstrap-datepicker.min.css') }}">
    <link href="{{ asset('admin/css/style.css') }}" rel="stylesheet">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('admin/backend/plugins/datatables/dataTables.bootstrap.css') }}">
     <link href="{{ asset('css/iziToast.css') }}" rel="stylesheet">
    <!-- jQuery 2.1.4 -->
    <script src="{{ asset('admin/backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">

      <header class="main-header">
        <!-- Logo -->
        <a href="#" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"></span>{{ logged_in_user_name() }}
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"> &nbsp; <i class="fa fa-spinner fa-spin fa-lg" id="ajaxLoader" style="display:none;"></i> </span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>

          <div class="col-md-10">
            @if(Session::has('message'))
              <div class="alert alert-block alert-{{Session::get('class')}}">
                <button type="button" class="close" data-dismiss="alert">
                  <i class="ace-icon fa fa-times"></i>
                </button>
                <i class="ace-icon fa fa-check green"></i>
                {{ Session::get("message") }}
              </div>
            @endif
          </div>

          <div class="navbar-custom-menu">
            
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    @php
	                    $user = DB::table('users')->where('id', logged_in_user_id())->first();
	                  @endphp
                    @if($user->image == NULL)
                      {{ Str::substr(logged_in_user_name(), 0,1 ) }}
                    @else
                      <img src="{{ asset($user->image) }}" class="user-image" alt="User Image">
                	  @endif
                    <span class="hidden-xs">{{ logged_in_user_name() }}</span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    @if($user->image == NULL)
                      {{ Str::substr(logged_in_user_name(), 0,1 ) }}
                    @else
                      <img src="{{ asset($user->image) }}" class="img-circle" alt="User Image">
                	  @endif
                    <p>{{ logged_in_user_name() }} - {{ $user->email }}</p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-right">
                      <a class="btn btn-default btn-flat" href="{{ route('logout') }}"
                          onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                          Sign out
                      </a>

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                          @csrf
                      </form>
                    </div>

                    <div class="pull-left">
                      <a href="{{ route('user.edit', hashid_encode(logged_in_user_id())) }}" class="btn btn-default btn-flat">Change Profile</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>

      <!-- =============================================== -->

		<!-- sidebar -->
        @include('admin.layout.template_left')
        <!-- //sidebar -->
        <!-- main panel -->
        @yield('content')
        <!-- main-panel ends -->



		@include('admin.layout.template_footer')