@extends('master.admin2')
@section('content')

    <div class="container">
        <h2>Merchant Activity Lists</h2><br>
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <form action="{{route('filter.customer')}}" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                <option value="" disabled selected>-- Customer Info --</option>
                                <option value="1">New Added Customer</option>
                                <option value="2">Updated Customer</option>
                                <option value="3">Deleted Customer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                <div class="col-md-3">
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

                @if(Auth::guard('merchant')->check())
                    <div class="col-md-3">
                        <form action="{{route('filter.inventory')}}" method="post" style="margin-top: -30px;">
                            @csrf
                            <div class="select">
                                <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                    <option value="hide">-- Inventory Info --</option>
                                    <option value="1">Added Product</option>
                                    <option value="2">Added Unit</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                        </form>
                    </div>
                @endif

                <div class="col-md-3">
                    <form action="{{route('filter.add-inventory')}}" method="post" style="margin-top: -30px;">
                        @csrf
                        <div class="select">
                            <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                <option value="hide">-- Disable Product --</option>
                                <option value="1">Product Added</option>
                                <option value="1">Product Removed</option>
                            </select>
                        </div>
                        <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                    </form>
                </div>

                @if(Auth::guard('admin')->check())
                    <div class="col-md-3">
                        <form action="{{route('filter.product')}}" method="post" style="margin-top: -30px;">
                            @csrf
                            <div class="select">
                                <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                    <option value="hide">-- Product Info --</option>
                                    <option value="1">New Added Product</option>
                                    <option value="2">Updated Product</option>
                                    <option value="3">Deleted Product</option>
                                </select>
                            </div>
                            <button type="submit" class="btn-sm btn-outline-success search-btn">Show</button>
                        </form>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <br>

    <div class="container">
        <div class="card" style="padding: 20px">
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
    </div>

@endsection