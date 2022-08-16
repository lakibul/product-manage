@extends('master.admin3')
@section('content')
    <div class="card card-primary">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="card-title mb-0">{{@$person->name}}'s Profile</h2>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12 text-right pb-3">
                    <a href="{{route('customer.manage')}}" class="btn btn-info"><i class="fa fa-arrow-left"></i> Go Back to Customer Index</a>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            {{--                    <a href="" class="btn btn-warning my-3" data-toggle="modal" data-target="#exampleModal">Add Profile</a>--}}
                            <p class="text-center text-success">{{Session::get('message')}}</p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Occupation</th>
                                    <th>Income</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td scope="row">{{@$loop->iteration}}</td>
                                    <td>{{@$person->name}}</td>
                                    <td>{{@$person->mobile}}</td>
                                    <td>{{@$person->customerProfile->age}}</td>
                                    <td>{{@$person->customerProfile->gender}}</td>
                                    <td>{{@$person->customerProfile->occupation}}</td>
                                    <td>{{@$person->customerProfile->income}}</td>
                                    <td>{{@$person->customerProfile->address}}</td>
                                    <td>
                                        @foreach(@$person->customerProfile->fileManager as $img)
                                            <img src="{{ @$img->file_url }}" height="40" width="50" alt="img"/>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('profile.edit', ['id'=>@$person->customerProfile->id])}}" class="btn btn-success btn-sm">
                                            <i class="fa fa-edit"></i>
                                        </a>
                                        <a href="{{route('profile.delete', ['id'=>@$person->customerProfile->id])}}" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
        </div>

    </div>

@endsection
