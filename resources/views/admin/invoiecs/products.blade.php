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
                               
                                <div class="col-md-4 col-sm-12">
                                    <div class="card">
                                    <div class="card-content">
                                        <div class="card-body">
                                        <div class="form-group">
                                            <h5>{{$product->name}}@if($invoice->products()->find($product->id) !== null) <i class="ft-check-circle float-right" style="color:green"></i>@endif</h5>
                                            <p>{{$product->price}} جينه
                                             <span class="float-right">الكميه : {{(int)$product->stock === 0 ? 'غير متاح' : $product->stock}} </span>
                                        </p>
                                            <div class="form-group">
                                                <form method="POST" action="{{route('admin.invoices.addProduct',$invoice->id)}}">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                                    <input type="number" id="quantity"
                                                        class="form-control"
                                                        placeholder="الكميه"
                                                        value="@if($invoice->products()->find($product->id) === null){{old('quantity')}} @else{{(int)App\Models\InvoiceProduct::where('product_id',$product->id)->where('invoice_id',$invoice->id)->first()->quantity}}@endif"
                                                        name="quantity">

                                                @error("quantity")
                                                <span class="text-danger"> {{ $message }} </span>
                                                @enderror
                                            </div>
                                            <button type="submit"
                                                class="btn btn-outline-success box-shadow-3 mr-1 mt-2 btn-md"><i class="ft-cart"></i>يضاف لفاتوره</button>
                                        </form>
                                            <a href="{{route('admin.invoices.removeProduct',[$invoice->id,$product->id])}}"
                                                    class="btn btn-outline-danger box-shadow-3 mr-1 mt-2 btn-md"><i class="ft-cart"></i>حذف من الفاتوره</a>
                                        </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        @endisset
                    </div>
                  </section>
                  {{ $products->links() }}
                <a href="{{route('admin.invoices.finish',$invoice->id)}}" class="btn btn-primary float-right mb-2">
                    <i class="la la-check-square-o"></i> انهاء الفاتوره
                </a>

            </div>
        </div>
    </div>

@endsection
