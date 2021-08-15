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
                        <li class="breadcrumb-item"><a href="{{ route('portal') }}">Home</a></li>
                        <li class="breadcrumb-item active">Setup</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible col-md-3 offset-md-9">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
            {{ $message }}
        </div>
    @endif
    @if ($message = Session::get('error'))
        <div class="alert alert-danger alert-dismissible col-md-3 offset-md-9">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i> Success</h5>
            {{ $message }}
        </div>
    @endif
    <div class="row mt-4">
        <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
                @if(\Illuminate\Support\Facades\Auth::user()->status == "pending")
                    <a class="nav-item nav-link active"  data-toggle="tab" href="#information" role="tab" aria-selected="true">Additional Information</a>
                    <a class="nav-item nav-link disabled"  data-toggle="tab"  role="tab" aria-selected="false" disabled="true">Generated Keys</a>
                    <a class="nav-item nav-link disabled" data-toggle="tab"  role="tab"  aria-selected="false" disabled>Completed Setup</a>
                @elseif(\Illuminate\Support\Facades\Auth::user()->status == "started")
                    <a class="nav-item nav-link"  data-toggle="tab" href="#information" role="tab" aria-selected="true">Add Information</a>
                    <a class="nav-item nav-link active"  data-toggle="tab" href="#generate_keys" role="tab" aria-selected="false">Generate Keys</a>
                    <a class="nav-item nav-link disabled" data-toggle="tab" role="tab"  aria-selected="false">Complete Setup</a>
                @elseif(\Illuminate\Support\Facades\Auth::user()->status == "completed" || \Illuminate\Support\Facades\Auth::user()->status == "midway" )
                    <a class="nav-item nav-link"  data-toggle="tab" href="#information" role="tab" aria-selected="true">Add Information</a>
                    <a class="nav-item nav-link"  data-toggle="tab" href="#generate_keys" role="tab" aria-selected="false">Generate Keys</a>
                    <a class="nav-item nav-link active" data-toggle="tab" href="#payments" role="tab"  aria-selected="false">Complete Setup</a>
                @endif
            </div>
        </nav>
        <div class="tab-content p-3 col-md-8" id="nav-tabContent">

            @if(\Illuminate\Support\Facades\Auth::user()->status == "pending")
                <div class="tab-pane fade active show" id="information" role="tabpanel">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Provide Extra Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form method="post" action="{{ route('portal.setup.update', \Illuminate\Support\Facades\Auth::user()->id) }}">
                                @csrf
                                @method('put')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Target Phone Number</label>
                                        <input type="number" name="target_phone_number" id="target_phone_number" class="form-control"  placeholder="Enter Phone number">
                                        @if ($errors->has('target_phone_number'))
                                            <div class="text-danger form-text">{{ $errors->first('target_phone_number') }}</div>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Target Device Name</label>
                                        <input type="text" name="target_device_name" class="form-control" id="target_device_name" placeholder="Enter the target device name">
                                        @if ($errors->has('target_device_name'))
                                            <div class="text-danger form-text">{{ $errors->first('target_device_name') }}</div>
                                        @endif
                                    </div>
                                    <input type="hidden" name="user_id" id="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" id="submit_information" class="btn btn-secondary">Submit Information</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            @else
                <div class="tab-pane fade" id="information" role="tabpanel">
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">My Information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <h3>Target Phone Number: <span class="badge badge-success">{{$user->target_phone_number}}</span></h3>
                                <h3>Target Device Name: <span class="badge badge-success">{{$user->target_device_name}}</span></h3>
                            </div>

                        </div>
                    </div>
                </div>
            @endif

            @if(\Illuminate\Support\Facades\Auth::user()->status == "started")
                <div class="tab-pane fade active show" id="generate_keys" role="tabpanel">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Generate Spk key and Spy Code</h3>
                        </div>
                        <form method="post" action="{{ route('portal.setup.generate', \Illuminate\Support\Facades\Auth::user()->id) }}" >
                            @csrf
                            @method('put')
                            <div class="card-body">
                                <p class="text-info">The Spy key and spy code will be your secret values assisting you to access extracted information</p>
                            </div>
                            <!-- /.card-body -->
                            <input type="hidden" name="user_id" id="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">
                            <div class="card-footer">
                                <input  type="submit"  id="generate_keys" class="btn btn-secondary" value="Generate Secret Spy Key and Spy Value">
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="tab-pane fade" id="generate_keys" role="tabpanel">
                    <div class="card card-success">
                        <div class="card-header">
                            <h3 class="card-title">My Spy Keys</h3>
                        </div>
                        <div class="form-group col-md-7 ml-3 row">
                            <label for="exampleInputEmail1">Spy Secret Key</label>
                            <div class="input-group">
                                <input type="text" id="spy_secret_key" name="target_phone_number" class="form-control" value="{{$user->spy_secret_key}}" disabled style="display: none;">
                                <div class="input-group-append">
                                    <span class="input-group-text bg-success">
                                        <i onclick="show_key()" class="fas fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-7 ml-3">
                            <label for="exampleInputPassword1">Spy Secret Value</label>
                            <div class="input-group">
                                <input type="text" id="spy_secret_value" name="target_device_name" class="form-control" value="{{$user->spy_secret_value}}" disabled style="display: none;">
                                <div class="input-group-append">
                                <span class="input-group-text bg-success">
                                        <i onclick="show_value()" class="fas fa-eye"></i>
                                </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if(\Illuminate\Support\Facades\Auth::user()->is_payment_confirmed == 0 && \Illuminate\Support\Facades\Auth::user()->status == "midway")
                <div class="tab-pane fade active show" id="payments" role="tabpanel">
                    <div class="card card-secondary">
                        <div class="card-header">
                            <h3 class="card-title">Pay and Download App</h3>
                        </div>
                        <div class="card-body">
                            {{--                    <h3>Choose payment method</h3>--}}
                            <form method="post" action="{{ route('stk.push') }}">
                                @csrf
                                @method('post')
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number</label>

                                    <input type="number" name="PhoneNumber" class="form-control"  placeholder="Enter phone number e.g. 0712365487">

                                    @if ($errors->has('PhoneNumber'))
                                        <div class="text-danger form-text">{{ $errors->first('PhoneNumber') }}</div>
                                    @endif
                                </div>
                                <input type="submit" class="btn btn-secondary" value="LIPA NA MPESA"><br>
                                <p class="mt-3 text-info">You will receive an mpesa prompt in your phone after clicking the button.Enter your pin to complete the transaction</p>
                            </form>
                        </div>
                    </div>
                </div>
            @else
                @if(\Illuminate\Support\Facades\Auth::user()->is_payment_confirmed == 1)
                    <div class="tab-pane fade active show" id="payments" role="tabpanel">
                        <div class="card card-success">
                            <div class="card-header">
                                <h3 class="card-title">Cyberdroid key</h3>
                            </div>
                            <div class="card-body">

                                <h5>Your secret <strong>cyberdroid key</strong> is:
                                    <span class="badge badge-success">{{ \Illuminate\Support\Facades\Auth::user()->spy_key }}</span><br>
                                    @if(\Illuminate\Support\Facades\Auth::user()->downloaded == 1)
                                        Here are the list of steps to follow after downloading the app:
                                        <ol>
                                            <li>Install the app in the target smartphone</li>
                                            <li>Enter the cyberdroid key(You will be asked to enter the cyberdroid key before the app can launch).</li>
                                            <li>Start monitoring the cyberdroid activities here in the system</li>
                                        </ol>
                                    @endif
                                </h5>
                                @if(\Illuminate\Support\Facades\Auth::user()->downloaded == 0)
                                    <form method="post" action="{{ route('portal.setup.download', \Illuminate\Support\Facades\Auth::user()->id) }}">
                                        @csrf
                                        <button type="submit" onclick="load_page()" class="mt-3 btn btn-secondary">Download Spy App</button>
                                    </form>
                                @endif
                                @endif
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>

