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
                            <li class="breadcrumb-item active">Contacts</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <h3 class="ml-3">Contacts</h3>
        @if($phone_numbers->isEmpty())
            <p class="text-danger text-center">No conversations found</p>
        @else

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title btn-sm btn-info">{{$device}}</h3>

                    <div class="card-tools">
                        <ul class="pagination pagination-sm float-right">
                            {!! $phone_numbers->links() !!}
                        </ul>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body p-0">

                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width: 10px">#</th>
                            <th>Phone Number</th>
                            <th>Contact Name</th>
                            <th>Contact Id</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($phone_numbers as $phone_number)
                            <tr>
                                <td>{{ ++$i }}</td>
                                <td>{{ $phone_number->phone_number }}</td>
                                <td>{{ $phone_number->contact_name }}</td>
                                <td>{{ $phone_number->contact_id }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
                <!-- /.card-body -->
            </div>

        @endif

        {!! $phone_numbers->links() !!}
    </div>
@endsection
