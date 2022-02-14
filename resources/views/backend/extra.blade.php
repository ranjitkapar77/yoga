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
                        {{-- <h1 class="m-0">Create Extra <a href="{{ route('courses.index') }}" class="btn btn-primary">View Extra</a></h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Extra</li>
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
                                <form action="{{ route('extra.update', $extra->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method("PATCH")
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="News Title">Key</label>
                                                <input type="text" class="form-control" name="key" placeholder="Enter Key"
                                                    value="{{ $extra->key }}">
                                                <p class="text-danger">
                                                    {{ $errors->first('key') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Sub Title">Title</label>
                                                <input type="text" class="form-control" name="value"
                                                    placeholder="Enter value" value="{{ $extra->value }}">
                                                <p class="text-danger">
                                                    {{ $errors->first('value') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="Sub Title">Sub Title</label>
                                                <input type="text" class="form-control" name="value_1"
                                                    placeholder="Enter value" value="{{ $extra->value_1 }}">
                                                <p class="text-danger">
                                                    {{ $errors->first('value_1') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="Description">Description:</label>
                                                <textarea name="description" id="summernote" class="form-control">
                                                        {!! $extra->description !!}
                                                    </textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('description') }}
                                                </p>
                                            </div>
                                        </div>

                                        <div class="col-md-12 mt-4">
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
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            placeholder: "Extra content.."
        });

        $('#summernote1').summernote({
            height: 300,
            placeholder: "Extra content.."
        });
    </script>

    <script>
        var loadOg = function(event) {
            var output = document.getElementById('current_og');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        var loadBanner = function(event) {
            var output = document.getElementById('banner_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
@endpush
