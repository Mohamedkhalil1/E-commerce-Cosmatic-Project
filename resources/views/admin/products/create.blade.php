@extends('layouts.admin')
@section('title',"Add Product")
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
                                    <h3 class="card-title" id="basic-layout-form">Add New Product </h3>
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
                                        <form class="form" action="{{route('admin.products.store')}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                           
                                            <div class="form-group">
                                                <label>Product Image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="image">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>

                                            <div class="form-body">
                                                <h5 class="form-section"><i class="la la-tag"></i>Product Information </h5>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" value="{{old('title')}}" id="title"
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
                                                            <input type="text" value="{{old('title_ar')}}" id="title_ar"
                                                                    class="form-control"
                                                                    placeholder="Product Title In arabic"
                                                                    name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> Price </label>
                                                        <div class="input-group">
                                                            <input type="number" value="{{old('price')}}" class="form-control square" placeholder="Price" aria-label="Amount (to the nearest EGP)" name="price">
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
                                                            <input type="number" value="{{old('price_discount')}}" class="form-control square" placeholder="Price After Discount" aria-label="Amount (to the nearest EGP)" name="price_discount">
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
                                                                    value="{{old('barcode')}}"
                                                                    name="barcode">

                                                            @error("barcode")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6 mt-1">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> Stock </label>
                                                            <input type="number" data-bts-init-val="VALUE"
                                                                    class="form-control"
                                                                    placeholder="Product Stock"
                                                                    value="{{old('stock')}}"
                                                                    name="stock">

                                                            @error("stock")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> Sub Category </label>
                                                            <select name="category_id" class=" form-control">
                                                                <optgroup label="choose main category">
                                                                    @if($categories && $categories-> count() > 0)
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                value="{{$category->id}}">{{$category->title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('category_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Brand</label>
                                                            <select name="brand_id" class=" form-control">
                                                                <optgroup label="choose main category">
                                                                    @if($brands && $brands-> count() > 0)
                                                                        @foreach($brands as $brand)
                                                                            <option
                                                                                value="{{$brand->id}}">{{$brand->title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Company</label>
                                                            <select name="company_id" class=" form-control">
                                                                <optgroup label="choose main category">
                                                                    @if($companies && $companies-> count() > 0)
                                                                        @foreach($companies as $company)
                                                                            <option
                                                                                value="{{$company->id}}">{{$company->name}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('brand_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="complaintinput5">Description </label>
                                                            <textarea id="complaintinput5" rows="5" class="form-control round" name="description" placeholder="Product Description">{{old('description')}}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="complaintinput5">Description (AR)</label>
                                                            <textarea id="complaintinput5" rows="5" class="form-control round" name="description_ar" placeholder="Product Description in arabic">{{old('description_ar')}}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>


                                            <div class="form-actions mb-2">
                                             
                                                <button type="submit" class="btn btn-primary float-right">
                                                    Save
                                                </button>

                                                <button type="button" class="btn btn-warning mr-1 float-right"
                                                        onclick="history.back();">
                                                     Back
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
