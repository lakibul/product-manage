@extends('master.admin')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
{{--                    <a href="" class="btn btn-warning my-3" data-toggle="modal" data-target="#exampleModal">Add Profile</a>--}}
                    <h4 class="card-title">Manage Customer Profile</h4>
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
                        @foreach($profiles as $person)
                            <tr>
                                <td scope="row">{{$loop->iteration}}</td>
                                <td>{{$person->customer->name}}</td>
                                <td>{{$person->customer->mobile}}</td>
                                <td>{{$person->age}}</td>
                                <td>{{$person->gender}}</td>
                                <td>{{$person->occupation}}</td>
                                <td>{{$person->income}}</td>
                                <td>{{$person->address}}</td>
                                    <td><img src="{{asset($person->image)}}" height="40" width="50" alt=""/></td>
                                <td>
                                    <a href="{{route('profile.edit', ['id'=>$person->id])}}" class="btn btn-success btn-sm">
                                        <i class="fa fa-edit"> Edit</i>
                                    </a>
                                    <a href="{{route('profile.delete', ['id'=>$person->id])}}" class="btn btn-danger btn-sm">
                                        <i class="fa fa-trash"> Delete</i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
@endsection
