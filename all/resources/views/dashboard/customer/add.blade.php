@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="card">
                <div class="col-md-12">
                    <br/>
                    <h4>Add New Customer</h4>
                    <hr/>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <div class="card-body">
                        <form action="{{route('customer.store')}}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-3">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                                    @error('name')
                                    <span class="text-danger">Name is Required</span>
                                    @enderror
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label for="mobile" class="col-sm-3">Phone Number</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Phone Number">
                                    @error('mobile')
                                    <span class="text-danger">Mobile Number is Required</span>
                                    @enderror
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-primary">Create New Customer</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>

        </div>
    </div>

@endsection


