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
                        <li class="breadcrumb-item active">Confirm Payment</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <div class="col-md-8 offset-md-2">
        <div class="card card-secondary">
            <div class="card-header">
                <h3 class="card-title">Confirm Payment</h3>
            </div>
            <form method="post" action="{{ route('mpesa.confirm') }}" >
                @csrf
                @method('post')
                <div class="card-body">
                    <p>Please enter the transaction code you received in your phone</p>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Transaction Code</label>
                        <input type="text" name="transaction_code" id="transaction_code" class="form-control"  placeholder="Enter transaction code">
                        @if ($errors->has('transaction_code'))
                            <div class="text-danger form-text">{{ $errors->first('transaction_code') }}</div>
                        @endif
                    </div>
                </div>
                <!-- /.card-body -->
                {{--            <input type="hidden" name="user_id" id="user_id" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}">--}}
                <div class="card-footer">
                    <input  type="submit"   class="btn btn-secondary" value="Confirm">
                </div>
            </form>
        </div>
    </div>
@endsection
