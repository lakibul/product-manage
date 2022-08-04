@extends('master.admin')
@section('content')

    <style>
        .dropbtn {
            background-color: #34c38f;
            color: white;
            padding: 12px;
            font-size: 12px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            border-radius: 10px;
            min-width: 160px;
            box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {background-color: #f1f1f1}

        .dropdown:hover .dropdown-content {
            display: block;
        }

        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>

    <div class="container">
        <h2>Merchant Activity Lists</h2><br>
        <div class="card-header">
            <div class="row">
                <div class="col-md-2">
                    <div class="card-body">
                        <div>
                            <div class="dropdown">
                                <button class="dropbtn block">Customer Info</button>
                                <div class="dropdown-content">
                                    <a href="#">Created Customer</a>
                                    <a href="#">Updated Customer</a>
                                    <a href="#">Deleted Customer</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card-body">
                        <div>
                            <div class="dropdown">
                                <button class="dropbtn block">Customer Profile Info</button>
                                <div class="dropdown-content">
                                    <a href="#">Created Profile</a>
                                    <a href="#">Updated Profile</a>
                                    <a href="#">Deleted Profile</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card-body">
                        <div>
                            <div class="dropdown">
                                <button class="dropbtn block">Product Index Info</button>
                                <div class="dropdown-content">
                                    <a href="#">Created Product</a>
                                    <a href="#">Updated Product</a>
                                    <a href="#">Deleted Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card-body">
                        <div>
                            <div class="dropdown">
                                <button class="dropbtn block">Inventory Info</button>
                                <div class="dropdown-content">
                                    <a href="#">Added Product</a>
                                    <a href="#">Removed Product</a>
                                    <a href="#">Added Unit</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <div class="card-body">
                        <div>
                            <div class="dropdown">
                                <button class="dropbtn">Disabled Product Info</button>
                                <div class="dropdown-content">
                                    <a href="#">Show Product</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<br>

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
