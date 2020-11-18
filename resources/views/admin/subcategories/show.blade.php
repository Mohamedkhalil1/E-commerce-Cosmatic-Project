@extends('layouts.admin')
@section('title',"$category->title")
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2">
          <h3 class="content-header-title">{{$category->title}}</h3>
         
        </div>
      </div>
      
      <div class="content-detached ">
        <div class="content-body">
          <section class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-head">
                  <div class="card-header">
                    <h4 class="card-title">SubCategory Information</h4>
                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                    <div class="heading-elements">
                         <span class="badge badge-default badge-danger">{{$category->title}}</span>                      
                    </div>
                  </div>
                </div>
                <!-- project-info -->
                <div id="project-info" class="card-body row">
                  <div class="project-info-count col-lg-6 col-md-6">
                    <div class="project-info-icon">
                      <h2>{{$category->products()->count()}}</h2>
                      <div class="project-info-sub-icon">
                        <span class="icon-grid"></span>
                      </div>
                    </div>
                    <div class="project-info-text pt-1">
                      <h5>Products</h5>
                    </div>
                  </div>

                  <div class="project-info-count col-lg-6 col-md-6">
                    <div class="project-info-icon">
                      <h2>{{$category->products()->where('count_selled','>',0)->count()}}</h2>
                      <div class="project-info-sub-icon">
                        <span class="icon-grid"></span>
                      </div>
                    </div>
                    <div class="project-info-text pt-1">
                      <h5>Selled Products</h5>
                    </div>
                  </div>
                </div>
                <!-- project-info -->
                
              </div>
            </div>
          </section>
          <!-- Task Progress -->
            <section id="dom" class="mt-3">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"> <span class="icon-grid"></span> Products </h4>
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
                                              <td>{{$product->brand->title}}</td>
                                              <td>{{$product->count_selled}}</td>
                                              <td>
                                                {{$product->company->name}}
                                               </td>
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
                                      @isset($products)@endisset
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
