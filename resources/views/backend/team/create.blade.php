@extends('backend.layouts.app')
@push('styles')
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
                    <h1 class="m-0">New Team <a href="{{ route('team.index') }}" class="btn btn-primary">View Team</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Team</li>
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
                                    <form action="{{ route('team.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" placeholder="Enter Name" value="{{ @old('name') }}">
                                                    <p class="text-danger">
                                                        {{$errors->first('name')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="post">Position</label>
                                                    <input type="text" name="post" class="form-control" placeholder="Enter Position" value="{{ @old('post') }}">
                                                    <p class="text-danger">
                                                        {{$errors->first('post')}}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Team Type: </label>
                                                    <select name="team_type_id" class="form-control">
                                                        <option disabled selected>--Select a team type--</option>
                                                        @foreach ($teamType as $cat)
                                                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('team_type_id') }}
                                                    </p>
                                                    <button  class="btn btn-warning"  type="button" id="formButton">Create Team type</button>
                                                    <label id="form1" style="display: none;">
                                                        <input type="text" id="name" placeholder="Team type">
                                                        <button class="btn btn-success" type="button" id="butsave">Submit</button>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-9">
                                                <div class="form-group">
                                                    <label for="team_image">Select an image:</label>
                                                    <input type="file" class="form-control" name="team_image" id="team_image" onchange="loadLogo(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('team_image') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-3">
                                                <img id="team_image_output" style="height: 100px; width:200px;">
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <input type="text" value="{{ @old('address') }}" name="address" placeholder="Enter address" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('address') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="phone">Phone Number</label>
                                                    <input type="text" value="{{ @old('phone') }}" name="phone" placeholder="Enter phone" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('phone') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="text" value="{{ @old('email') }}" name="email" placeholder="Enter email" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('email') }}
                                                    </p>
                                                </div>
                                            </div>
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="website">Website Url</label>
                                                    <input type="text" value="{{ @old('website') }}" name="website" placeholder="Enter website Url" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('website') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">Team Content :</label>
                                                    <textarea name="content" id="summernote" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="facebook">Facebook Url</label>
                                                    <input type="text" value="{{ @old('facebook') }}" name="facebook" placeholder="Enter Facebook Url" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('facebook') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="linkedin">Linkedin Url</label>
                                                    <input type="text" value="{{ @old('linkedin') }}" name="linkedin" placeholder="Enter Linkedin Url " class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('linkedin') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="youtube">Youtube Url</label>
                                                    <input type="text" value="{{ @old('youtube') }}" name="youtube" placeholder="Enter Youtube Url" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('youtube') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="twitter">Twitter Url</label>
                                                    <input type="text" value="{{ @old('twitter') }}" name="twitter" placeholder="Enter Twitter Url" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('twitter') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="active" value="1">
                                                        <span class="slider round"></span>
                                                    </label>
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
            var output = document.getElementById('team_image_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
    </script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script type="text/javascript">
        $('#summernote').summernote({
            height: 300,
            placeholder: "Services content.."
        });
    </script>
    <script>
        $("#formButton").click(function(){
        $("#form1").toggle();
    });
    </script>
    <script>
        $(document).ready(function() {
            $('#butsave').on('click', function() {
                $("#butsave").attr("disabled", "disabled");
                var name = $('#name').val();
                if(name!=""){
                    $.ajax({
                        url: "{{route('teamType.create')}}",
                        type: "POST",
                        data: {
                            _token:"{{ csrf_token()}}",
                            name: name,
                        },
                        cache: false,
                        success: function() {
                            $('#alertMessage').html('<p>success message</p>');
                            setTimeout(function(){
                            location.reload();
                            }, 800);
                        }
                    });
                }
                else{
                    alert('Please fill all the field !');
                }
            });
        });
        </script>
@endpush
