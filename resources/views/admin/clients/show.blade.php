@extends('layouts.admin')
@section('title',"$client->name")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
      
      <div class="content-detached ">
        <div class="content-body">
          <section class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">Client Information</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                         <span class="badge badge-default badge-danger">{{$client->phone}}</span>
                      <span class="badge badge-default badge-warning">{{$client->address}}</span>
                      <span class="badge badge-default badge-success">{{$client->email}}</span>
                      
                      
                    </div>
                  </div>
                  <div class="px-1">
                    <ul class="list-inline list-inline-pipe text-center p-1 border-bottom-grey border-bottom-lighten-3">
                      <li>Client :
                        <span class="text-muted">{{$client->name}}</span>
                      </li>
                      <li>
                        <span class="text-muted">{{$client->created_at->format('Y-m-d')}}</span>
                      </li>
                      
                    </ul>
                  </div>
                </div>
                <!-- project-info -->
                <div id="project-info" class="card-body row">
      
                  <div class="project-info-count col-lg-6 col-md-12">
                    <div class="project-info-icon">
                      <h2>{{$client->orders()->count()}}</h2>
                      <div class="project-info-sub-icon">
                        <span class="la la-clipboard"></span>
                      </div>
                    </div>
                    <div class="project-info-text pt-1">
                      <h5>Orders</h5>
                    </div>
                  </div>
                  <div class="project-info-count col-lg-6 col-md-12">
                    <div class="project-info-icon">
                     
                      <h2>{{$client->favourites()->count()}}</h2>
                      <div class="project-info-sub-icon">
                        <span class="la la-tags"></span>
                      </div>
                    </div>
                    <div class="project-info-text pt-1">
                      <h5>Favoruites</h5>
                    </div>
                  </div>
                </div>
                <!-- project-info -->
                
              </div>
            </div>
          </section>
            <section id="dom" class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> Orders </h4>
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

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <section id="dom" class="mt-3">
              <div class="row">
                  <div class="col-12">
                      <div class="card">
                          <div class="card-header">
                              <h4 class="card-title"> Favoruite Products </h4>
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

                          <div class="card-content collapse show">
                              <div class="card-body card-dashboard table-responsive">
                                 <table
                                            class="table table-de mb-0 display nowrap table-striped table-bordered">
                                            <thead class="">
                                            <tr>
                                                <th>Title</th>
                                                <th>Price</th>
                                                <th>PriceAfterDiscount</th>
                                                <th>Stock</th>
                                                <th>SubCategory</th>
                                                <th>Category</th>
                                                <th>Brand</th>
                                                <th>Selled</th>
                                                <th>Company</th>
                                                <th>Image</th>
                                                <th>Settings</th>
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
                                                         <td>
                                                             {{$product->categories()->get()->whereNotNull('parent_id')->first() !== null ?
                                                             $product->categories()->get()->whereNotNull('parent_id')->first()->title
                                                             :
                                                             ''}}
                                                            </td>
                                                         <td>{{$product->categories()->get()->whereNull('parent_id')->first() !== null ?
                                                            $product->categories()->get()->whereNull('parent_id')->first()->title
                                                            :
                                                            ''
                                                            }}</td>
                                                         <td>{{$product->brand->title}}</td>
                                                         <td>{{$product->count_selled}}</td>
                                                           <td>{{$product->company->name}}</td>
                                                        <td>
                                                           <img style="width: 150px; height: 100px;" src="http://localhost:8888/assets/{{$product->image}}">
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.products.edit',$product -> id)}}"
                                                                   class="btn btn-outline-primary box-shadow-3 mr-1 mb-1 btn-sm"><i class="ft-edit"></i></a>

                                                                <a href="{{route('admin.products.delete',$product->id)}}"
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
  </div>
@endsection
