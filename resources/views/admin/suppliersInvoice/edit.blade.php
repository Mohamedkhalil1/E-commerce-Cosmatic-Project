@extends('layouts.admin')
@section('title',"اضافه فاتوره لمزودين")
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
                                <li class="breadcrumb-item"><a href="{{route('admin.suppliersInvoice')}}"> الفواتير </a>
                                </li>
                                <li class="breadcrumb-item active">تحديث فاتوره
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
                                    <h4 class="card-title" id="basic-layout-form"> تحديث فاتوره </h4>
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
                                        <form class="form" action="{{route('admin.suppliersInvoice.update',$invoice->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الفاتوره </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> تاريخ الفاتوره </label>
                                                            <input type="datetime-local" value="{{$invoice->date}}" id="date"
                                                                    class="form-control"
                                                                    placeholder=""
                                                                    name="date">
                                                            @error("date")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر الموظف </label>
                                                            <select name="supplier_id" class=" form-control">
                                                                <optgroup label="من فضلك أختر العميل ">
                                                                    @if($suppliers && $suppliers-> count() > 0)
                                                                        @foreach($suppliers as $supplier)
                                                                            <option
                                                                                value="{{$supplier->id}}" @if(isset($invoice->supplier) && $invoice->supplier->id === $supplier->id ) selected @endif>{{$supplier->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('supplier_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> المبلغ </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                              <span class="input-group-text">.00</span>
                                                            </div>
                                                            
                                                            <input type="number" value="{{$invoice->price}}" class="form-control square" placeholder="السعر" aria-label="Amount (to the nearest EGP)" name="price">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text">جينه</span>
                                                            </div>
                                                           
                                                        </div>
                                                        @error("price")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">نوع الفاتوره</label>
                                                            <input type="text" value="{{$invoice->type}}" id="date"
                                                                    class="form-control"
                                                                    placeholder="نوع الفاتوره او سبب الفاتوره"
                                                                    name="type">
                                                            @error("type")
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
