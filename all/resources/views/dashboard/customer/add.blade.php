@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <br/>
                <h4>Add New Customer</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <form action="{{route('customer.store')}}" method="post">
                    @csrf

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" placeholder="Enter Your Name">
                            @error('name')
                            <span class="text-danger">Name is Required</span>
                            @enderror
                        </div>

                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Phone Number</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="mobile" placeholder="Phone Number">
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

@endsection


