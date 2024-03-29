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
    @foreach(@$customers as $customer)
        <tr>
            <td scope="row">{{@$loop->iteration}}</td>

            @if(@$customer->admin_id == 1)
                <td>Admin</td>
            @else
                <td>Merchant</td>
            @endif

            <td>{{@$customer->name}}</td>
            <td>{{@$customer->mobile}}</td>
            <td>
                <a href="{{route('customer.edit', ['id' => @$customer->id])}}"
                   class="btn btn-secondary btn-sm ">
                    <i class="fa fa-edit"></i> Edit
                </a>
                <a href="{{route('customer.delete', ['id' => @$customer->id])}}"
                   class="btn btn-danger btn-sm">
                    <i class="fa fa-trash"></i> Remove
                </a>
            </td>
            <td>
                @if(!isset($customer->customerProfile->id))
                    <a href="{{route('profile.add', ['id' => @$customer->id])}}"
                       class="btn btn-info btn-sm icon">
                        <i class="fa fa-plus-circle"></i> Add
                    </a>
                @else
                    <a href="" class="btn btn-success btn-sm icon">
                        <i class="fa fa-check-circle"></i> Added
                    </a>
                @endif
                    @if(!isset($customer->customerProfile->id))
                        <a href="" class="btn btn-danger btn-sm icon">
                            <i class="fa fa-ban"></i> No Profile
                        </a>
                    @else
                        <a href="{{route('profile.manage', ['id' => @$customer->id])}}" class="btn btn-primary btn-sm icon">
                            <i class="fa fa-tasks"></i> Manage
                        </a>
                    @endif
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{!! $customers->links() !!}
