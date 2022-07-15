<table id="datatable" class="table table-bordered" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
    <thead>
    <tr>
        <th>#</th>
        <th>Created By</th>
        <th>Name</th>
        <th>Mobile</th>
        <th>Action</th>
        <th>Profile</th>
    </tr>
    </thead>
    <tbody>
    @foreach($customers as $customer)
        <tr>
            <td scope="row">{{$loop->iteration}}</td>

            @if($customer->admin_id == 1)
                <td>Admin</td>
            @else
                <td>Merchant</td>
            @endif

            <td>{{$customer->name}}</td>
            <td>{{$customer->mobile}}</td>
            <td>
                <a href="{{route('customer.edit', ['id' => $customer->id])}}" class="btn btn-success btn-sm">
                    <i class="fa fa-edit"> Edit</i>
                </a>
                <a href="{{route('customer.delete', ['id' => $customer->id])}}" class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"> Delete</i>
                </a>
            </td>
            <td>
                <a href="" class="btn btn-info btn-sm icon">
                    <i class="fas fa-plus"> Add</i>
                </a>
                <a href="" class="btn btn-info btn-sm icon">
                    <i class="fa fa-edit"> Manage</i>
                </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $customers->links() !!}
