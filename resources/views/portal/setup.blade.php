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
    <div class="row mt-4">
        <nav class="w-100">
            <div class="nav nav-tabs" id="product-tab" role="tablist">
                <a class="nav-item nav-link active"  data-toggle="tab" href="#information" role="tab" aria-selected="true">Add Information</a>
                <a class="nav-item nav-link"  data-toggle="tab" href="#generate_keys" role="tab" aria-selected="false">Generate Keys</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#payments" role="tab"  aria-selected="false">Complete Setup</a>
            </div>
        </nav>
        <div class="tab-content p-3 col-md-8" id="nav-tabContent">
            <div class="tab-pane fade show active" id="information" role="tabpanel" aria-labelledby="product-desc-tab">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Provide Extra Information</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Target Phone Number</label>
                                    <input type="number" class="form-control"  placeholder="Enter Phone number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Target Device Name</label>
                                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Enter the target device name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <div class="tab-pane fade" id="generate_keys" role="tabpanel" aria-labelledby="product-comments-tab">
                hello
            </div>
            <div class="tab-pane fade" id="payments" role="tabpanel" aria-labelledby="product-rating-tab">
                hello 2
            </div>
        </div>
    </div>
@endsection
