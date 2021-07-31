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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.messages.index') }}">Messages</a></li>
                        <li class="breadcrumb-item active">{{ $device }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <h3 class="ml-3">Messages <small><a class="btn btn-info btn-sm" href="{{ route('dashboard.messages.index') }}">Back</a></small></h3>
    @if($messages->isEmpty())
        <p class="text-danger text-center">No messages found</p>
    @else

        <div class="card">
            <div class="card-header">
                <h3 class="card-title btn-sm btn-info">{{ $device }}</h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {!! $messages->links() !!}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Mesage Id</th>
                        <th>Phone Number</th>
                        <th>Message Body</th>
                        <th>Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($messages as $msg)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $msg->message_id }}</td>
                            <td>{{ $msg->phone_number }}</td>
                            <td>{{ $msg->message_body }}</td>
                            <td>{{ $msg->created_at }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

    @endif

    {!! $messages->links() !!}
@endsection
