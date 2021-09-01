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
                            <li class="breadcrumb-item">Call Logs</li>
                            <li class="breadcrumb-item active">{{ $phone_number }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <h3 class="ml-3">Call Details</h3>
        @if($logs->isEmpty())
            <p class="text-danger text-center">No call logs found</p>
        @else

            <div class="card card-outline card-info">
                <div class="card-header">
                    <h3 class="card-title">
                        Messages
                        <a class="m-3" href="{{ route('call_logs.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}">
                            <button class="btn btn-sm btn-danger">Back</button>
                        </a><br>
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Call Id</th>
                            <th>Phone Number</th>
                            <th>Call Name</th>
                            <th>Call Date</th>
                            <th>Duration</th>
                            <th>Call Type</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($logs as $log)
                            <tr>
                                <td>{{ $log->call_id }}</td>
                                <td>{{ $log->phone_number }}</td>
                                <td>{{ $log->call_name }}</td>
                                <td>{{ $log->call_date }}</td>
                                <td>{{ $log->duration }} ms</td>
                                @if($log->call_type == "missed")
                                    <td> <span class="badge badge-danger">{{ $log->call_type }}</span></td>
                                @elseif($log->call_type == "outgoing")
                                    <td> <span class="badge badge-success">{{ $log->call_type }}</span></td>
                                @elseif($log->call_type == "incoming")
                                    <td> <span class="badge badge-warning">{{ $log->call_type }}</span></td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>

        @endif

    </div>
@endsection
