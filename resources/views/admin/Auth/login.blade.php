@extends('layouts.login')
@section('title','الدخول')
@section('content')
<link rel="apple-touch-icon" href="https://gfx4arab.com/wp-content/uploads/2018/12/blue-company-logo_1057-513.jpg">
<body class="vertical-layout vertical-menu 1-column  bg-full-screen-image menu-expanded blank-page blank-page"
data-open="click" data-menu="vertical-menu" data-col="1-column">
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body">
        <section class="flexbox-container">
          <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
              <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                <div class="card-header border-0 pb-0">
                  <div class="card-title text-center">
                    <img src="https://gfx4arab.com/wp-content/uploads/2018/12/blue-company-logo_1057-513.jpg" height="200px" weight="200px" alt="لوجو الشركه">
                  </div>
                </div>
                <div class="card-content mt-2">
                  <p class="card-subtitle line-on-side text-muted text-center font-small-3 mx-2 my-1">
                    <span>ادخال البيانات</span>
                  </p>
                   @include('admin.includes.alerts.errors') 
                   @include('admin.includes.alerts.success')
                  <div class="card-body">
                    <form class="form-horizontal" action="{{route('admin.login')}}" method="post" novalidate>
                      @csrf
                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="text" name="email" class="form-control" id="user-email" placeholder="البريد الالكتروني"
                        >
                        <div class="form-control-position">
                          <i class="ft-mail"></i>
                        </div>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </fieldset>

                      <fieldset class="form-group position-relative has-icon-left">
                        <input type="password" name="password" class="form-control" id="user-password" placeholder="كلمه المرور"
                        >
                        <div class="form-control-position">
                          <i class="la la-key"></i>
                        </div>
                        @error('password')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                      </fieldset>

                      <div class="form-group row">
                        <div class="col-md-6 col-12 text-center text-sm-left">
                          <fieldset>
                            <input type="checkbox" name = "remember_me" id="remember-me" class="chk-remember">
                            <label for="remember-me"> تذكرني</label>
                          </fieldset>
                        </div>
                      </div>
                      <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-user"></i> الدخول</button>
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
</body>
@endsection
