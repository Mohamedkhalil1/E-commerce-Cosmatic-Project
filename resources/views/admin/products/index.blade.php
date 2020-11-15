@extends('layouts.admin')
@section('title',"Products")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="heading-elements mb-2">
                <a href="{{route('admin.products.create')}}" class="btn btn-success btn-sm"><i class="ft-plus white"></i>Add Product</a>
              </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Products</h4>
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
                                                <th>Title</th>
                                                <th>Price</th>
                                                <th>PriceAfterDiscount</th>
                                                <th>Stock</th>
                                                <th>SubCategory</th>
                                                <th>Category</th>
                                                <th>Brand</th>
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
@endsection
