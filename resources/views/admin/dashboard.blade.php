@extends('layouts.admin')
@section('title',"Home")
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
          <div class="row">
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h3 class="info">{{App\Models\Product::where('count_selled','>',0)->count()}}</h3>
                        <h6>Products Sold</h6>
                      </div>
                      <div>
                        <i class="icon-basket-loaded info font-large-2 float-right"></i>
                      </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-info" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h3 class="success">${{number_format(App\Models\Order::sum('amount'),1)}}</h3>
                        <h6>Profit</h6>
                      </div>
                      <div>
                        <i class="la la-money success font-large-2 float-right"></i>
                      </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 100%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h3 class="warning">{{App\User::all()->count()}}</h3>
                        <h6>Customers</h6>
                      </div>
                      <div>
                        <i class="icon-user-follow warning font-large-2 float-right"></i>
                      </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-warning" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-12">
              <div class="card pull-up">
                <div class="card-content">
                  <div class="card-body">
                    <div class="media d-flex">
                      <div class="media-body text-left">
                        <h3 class="danger">{{App\Models\Order::all()->count()}}</h3>
                        <h6>Orders Number</h6>
                      </div>
                      <div>
                        <i class="icon-handbag danger font-large-2 float-right"></i>
                      </div>
                    </div>
                    <div class="progress progress-sm mt-1 mb-0 box-shadow-2">
                      <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 100%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
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
                        <h4 class="card-title"><a href="{{route('admin.orders')}}"><i class="la la-money" style="color:green"></i> Top Orders</a></h4>
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
                        <h4 class="card-title"><a href="{{route('admin.products')}}"><i class="icon-basket-loaded" style="color:black"></i> Top Products</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                         

                          <table class="table table-de mb-0">
                            <thead class="">
                            <tr>
                                <th>Title</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>Stock</th>
                               
                            </tr>
                            </thead>
                            <tbody>

                            @isset($products)
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->title}}</td>
                                        <td>
                                          <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="Kimberly Simmons" class="avatar avatar-sm pull-up">
                                            <img class="media-object rounded-circle" src="http://localhost:8888/assets/{{$product->image}}" alt="image">
                                          </li>
                                       </td>
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
                        <h4 class="card-title"><a href="{{route('admin.clients')}}"><i class="la la-users" style="color:blue"></i> Top Clients</a></h4>
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
