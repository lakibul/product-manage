@extends('master.admin')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Product Index</h2>
            @if(Auth::guard('admin')->check())
                <div class="col-md-4">
                    <a href="{{route('product.add')}}" class="btn btn-info" style="float: right;font-size: 15px;">Add Product</a>
                </div>
            @endif
        </div>
    <div class="card-header pb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <input type="text" name="search" id="search" placeholder="Search Product here..." class="form-control">
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
                                <th>Inventory Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach(@$products as $item)
                                <tbody>
                                <tr>
                                    <td scope="row">{{@$loop->iteration}}</td>
                                    <td>{{@$item->name}}</td>
                                    <td>{{@$item->sku}}</td>
                                    <td>{{@$item->price}}</td>
                                    <td>
                                        @foreach(@$item->fileManager as $img)
                                            <img src="{{ $img->url[0] }}" height="40" width="50" alt=""/>
                                        @endforeach
                                    </td>
                                    <td>{{@$item->status == 1 ? 'Not Added' : 'Added'}}</td>
                                    <td>
                                        @if(Auth::guard('admin')->check())
                                            <a href="{{route('product.edit', ['id'=>@$item->id])}}" class="btn btn-success btn-sm">
                                                <i class="fa fa-edit"> Edit</i>
                                            </a>
                                            <a href="{{route('product.delete', ['id'=>@$item->id])}}" class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> Delete</i>
                                            </a>
                                        @elseif(Auth::guard('merchant')->check())
                                            {{--                                            @if($item->status == 1)--}}
                                            {{--                                                <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>--}}
                                            {{--                                            @else--}}
                                            {{--                                               <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>--}}
                                            {{--                                            @endif--}}
                                            @if(@$item->status == 1)
                                                <a href="{{route('inventory.add', ['id'=>@$item->id])}}" class="btn btn-warning"><i class="fa fa-plus"> Add to Inventory</i></a>
                                            @else
                                                <div class="btn btn-success"><i class="fa fa-arrow-up"> Added</i></div>
                                            @endif
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
    </div>
    @include('dashboard.product.product_js');
@endsection

