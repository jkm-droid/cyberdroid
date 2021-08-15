@extends('base.index')

@section('content')
    <div class="ml-3 m-3">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('portal') }}">Home</a></li>
                            <li class="breadcrumb-item active">Call Logs</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <h3 class="ml-3">Call Logs</h3>
        @if($call_logs->isEmpty())
            <p class="text-danger text-center">No call logs found</p>
        @else

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title btn-sm btn-info">{{$device}}</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            {!! $call_logs->links() !!}
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Phone Number</th>
                            <th>Call Name</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($call_logs as $call_log)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td><a href="{{ route('call_logs.logs', [$call_log->phone_number, $call_log->spy_key]) }}">{{ $call_log->phone_number }}</a></td>
                                <td>{{ $call_log->call_name }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>

        @endif

        {!! $call_logs->links() !!}
    </div>
@endsection
