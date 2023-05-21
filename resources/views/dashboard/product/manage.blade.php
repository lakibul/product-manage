@extends('master.admin3')
@section('content')
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title">Product Index</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="search" id="search" placeholder="Search Product here..."
                           class="form-control">
                </div>
                @if(Auth::guard('admin')->check())
                    <div class="col-md-6">
                        <a href="{{route('product.add')}}" class="btn btn-info" style="float: right;font-size: 15px;">Add New Product</a>
                    </div>
                @endif
            </div>
            <p class="text-center text-success mt-5 mb-5">{{Session::get('message')}}</p>
            <div class="table-data">
                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                       style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                    <img src="{{ @$img->file_url }}" height="40" width="50" alt=""/>
                                @endforeach
                            </td>
                            <td>{{@$item->status == 1 ? 'Not Added' : 'Added'}}</td>
                            <td>
                                @if(Auth::guard('admin')->check())
                                    <a href="{{route('product.edit', ['id'=>@$item->id])}}"
                                       class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="{{route('product.delete', ['id'=>@$item->id])}}"
                                       class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                @elseif(Auth::guard('merchant')->check())
                                    @if(@$item->status == 1)
                                        <a href="{{route('inventory.add', ['id'=>@$item->id])}}"
                                           class="btn btn-warning"><i class="fa fa-plus"></i>  Add to Inventory</a>
                                    @else
                                        <div class="btn btn-success"><i class="fa fa-arrow-up"></i> Added</div>
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
    @include('dashboard.product.product_js')
@endsection

