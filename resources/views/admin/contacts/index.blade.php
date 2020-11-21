@extends('layouts.admin')
@section('title',"Contact Us")
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
           
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Messages</h4>
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
                                        <table class="table table-de mb-0 display nowrap table-striped table-bordered">
                                            <thead class="">
                                            <tr>
                                                <th>Subject</th>
                                                <th>email</th>
                                                <th>phone</th>
                                                <th>message</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($contacts)
                                                @foreach($contacts as $contact)
                                                    <tr>
                                                        <td>{{$contact->subject}}</td>
                                                        <td>{{$contact->user === null ? $contact->email : $contact->user->email}}</td>
                                                        <td>{{$contact->user === null ? $contact->phone : $contact->user->phone}}</td>
                                                        <td>{{$contact->message}}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                        
                                        <div class="justify-content-center d-flex">

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
