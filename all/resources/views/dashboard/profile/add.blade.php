@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h4>Add Customer Profile</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <form action="{{route('profile.store')}}" method="post" enctype="multipart/form-data" style="width: 50%;">
                    @csrf

                    <div class="form-group row">
                        <label for="customer_id" class="col-md-3 col-form-label" style="margin-left: 0px;">Name</label>
                        <div class="col-md-9" >
                            <select name="customer_id" id="customer_id" style="background-color: blanchedalmond;">
                                <option value="{{$customer->id}}">{{$customer->name}}</option>
                            </select>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="gender" class="col-md-3 col-form-label">Gender</label>
                        <div class="col-md-9">
                            <select name="gender" id="gender">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                            <span style="color: red">@error('gender'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-3 col-form-label">Age</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="age" placeholder="Enter Age">
                            <span style="color: red">@error('age'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-md-3 col-form-label">Occupation</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="occupation" placeholder="Enter Occupation">
                            <span style="color: red">@error('occupation'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Monthly Income</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" name="income" placeholder="Income">
                            <span style="color: red">@error('income'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputPassword3" class="col-sm-3 col-form-label">Home Address</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="address" placeholder="Address">
                            <span style="color: red">@error('address'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" name="image" id="inputEmail3" placeholder="Enter Image" accept="image/*">
                            <span style="color: red">@error('image'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-success">Save Customer Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


