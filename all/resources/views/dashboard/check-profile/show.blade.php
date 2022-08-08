@extends('master.admin2')
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="section-title mb-0">Details</h2>
            <div class="text-right">
                <a href="{{route('customer.manage')}}" class="btn btn-info">Go Back to Customer Index</a>
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
