@extends('layouts.admin')
@section('title',"Edit Code")
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
                                    <h4 class="card-title" id="basic-layout-form">Update Code</h4>
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
                                        <form class="form" action="{{route('admin.codes.update',$code->id)}}" method="POST" >
                                            @csrf
                                            @method('put')
                                            
                                            <input type="hidden" value="{{$code->id}}" name="id">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-home"></i>Code Information</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Code</label>
                                                            <input type="text" value="{{$code->code}}" id="title"
                                                                    class="form-control"
                                                                    placeholder="Code"
                                                                    name="code">
                                                            @error("code")
                                                            <span class="text-danger"> {{ $message }} </span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">Discount</label>
                                                            <input type="number" value="{{$code->discount}}" id="discount"
                                                                    class="form-control"
                                                                    placeholder="Discount perctage"
                                                                    name="discount">
                                                            @error("discount")
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
