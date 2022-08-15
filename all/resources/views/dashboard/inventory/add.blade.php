@extends('master.admin3')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h4>Add product to Inventory</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <form action="{{route('inventory.store', ['id'=>$product->id])}}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control inventory-form" name="name" value="{{$product->name}}" disabled>
                            <span style="color: red">@error('name'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>

                    <div class="form-group row">
                        <label for="sku" class="col-md-3 col-form-label">SKU Number</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control inventory-form" name="sku" value="{{$product->sku}}" disabled>
                            <span style="color: red">@error('sku'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="sku" class="col-md-3 col-form-label">Unit</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control inventory-form" name="unit" >
                            <span style="color: red">@error('sku'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control inventory-form" name="short_description" value="{{$product->long_description}}" disabled>
                            <span style="color: red">@error('short_description'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="short_description" class="col-sm-3 col-form-label">Long Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inventory-form" name="long_description" value="{{$product->long_description}}" disabled>
                            <span style="color: red">@error('long_description'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control inventory-form" name="price" value="{{$product->price}}" disabled>
                            <span style="color: red">@error('price'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control-file" name="image[]" id="image" disabled>
                            <span style="color: red">@error('image'){{$message}}@enderror</span>
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

@endsection


