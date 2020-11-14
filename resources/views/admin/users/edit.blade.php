@extends('layouts.admin')
@section('title',"تعديل البينات الشخصيه ")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <section id="sizing">
                <div class="row">
                  <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase">تعديل بيانات المستخدم</h4>
                  </div>
                </div>
                <div class="row">
                 
                  <div class="col-md-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title">البيانات الشخصيه</h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content collpase show">
                        <div class="card-body">
                            @include('admin.includes.alerts.success')
                            @include('admin.includes.alerts.errors')
                          <form class="form" method ="post" action="{{route('admin.user.update')}}">
                            @csrf
                            @method('put')
                            <div class="form-body">
                              <h4 class="form-section"><i class="ft-user"></i>البيانات الشخصيه</h4>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="userinput1" >اسم المستخدم</label>
                                    <input type="text" id="userinput1" class="form-control" placeholder="اسم المستخدم" name="name" value="{{$user->name}}">
                                    @error("name")
                                        <span class="text-danger"> {{ $message }} </span>
                                    @enderror  
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="userinput2" >رقم التليفون</label>
                                    <input type="text" id="userinput2" class="form-control" placeholder="رقم التليفون" name="phone" value="{{$user->phone}}">
                                    @error("phone")
                                      <span class="text-danger"> {{ $message }} </span>
                                    @enderror  
                                  </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label for="userinput3" >البريد الالكترني</label>
                                    <input type="text" id="userinput3" class="form-control" placeholder="البريد الالكتروني" name="email" value="{{$user->email}}">
                                    @error("email")
                                      <span class="text-danger"> {{ $message }} </span>
                                    @enderror  
                                  </div>
                                </div>
                              </div>

                              <h4 class="form-section"><i class="la la-key"></i> كلمه المرور</h4>
                              <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput4">كلمه المرور القديمه</label>
                                        <input type="password" id="userinput4" class="form-control" placeholder="كلمه المرور" name="old_password">
                                        @error("old_password")
                                        <span class="text-danger"> {{ $message }} </span>
                                        @enderror  
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="userinput4" >كلمه المرور الجديد</label>
                                        <input type="password" id="userinput4" class="form-control" placeholder="كلمه المرور" name="password">
                                        @error("password")
                                            <span class="text-danger"> {{ $message }} </span>
                                            @enderror 
                                        </div>
                                </div>

                                <div class="col-md-6">
                                        <div class="form-group">
                                        <label for="userinput4" >تأكيد كلمه المرور الجديده</label>
                                        <input type="password" id="userinput4" class="form-control" placeholder="كلمه المرور" name="password_confirmation">
                                        @error("old_password")
                                            <span class="text-danger"> {{ $message }} </span>
                                        @enderror 
                                    </div>
                                </div>
                              </div>


                              <div class="form-actions right">
                                <button type="submit" class="btn btn-outline-primary">
                                    تحديث <i class="ft-check"></i> 
                                </button>
                              </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </section>
        </div>
    </div>

@endsection
