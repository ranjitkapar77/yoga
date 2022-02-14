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
                    <h1 class="m-0">Choose Us <a href="{{ route('choose.index') }}" class="btn btn-primary">View Choose Us</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Choose Us</li>
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
                                    <form action="{{ route('choose.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_icon_1">Icon 1:</label>
                                                    <input type="file" class="form-control" value="{{ old('choose_icon_1') }}" name="choose_icon_1" id="choose_icon_1" onchange="loadCover1(event)">
                                                    <img id="image_1" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_icon_1') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_title_1">Title 1:</label>
                                                    <input type="text" class="form-control" name="choose_title_1" value="{{ old('choose_title_1') }}" placeholder="Enter Title 1">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_title_1') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_title_2">Icon 2:</label>
                                                    <input type="file" class="form-control" name="choose_icon_2" id="choose_icon_2" value="{{ old('choose_icon_2') }}" onchange="loadCover2(event)">
                                                    <img id="image_2" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_icon_2') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_title_2">Title 2:</label>
                                                    <input type="text" class="form-control" name="choose_title_2" value="{{ old('choose_title_2') }}" placeholder="Enter  Title 2">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_title_2') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_title_3">Title 3:</label>
                                                    <input type="text" class="form-control" name="choose_title_3[]" value="{{ old('choose_title_3') }}" placeholder="Enter  Title 3">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_title_3') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image_title_4">Title Image 4:</label>
                                                    <input type="file" class="form-control" name="image_title_4" value="{{ old('image_title_4') }}" id="image_title_4" onchange="loadCover3(event)">
                                                    <img id="image_3" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('image_title_4') }}
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="choose_title_4">Title 4:</label>
                                                    <input type="text" class="form-control" name="choose_title_4" value="{{ old('choose_title_4') }}" placeholder="Enter Main Title 4">
                                                    <p class="text-danger">
                                                        {{ $errors->first('choose_title_4') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image:</label>
                                                    <input type="file" class="form-control" name="image" value="{{ old('image') }}" id="image" onchange="loadCover4(event)">
                                                    <img id="image_4" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Main Title">Main Title:</label>
                                                    <input type="text" class="form-control" value="{{ old('title') }}" name="title" placeholder="Enter Main Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Sub Title">Sub Title:</label>
                                                    <input type="text" class="form-control" value="{{ old('sub_title') }}" name="sub_title" placeholder="Enter Descriptive Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('sub_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Description">Description:</label>
                                                    <textarea name="description" id="summernote" value="{{ old('description') }}" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('description') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Button Title">Vedio Link:</label>
                                                    <input type="text" class="form-control" name="vedio_link" value="{{ old('vedio_link') }}" placeholder="Enter Vedio Link">
                                                    <p class="text-danger">
                                                        {{ $errors->first('vedio_link') }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Button Title">Button Title:</label>
                                                    <input type="text" class="form-control" name="btn_title" value="{{ old('btn_title') }}" placeholder="Enter Button Title">
                                                    <p class="text-danger">
                                                        {{ $errors->first('btn_title') }}
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
        var loadCover1 = function(event) {
            var output = document.getElementById('image_1');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script>
        var loadCover2 = function(event) {
            var output = document.getElementById('image_2');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script>
        var loadCover3 = function(event) {
            var output = document.getElementById('image_3');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script>
        var loadCover4 = function(event) {
            var output = document.getElementById('image_4');
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
            placeholder: "Choose content.."
        });

        $('#summernote1').summernote({
            height: 300,
            placeholder: "Choose content.."
        });
    </script>
@endpush
