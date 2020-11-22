@extends('layouts.admin')
@section('title',"Clients")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="heading-elements mb-2">
                <a href="{{route('admin.clients.create')}}" class="btn btn-success btn-sm"><i class="ft-plus white"></i>Add Client</a>
              </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Clients</h4>
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
                                    <div class="card-body card-dashboard table-responsive">
                                       
                                        <div class="row">
                                            <fieldset class="col-lg-4  col-md-4 col-sm-10">
                                                <form class="form" action="{{route('admin.clients')}}" method="GET" >
                                                        <div class="input-group">
                              
                                                        <input type="text" name="searchValue" class="form-control" placeholder="Search" aria-label="Amount">
                                                        <div class="input-group-append">
                                                            <button class="btn btn-success" type="submit"><i class="la la-search"></i></button>
                                                        </div>
                                                        </div>
                                                </form>
                                            </fieldset> 
                                        </div>
                                        <table class="table table-de mb-0 display nowrap table-striped table-bordered mt-1">
                                            <thead class="">
                                            <tr>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>E-mail</th>
                                                <th>Settings</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($clients)
                                                @foreach($clients as $client)
                                                    <tr>
                                                        <td><a href="{{route('admin.clients.show',$client->id)}}">{{$client->name}}</a></td>
                                                        <td>{{$client->phone}}</td>
                                                        <td>{{$client->email}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('admin.clients.edit',$client->id)}}"
                                                                   class="btn btn-outline-primary box-shadow-3 mr-1 mb-1 btn-sm"><i class="ft-edit"></i></a>

                                                                <a href="{{route('admin.clients.delete',$client->id)}}"
                                                                   class="btn btn-outline-danger box-shadow-3 mr-1 mb-1 btn-sm"><i class="ft-trash-2"></i></a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        
                                        <div class="justify-content-center d-flex">
                                            {{ $clients->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
