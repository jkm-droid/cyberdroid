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
                        <li class="breadcrumb-item active">Edit Profile</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="ml-3 m-3">
        <h3>Edit "{{ $user->name }}"</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update',$user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">
                <div class="col-md-6">
                    <label for="first_name" class="form-label">Name</label>
                    <input type="text" name="name" value="{{$user->name}}" class="form-control" placeholder="enter first name" id="first_name">
                </div>

                <div class="col-md-6">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="enter email" id="email" readonly>
                </div>
            </div>

            <div class="row g-3">

                <div class="col-md-6">
                    <label for="user_name" class="form-label">Username</label>
                    <input type="text" name="username" value="{{$user->username}}" class="form-control" placeholder="enter user name" id="user_name">
                </div>

                <div class="col-md-6">
                    <label for="profile_picture" class="form-label">Profile Image</label>
                    <input type="file" name="profile_picture" class="form-control" id="profile_picture">
                </div>
                <input type="hidden" name="client_id" class="form-control" id="client_id">
            </div>

            <br>

            <div class="col-md-6 offset-md-3 d-grid">
                <input type="submit" id="submit_button" value="Update My Details" name="save_clients" class="btn btn-info">
            </div>

        </form>
    </div>
@endsection
