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
            <td><img src="{{asset($item->image)}}" height="40" width="50" alt=""/></td>
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
                    @if($item->status == 1)
                        <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-success">Active</a>
                    @else
                        <a href="{{route('status.update', ['id'=>$item->id])}}" class="btn btn-sm btn-danger">Inactive</a>
                    @endif
                @endif
            </td>
        </tr>
        </tbody>
    @endforeach
</table>
{!! $products->links() !!}
