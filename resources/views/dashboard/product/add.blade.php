@extends('master.admin3')
@section('content')
    <div class="card card-info">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title">Add a product</h2>
        </div>
        <p class="text-center text-success">{{Session::get('message')}}</p>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form action="{{route('product.store')}}" method="post" enctype="multipart/form-data" style="padding: 35px">
                            @csrf
                            <div class="form-group row col-md-12">
                                <label for="name" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="name" placeholder="Enter Name">
                                    <span style="color: red">@error('name'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <br/>

                            <div class="form-group row">
                                <label for="sku" class="col-md-3 col-form-label">SKU Number</label>
                                <div class="col-md-9">
                                    <input type="number" class="form-control" name="sku" placeholder="Enter SKU">
                                    <span style="color: red">@error('sku'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                                <div class="col-md-9">
                                    <input type="text" class="form-control" name="short_description"
                                           placeholder="Enter Short Description">
                                    <span style="color: red">@error('short_description'){{$message}}@enderror</span>
                                </div>

                            </div>
                            <br/>
                            <div class="form-group row">
                                <label for="short_description" class="col-sm-3 col-form-label">Long Description</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="long_description"
                                           placeholder="Enter Long Description">
                                    <span style="color: red">@error('long_description'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label for="price" class="col-sm-3 col-form-label">Price</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="price" placeholder="Enter Price">
                                    <span style="color: red">@error('price'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row">
                                <label for="image" class="col-sm-3 col-form-label">Image</label>
                                <div class="col-sm-9">
                                    <input type="file" class="form-control-file" name="images[]" id="images" multiple>
                                    <span style="color: red">@error('images'){{$message}}@enderror</span>
                                </div>
                            </div>
                            <br/>
                            <div class="form-group row justify-content-end">
                                <div class="col-sm-9">
                                    <div>
                                        <button type="submit" class="btn btn-success">Save Product Info</button>
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


