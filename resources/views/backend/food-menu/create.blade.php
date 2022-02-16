@extends('backend.layouts.app')
@push('styles')
<style>
    #form1 {
        display:none;
    }

    
</style>
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
                    <h1 class="m-0">New Food Menu <a href="{{ route('food-menu.index') }}" class="btn btn-primary">View Food Menus</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Food Menu Lists</li>
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
                                    @isset($fmenu)
                                    <form action="{{ route('food-menu.update',$fmenu->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                    @else
                                    <form action="{{ route('food-menu.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                    @endisset
                                    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Food Menu name : </label>
                                                    <input type="text" class="form-control" name="name" value="{{isset($fmenu)?$fmenu->name:old('name') }}" placeholder="Food title" required>
                                                    <p class="text-danger">
                                                        {{ $errors->first('name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page_title">Price : </label>
                                                    <input type="text" class="form-control" name="price" value="{{isset($fmenu)?$fmenu->price:old('price') }}" placeholder="Food price">
                                                    <p class="text-danger">
                                                        {{ $errors->first('price') }}
                                                    </p>
                                                </div>
                                            </div>

                                            

                                            
                                            
                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="banner_image">Banner Image:</label>
                                                    <input type="file" class="form-control" name="banner_image" id="banner_image" onchange="loadBanner(event)">
                                                    <img id="banner_output" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('banner_image') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Menu Type: </label>
                                                    <select name="menu_type" class="form-control">
                                                        <option disabled selected>--Select a menu type--</option>
                                                        {{-- @foreach ($menu_categories as $category)
                                                        @endforeach --}}
                                                        <option value="All Day Menu" @if(isset($fmenu)) @if($fmenu->menu_type=='All Day Menu') selected @endif  @endif>All Day Menu</option>
                                                        <option value="Dinner Special" @if(isset($fmenu)) @if($fmenu->menu_type=='Dinner Special') selected @endif  @endif>Dinner Special</option>
                                                        <option value="Take Away" @if(isset($fmenu)) @if($fmenu->menu_type=='Take Away') selected @endif  @endif>Take Away</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('menu_type') }}
                                                    </p>
                                                    {{-- <button  class="btn btn-warning"  type="button" id="formButton">Create Category</button>
                                                    <label id="form1">
                                                        <input type="text" id="name" placeholder="category Title">
                                                        <button class="btn btn-success" type="button" id="butsave">Submit</button>
                                                    </label> --}}
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Food Type: </label>
                                                    <select name="food_type" class="form-control">
                                                        <option disabled selected>--Select a food type--</option>
                                                        @foreach ($foodType as $cat)
                                                        <option value="{{ $cat->id }}" @if(isset($fmenu)) @if($fmenu->food_type==$cat->id) selected @endif  @endif>{{ $cat->name }}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('food_type') }}
                                                    </p>
                                                    <button  class="btn btn-warning"  type="button" id="formButton">Create Category</button>
                                                    <label id="form1">
                                                        <input type="text" id="name" placeholder="category Title">
                                                        <button class="btn btn-success" type="button" id="butsave">Submit</button>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="image">Image:</label>
                                                    <input type="file"  name="image" id="image" onchange="loadImage(event)">
                                                    <img id="image_output" style="height: 100px;" @if(isset($fmenu)) src="{{ Storage::disk('uploads')->url($fmenu->featured_img) }}"   @else src="{{ Storage::disk('uploads')->url('noimage.jpg') }}" @endif>
                                                    <p class="text-danger">
                                                        {{ $errors->first('image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status"  value="1" @if(isset($fmenu)) @if($fmenu->publish_status==1) checked  @endif @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="page_title">Food description : </label>
                                                    <textarea class="form-control" name="description" placeholder="Food Menu Description"> {{isset($fmenu)?$fmenu->description:old('description') }} </textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('description') }}
                                                    </p>
                                                </div>
                                            </div>

                                         

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Main Child">Main or Child Menu:</label>
                                                    <select name="main_child" class="form-control main_child">
                                                        <option value="">--Choose as main or child--</option>
                                                        <option value="0">Main Menu</option>
                                                        <option value="1">Chlid Menu</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('main_child') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="parent" style="display: none;">
                                                <div class="form-group">
                                                    <label for="parent id">Under Main Menu:</label>
                                                    <select name="parent_id" class="form-control" id="parent_id">
                                                        <option value="">--Select a Parent Menu--</option>
                                                        @foreach ($parent_menus as $menu)
                                                            <option value="{{ $menu->id }}">{{ $menu->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('parent_id') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6" id="header_footer" style="display: none;">
                                                <div class="form-group">
                                                    <label for="show in">Show In:</label>
                                                    <select name="show_in" class="form-control" id="show_in_id">
                                                        <option value="">--Select where to show--</option>
                                                        <option value="1">Header</option>
                                                        <option value="2">Footer</option>
                                                        <option value="3">Header and Footer</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('show_in') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="Content">Menu Content:</label>
                                                    <textarea name="content" id="summernote" class="form-control"></textarea>
                                                    <p class="text-danger">
                                                        {{ $errors->first('content') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            {{-- <div class="col-md-12 text-center">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" value="{{ old('meta_title') }}" placeholder="Meta Title for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" value="{{ old('meta_keyword') }}" placeholder="Meta Keywords for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description"  value="{{ old('meta_description') }}" cols="30" rows="5" class="form-control" placeholder="Meta description.."></textarea>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="og_image">OG Image (1200 X 600): </label>
                                                    <input type="file" class="form-control" name="og_image" onchange="loadOg(event)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('og_image') }}
                                                    </p>
                                                </div>
                                            </div>
                                            

                                            <div class="col-md-6">
                                                <label for="">Current Og:</label> <br>
                                                <img id="current_og" style="height: 100px;" src="{{ Storage::disk('uploads')->url('noimage.jpg') }}">
                                            </div>
                                        --}}
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
    $(function() {
        $('.main_child').change(function() {
            var main_child = $(this).children("option:selected").val();
            if (main_child == 1)
            {
                document.getElementById("parent").style.display = "block";
                document.getElementById("header_footer").style.display = "none";
            }
            else if(main_child == 0)
            {
                document.getElementById("parent").style.display = "none";
                document.getElementById("header_footer").style.display = "block";
            }
        })
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

    var loadImage = function(event) {
        var output = document.getElementById('image_output');
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
            placeholder: "Menu content.."
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
                        url: "{{route('foodMenuType.create')}}",
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
