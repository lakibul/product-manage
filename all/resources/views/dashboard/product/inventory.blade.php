@extends('master.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--                    <a href="" class="btn btn-warning my-3" data-toggle="modal" data-target="#exampleModal">Add Profile</a>--}}
                    <div class="row">
                        <div class="col-md-8">
                            <input type="text" name="search" id="search" placeholder="Search here..." class="form-control">
                        </div>
                    </div>
                    <p class="text-center text-success mt-5 mb-5">{{Session::get('message')}}</p>
                    <div class="table-data">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>SKU Number</th>
                                <th>Price</th>
                                <th>Image</th>
                                <th>Short Description</th>
                                <th>Long Description</th>
                            </tr>
                            </thead>
                            @foreach($products as $item)
                                <tbody>
                                @if($item->status == 1)
                                    <tr>
                                        <td scope="row">{{$loop->iteration}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->sku}}</td>
                                        <td>{{$item->price}}</td>
                                        <td><img src="{{asset($item->image)}}" height="40" width="50" alt=""/></td>
                                        <td>{{$item->short_description}}</td>
                                        <td>{{$item->long_description}}</td>
                                    </tr>
                                @endif
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- end col -->
    </div>
    @include('dashboard.product.product_js');
@endsection
