@extends('layouts.admin')
@section('title',"تعديل فرع|$branch->name")
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
                                <li class="breadcrumb-item"><a href="{{route('admin.branches')}}"> الفروع </a>
                                </li>
                                <li class="breadcrumb-item active">تحديث فرع 
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
                                    <h4 class="card-title" id="basic-layout-form"> تحديث قسم فرع  </h4>
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
                                        <form class="form" action="{{route('admin.branches.update',$branch->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            
                                            <div class="form-body">
                                                <input type="hidden" value="{{$branch->id}}" name="id">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الفرع </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم الفرع </label>
                                                            <input type="text" id="name"
                                                                    class="form-control"
                                                                    placeholder="اسم الفرع"
                                                                    name="name"
                                                                    value="{{$branch->name}}"
                                                                    >
                                                            @error("name")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر المسئول </label>
                                                            <select name="admin_id" class="form-control">
                                                                <optgroup label="من فضلك أختر المسئول ">
                                                                    @if($admins && $admins-> count() > 0)
                                                                        @foreach($admins as $admin)
                                                                            <option
                                                                                value="{{$admin->id}}" @if(isset($branch->admin) && $branch->admin->id === $admin->id) selected @endif>{{$admin->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('admin_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> عنوان الفرع </label>
                                                            <input type="text" id="abbr"
                                                                    class="form-control"
                                                                    placeholder="عنوان الفرع"
                                                                    value="{{$branch->address}}"
                                                                    name="address">

                                                            @error("address")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> المدينه </label>
                                                            <input type="text" id="city"
                                                                    class="form-control"
                                                                    placeholder="المدينه"
                                                                    value="{{$branch->city}}"
                                                                    name="city">

                                                            @error("city")
                                                            <span class="text-danger"> {{ $message }} </span>
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
