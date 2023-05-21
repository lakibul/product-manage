@extends('master.admin3')
@section('content')

    <div class="card card-warning">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title">Disabled Product</h2>
        </div>
        <div class="card-body">
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
                                    @foreach(@$disabledProducts as $item)
                                        <tbody>
                                        <tr>
                                            @if(@$item->status == 0)
                                                <td scope="row">{{@$loop->iteration}}</td>
                                                <td>{{@$item->product->name}}</td>
                                                <td>{{@$item->product->sku}}</td>
                                                <td>{{@$item->product->price}}</td>
                                                <td>
                                                    @foreach(@$item->product->fileManager as $img)
                                                        <img src="{{ $img->file_url }}" height="40" width="50" alt=""/>
                                                    @endforeach
                                                </td>
                                                <td>{{@$item->inventory->unit}}</td>
                                                <td>
                                                    <a href="{{route('disable.move', ['id'=>@$item->id])}}" class="btn btn-info"><i class="fa fa-exchange-alt"></i> Move to Inventory</a>
                                                </td>
                                            @endif
                                        </tr>
                                        </tbody>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection


