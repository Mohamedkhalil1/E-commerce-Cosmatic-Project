@extends('layouts.admin')
@section('title',"تعديل منتج")
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.products')}}"> المنتاجات </a>
                                </li>
                                <li class="breadcrumb-item active">تحديث المنتج 
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> تحديث المنتج   </h4>
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
                                        <form class="form" action="{{route('admin.products.update',$product->id)}}" method="POST">
                                            @csrf
                                            @method('put')
                                            
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i> بيانات المنتج </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم المنتج </label>
                                                            <input type="text" value="{{$product->name}}" id="name"
                                                                    class="form-control"
                                                                    placeholder="اسم المنتج"
                                                                    name="name">
                                                            @error("name")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> أختر الفرع </label>
                                                            <select name="branch_id" class=" form-control">
                                                                <optgroup label="من فضلك أختر الفرع ">
                                                                    @if($branches && $branches-> count() > 0)
                                                                        @foreach($branches as $branch)
                                                                            <option
                                                                                value="{{$branch->id}}" @if(isset($product->branch) && $product->branch->id === $branch->id ) selected @endif>{{$branch->name}}></option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('branch_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="projectinput1"> السعر </label>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                              <span class="input-group-text">.00</span>
                                                            </div>
                                                            
                                                            <input type="number" value={{$product->price}} class="form-control square" placeholder="السعر" aria-label="Amount (to the nearest EGP)" name="price">
                                                            <div class="input-group-append">
                                                              <span class="input-group-text">جينه</span>
                                                            </div>
                                                           
                                                        </div>
                                                        @error("price")
                                                        <span class="text-danger"> {{ $message }} </span>
                                                        @enderror
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الكميه </label>
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

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="complaintinput5">الوصف</label>
                                                            <textarea id="complaintinput5" rows="5" class="form-control round" name="description" placeholder="وصف المنتج">{{$product->description}}</textarea>
                                                            @error("description")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> تحديث
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
