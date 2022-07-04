@extends('master.admin')
@section('content')
<div class="col-md-12">
    <h2>Product Index</h2>
</div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{--                    <a href="" class="btn btn-warning my-3" data-toggle="modal" data-target="#exampleModal">Add Profile</a>--}}
                    <div class="row">

                        <div class="col-md-8">
                            <input type="text" name="search" id="search" placeholder="Search here..." class="form-control">
                        </div>
                        @if(Auth::guard('admin')->check())
                        <div class="col-md-4">
                            <a href="{{route('product.add')}}" class="btn btn-info" style="float: right;font-size: 15px;">Add Product</a>
                        </div>
                        @endif
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
                                <th>Inventory Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($products as $item)
                                <tbody>
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->sku}}</td>
                                    <td>{{$item->price}}</td>
                                    <td><?php  $image = json_decode($item->image);?> <img src="{{ asset('product-images/'. $image[0]) }}" height="40" width="50" class=""> </td>
                                    <td>{{$item->status == 1 ? 'Added' : 'Not Added'}}</td>
                                    <td>
                                        @if(Auth::guard('admin')->check())
                                            <a href="{{route('product.edit', ['id'=>$item->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"> Edit</i>
                                            </a>
                                            <a href="{{route('product.delete', ['id'=>$item->id])}}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> Delete</i>
                                            </a>
                                        @elseif(Auth::guard('merchant')->check())
{{--                                            @if($item->status == 1)--}}
{{--                                                <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>--}}
{{--                                            @else--}}
{{--                                                <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>--}}
{{--                                            @endif--}}
                                            <a href="{{route('inventory.add', ['id'=>$item->id])}}" class="btn btn-warning"><i class="fa fa-plus"> Add to Inventory</i></a>
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                        {!! $products->links() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>
    @include('dashboard.product.product_js');
@endsection

