@extends('layouts.admin')
@section('title',"Add Category")
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
                                    <h3 class="card-title" id="basic-layout-form">Add New SubCategory </h3>
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
                                        <form class="form" action="{{route('admin.subcategories.store')}}" method="POST">
                                            @csrf
                                            <div class="form-body">
                                                <h5 class="form-section"><i class="la la-tag"></i>SubCategory Information </h5>
                                                <div class="row">

                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" value="{{old('title')}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="Category Title"
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
                                                                    placeholder="Category Title In arabic"
                                                                    name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> Main Category </label>
                                                            <select name="parent_id" class=" form-control">
                                                                <optgroup label="choose main category">
                                                                    @if($categories && $categories-> count() > 0)
                                                                        @foreach($categories as $category)
                                                                            <option
                                                                                value="{{$category->id}}">{{$category->title}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('parent_id')
                                                            <span class="text-danger"> {{$message}}</span>
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