@extends('layouts.admin')
@section('title',"Home")
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <div id="crypto-stats-3" class="row">
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    
                                    <div class="col-12 pl-2">
                                        <h3 class="text-muted">Selled Products</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        <h4>{{number_format(App\Models\Product::sum('count_selled'),0)}}  <i class="la la-tags" style="color:black"></i></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="btc-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                    <div class="col-12 pl-2">
                                        <h3 class="text-muted">Total Orders</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                      <h4>{{number_format(App\Models\Order::sum('amount'),1)}} <span style="color:green">$</span></h4>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="eth-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-12">
                    <div class="card crypto-card-3 pull-up">
                        <div class="card-content">
                            <div class="card-body pb-0">
                                <div class="row">
                                 
                                    <div class="col-12 pl-2">
                                        <h4 class="text-muted">Total Products</h4>
                                    </div>
                                    <div class="col-12 text-right">
                                        <h4>{{number_format(App\Models\Product::count())}}  <i class="la la-tags" style="color:black"></i></h4>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <canvas id="xrp-chartjs" class="height-75"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Candlestick Multi Level Control Chart -->

            <!-- Sell Orders & Buy Order -->
            <div class="row match-height">

                <div id="recent-transactions" class="col-12">
                    <div class="card">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.orders')}}"><i class="la la-money" style="color:green"></i> latest Orders</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                        </div>
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          
                          <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead class="">
                              <tr>
                                  <th>#</th>
                                  <th>Amount($)</th>
                                  <th>Origin Amount($)</th>
                                  <th>Status</th>
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
                                       
                                        <td>{{$order->user === null ? '' : $order->user->name}}</td>
                                        <td>
                                            {{$order->created_at->format('Y-d-m')}}
                                        </td>
                                    </tr>
                                @endforeach
                              @endisset
                            </tbody>
                          </table>

                        </div>
                      </div>
                    </div>
                  </div>

          
                  <div class="col-12 col-xl-6">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.products')}}"><i class="la la-tags" style="color:black"></i> Lastest Products</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                         

                          <table class="table table-de mb-0">
                            <thead class="">
                            <tr>
                                <th>Title</th>
                                <th>Price</th>
                                <th>PriceAfterDiscount</th>
                                <th>Stock</th>
                            </tr>
                            </thead>
                            <tbody>

                            @isset($products)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->title}}</td>
                                        <td>{{$product->price}}</td>
                                        <td>{{$product->price_discount}}</td>
                                        <td>{{$product->stock}}</td>
                                        
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>



                  <div class="col-12 col-xl-6">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.clients')}}"><i class="la la-users" style="color:blue"></i> Lastest Client</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                         
                          <table class="table table-de mb-0 display nowrap table-striped table-bordered">
                            <thead class="">
                            <tr>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>E-mail</th>
                               
                            </tr>
                            </thead>
                            <tbody>

                            @isset($clients)
                                @foreach($clients as $client)
                                    <tr>
                                        <td><a href="{{route('admin.clients.show',$client->id)}}">{{$client->name}}</a></td>
                                        <td>{{$client->phone}}</td>
                                        <td>{{$client->email}}</td>
                                        
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                          </table>
                          
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-xl-12">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.contactus')}}"><i class="la la-comments-o" style="color:blue"></i> Latest Messages</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead class="">
                            <tr>
                                <th>Subject</th>
                                <th>email</th>
                                <th>phone</th>
                                <th>message</th>
                            </tr>
                            </thead>
                            <tbody>

                            @isset($contacts)
                                @foreach($contacts as $contact)
                                    <tr>
                                        <td>{{$contact->subject}}</td>
                                        <td>{{$contact->user === null ? $contact->email : $contact->user->name}}</td>
                                        <td>{{$contact->user === null ? $contact->phone : $contact->user->phone}}</td>
                                        <td>{{$contact->message}}</td>
                                    </tr>
                                @endforeach
                            @endisset
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                  
                </div>
            </div>
            <!--/ Sell Orders & Buy Order -->
        </div>
    </div>
</div><!-- ////////////////////////////////////////////////////////////////////////////-->

@endsection
