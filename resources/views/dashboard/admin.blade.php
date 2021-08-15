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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Cyber<b>droid</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_messages }}</h3>

                            <p>Messages</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_contacts }}</h3>

                            <p>Contacts</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_users }}</h3>

                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('dashboard.users.index') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_call_logs }}</h3>

                            <p>Call Logs</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- DIRECT CHAT -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Latest Users</h3>
                        </div>
                        <!-- /.card-header -->
                        @if($latest_users->isEmpty())
                            <p class="text-center text-danger">No latest users found</p>
                        @else
                            <div class="card-body p-0">
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Email</th>
                                        <th>Progress</th>
                                        <th style="width: 40px">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($latest_users as $latest)
                                        <tr>
                                            <td>1.</td>
                                            <td>{{ $latest->email }}</td>
                                            @if($latest->status == "pending")
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar bg-danger" style="width: 25%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-danger">25%</span></td>
                                            @endif
                                            @if($latest->status == "started")
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar bg-warning" style="width: 50%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-warning">50%</span></td>
                                            @endif
                                            @if($latest->status == "midway")
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar bg-primary" style="width: 75%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-primary">75%</span></td>
                                            @endif
                                            @if($latest->status == "completed")
                                                <td>
                                                    <div class="progress progress-xs">
                                                        <div class="progress-bar bg-success" style="width: 100%"></div>
                                                    </div>
                                                </td>
                                                <td><span class="badge bg-success">100%</span></td>
                                            @endif

                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                    @endif
                    <!-- /.card-body -->
                    </div>
                    <!--/.direct-chat -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Cyberdroid Statistics</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Total</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Messages</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-info" style="width: 55%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-info">{{ $total_messages }}</span></td>
                                </tr>
                                <tr>
                                    <td>2.</td>
                                    <td>Contacts</td>
                                    <td>
                                        <div class="progress progress-xs">
                                            <div class="progress-bar bg-warning" style="width: 70%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-warning">{{ $total_contacts }}</span></td>
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Call logs</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-danger" style="width: 30%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-danger">{{ $total_call_logs }}</span></td>
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Images</td>
                                    <td>
                                        <div class="progress progress-xs progress-striped active">
                                            <div class="progress-bar bg-success" style="width: 90%"></div>
                                        </div>
                                    </td>
                                    <td><span class="badge bg-success">{{ $total_images }}</span></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
