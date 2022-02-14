@extends('backend.layouts.app')
@push('styles')
    <!-- summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Update a Model <a href="{{ route('series.index') }}" class="btn btn-primary">View Models</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Models</li>
                    </ol>
                </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    @if (session('success'))
                        <div class="col-sm-12">
                            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="col-sm-12">
                            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('series.update', $series->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="model_image">Model image:</label>
                                                    <input type="file" class="form-control" name="model_image" id="model_image" onchange="loadCover(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('model_image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <label for="">Preview:</label><br>
                                                <img id="cover_image_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url($series->model_image) }}">
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="Series Title">Series Name :</label>
                                                    <input type="text" class="form-control" name="model_name" placeholder="Enter Model Name" value="{{ $series->model_name }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('model_name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6 mt-4">
                                                <div class="form-group">
                                                    <label for="Brand">Related Brand :</label>
                                                    <select name="brand" class="form-control">
                                                        <option value="">--Select a brand--</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}" {{ $brand->id == $series->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('brand') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-4 text-center">
                                                <button type="submit" class="btn btn-success">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- /.content -->
        </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
<script>
    var loadCover = function(event) {
        var output = document.getElementById('cover_image_output');
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src)
        }
    };
</script>
@endpush
