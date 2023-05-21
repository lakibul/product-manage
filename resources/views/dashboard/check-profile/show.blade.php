@extends('master.admin3')
@section('content')
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-8">
                    <h2 class="section-title mb-0">Details</h2>
                </div>
                <div class="col-md-4">
                    <div class="text-right">
                        <a href="{{route('customer.manage')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back to Customer Index</a>
                    </div>

                </div>
            </div>
        </div>
        @if(@$hasNotProfile)
        <div class="card-header">
            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                <thead>
                <tr>
                    <th>Name</th>
                    <th>Mobile</th>
                </tr>
                </thead>
                <tbody>
                @foreach(@$hasNotProfile as $person)
                <tr>
                    <td class="section-title ml-5">{{$person->name}}</td>
                    <td class="section-title ml-5">{{$person->mobile}}</td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
        @else
            <div class="card-header">
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                    <tr>
                        <th>Name</th>
                        <th>Mobile</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach(@$hasProfile as $person)
                        <tr>
                            <td class="section-title ml-5">{{$person->customer->name}}</td>
                            <td class="section-title ml-5">{{$person->customer->mobile}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{--{{@$hasNotProfile->customerProfile->name}}--}}
@endsection
