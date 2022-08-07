@extends('master.admin')
@section('content')

    <div class="container">
        <h2>Merchant Activity Lists</h2><br>
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    <form action="{{route('filter.customer')}}" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                <option value="hide">-- Customer Info --</option>
                                <option value="1">New Added Customer</option>
                                <option value="2">Updated Customer</option>
                                <option value="3">Deleted Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="{{route('filter.profile')}}" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                <option value="hide">-- Profile Info --</option>
                                <option value="1">New Added Profile</option>
                                <option value="2">Updated Profile</option>
                                <option value="3">Deleted Profile</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select>
                                <option value="hide">-- Product Info --</option>
                                <option value="january">New Added Product</option>
                                <option value="february">Updated Product</option>
                                <option value="march">Deleted Product</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select>
                                <option value="hide">-- Inventory Info --</option>
                                <option value="january">Added Product</option>
                                <option value="march">Added Unit</option>
                                <option value="february">Removed Product</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                <div class="col-md-2">
                    <form action="" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select>
                                <option value="hide">-- Disable Product --</option>
                                <option value="january">View All</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{--            <div class="row">--}}
    {{--                <div class="col-md-2">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="dropbtn block">Customer Info</button>--}}
    {{--                                <div class="dropdown-content">--}}
    {{--                                    <a href="{{route('new.customer')}}">New Added</a>--}}
    {{--                                    <a href="{{route('updated.customer')}}">Updated</a>--}}
    {{--                                    <a href="{{route('delete.customer')}}">Deleted</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="col-md-2">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="dropbtn block">Customer Profile Info</button>--}}
    {{--                                <div class="dropdown-content">--}}
    {{--                                    <a href="#">Created Profile</a>--}}
    {{--                                    <a href="#">Updated Profile</a>--}}
    {{--                                    <a href="#">Deleted Profile</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="col-md-2">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="dropbtn block">Product Index Info</button>--}}
    {{--                                <div class="dropdown-content">--}}
    {{--                                    <a href="#">Created Product</a>--}}
    {{--                                    <a href="#">Updated Product</a>--}}
    {{--                                    <a href="#">Deleted Product</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="col-md-2">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="dropbtn block">Inventory Info</button>--}}
    {{--                                <div class="dropdown-content">--}}
    {{--                                    <a href="#">Added Product</a>--}}
    {{--                                    <a href="#">Removed Product</a>--}}
    {{--                                    <a href="#">Added Unit</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}

    {{--                <div class="col-md-2">--}}
    {{--                    <div class="card-body">--}}
    {{--                        <div>--}}
    {{--                            <div class="dropdown">--}}
    {{--                                <button class="dropbtn">Disabled Product Info</button>--}}
    {{--                                <div class="dropdown-content">--}}
    {{--                                    <a href="#">Show Product</a>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--            </div>--}}


    {{--                <div class="card-header pb-3">--}}
    {{--                    <form class="d-flex align-items-center justify-content-start flex-wrap" action="{{route('log.merchant')}}">--}}
    {{--                        <div class="mobile-w-100 me-0 me-sm-3 mb-3">--}}
    {{--                            <input type="search" class="form-control me-3" placeholder="Added Customer" name="newCustomer" value="{{app('request')->newCustomer}}" disabled>--}}
    {{--                        </div>--}}
    {{--                        <div class="mobile-w-100 me-0 me-sm-3 mb-3">--}}
    {{--                            <input type="search" class="form-control me-3" placeholder="সংগঠনের নাম" name="name" value="{{app('request')->name}}">--}}
    {{--                        </div>--}}

    {{--                        <div class="mobile-w-100 me-0 me-sm-3 mb-3">--}}
    {{--                            <button type="submit" class="btn-create border-0 h-100">খুঁজুন</button>--}}
    {{--                        </div>--}}
    {{--                    </form>--}}
    {{--                </div>--}}

    <br>

    <div class="card">
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Description</th>
                <th width="400px">URL</th>
                <th>Action Time</th>
            </tr>
            @foreach(@$logs as $key => $log)
                <tr>
                    <td>{{ ++$key }}</td>
                    <td>{{ @$log->description }} <br>
                        @if(@$log->loggable->name)
                            <b>Name: {{@$log->loggable->name}} </b>

                        @elseif(@$log->loggable->customer->name)
                            <b>Name: {{@$log->loggable->customer->name}} </b>

                        @elseif(@$log->loggable->products->name)
                            <b>Unit Amount: {{@$log->loggable->unit}}</b><br>
                            <b>Product Name: {{@$log->loggable->products->name}}</b>

                        @elseif(@$log->loggable->product->name)
                            <b>Product Name: {{@$log->loggable->product->name}}</b>
                        @endif
                    </td>
                    <td class="text-success">{{ @$log->url }}</td>
                    <td>{{ @$log->created_at->diffForHumans() }} <br/> {{ @$log->created_at }}</td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
