@extends('base.user_index')

@section('content')
    <div class="login-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="/" class="h1">Cyber<b>droid</b></a>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <p class="alert alert-success">{{ $message }}</p>
                @endif
                @if ($message = Session::get('error'))
                    <p class="alert alert-danger">{{ $message }}</p>
                @endif
                <p class="login-box-msg">Enter email to start password reset</p>

                <form action="{{ route('user.forgot_submit') }}" method="post">
                    @csrf
                    <div class="mb-3">
                        <input type="text" class="form-control" name="email" placeholder="Enter your email">
                        @if ($errors->has('email'))
                            <div class="text-danger form-text">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block">Request Password Reset</button>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
    </div>

@endsection
