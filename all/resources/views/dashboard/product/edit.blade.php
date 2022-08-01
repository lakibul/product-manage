@extends('master.admin')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <br/>
                <h4>Edit product</h4>
                <hr/>
                <br/>
                <p class="text-center text-success">{{Session::get('message')}}</p>
                <form action="{{route('product.update', ['id'=>@$product->id])}}" method="post" enctype="multipart/form-data" style="width: 80%">
                    @csrf

                    <div class="form-group row">
                        <label for="name" class="col-md-3 col-form-label">Name</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" value="{{@$product->name}}" name="name" placeholder="Enter Name">
                            <span style="color: red">@error('name'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>

                    <div class="form-group row">
                        <label for="sku" class="col-md-3 col-form-label">SKU Number</label>
                        <div class="col-md-9">
                            <input type="number" class="form-control" name="sku" value="{{@$product->sku}}" placeholder="Enter SKU">
                            <span style="color: red">@error('sku'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                        <div class="col-md-9">
                            <input type="text" class="form-control" name="short_description" value="{{@$product->short_description}}" placeholder="Enter Short Description">
                            <span style="color: red">@error('short_description'){{$message}}@enderror</span>
                        </div>

                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="short_description" class="col-sm-3 col-form-label">Long Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="long_description" value="{{@$product->long_description}}" placeholder="Enter Long Description">
                            <span style="color: red">@error('long_description'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="price" class="col-sm-3 col-form-label">Price</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" name="price" value="{{@$product->price}}" placeholder="Enter Price">
                            <span style="color: red">@error('price'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row">
                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            @foreach(@$product->fileManager as $img)
                                <img src="{{ $img->url }}" height="40" width="50" alt=""/>
                            @endforeach
                            <input type="file" class="form-control-file" name="edit_images[]" id="inputEmail3" placeholder="Enter Image" multiple>
                            <span style="color: red">@error('image'){{$message}}@enderror</span>
                        </div>
                    </div>
                    <br/>
                    <div class="form-group row justify-content-end">
                        <div class="col-sm-9">
                            <div>
                                <button type="submit" class="btn btn-success">Update Product Info</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection


