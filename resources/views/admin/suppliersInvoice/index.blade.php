@extends('layouts.admin')
@section('title',"فواتير المزودين")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-1">
                    <h3 class="content-header-title"> الفواتير </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active"> الفواتير
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="heading-elements mb-2">
                <a href="{{route('admin.suppliersInvoice.create')}}" class="btn btn-success btn-sm"><i class="ft-plus white"></i> اضافه فاتوره جديد</a>
              </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"><span class="la la-clipboard"></span> جميع الفواتير <span class="badge badge-default badge-success">{{App\Models\Invoice::supplierInvoices()->count()}}</span></h4>
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
                                    <div class="card-body card-dashboard table-responsive">
                                        <table
                                            class="table table-de mb-0 display nowrap table-striped table-bordered">
                                            <thead class="">
                                            <tr>
                                                <th>الرقم</th>
                                                <th>التاريخ</th>
                                                <th>المبلغ</th>
                                                <th>المزود</th>
                                                <th>السبب</th>
                                                <th>الإجراءات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($invoices)
                                                @foreach($invoices as $invoice)
                                                    <tr>
                                                        <td>{{$invoice->id}}</td>
                                                        <td>{{$invoice->date}}</td>
                                                        <td>{{$invoice->price}} ج</td>
                                                        
                                                        <td>{{$invoice->supplier ? $invoice->supplier->name : ''}}</td>
                                                        <td>{{$invoice->type}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.suppliersInvoice.edit',$invoice->id)}}"
                                                                   class="btn btn-outline-primary box-shadow-3 mr-1 mb-1 btn-sm"><i class="ft-edit"></i></a>

                                                                <a href="{{route('admin.suppliersInvoice.delete',$invoice->id)}}"
                                                                   class="btn btn-outline-danger box-shadow-3 mr-1 mb-1 btn-sm"><i class="ft-trash-2"></i></a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
