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
                            <li class="breadcrumb-item active">Images</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title">Photos</h4>
                            </div>
                            <div class="card-body">
                                <div>
                                    <div class="btn-group w-100 mb-2">
                                        <a class="btn btn-info active" href="javascript:void(0)" data-filter="all"> All items </a>
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="1"> Category 1 (WHITE) </a>
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="2"> Category 2 (BLACK) </a>
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="3"> Category 3 (COLORED) </a>
                                        <a class="btn btn-info" href="javascript:void(0)" data-filter="4"> Category 4 (COLORED, BLACK) </a>
                                    </div>
                                </div>
                                <div>
                                    @if($images->isEmpty())
                                        <p class="text-danger text-center">No images found</p>
                                    @else
                                        <div class="filter-container p-0 row">
                                            @foreach($images as $image)
                                                <div class="filtr-item col-sm-2" data-category="1" data-sort="white sample">
                                                    <img style="height: 400px;" src="/gallery/{{ $image->image_name }}" class="img-fluid mb-2" alt=""/>
                                                </div>
                                            @endforeach
                                        </div>

                                    @endif
                                    {!! $images->links() !!}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
