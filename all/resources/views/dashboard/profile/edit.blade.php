@extends('master.admin2')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h4>Edit Customer Profile</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <div class="card">
                    <form action="{{route('profile.update', ['id'=>$profile->id])}}" method="post" enctype="multipart/form-data" style="padding: 35px">
                        @csrf
                        <div class="form-group row">
                            <label for="customer_id" class="col-md-3 col-form-label" style="margin-left: 0px;">Customer Name</label>
                            <div class="col-md-9">
                                <select class="form-select min-w-150px me-3" name="customer_id" id="customer_id" style="background-color: blanchedalmond; border-radius: 5px">
                                    <option value="{{$profile->customer->id}}">{{$profile->customer->name}}</option>
                                </select>
                            </div>
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="gender" class="col-md-3 col-form-label" style="margin-left: 0px;">Gender</label>
                            <div class="col-md-9">
                                <select class="form-select min-w-150px me-3" name="gender" id="gender" style="border-radius: 5px">
                                    <option>{{@$profile->gender}}</option>
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
                                <input type="number" class="form-control" name="age" value="{{@$profile->age}}" placeholder="Enter Age"/>
                                <span style="color: red">@error('age'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-3 col-form-label">Occupation</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="occupation" value="{{@$profile->occupation}}" placeholder="Enter Occupation">
                                <span style="color: red">@error('occupation'){{$message}}@enderror</span>
                            </div>

                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="income" class="col-md-3 col-form-label">Monthly Income</label>
                            <div class="col-md-9">
                                <input type="number" class="form-control" value="{{@$profile->income}}" name="income" id="income" placeholder="Income">
                                <span style="color: red">@error('income'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-md-3 col-form-label">Home Address</label>
                            <div class="col-md-9">
                                <input type="text" class="form-control" name="address" value="{{@$profile->address}}" placeholder="Address">
                                <span style="color: red">@error('address'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <br/>

                        <div class="form-group row">
                            <label for="inputEmail3" class="col-md-3 col-form-label">Image</label>
                            <div class="col-md-9">
                                @foreach(@$profile->fileManager as $img)
                                    <img src="{{ @$img->url }}" class="img-thumbnail" style="width: 100px; padding: 5px" alt="img">
                                @endforeach
                                <input type="file" class="form-control-file" value="" name="edit_images[]" id="inputEmail3" accept="image/*">
                                <span style="color: red">@error('image'){{$message}}@enderror</span>
                            </div>
                        </div>
                        <br/>
                        <div class="form-group row justify-content-end">
                            <div class="col-md-9">
                                <div>
                                    <button type="submit" class="btn btn-success">Update Customer Info</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection


