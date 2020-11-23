@extends('layouts.admin')
@section('title',"Products|ad")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <section id="block-examples">
                    <div class="row">
                      <div class="col-12 mt-1 mb-3">
                        <h4>Add Product To Ad</h4>
                        <hr>
                      </div>
                    </div>
                    @include('admin.includes.alerts.success')
                    @include('admin.includes.alerts.errors')
                    <div class="row mb-3">
                        @isset($products)
                            @foreach($products as $index => $product)
                            <div class="col-lg-4 col-md-12 mt-4">
                                <div class="card" style="height: 300.844px;">
                                  <div class="card-content">
                                    <img class="card-img-top " height="200px" src="http://localhost:8888/assets/{{$product->image}}" alt="product image">
                                    <div class="card-body">
                                      <h4 class="card-title text-muted  ">
                                        {{$product->title}}
                                        @if($product->ad_id === $ad->id)
                                        <i class="ft-check-circle float-right" style="color:green"></i>
                                        @endif
                                      </h4>
                                     
                                    </div>
                                  </div>
                                  <div class="card-footer text-muted">
                                    <span class="float-left">{{$product->price_discount}} EGP</span>

                                    @if($product->ad_id === $ad->id)
                                    <a href="{{route('admin.ads.products.remove',[$ad->id,$product->id])}}" class="btn btn-sm btn-danger float-right"><span class="float-right">Remove from Ad </span></a>
                                    @else
                                      <a href="{{route('admin.ads.products.add',[$ad->id,$product->id])}}" class="btn btn-sm btn-success float-right"><span class="float-right">Add To Ad </span></a>
                                    @endif
                                   
                                    
                                  </div>
                                </div>
                            </div>
                            
                            @endforeach
                        @endisset
                    </div>
                  </section>
                  <div class="d-flex">
                    {{ $products->links() }}
                </div>
            </div>
        </div>
    </div>

@endsection
