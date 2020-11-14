@extends('layouts.admin')
@section('title',"عرض الفاتوره")
@section('content')
  <div class="app-content content" >
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">الفاتوره #{{$invoice->id}}</h3>
          <div class="row breadcrumbs-top">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">الرئسيه</a>
                </li>
                <li class="breadcrumb-item"><a href="{{route('admin.invoices')}}">الفواتير</a>
                </li>
                <li class="breadcrumb-item active">#{{$invoice->id}}
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      
      <div class="content-body">
        <section class="card">
          <div id="invoice-template" class="card-body">
            <!-- Invoice Company Details -->
            <div id="invoice-company-details" class="row">
              <div class="col-md-6 col-sm-12 text-center text-md-left">
                <div class="media">
                  <img height="100px" wight="100px" src="https://gfx4arab.com/wp-content/uploads/2018/12/blue-company-logo_1057-513.jpg" alt="لوجو الشركه" class=""
                  />
                  <div class="media-body">
                    <ul class="ml-2 px-0 list-unstyled">
                      <li class="text-bold-800">{{$invoice->branch ? $invoice->branch->name : ''}}</li>
                      <li>{{$invoice->branch ? $invoice->branch->city : ''}}</li>
                      <li>{{$invoice->branch ? $invoice->branch->address : ''}}</li>
                      <li>{{$invoice->branch ? $invoice->branch->admin->name : ''}}</li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-right">
                <h2>الفاتوره</h2>
                <p class="pb-3"># {{$invoice->id}}</p>
              </div>
            </div>
            <!--/ Invoice Company Details -->

            
            <!-- Invoice Customer Details -->
            <div id="invoice-customer-details" class="row pt-2">
              <div class="col-sm-12 text-center text-md-left">
                <p class="text-muted">الفاتوره الى</p>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-left">
                <ul class="px-0 list-unstyled">
                  <li class="text-bold-800">{{$invoice->client ? $invoice->client->name : ''}}</li>
                  <li>{{$invoice->client ? $invoice->client->email : ''}}</li>
                  <li>{{$invoice->client ? $invoice->client->phone : ''}}</li>
                  <li>{{$invoice->client ? $invoice->client->address : ''}}</li>
                </ul>
              </div>
              <div class="col-md-6 col-sm-12 text-center text-md-right">
                <p>
                  <span class="text-muted">تاريخ الفاتوره : </span>{{$invoice->date}}</p>
                
                  <span class="text-muted">وقت انشاء فالنظام :</span> {{$invoice->created_at->format('Y-m-d h:i')}}</p>
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
                        <th>اسم المنتج</th>
                        <th class="text-right">السعر</th>
                        <th class="text-right">الكميه</th>
                        <th class="text-right">المبلغ</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                        @foreach ($details as $index => $detail)
                            <tr>
                                <th scope="row">{{$index+1}}</th>
                                <td>
                                <p>{{App\Models\Product::find($detail->product_id)->name}}</p>
                                </td>
                                <td class="text-right">{{$detail->price}} ج</td>
                                <td class="text-right">{{$detail->quantity}}</td>
                                <td class="text-right">{{$detail->price * $detail->quantity}} ج</td>
                            </tr>
                        @endforeach  
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            {{ $details->links() }}
          </div>
        </section>

        <div class="row">
          <div class="col-md-7 col-sm-12 text-center text-md-left">
          </div>
          <div class="col-md-5 col-sm-12">
            <p class="lead">المجموع</p>
            <div class="table-responsive">
              <table class="table">
                <tbody>
                  <tr>
                    <td>المبلغ</td>
                    <td class="text-right">{{$invoice->price}} ج</td>
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
