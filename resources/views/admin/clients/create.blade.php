@extends('layouts.admin')
@section('title',"Add Client")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title" id="basic-layout-form">Add New Client </h3>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('admin.includes.alerts.success')
                                @include('admin.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.clients.store')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf

                                            <div class="form-body">
                                                <h5 class="form-section"><i class="la la-tag"></i>Client Information </h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">FullName</label>
                                                            <input type="text" value="{{old('fullname')}}" id="name"
                                                                    class="form-control"
                                                                    placeholder="FullName"
                                                                    name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Email</label>
                                                            <input type="email" value="{{old('email')}}" id="email"
                                                                    class="form-control"
                                                                    placeholder="Email"
                                                                    name="email">
                                                            @error("email")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> Phone </label>
                                                        <div class="input-group">
                                                            <input type="number" value="{{old('phone')}}" class="form-control square" placeholder="Phone" aria-label="Amount (to the nearest EGP)" name="phone">
                                                        </div>
                                                        @error("email")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>

                                                    
                                                    <div class="col-md-6">
                                                        <label for="projectinput1">Password</label>
                                                        <div class="input-group">
                                                            <input type="text" value="{{old('password')}}" class="form-control square" placeholder="Password" aria-label="Amount (to the nearest EGP)" name="password">
                                                             
                                                        </div>
                                                        @error("password")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>


                                            <div class="form-actions mb-2">
                                             
                                                <button type="submit" class="btn btn-primary float-right">
                                                    Save
                                                </button>

                                                <button type="button" class="btn btn-warning mr-1 float-right"
                                                        onclick="history.back();">
                                                     Back
                                                </button>

                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
