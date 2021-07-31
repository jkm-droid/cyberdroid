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
                            <li class="breadcrumb-item active">Conversations</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <h3 class="ml-3">Conversations</h3>
        @if($phone_numbers->isEmpty())
            <p class="text-danger text-center">No conversations found</p>
        @else

            @foreach($phone_numbers as $phone_number)
                <div class="ml-4 m-3">
                    @if($phone_number->contact_name == "")
                        <a class="btn btn-info" href="{{ route('messages.conversation', $phone_number->phone_number) }}">{{ $phone_number->phone_number }}</a>
                    @else
                        <a class="btn btn-info" href="{{ route('messages.conversation', $phone_number->phone_number) }}">{{ $phone_number->contact_name }}</a>
                    @endif
                </div>
            @endforeach

        @endif

        {!! $phone_numbers->links() !!}
    </div>
@endsection
