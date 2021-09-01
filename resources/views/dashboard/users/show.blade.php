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
                        <li class="breadcrumb-item">Users/{{ $user->username }}</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if ($message = Session::get('success'))
        <p class="alert alert-success">{{ $message }}</p>
    @endif
    @if ($message = Session::get('error'))
        <p class="alert alert-danger">{{ $message }}</p>
    @endif
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" height="20" width="20"
                                     src="/profile_pictures/{{ $user->profile_url }}"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $user->name }}</h3>
                            @if($user->is_verified == 1)
                                <p class="text-center"><span class="badge badge-success">verified</span></p>
                            @else
                                <p class="text-center"><span class="badge badge-danger">unverified</span></p>
                            @endif

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Messages</b> <a class="float-right">{{ $messages }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Contacts</b> <a class="float-right">{{ $contacts }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Call Logs</b> <a class="float-right">{{ $call_logs }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Images</b> <a class="float-right">{{ $images }}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">About User</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-clock mr-1"></i> Last Login</strong>
                            <p class="text-muted">{{$user->last_login_at}}</p>

                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> IP Address</strong>
                            <p class="text-muted">{{ $user->ip_address }}</p>

                            <hr>

                            <strong><i class="fas fa-pencil-alt mr-1"></i> Target Device</strong>

                            <p class="text-muted">
                                <span class="tag tag-danger">{{ $user->target_device_name }}</span>
                            </p>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab"> Actions</a></li>
                                <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Basic Information</a></li>
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <div class="card-body">
                                        <p class="login-box-msg">Add Merchant Id/Payment Code</p>

                                        <form action="{{ route('admin.add.payment', $user->id) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="row">
                                                <div class="col-sm-4 mb-3">
                                                    <input type="text" class="form-control" name="merchant_id" placeholder="Enter Merchant Id">
                                                    @if ($errors->has('merchant_id'))
                                                        <div class="text-danger form-text">{{ $errors->first('merchant_id') }}</div>
                                                    @endif
                                                </div>

                                                <div class="col-sm-4 mb-3">
                                                    <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number">
                                                    @if ($errors->has('phone_number'))
                                                        <div class="text-danger form-text">{{ $errors->first('phone_number') }}</div>
                                                    @endif
                                                </div>

                                                <div class="col-sm-4 mb-3">
                                                    <input type="date" class="form-control" name="transaction_date" placeholder="Enter transaction date">
                                                    @if ($errors->has('transaction_date'))
                                                        <div class="text-danger form-text">{{ $errors->first('transaction_date') }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-4 offset-md-4">
                                                <button type="submit" class="btn btn-primary btn-block">Add Payment Details</button>
                                            </div>
                                            <!-- /.col -->
                                        </form>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="timeline">
                                    <h3>Username: <span class="badge badge-info">{{ $user->username }}</span></h3>
                                    <h3>Name: <span class="badge badge-info">{{ $user->name }}</span></h3>
                                    <h3>Email: <span class="badge badge-info">{{ $user->email }}</span></h3>
                                    <h3>Merchant Id: <span class="badge badge-info">{{ $user->merchant_id }}</span></h3>
                                    @if($user->status == "completed")
                                        <h3>Status: <span class="badge badge-success">Completed</span></h3>
                                    @else
                                        <h3>Status: <span class="badge badge-warning">In progress</span></h3>
                                    @endif
                                    @if($user->is_client == 1)
                                        <h3>Client: <span class="text-success"><i class="fa fa-check-circle"></i></span></h3>
                                    @else
                                        <h3>Client: <span><i class="fa fa-times-circle"></i></span></h3>
                                    @endif

                                    @if($user->is_payment_confirmed == 1)
                                        <h3>Payment Confirmation: <span class="text-success"><i class="fa fa-check-circle"></i></span></h3>
                                    @else
                                        <h3>Payment Confirmation: <span class="text-danger"><i class="fa fa-times-circle"></i></span></h3>
                                    @endif

                                    @if($user->downloaded == 1)
                                        <h3>Downloaded App: <span class="text-success"><i class="fa fa-download"></i></span></h3>
                                    @else
                                        <h3>Downloaded App: <span class="text-danger"><i class="fa fa-times-circle"></i></span></h3>
                                    @endif
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="settings">

                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>

@endsection
