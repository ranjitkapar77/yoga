@extends('backend.layouts.app')
@push('styles')
<style>
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
        color: #000 !important;
    }
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
    <!-- summernote css -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit a Courses <a href="{{ route('courses.index') }}" class="btn btn-primary">View Courses</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Courses</li>
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
                                    <form action="{{ route('courses.update', $courses->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="News Title">Main Title:</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter Main Title" value="{{$courses->title}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Sub Title">Sub Title:</label>
                                                    <input type="text" class="form-control" name="sub_title" placeholder="Enter Descriptive Title" value="{{$courses->sub_title}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('sub_title') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image:</label>
                                                    <input type="file" class="form-control" name="image" id="image" onchange="loadCover(event)">
                                                    <img id="image_output" style="height: 100px;" src="{{Storage::disk('uploads')->url($courses->image)}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_image">Banner Image:</label>
                                                    <input type="file" class="form-control" name="banner_image" id="banner_image" onchange="loadBanner(event)">
                                                    <img id="banner_output" style="height: 100px;" src="{{Storage::disk('uploads')->url($courses->banner_image)}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('banner_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="destination">Course Destination: </label>
                                                    <select name="destination[]" multiple="multiple"  class="form-control dest-multiple">
                                                        <option value="">--Select a Destination--</option>
                                                        @foreach ($course_destination as $destination)
                                                            <option value="{{ $destination->id }}"{{ in_array($destination->id, $dselected) ? 'selected' : '' }}>{{ $destination->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('destination') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="course_category">Course Category: </label>
                                                    <select name="course_category[]" multiple="multiple" class="form-control cat-multiple">
                                                        <option value="">--Select a category--</option>
                                                        @foreach ($course_categories as $category)
                                                            <option value="{{ $category->id }}"{{ in_array($category->id, $cselected) ? 'selected' : '' }}>{{ $category->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('course_category') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="course_level">Course Level: </label>
                                                    <select name="course_level" class="form-control">
                                                        <option value="">--Select a Level--</option>
                                                            @foreach ($level as $lev)
                                                            <option value="{{$lev->id}}" {{$courses->course_level == $lev->id ? 'selected' : ''}}>{{$lev->title}}</option>
                                                            @endforeach
                                                        </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('course_level') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Month Intake">Month Intake:</label>
                                                    <input type="text" class="form-control" name="month_intake" placeholder="Enter month intake" value="{{$courses->month_intake}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('month_intake') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Course Duration">Course Duration:</label>
                                                    <input type="text" class="form-control" name="course_duration" placeholder="Enter Course Duration" value="{{$courses->course_duration}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('course_duration') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Qualification">Qualification:</label>
                                                    <input type="text" class="form-control" name="qualification" placeholder="Enter Qualification" value="{{$courses->qualification}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('qualification') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Visa Duration">Visa Duration:</label>
                                                    <input type="text" class="form-control" name="visa_duration" placeholder="Enter Visa Duration" value="{{$courses->visa_duration}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('visa_duration') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Course Fee">Course Fee:</label>
                                                    <input type="text" class="form-control" name="course_fee" placeholder="Enter Course Fee" value="{{$courses->course_fee}}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('course_fee') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Content">Course Content:</label>
                                                    <textarea name="content" id="summernote" class="form-control">{{$courses->content}}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Requirements">Requirement:</label>
                                                    <textarea name="requirements" id="summernote1" class="form-control">{{$courses->requirements}}</textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('requirements') }}
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
                                                    <input type="text" class="form-control" name="meta_title" value="{{$courses->meta_title}}" placeholder="Meta Title for SEO">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" value="{{$courses->meta_keywords}}" placeholder="Meta Keywords for SEO">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description"  cols="30" rows="5" class="form-control" placeholder="Meta description..">{{$courses->meta_description}}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status" value="1" {{ $courses->publish_status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="show_in_menu">Show on menu: </label>
                                                    <select name="show_in_menu"class="form-control">
                                                            <option value="1" {{$courses->show_in_menu == "1" ? 'selected' : ''}}>Yes</option>
                                                            <option value="0" {{$courses->show_in_menu == "0" ? 'selected' : ''}}>No</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_in_menu') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="Youtube Link">Youtube Link:</label>
                                                    <input type="text" class="form-control" name="youtube_link" value="{{ $courses->youtube_link }}" placeholder="Enter Youtube Link">
                                                    <p class="text-danger">
                                                        {{ $errors->first('youtube_link') }}
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
            var output = document.getElementById('image_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <!-- summernote js -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            placeholder: "Course content.."
        });

        $('#summernote1').summernote({
            height: 300,
            placeholder: "Course content.."
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
<script>
    $(document).ready(function() {
    $('.dest-multiple').select2();
});
$(document).ready(function() {
    $('.cat-multiple').select2();
});
</script>
@endpush