<script type="text/javascript">
    function load_page() {
        setTimeout(function (){
            window.location.reload();
        }, 20000);
    }
</script>
<script type="text/javascript">
    function add_information() {
        $(document).on('click', '#submit_information', function (e) {
            e.preventDefault();

            var target_phone_number = $('#target_phone_number').val();
            var target_device_name = $('#target_device_name').val();
            var user_id = $('#user_id').val();

            if (target_phone_number === '' || target_device_name === '') {
                alert('Fill all the fields');
            }else{
                $.ajax({
                    url: '{{ url('setup/update') }}',
                    type: 'POST',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'target_device_name': target_device_name,
                        'target_phone_number': target_phone_number,
                        'user_id' : user_id,
                    },
                    success: function (response) {
                        console.log(response);
                        if (response.status === 200){
                            location.href = "/setup";
                        }else {
                            alert("An error occurred...Try again later");
                        }
                    },

                    failure: function (response) {
                        console.log("something went wrong");
                    }
                });
            }
        });
    }
</script>
<script type="text/javascript">
    function generate_keys() {
        $(document).on('click', '#generate_keys', function (e) {
            e.preventDefault();
            console.log('clicked');
            var user_id = $('#user_id').val();

            $.ajax({
                url: '{{ url('setup/generate/') }}'+user_id,
                type: 'POST',
                data: {
                    "_token": "{{ csrf_token() }}",
                    'user_id' : user_id,
                },
                success: function (response) {
                    console.log(response);
                    if (response.status === 200){
                        location.href = "/setup";
                    }else {
                        alert("An error occurred...Try again later");
                    }
                },

                failure: function (response) {
                    console.log("something went wrong");
                }
            });
        });
    }
</script>

<script type="text/javascript">
    function show_key(){
        $('#spy_secret_key').show();
    }

    function show_value(){
        $('#spy_secret_value').show();
    }
</script>
