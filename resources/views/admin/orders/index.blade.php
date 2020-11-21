@extends('layouts.admin')
@section('title',"Orders")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Orders</h4>
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
                                                <th>#</th>
                                                <th>Amount($)</th>
                                                <th>Origin Amount($)</th>
                                                <th>Status</th>
                                                <th>Shipping($)</th>
                                                <th>Payment Type</th>
                                                <th>Tracing</th>
                                                <th>Client</th>
                                                <th>Created At</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($orders)
                                                @foreach($orders as $order)
                                                    <tr>
                                                        <td><a href="{{route('admin.orders.show',$order->id)}}">{{$order->invoice_num}}</a></td>
                                                        <td>{{$order->amount}}</td>
                                                        <td>{{$order->origin_amount}}</td>
                                                       
                                                        <td>
                                                            @if($order->done === 0)
                                                                <i class="warning font-medium-1 mr-1">Pending</i>
                                                            @elseif($order->done==1)
                                                                <i class="success font-medium-1 mr-1">Paid</i>
                                                            @elseif($order->done === 4)
                                                                <i class="danger font-medium-1 mr-1">Decline</i>
                                                            @endif
                                                        </td>
                                                        <td>
                                                           {{$order->shipping_fees}}
                                                        </td>
                                                        <td>{{$order->payment_type}}</td>
                                                        <td>{{$order->tracing_status}}</td>
                                                        <td>{{$order->user === null ? '' : $order->user->name}}</td>
                                                        <td>
                                                           {{$order->created_at->format('Y-d-m')}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        
                                        <div class="justify-content-center d-flex">
                                            {{ $orders->links() }}
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
