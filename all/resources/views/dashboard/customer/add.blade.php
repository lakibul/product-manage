@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body">
                    <br/>
                    <h4>Add New Customer</h4>
                    <hr/>
                    <p class="text-center text-success">{{Session::get('message')}}</p>
                    <div class="card">
                        <div class="col-md-12">
                            <form action="{{route('customer.store')}}" method="post" style="width: 50%">
                                @csrf
                                <div class="form-group row">
                                    <label for="name" class="col-md-4">Name</label>
                                    <div class="col-md-8">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Enter Your Name">
                                        @error('name')
                                        <span class="text-danger">Name is Required</span>
                                        @enderror
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group row">
                                    <label for="mobile" class="col-md-4">Phone Number</label>
                                    <div class="col-md-8">
                                        <input type="number" class="form-control" name="mobile" id="mobile" placeholder="Phone Number">
                                        @error('mobile')
                                        <span class="text-danger">Mobile Number is Required</span>
                                        @enderror
                                    </div>
                                </div>
                                <br/>
                                <div class="form-group row justify-content-end">
                                    <div class="col-md-8">
                                        <div>
                                            <button type="submit" class="professional-button">Create</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


                </div>
            </div>

        </div>
    </div>

@endsection


