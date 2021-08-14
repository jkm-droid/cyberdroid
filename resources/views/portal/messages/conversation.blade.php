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
                            <li class="breadcrumb-item active">{{ $title }}</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <h2 class="ml-3">{{ $title }}</h2>
        <a class="m-3" href="{{ route('messages.index', \Illuminate\Support\Facades\Auth::user()->spy_key) }}"><button class="btn btn-sm btn-success">Back</button></a><br>

        <div class="col-md-10 mt-2">
            <!-- DIRECT CHAT -->
            <div class="card direct-chat direct-chat-warning" >
                <div class="card-header">
                    <h3 class="card-title">Messages</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                    <!-- Conversations are loaded here -->
                    <div class="direct-chat-messages" style="min-height: 500px;">
                    @foreach($conversations as $conversation)
                        <!-- Message. Default to the left -->
                            @if($conversation->message_type == 'inbox')
                                <div class="direct-chat-msg">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-left">{{ $title }}</span>
                                        <span class="direct-chat-timestamp ml-1 text-success">{{ $conversation->message_date }}</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="{{ asset('images/images.jpeg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text" style="width: fit-content;">
                                        {{ $conversation->message_body }}
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                            @endif
                        <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            @if($conversation->message_type == 'sent')
                                <div class="direct-chat-msg right">
                                    <div class="direct-chat-infos clearfix">
                                        <span class="direct-chat-name float-right ml-1">Target</span>
                                        <span class="direct-chat-timestamp float-right mr-1">{{ $conversation->message_date }}</span>
                                    </div>
                                    <!-- /.direct-chat-infos -->
                                    <img class="direct-chat-img" src="{{ asset('images/profile.jpeg') }}" alt="message user image">
                                    <!-- /.direct-chat-img -->
                                    <div class="direct-chat-text float-right" style="width: fit-content;">
                                        {{ $conversation->message_body }}
                                    </div>
                                    <!-- /.direct-chat-text -->
                                </div>
                            @endif
                        <!-- /.direct-chat-msg -->
                        @endforeach
                    </div>
                    <!--/.direct-chat-messages-->

                </div>
            </div>
            <!--/.direct-chat -->
        </div>
    </div>
@endsection
