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
                        <li class="breadcrumb-item">Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <h3 class="ml-3">All Users</h3>
    @if($users->isEmpty())
        <p class="text-danger text-center">No users found</p>
    @else

        <div class="card">
            <div class="card-header">
                <h3 class="card-title btn-sm btn-info">Based on Devices</h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {!! $users->links() !!}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Is Verified</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->is_payment_confirmed == 0)
                                <td><i class="text-danger fa fa-times-circle"></i></td>
                            @elseif($user->is_payment_confirmed == 1)
                                <td><i class="text-success fa fa-check-circle"></i></td>
                            @endif
                            @if($user->status == "pending")
                                <td><span class="badge badge-danger">{{ $user->status }}</span></td>
                            @elseif($user->status == "started")
                                <td><span class="badge badge-warning">{{ $user->status }}</span></td>
                            @elseif($user->status == "midway")
                                <td><span class="badge badge-info">{{ $user->status }}</span></td>
                            @else
                                <td><span class="badge badge-success">{{ $user->status }}</span></td>
                            @endif
                            @if($user->is_verified == 0)
                                <td><i class="text-danger fa fa-times-circle"></i></td>
                            @elseif($user->is_verified == 1)
                                <td><i class="text-success fa fa-check-circle"></i></td>
                            @endif

{{--                            @if($user->is_verified == 0)--}}
{{--                                <td>--}}
{{--                                    <form method="post" action="">--}}
{{--                                        @csrf--}}
{{--                                        @method('put')--}}
{{--                                        <input type="submit" value="Verify" class="btn btn-success btn-sm">--}}
{{--                                    </form>--}}
{{--                                </td>--}}
{{--                            @endif--}}
                            <td>
                                <a href="{{ route('dashboard.users.view', $user->id) }}"><button class="btn btn-sm btn-info">View</button></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

    @endif

    {!! $users->links() !!}
@endsection
