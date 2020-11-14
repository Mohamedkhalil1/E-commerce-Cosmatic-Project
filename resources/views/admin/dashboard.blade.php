@extends('layouts.admin')
@section('title',"الصفحه الرئسيه")
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
                                        <h3 class="text-muted">اجمالي المبيعات</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        <h4>{{number_format(App\Models\Invoice::clientInvoices()->sum('price'),1)}} <span style="color:green">$</span></h4>
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
                                        <h3 class="text-muted">اجمالي المخرجات</h3>
                                    </div>
                                    <div class="col-12 text-right">
                                        <h4>{{number_format(App\Models\Invoice::supplierInvoices()->sum('price') + App\Models\Invoice::employeeInvoices()->sum('price'),1)}} <span style="color:green">$</span></h4>
                                      
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
                                        <h4 class="text-muted">عدد المنتجات</h4>
                                    </div>
                                    <div class="col-12 text-right">
                                        <h4>{{number_format(App\Models\Product::count(),1)}}  <i class="la la-tags" style="color:blue"></i></h4>
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
                        <h4 class="card-title"><a href="{{route('admin.invoices')}}"><i class="la la-money" ></i> احدث الفواتير</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        <div class="heading-elements">
                          <ul class="list-inline mb-0">
                            <li><button class="btn btn-sm btn-danger box-shadow-2 round btn-min-width pull-right">تفاصيل الفواتير</button></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table id="recent-orders" class="table table-hover table-xl mb-0">
                            <thead>
                              <tr>
                                <th class="border-top-0">الحاله</th>
                                <th class="border-top-0">#رقم الفاتوره</th>
                                <th class="border-top-0">اسم العميل</th>
                                <th class="border-top-0">الفرع</th>
                                <th class="border-top-0">المبلغ</th>
                                <th class="border-top-0">التاريخ</th>
                              </tr>
                            </thead>
                            <tbody>
                            @isset($invoices)
                                @foreach($invoices as $index => $invoice)
                                    <tr>
                                        <td class="text-truncate">
                                            @if($invoice->status === 0)
                                            <i class="la la-dot-circle-o warning font-medium-1 mr-1"></i>قيد التنفيذ
                                            @else
                                            <i class="la la-dot-circle-o success font-medium-1 mr-1"></i>مدفوعه
                                            @endif
                                        </td>
                                        <td class="text-truncate"><a href="{{route('admin.invoices.show',$invoice->id)}}">INV-{{$invoice->id}}</a></td>
                                        <td class="text-truncate">
                                            <span>{{$invoice->client ? $invoice->client->name : ''}}</span>
                                        </td>
                                        
                                        <td>
                                        <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-danger round"@else class="btn btn-sm btn-outline-success round" @endif >{{$invoice->branch ? $invoice->branch->name : ''}}</button>
                                        </td>

                                        <td class="text-truncate">{{$invoice->price}} ج</td>

                                        <td class="text-truncate">
                                            {{$invoice->date}}
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
                        <h4 class="card-title"><a href="{{route('admin.products')}}"><i class="la la-tags"></i>احدث المنتاجات</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead>
                              <tr>
                                <th>اسم المنتج</th>
                                <th>السعر (ج)</th>
                                <th>الفرع</th>
                              </tr>
                            </thead>
                            
                            @isset($products)
                                <tbody>
                                    @foreach($products as $index => $product)
                                        
                                        <tr @if($index%2 === 0 ) class="bg-success bg-lighten-5" @endif>
                                            <td>{{$product->name}}</td>
                                            <td>{{$product->price}}</td>
                                            <td>
                                                <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-danger round"@else class="btn btn-sm btn-outline-success round" @endif >{{$product->branch ? $product->branch->name : ''}}</button>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            @endisset
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-xl-6">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.branches')}}"><i class="la la-building"></i> احدث الفروع</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead>
                              <tr>
                                <th>الاسم</th>
                                <th>المدينه</th>
                                <th>المسئول</th>
                              </tr>
                            </thead>
                            @isset($branches)
                                <tbody>
                                    @foreach($branches as $index=>$branch)
                                        <tr @if($index%2 === 0 ) class="bg-danger bg-lighten-5" @endif>
                                            <td>{{$branch->name}}</td>
                                            <td>
                                                <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-info round"@else class="btn btn-sm btn-outline-success round" @endif >{{$branch->city}}</button>
                                            </td>
                                            <td>{{$branch->admin ? $branch->admin->name : ''}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endisset
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>


                  <div class="col-12 col-xl-6">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.suppliers')}}"><i class="icon-users"></i> احدث المزودين</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead>
                              <tr>
                                <th>الاسم</th>
                                <th>العنوان</th>
                                <th>رقم التليفون</th>
                              </tr>
                            </thead>
                            @isset($suppliers)
                                <tbody>
                                    @foreach($suppliers as $index=>$supplier)
                                        <tr @if($index%2 === 0 ) class="bg-danger bg-lighten-5" @endif>
                                            <td>{{$supplier->name}}</td>
                                            <td>
                                                <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-info round"@else class="btn btn-sm btn-outline-success round" @endif >{{$supplier->address}}</button>
                                            </td>
                                            <td>{{$supplier->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endisset
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-12 col-xl-6">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.clients')}}"><i class="ft-users"></i> احدث العملاء</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead>
                              <tr>
                                <th>الاسم</th>
                                <th>العنوان</th>
                                <th>رقم التليفون</th>
                              </tr>
                            </thead>
                            @isset($clients)
                                <tbody>
                                    @foreach($clients as $index=>$client)
                                        <tr @if($index%2 === 0 ) class="bg-danger bg-lighten-5" @endif>
                                            <td>{{$client->name}}</td>
                                            <td>
                                                <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-info round"@else class="btn btn-sm btn-outline-success round" @endif >{{$client->address}}</button>
                                            </td>
                                            <td>{{$client->phone }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            @endisset
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="col-12 col-xl-12">
                    <div class="card" style="height: 355px;">
                      <div class="card-header">
                        <h4 class="card-title"><a href="{{route('admin.employees')}}"><i class="la la-users"></i> احدث الموظفين</a></h4>
                        <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                        
                      </div>
                      <div class="card-content">
                        <div class="table-responsive">
                          <table class="table table-de mb-0">
                            <thead>
                              <tr>
                                <th>الاسم</th>
                                <th>العنوان </th>
                                 <th>رقم التليفون</th>
                                <th>الفرع</th>
                              </tr>
                            </thead>
                            
                            @isset($employees)
                                <tbody>
                                    @foreach($employees as $index => $employee)
                                        
                                        <tr @if($index%2 === 0 ) class="bg-success bg-lighten-5" @endif>
                                            <td>{{$employee->name}}</td>
                                            <td>{{$employee->address}}</td>
                                             <td>{{$employee->phone}}</td>
                                            <td>
                                                <button type="button" @if($index%2 === 0)class="btn btn-sm btn-outline-danger round"@else class="btn btn-sm btn-outline-success round" @endif >{{$employee->branch ? $employee->branch->name : ''}}</button>
                                            </td>
                                        </tr>
                                        
                                    @endforeach
                                </tbody>
                            @endisset
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
