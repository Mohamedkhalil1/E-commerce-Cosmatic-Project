@extends('layouts.admin')
@section('title',"Edit brand")
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
                                    <h4 class="card-title" id="basic-layout-form">Update brand</h4>
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
                                        <form class="form" action="{{route('admin.brands.update',$brand->id)}}" method="POST"  enctype="multipart/form-data">
                                            @csrf
                                            @method('put')
                                            
                                            <input type="hidden" value="{{$brand->id}}" name="id">

                                            <div class="form-group">
                                                <div class="text-center">
                                                    <img
                                                        src="http://localhost:8888/assets/{{$brand->image}}"
                                                        class="rounded-circle  height-150" alt="product image">
                                                </div>
                                            </div>

                                            
                                            <div class="form-group">
                                                <label> brand Image </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <input type="file" id="file" name="image">
                                                    <span class="file-custom"></span>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>


                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>brand Information</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Title</label>
                                                            <input type="text" value="{{$brand->title}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="brand Title"
                                                                    name="title">
                                                            @error("title")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2">Belong to Division</label>
                                                            <select name="division_id" class=" form-control">
                                                                <optgroup label="Choose Main Category">
                                                                    @if($divisions && $divisions-> count() > 0)
                                                                        @foreach($divisions as $division)
                                                                            <option
                                                                                value="{{$division->id}}" @if(isset($brand->division) && $brand->division->id === $division->id ) selected @endif>{{$division->title}} </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('division_id')
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
