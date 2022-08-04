@extends('master.admin')
@section('content')

    <div class="container">
        <h2>Merchant Activity Lists</h2><br>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th width="250px">Description</th>
                <th>URL</th>
                <th>Method</th>
                <th width="250px">User Agent</th>
                <th>Merchant Id</th>
                <th width="150px">Action Time</th>
            </tr>
                @foreach(@$logs as $key => $log)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ @$log->description }} <br>
                            @if(@$log->loggable->name)
                                <b>Name: {{@$log->loggable->name}} </b>

                            @elseif(@$log->loggable->customer->name)
                                <b>Name: {{@$log->loggable->customer->name}} </b>

                            @elseif(@$log->loggable->products->name)
                                <b>Unit Amount: {{@$log->loggable->unit}}</b><br>
                                <b>Product Name: {{@$log->loggable->products->name}}</b>

                            @elseif(@$log->loggable->product->name)
                                <b>Product Name: {{@$log->loggable->product->name}}</b>
                            @endif
                        </td>
                        <td class="text-success">{{ @$log->url }}</td>
                        <td><label class="label label-info">{{ @$log->method }}</label></td>
                        <td class="text-danger">{{ @$log->agent }}</td>
                        <td>{{ @$log->merch_id }}</td>
                        <td>{{ @$log->created_at->diffForHumans() }} <br/> {{ @$log->created_at }}</td>
                    </tr>
                @endforeach
        </table>
    </div>

@endsection
