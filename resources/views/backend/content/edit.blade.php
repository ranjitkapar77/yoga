@extends('backend.layouts.app')
@push('styles')
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
                    <h1 class="m-0">Edit Content <a href="{{ route('content.index') }}" class="btn btn-primary">View Content</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Edit Content</li>
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
                        <div class="col-md-9">
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('content.update', $content->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="content_title">Title</label>
                                                    <input type="text" name="content_title" class="form-control" placeholder="Content title" value="{{ $content->content_title }}">
                                                    <p class="text-danger">
                                                        {{$errors->first('content_title')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="content_page_title">Sub Title</label>
                                                    <input type="text" name="content_page_title" class="form-control" placeholder="Content Page Title" value="{{ $content->content_page_title }}">
                                                    <p class="text-danger">
                                                        {{$errors->first('content_page_title')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="content_type">Content Type: </label>
                                                    <select name="content_type"class="form-control">
                                                        <option value="">--Select a Content Type--</option>
                                                            <option value="About" {{$content->content_type == "About" ? 'selected' : ''}}>About</option>
                                                            <option value="Page" {{$content->content_type == "Page" ? 'selected' : ''}}>Page</option>
                                                            <option value="Article" {{$content->content_type == "Article" ? 'selected' : ''}}>Article</option>
                                                            <option value="Why" {{$content->content_type == "Why" ? 'selected' : ''}}>Why</option>
                                                            <option value="FAQ" {{$content->content_type == "FAQ" ? 'selected' : ''}}>FAQ</option>
                                                            <option value="Welcome" {{$content->content_type == "Welcome" ? 'selected' : ''}}>Welcome</option>
                                                            <option value="Team" {{$content->content_type == "Team" ? 'selected' : ''}}>Team</option>
                                                            <option value="Courses" {{$content->content_type == "Courses" ? 'selected' : ''}}>Courses</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content_type') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="featured_img">Select an image for Content:</label>
                                                    <input type="file" class="form-control" name="featured_img" id="featured_img" onchange="loadLogo(event)">
                                                    <img id="featured_img_output" style="height: 100px;" src="{{Storage::disk('uploads')->url($content->featured_img)}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('featured_img') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="freezone_img">Select an Cover for Content:</label>
                                                    <input type="file" class="form-control" name="freezone_img" id="freezone_img" onchange="loadCover(event)">
                                                    <img id="freezone_img_output" style="height: 100px;" src="{{Storage::disk('uploads')->url($content->freezone_img)}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('freezone_img') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Description">Content Description:</label>
                                                    <textarea name="content_body" id="summernote" class="form-control">{{$content->content_body}}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content_body') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" value="{{$content->meta_title}}" placeholder="Meta Title for SEO">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" value="{{$content->meta_keywords}}" placeholder="Meta Keywords for SEO">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description"  cols="30" rows="5" class="form-control" placeholder="Meta description..">{{$content->meta_description}}</textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="publish_status">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status" value="1" {{ $content->publish_status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="show_on_menu">Show on footer: </label>
                                                    <select name="show_on_menu"class="form-control">
                                                            <option value="Y" {{$content->show_on_menu == "Y" ? 'selected' : ''}}>Yes</option>
                                                            <option value="N" {{$content->show_on_menu == "N" ? 'selected' : ''}}>No</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_on_menu') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="external_link">Extarnal Link(Optional): </label>
                                                    <input type="text" class="form-control" name="external_link" value="{{$content->external_link}}" placeholder="External link">
                                                    <p class="text-danger">
                                                        {{ $errors->first('external_link') }}
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
        var loadLogo = function(event) {
            var output = document.getElementById('featured_img_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };

        var loadCover = function(event) {
            var output = document.getElementById('freezone_img_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 200,
            placeholder: "Content Description.."
        });
    </script>
@endpush
