@extends('master.admin')
@section('content')
    <div class="container mt-5">
        <div class="row">
            <h4>Search customer by profile</h4>
           <div class="col-md-8">
               <form id="form" class="search-customer">
                   <input type="radio" id="child" name="age" value="child" class="customer-radio">
                   <label for="child">Has Profile</label><br>
                   <input type="radio" id="adult" name="age" value="adult" class="customer-radio">
                   <label for="adult">Hasn't Profile</label><br>
                   <div>
                       <button type="submit">Submit</button>
                   </div>
               </form>
           </div>
        </div>

        <div class="row">
            <div class="col-10">
                <div class="col-md-3" style="margin-left: -13px;">
{{--                    <a href="javascript:void(0)" class="btn btn-warning my-3" onclick="openModal()">Add Customer</a>--}}
                    <a href="{{route('customer.add')}}" class="btn btn-warning my-3">Add Customer</a>
                </div>

                <input type="text" name="search" id="search" placeholder="Search here..." class="form-control">
                <div class="card">
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <div class="table-data">
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
                                        <a href="{{route('customer.edit', ['id' => $customer->id])}}" class="btn btn-success btn-sm icon">
                                            <i class="fa fa-edit"> Edit</i>
                                        </a>
                                        <a href="{{route('customer.delete', ['id' => $customer->id])}}" class="btn btn-danger btn-sm icon">
                                            <i class="fa fa-trash"> Delete</i>
                                        </a>
                                    </td>
                                    <td>
                                        <a href="{{route('profile.add', ['id' => $customer->id])}}" class="btn btn-info btn-sm icon">
                                            <i class="fa fa-plus"> Add</i>
                                        </a>
                                        <a href="{{route('profile.manage')}}" class="btn btn-info btn-sm icon">
                                            <i class="fa fa-edit"> Manage</i>
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


    <!-- Optional JavaScript -->
    @include('dashboard.customer.customer_modal');
    @include('dashboard.customer.customer_js');
{{--    {!! Toastr::message() !!}--}}
    <script>
        var form = document.getElementById('form');
        form.addEventListener('submit', showMessage);

        function showMessage(event) {
            alert("Your response has been recorded. (Not actually, this is just a demo!)");
            event.preventDefault();
        }
    </script>
@endsection
