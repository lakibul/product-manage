@extends('master.admin')
@section('content')

    <div class="container">
        <h2>Merchant Activity Lists</h2><br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Description</th>
                <th>URL</th>
                <th>Method</th>
                <th>Ip</th>
                <th width="300px">User Agent</th>
                <th>User Id</th>
                <th>Action Time</th>
            </tr>
            @if($logs->count())
                @foreach($logs as $key => $log)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $log->description }} <br> <b>Customer Name:</b> {{$log->loggable->name}}</td>
                        <td class="text-success">{{ $log->url }}</td>
                        <td><label class="label label-info">{{ $log->method }}</label></td>
                        <td class="text-warning">{{ $log->ip }}</td>
                        <td class="text-danger">{{ $log->agent }}</td>
                        <td>{{ $log->merch_id }}</td>
                        <td>{{ $log->created_at->diffForHumans() }} <br/> {{ $log->created_at }}</td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div>

@endsection
