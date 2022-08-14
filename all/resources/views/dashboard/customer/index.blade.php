@extends('master.admin3')
@section('content')
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">Customers Details</h2>
        </div>
        <div class="card-body pb-3">
            <div class="row">
                <div class="col-md-3">
                    <div class="card-body">
                        <form action="{{route('customer.profile')}}" method="post">
                            @csrf
                            <div>
                                <select class="form-select min-w-150px me-3" data-allow-clear="true" name="value">
                                    <option value="" disabled selected>Select by Profile</option>
                                    <option value="1">With Profile</option>
                                    <option value="2">Without Profile</option>
                                </select>
                            </div>
                            <div class="form-group ">
                                <button type="submit" class="btn-sm btn-info mt-2">Show</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-9 text-right">
                    <a href="{{route('customer.add')}}" class="btn btn-info">Add New Customer</a>
                </div>
            </div>
        </div>
        <div class="card-body">
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
                                                <i class="fa fa-edit"> Edit</i>
                                            </a>
                                            <a href="{{route('customer.delete', ['id' => @$customer->id])}}"
                                               class="btn btn-danger btn-sm">
                                                <i class="fa fa-trash"> Remove</i>
                                            </a>
                                        </td>
                                        <td>
                                            @if(!isset($customer->customerProfile->id))
                                                <a href="{{route('profile.add', ['id' => @$customer->id])}}"
                                                   class="btn btn-info btn-sm icon">
                                                    <i class="fa fa-plus"> Add</i>
                                                </a>
                                            @else
                                                <a href="" class="btn btn-success btn-sm icon">
                                                    <i class="fa fa-check-circle"> Added</i>
                                                </a>
                                            @endif
                                            @if(!isset($customer->customerProfile->id))
                                                <a href="" class="btn btn-danger btn-sm icon">
                                                    <i class="fa fa-ban"> No Profile</i>
                                                </a>
                                            @else
                                                <a href="{{route('profile.manage', ['id' => @$customer->id])}}" class="btn btn-primary btn-sm icon">
                                                    <i class="fa fa-fill"> Manage</i>
                                                </a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {!! @$customers->links() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @include('dashboard.customer.customer_modal')
    @include('dashboard.customer.customer_js')

@endsection
