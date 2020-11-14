@extends('layouts.admin')
@section('title',"تعديل منتج")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form">Update Product</h4>
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
                                    <div class="card-body">
                                        <form class="form" action="{{route('admin.products.update',$product->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            
                                            <input type="hidden" value="{{$product->id}}" name="id">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="http://localhost:8888/assets/{{$product->image}}"
                                                        class="rounded-circle  height-150" alt="product image">
                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label> Product Image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="image">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>Product Information</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" value="{{$product->title}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="Product Title"
                                                                    name="title">
                                                            @error("title")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title (AR)</label>
                                                            <input type="text" value="{{$product->title_ar}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="Product Title"
                                                                    name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    

                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> Price </label>
                                                        <div class="input-group">
                                                            <input type="number" value={{$product->price}} class="form-control square" placeholder="Product Price" aria-label="Amount (to the nearest EGP)" name="price">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text">EGP</span>
                                                            </div>
                                                        </div>
                                                        @error("price")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> Price After Discount </label>
                                                        <div class="input-group">
                                                            <input type="number" value={{$product->price_discount}} class="form-control square" placeholder="Price After Discount" aria-label="Amount (to the nearest EGP)" name="price_discount">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text">EGP</span>
                                                            </div>
                                                        </div>
                                                        @error("price_discount")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>


                                                    <div class="col-md-6 mt-1">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> barcode </label>
                                                            <input type="text"
                                                                    class="form-control"
                                                                    placeholder="Product barcode"
                                                                    value="{{$product->barcode}}"
                                                                    name="barcode">

                                                            @error("barcode")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="col-md-6 mt-1">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Stock </label>
                                                            <input type="number"
                                                                    class="form-control"
                                                                    placeholder="كميه المنتج"
                                                                    value="{{$product->stock}}"
                                                                    name="stock">

                                                            @error("stock")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="complaintinput5">Description</label>
                                                            <textarea id="complaintinput5" rows="5" class="form-control round" name="description" placeholder="Product Descrption">{{$product->description}}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="complaintinput5">Description (AR)</label>
                                                            <textarea id="complaintinput5" rows="5" class="form-control round" name="description_ar" placeholder="Description in arabic">{{$product->description_ar}}</textarea>
                                                            @error("description_ar")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-actions mb-2">
                                               
                                                <button type="submit" class="btn btn-primary float-right">
                                                    update
                                                </button>

                                                <button type="button" class="btn btn-warning mr-1 float-right"
                                                onclick="history.back();">
                                                    back
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection
