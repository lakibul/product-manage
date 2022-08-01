@extends('master.admin')
@section('content')

    <div class="col-md-12">
        <h2>Product Inventory</h2>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
{{--                        <div class="col-md-8">--}}
{{--                            <input type="text" name="search" id="search" placeholder="Search here..." class="form-control">--}}
{{--                        </div>--}}
                    </div>
                    <p class="text-center text-success mt-5 mb-5">{{Session::get('message')}}</p>
                    <div class="table-data">
                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>SKU Number</th>
                                <th>Price</th>
                                <th style="text-align: center;">Unit</th>
                                <th>Image</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            @foreach(@$inventories as $item)
                                @if(@$item->status == 1)
                                <tbody>
                                <tr>
                                    <td scope="row">{{$loop->iteration}}</td>
                                    <td>{{@$item->products->name}}</td>
                                    <td>{{@$item->products->sku}}</td>
                                    <td>{{@$item->products->price}}</td>
                                    <td>
                                        <form method="post" action="{{route('unit.add', ['id'=>@$item->id])}}">
                                            @csrf
                                            <div class="input-counter">
                                                <div class="" id="decrease" onclick="decreaseValue()" value="Decrease Value"><span class="minus-btn"><i class="bx bx-minus"></i></span></div>
                                                <input type="text" name="unit" id="unit" value="{{@$item->unit}}">
                                                <div class="" id="increase" onclick="increaseValue()" value="Increase Value"><span class="plus-btn"><i class="bx bx-plus"></i></span></div>
                                            </div>
                                            <input type="submit" value="Submit" id="submit" class="btn btn-warning" style="margin-right: -150px;margin-top: -70px;">
                                        </form>
                                    </td>
                                    <td>
                                        @foreach(@$item->products->fileManager as $img)
                                            <img src="{{ $img->url[0] }}" height="40" width="50" alt=""/>
                                    @endforeach
                                    <td>
                                        <a href="{{route('product.disable', ['id'=>$item->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-arrow-down"> Disable</i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                                @endif
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
    function increaseValue() {
        var currentVal = document.getElementById('unit').value;
        console.log("current cart value",currentVal);
        currentVal = isNaN(currentVal) ? 0 : currentVal;
        currentVal++;
        document.getElementById('unit').value = currentVal;
    }

    function decreaseValue() {
        var currentVal = document.getElementById('unit').value;
        console.log("current cart value",currentVal);
        currentVal = isNaN(currentVal) ? 0 : currentVal;
        currentVal < 1 ? currentVal = 1 : '';
        currentVal--;
        document.getElementById('unit').value = currentVal;
    }
</script>

@endsection

