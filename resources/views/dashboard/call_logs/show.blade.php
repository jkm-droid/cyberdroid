@extends('base.admin_index')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.call_logs.index') }}">Call Logs</a></li>
                        <li class="breadcrumb-item active">{{ $device }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <h3 class="ml-3">Call Logs <small><a class="btn btn-info btn-sm" href="{{ route('dashboard.call_logs.index') }}">Back</a></small></h3>
    @if($call_logs->isEmpty())
        <p class="text-danger text-center">No call logs found</p>
    @else

        <div class="card">
            <div class="card-header">
                <h3 class="card-title btn-sm btn-info">{{ $device }}</h3>

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
                        <th>call_log Name</th>
                        <th>Created On</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($call_logs as $phone_number)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $phone_number->phone_number }}</td>
                            <td>{{ $phone_number->call_name }}</td>
                            <td>{{ $phone_number->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

    @endif

    {!! $call_logs->links() !!}
@endsection
