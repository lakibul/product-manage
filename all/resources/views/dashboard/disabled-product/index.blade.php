@extends('master.admin')
@section('content')

    <div class="col-md-12">
        <h2>Disabled Product</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
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
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach($disabledProducts as $item)
                                <tbody>
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->product->sku}}</td>
                                    <td>{{$item->product->price}}</td>
                                    <td><?php  $image = json_decode($item->product->image);?>
                                        <img src="{{ asset('product-images/'. $image[0]) }}" height="40" width="50" class="">
                                    </td>
                                    <td>{{$item->inventory->unit}}</td>
                                    <td>
                                        <a href="{{route('disable.move', ['id'=>$item->id])}}" class="btn btn-outline-info"><i class="fa fa-truck-moving"> Move to Inventory</i></a>
                                    </td>
                                </tr>
                                </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection


