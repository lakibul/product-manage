@extends('master.admin')
@section('content')
    <style>
        .search-btn{
            margin-left: 5px;
        }
    </style>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Customer</h2>
            <div class="text-right">
                <a href="{{route('customer.add')}}" class="btn btn-warning">Add Customer</a>
            </div>
        </div>
        <div class="card-header pb-3">
            <div class="col-md-4">
                <div class="card-body">
                    <form action="{{route('customer.profile')}}" method="post" class="d-flex justify-content-start align-items-center" style="margin-top: -80px;">
                        @csrf
                        <div>
                            <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                <option value="" disabled selected>Select by Profile</option>
                                <option value="1">With Profile</option>
                                <option value="2">Without Profile</option>
                            </select>
                        </div>
                        <div class="form-group ">
                            <button type="submit" class="btn-sm btn-warning search-btn">Show</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="search" id="search" placeholder="Search here..." class="form-control">
                <div class="card">
                    <p class="text-center text-success mt-3">{{Session::get('message')}}</p>
                    <div class="table-data">
                        <table id="datatable" class="table table-bordered"
                               style="border-collapse: collapse; border-spacing: 0; width: 100%;">
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
                                        <a href="{{route('customer.edit', ['id' => $customer->id])}}"
                                           class="btn btn-success btn-sm ">
                                            <i class="fa fa-edit"> Edit</i>
                                        </a>
                                        <a href="{{route('customer.delete', ['id' => $customer->id])}}"
                                           class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"> Remove</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('profile.add', ['id' => $customer->id])}}"
                                           class="btn btn-info btn-sm icon">
                                            <i class="fa fa-plus"> Add</i>
                                        </a>
                                        <a href="{{route('profile.manage', ['id' => $customer->id])}}" class="btn btn-info btn-sm icon">
                                            <i class="fa fa-fill"> Manage</i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {!! $customers->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.customer.customer_modal');
    @include('dashboard.customer.customer_js');

@endsection
