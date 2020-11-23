@extends('layouts.admin')
@section('title',"اختيار المنتجات")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="block-examples">
                    <div class="row">
                      <div class="col-12 mt-1 mb-3">
                        <h4>اضافه منتجات لفاتوره</h4>
                        <hr>
                      </div>
                    </div>
                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')
                    <div class="row">
                        @isset($products)
                            @foreach($products as $product)
                               
                            <div class="col-lg-4 col-md-12">
                                <div class="card" style="height: 428.844px;">
                                  <div class="card-content">
                                    <img class="card-img-top " height="200px" src="http://localhost:8888/assets/{{$product->image}}" alt="product image">
                                    <div class="card-body">
                                      <h4 class="card-title">{{$product->title}}</h4>
                                      <p class="card-text">
                                        {{$product->description}}
                                      </p>
                                    </div>
                                  </div>
                                  <div class="card-footer text-muted">
                                    <span class="float-left">$349</span>
                                    <button type="submit" class="btn btn-sm btn-primary float-right"><span class="float-right">Add To Ad </span></button>
                                  </div>
                                </div>
                              </div>

                            @endforeach
                        @endisset
                    </div>
                  </section>
                  <div class=" d-flex">
                    {{ $products->links() }}
                </div>
                
                <a href="" class="btn btn-success btn-lg float-right mb-2">
                     Finish <i class="la la-check-square-o"></i>
                </a>

            </div>
        </div>
    </div>

@endsection
