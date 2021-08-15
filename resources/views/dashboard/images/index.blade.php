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
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">images</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <h3 class="ml-3">All Images</h3>
    @if($images->isEmpty())
        <p class="text-danger text-center">No images found</p>
    @else

        <div class="card">
            <div class="card-header">
                <h3 class="card-title btn-sm btn-info">Based on Cyberdroid Key</h3>

                <div class="card-tools">
                    <ul class="pagination pagination-sm float-right">
                        {!! $images->links() !!}
                    </ul>
                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">

                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Device Name</th>
                        <th>Images</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($images as $image)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td><a href="{{ route('dashboard.images.show', $image->spy_key) }}">{{ $image->device }}</a></td>
                            <td>{{ $images_no }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
            <!-- /.card-body -->
        </div>

    @endif

    {!! $images->links() !!}
@endsection
