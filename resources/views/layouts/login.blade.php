<html class="loaded" lang="en" data-textdirection="ltr"><head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="" content="">
    <title>Login</title>
    <link rel="apple-touch-icon" href="https://static.rfstat.com/renderforest/images/v2/logo-homepage/gradient_2.png">
    <link rel="shortcut icon" type="image/x-icon" href="https://static.rfstat.com/renderforest/images/v2/logo-homepage/gradient_2.png">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700" rel="stylesheet">
    <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css" rel="stylesheet">
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/vendors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/icheck/custom.css')}}">
    <!-- END VENDOR CSS-->
    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/app.css')}}">
    <!-- END MODERN CSS-->
    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/core/colors/palette-gradient.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/pages/login-register.css')}}">


  </head>
  <body style="background-color:#F0F1F6 !important" class="vertical-layout vertical-menu 1-column  bg-cyan bg-lighten-2 menu-expanded fixed-navbar  pace-done" data-open="click" data-menu="vertical-menu" data-col="1-column"><div class="pace  pace-inactive"><div class="pace-progress" data-progress-text="100%" data-progress="99" style="transform: translate3d(100%, 0px, 0px);">
    <div class="pace-progress-inner"></div>
  </div>
  <div class="pace-activity"></div></div>
    <!-- fixed-top-->
    <nav class="header-navbar navbar-expand-md navbar navbar-with-menu navbar-without-dd-arrow fixed-top navbar-shadow" style="background-color: #1E9FF2">
      <div class="navbar-wrapper">
        <div class="navbar-header">
          <ul class="nav navbar-nav flex-row">
            <li class="nav-item mobile-menu d-md-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ft-menu font-large-1"></i></a></li>
            <li class="nav-item">
              <a class="navbar-brand" href="">
                <img class="brand-logo" alt="logo" src="https://static.rfstat.com/renderforest/images/v2/logo-homepage/gradient_2.png">
                <h3 class="brand-text" style="color:#FFFFFF">Company</h3>
              </a>
            </li>
            <li class="nav-item d-md-none">
              <a class="nav-link open-navbar-container" data-toggle="collapse" data-target="#navbar-mobile"><i class="la la-ellipsis-v"></i></a>
            </li>
          </ul>
        </div>
        
      </div>
    </nav>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="app-content content">
      <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <section class="flexbox-container">
            <div class="col-12 d-flex align-items-center justify-content-center">
              <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                  <div class="card-header border-0">
                    <div class="card-title text-center">
                      <img src="https://static.rfstat.com/renderforest/images/v2/logo-homepage/gradient_2.png" height="100px" weight="100px" alt="branding logo">
                    </div>
                    <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                      <span>Login with Company</span>
                    </h6>
                  </div>
                  <div class="card-content">
                    <div class="card-body">
                       
                      <form class="form-horizontal" action="{{route('admin.login')}}" method="POST">
                       @csrf
                       @include('admin.includes.alerts.success')
                       @include('admin.includes.alerts.errors')
                        <fieldset class="form-group position-relative ">
                           
                          <input type="text" class="form-control" id="user-name" name="email" placeholder="Your Email" tabindex="1" required="" data-validation-required-message="Please enter your email.">
                         
                          <div class="help-block font-small-3"></div>
                          @error("email")
                          <span class="text-danger"> {{ $message }} </span>
                          @enderror
                        </fieldset>
                        <fieldset class="form-group position-relative ">
                          <input type="password" class="form-control" id="password" name="password" placeholder="Enter Password" tabindex="2" required="" data-validation-required-message="Please enter valid passwords.">
                         
                          <div class="help-block font-small-3"></div>
                          @error("password")
                          <span class="text-danger"> {{ $message }} </span>
                          @enderror
                        </fieldset>
                        <div class="form-group row">
                          <div class="col-md-6 col-12 text-center text-md-left">
                            <fieldset>
                              <div class="icheckbox_square-blue" style="position: relative;"><input type="checkbox" id="remember-me" class="chk-remember" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div>
                              <label for="remember-me"> Remember Me</label>
                            </fieldset>
                          </div>
                         
                        </div>
                        <button type="submit" class="btn btn-success btn-block btn-md "><i class="ft-unlock"></i> Login</button>
                      </form>
                    </div>
                  </div>
                  
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <footer class="footer fixed-bottom navbar-border navbar-shadow mt-4" style="background-color: #FFF">
      <p class="clearfix blue-grey lighten-2 text-sm-center mb-0 px-2">
        
        <span class="float-md-right d-block d-md-inline-blockd-none d-lg-block">Company &amp; Made with Khalil <i class="ft-heart pink"></i></span>
      </p>
    </footer>
    <!-- BEGIN VENDOR JS-->
    <script src="{{asset('assets/admin/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{asset('assets/admin/vendors/js/forms/validation/jqBootstrapValidation.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN MODERN JS-->
    <script src="{{asset('assets/admin/vendors/js/core/app-menu.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/core/app.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/customizer.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/scripts/forms/form-login-register.js')}}" type="text/javascript"></script>
  
  </body></html>