@extends('backend.layouts.app')
@push('styles')
    <!-- summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

            .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

            .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

            .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

            input:checked + .slider {
            background-color: #2196F3;
        }

            input:focus + .slider {
            box-shadow: 0 0 1px #2196F3;
        }

            input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

            /* Rounded sliders */
            .slider.round {
            border-radius: 34px;
        }

            .slider.round:before {
            border-radius: 50%;
        }
        .hide{
            display: none;

        }
        .show{
            display: block;
        }
    </style>
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create a Looking <a href="{{ route('learns.index') }}" class="btn btn-primary">View Looking</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Looking</li>
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
                                    <form action="{{ route('learns.update', $learns->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="logo">Logo:</label>
                                                    <input type="file" class="form-control" name="icon" id="logo" onchange="loadBanner(event)">
                                                    <img id="banner_output" style="height: 100px;" src="{{Storage::disk('uploads')->url($learns->icon)}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('icon') }}
                                                    </p>
                                                </div>
                                            </div>


                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Title">Title:</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter  Title" value="{{ $learns->title }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Page Title">Page Title:</label>
                                                    <input type="text" class="form-control" name="page_title" placeholder="Enter Page title" value="{{ $learns->page_title }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('page_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Langeage"> Language:</label>
                                                    <input type="text" class="form-control" name="language" placeholder="Enter Test Language" value="{{ $learns->language }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('language') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Fee">Fee:</label>
                                                    <input type="text" class="form-control" name="fee" placeholder="Enter Fee" value="{{ $learns->fee }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('fee') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Rotal Mark">Total mark:</label>
                                                    <input type="text" class="form-control" name="total_mark" placeholder="Enter Total Mark" value="{{ $learns->total_mark }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('total_mark') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Required Mark">Required Mark:</label>
                                                    <input type="text" class="form-control" name="required_mark" placeholder="Enter Required Mark" value="{{ $learns->required_mark }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('required_mark') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">Description Title:</label>
                                                    <textarea name="description" id="summernote" class="form-control">{{$learns->description}}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('description') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status" value="1" {{ $learns->publish_status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="show_in_menu">Show on menu: </label>
                                                    <select name="show_in_menu"class="form-control">
                                                            <option value="1" {{$learns->show_in_menu == "1" ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$learns->show_in_menu == "0" ? 'selected' : ''}}>No</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_in_menu') }}
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
    {{-- <script>
        var loadCover = function(event) {
            var output = document.getElementById('logo');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <!-- summernote js --> --}}
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            placeholder: "Looking content.."
        });

        $('#summernote1').summernote({
            height: 300,
            placeholder: "Looking content.."
        });
    </script>

<script>
    var logo = function(event) {
        var output = document.getElementById('logo');
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
