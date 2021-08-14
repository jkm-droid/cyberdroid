@extends('base.index')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Portal</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('portal') }}">Home</a></li>
                        <li class="breadcrumb-item active">View Profile</li>
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

    <div class="text-center text-info" style="font-size: x-large;">
        <img height="300" width="300" src="/profile_pictures/{{ \Illuminate\Support\Facades\Auth::user()->profile_url }}" class="img-circle" alt="User Image" /><br>
        Name: {{ $user->name }} <br>
        Username: {{ $user->username }}<br>
        Email: {{ $user->email }}<br>
        @if(\Illuminate\Support\Facades\Auth::user()->is_verified ==0)
            Status: <span class="badge badge-danger">Unverified</span><br>
        @else
            Status: <span class="badge badge-success">Verified</span><br>
        @endif
        <a href="{{ route('profile.edit', $user->id) }}"> <button class="btn btn-sm btn-success mt-3">Edit Profile</button></a>
    </div>
@endsection
