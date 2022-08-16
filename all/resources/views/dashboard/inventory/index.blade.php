@extends('master.admin3')
@section('content')
    <style>
        form {
            width: 300px;
            margin: 0 auto;
            text-align: center;
            padding-top: 2px;
        }

        .value-button {
            display: inline-block;
            border: 1px solid #ddd;
            margin: 0px;
            width: 40px;
            height: 40px;
            text-align: center;
            vertical-align: middle;
            padding: 5px 0;
            background: #eee;
            -webkit-touch-callout: none;
            -webkit-user-select: none;
            -khtml-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .value-button:hover {
            cursor: pointer;
        }

        form #decrease {
            margin-right: -4px;
            border-radius: 8px 0 0 8px;
        }

        form #increase {
            margin-left: -4px;
            border-radius: 0 8px 8px 0;
        }

        form #input-wrap {
            margin: 0px;
            padding: 0px;
        }

        .value-input{
            width: 35px;
            height: 40px;
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }

        .value-submit{
            margin-left: 10px;
        }

        input#number {
            text-align: center;
            border: none;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            margin: 0px;
            width: 20px;
            height: 40px;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>

    <div class="card card-info">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title">Product Inventory</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <p class="text-center text-success mt-5 mb-5">{{Session::get('message')}}</p>
                            <div class="table-data">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>SKU Number</th>
                                        <th>Price</th>
                                        <th>Unit</th>
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
                                                            <div class="value-button" id="decrease" onclick="decreaseValue()" value="Decrease Value">-</div>
                                                            <input type="number" class="value-input" name="unit" id="unit" value="{{@$item->unit}}" />
                                                            <div class="value-button" id="increase" onclick="increaseValue()" value="Increase Value">+</div>
                                                        <button type="submit" class="btn-sm btn-warning">Submit</button>
                                                    </form>
                                                </td>
                                                <td>
                                                    @foreach(@$item->products->fileManager as $img)
                                                        <img src="{{ $img->file_url }}" height="40" width="50" alt=""/>
                                                @endforeach
                                                <td>
                                                    <a href="{{route('product.disable', ['id'=>$item->id])}}" class="btn btn-danger btn-sm">
                                                        <i class="fa fa-arrow-down"></i> Disable
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

