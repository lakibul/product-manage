@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h4>Edit this Customer</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <form action="{{route('customer.update', ['id'=>@$customer->id])}}" method="post" style="width: 50%">
                    @csrf
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-3 col-form-label">Enter Your Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="name" value="{{@$customer->name}}" placeholder="Enter Your Name">
                            <span style="color: red">@error('name'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Enter Phone No</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="mobile" value="{{@$customer->mobile}}" placeholder="Phone Number">
                            <span style="color: red">@error('mobile'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-primary">Update this Customer</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

