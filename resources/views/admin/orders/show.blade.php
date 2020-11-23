@extends('layouts.admin')
@section('title',"Order")
@section('content')
  <div class="app-content content" >
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">Order #{{$order->invoice_num}}</h3>
        </div>
      </div>
      
      <div class="content-body">
        <section class="card">
          <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12 text-center text-md-left">
                <div class="media">
                  <img height="100px" wight="100px" src="https://static.rfstat.com/renderforest/images/v2/logo-homepage/gradient_2.png" alt="logo" class=""
                  />
                  <div class="media-body">
                    <ul class="ml-2 px-0 list-unstyled">
                      <li class="text-bold-800">{{$order->region}}</li>
                      <li>{{$order->city}}</li>
                      <li>{{$order->address}}</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>Order</h2>
                <p class="pb-3"># {{$order->invoice_num}}</p>
              </div>
            </div>
            <!--/ Invoice Company Details -->

            
            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
              <div class="col-sm-12 text-center text-md-left">
                <p class="text-muted">Bill To</p>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-left">
                <ul class="px-0 list-unstyled">
                  <li class="text-bold-800">{{$order->user ? $order->user->name : ''}}</li>
                  <li>{{$order->user ? $order->user->email : ''}}</li>
                  <li>{{$order->user ? $order->user->phone : ''}}</li>
                  
                </ul>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-right">
                <p>
         
                  <span class="text-muted">Created At :</span> {{$order->created_at->format('Y-m-d h:i')}}</p>
              </div>
            </div>
            <!--/ Invoice Customer Details -->
            <!-- Invoice Items Details -->
            <div id="invoice-items-details" class="pt-2"> 
              <div class="row">
                <div class="table-responsive col-sm-12">
                  <table class="table" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Product Title</th>
                        <th class="text-right">Price</th>
                        <th class="text-right">Price After Discount</th>
                        <th class="text-right">Quantity</th>
                        <th class="text-right">Total Price</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($details as $index => $detail)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>
                                <p>{{App\Models\Product::find($detail->product_id)->title}}</p>
                                </td>
                                <td class="text-right">{{$detail->price}} EGP</td>
                                <td class="text-right">{{$detail->price_discount}} EGP</td>
                                <td class="text-right">{{$detail->quantity}}</td>
                                <td class="text-right">{{$detail->price * $detail->quantity}} EGP</td>
                            </tr>
                        @endforeach  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
           
          </div>
        </section>

        <div class="row">

          <div class="col-md-7 col-sm-12 text-center text-md-left">
            <p class="lead">Payment Methods:</p>
            <div class="row">
              <div class="col-md-8">
                <table class="table table-borderless table-sm">
                  <tbody>
                    <tr>
                      <td>Payment Method</td>
                      <td>
                        <i class="success font-medium-1 mr-1">{{$order->payment_type}}</i>
                      </td>
                    </tr>
  
                    <tr>
                      <td>Status</td>
                      <td>
                        @if($order->done === 0)
                          <i class="warning font-medium-1 mr-1">Pending</i>
                        @elseif($order->done==1)
                          <i class="success font-medium-1 mr-1">Paid</i>
                        @elseif($order->done === 4)
                          <i class="danger font-medium-1 mr-1">Decline</i>
                        @endif
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

         
          <div class="col-md-5 col-sm-12">
            <p class="lead">Total due</p>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>Sub Total</td>
                    <td class="text-right">{{$order->amount - $order->shipping_fees}} EGP</td>
                  </tr>
                  <tr>
                    <td>Shipping</td>
                    <td class="text-right">{{$order->shipping_fees}} EGP</td>
                  </tr>
                  <tr>
                    <td class="text-bold-800">Total</td>
                    <td class="text-bold-800 text-right">{{$order->amount}} EGP</td>
                  </tr>
                </tbody>
              </table>
            </div>
            
          </div>
        </div>
        
      </div>
    </div>
  </div>

@endsection
