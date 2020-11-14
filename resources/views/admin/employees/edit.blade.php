@extends('layouts.admin')
@section('title',"اضافه فرع|$employee->name")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.employees')}}"> الموظفين </a>
                                </li>
                                <li class="breadcrumb-item active">تحديث الموظف 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تحديث الموظف  </h4>
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
                                        <form class="form" action="{{route('admin.employees.update',$employee->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الموظف </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم العميل </label>
                                                            <input type="text" value="{{$employee->name}}" id="name"
                                                                    class="form-control"
                                                                    placeholder="اسم الموظف"
                                                                    name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان الموظف </label>
                                                            <input type="text" id="abbr"
                                                                    class="form-control"
                                                                    placeholder="عنوان الموظف"
                                                                    value="{{$employee->address}}"
                                                                    name="address">
                                                            @error("address")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> البريد الالكتروني </label>
                                                            <input type="email" id="city"
                                                                    class="form-control"
                                                                    placeholder="البريد الالكتروني الخاص بالموظف"
                                                                    value="{{$employee->email}}"
                                                                    name="email">

                                                            @error("email")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الهاتف </label>
                                                            <input type="number" id="phone"
                                                                    class="form-control"
                                                                    placeholder="رقم الهاتف الخاص بالموظف"
                                                                    value="{{$employee->phone}}"
                                                                    name="phone">

                                                            @error("phone")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر الفرع </label>
                                                            <select name="branch_id" class=" form-control">
                                                                <optgroup label="من فضلك أختر الفرع ">
                                                                    @if($branches && $branches-> count() > 0)
                                                                        @foreach($branches as $branch)
                                                                            <option
                                                                                value="{{$branch->id}}"  @if(isset($employee->branch) && $employee->branch->id === $branch->id ) selected @endif>{{$branch->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('branch_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
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
