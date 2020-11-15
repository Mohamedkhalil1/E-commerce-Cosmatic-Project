@extends('layouts.admin')
@section('title',"Edit Category")
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
                                    <h4 class="card-title" id="basic-layout-form">Update Category</h4>
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
                                        <form class="form" action="{{route('admin.subcategories.update',$category->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            
                                            <input type="hidden" value="{{$category->id}}" name="id">

                                           

                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>Category Information</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" value="{{$category->title}}" id="title"
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
                                                            <input type="text" value="{{$category->title_ar}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="Category Title In Arabic"
                                                                    name="title_ar">
                                                            @error("title_ar")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Belong to Category</label>
                                                            <select name="parent_id" class=" form-control">
                                                                <optgroup label="Choose Main Category">
                                                                    @if($categories && $categories-> count() > 0)
                                                                        @foreach($categories as $maincategory)
                                                                            <option
                                                                                value="{{$maincategory->id}}" @if(isset($category->category) && $category->category->id === $maincategory->id ) selected @endif>{{$maincategory->title}} </option>
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
