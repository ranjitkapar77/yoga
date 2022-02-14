@extends('backend.layouts.app')
@push('styles')
    <style>
        .imgPreview img {
            padding: 8px;
            max-width: 150px;
        }
        input[type="file"] {
    		display: block;
    	}
    	.imageThumb {
    		max-height: 75px;
    		/*border: 2px solid;*/
    		padding: 1px;
    		cursor: pointer;
    	}
    	.pip {
    		display: inline-block;
    		margin: 10px 10px 0 0;
    	}
    	.remove {
    		display: block;
    		background: #dc3545;
    		border:#dc3545;
    		color: white;
    		text-align: center;
    		cursor: pointer;
    	}
    	.remove:hover {
    		background: white;
    		color: black;
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
@endpush
@section('content')
    <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create an Product <a href="{{ route('products.index') }}" class="btn btn-primary">View Products</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Products</li>
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
                                    @isset($product)
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                    @else
                                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                    @endisset
                                    
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Product Name">Product Name :</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter Product Name" value="{{ isset($product)? $product->title: old('title'); }}" >
                                                    <p class="text-danger">
                                                        {{ $errors->first('title') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Brand">Select category :</label>
                                                    <select name="category_id" class="form-control brand">
                                                        <option value="">--Select a Category--</option>
                                                        @foreach ($cats as $cat)
                                                            <option value="{{ $cat->id }}" @if(isset($product)) @if($product->category_id==$cat->id) selected @endif @endif>{{ $cat->title }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('category_id') }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="series">Related Model<i class="text-danger">*</i> :</label>
                                                    <select name="series" class="form-control series" id="series_product">
                                                        <option value="">--Select a Brand first--</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('series') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="publish_status"  value="1" @if(isset($product)) @if($product->publish_status==1) checked  @endif @endif>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="picture">Choose a featured photo:</label>
                                                    <input type="file" class="form-control" name="featured_photo" id="picture" onchange="loadMemberPhoto(event)"> <br>
                                                    <img id="member_photo_output" style="height: 150px;width: 150px;" src="@if(!isset($product)) {{ Storage::disk('uploads')->url('noimage.jpg') }} @else {{ Storage::disk('uploads')->url($product->featured_img) }} @endif">

                                                    <p class="text-danger">
                                                        {{ $errors->first('picture') }}
                                                    </p>
                                                </div>
                                            </div>
                                        
                                            {{-- <div class="col-md-6">
                                                <label for="image_preview">Preview:</label> <br>
                                            </div> --}}

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Price (In Rs.)">Price (In Rs.) :</label>
                                                    <input type="text" class="form-control" name="price" placeholder="Enter Price (In Rs.)" value="{{ isset($product)? $product->price: old('price'); }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('price') }}
                                                    </p>
                                                </div>
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Color">Color :</label>
                                                    <input type="text" class="form-control" name="color" placeholder="Eg: Red, Green">
                                                    <p class="text-danger">
                                                        {{ $errors->first('color') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Size">Size :</label>
                                                    <input type="text" class="form-control" name="size" placeholder="Eg: Medium">
                                                    <p class="text-danger">
                                                        {{ $errors->first('size') }}
                                                    </p>
                                                </div>
                                            </div>

                                            

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Warranty / Guarantee Time:</label>
                                                    <input type="text" class="form-control" name="guarantee_time" placeholder="Eg: 3 months">
                                                    <p class="text-danger">
                                                        {{ $errors->first('guarantee_time') }}
                                                    </p>
                                                </div>
                                            </div> --}}

                                            <div class="col-md-12">
                                                <label for="">Brief Description (Shows at the side of product):</label>
                                                <textarea name="brief_description" class="form-control" placeholder="Brief Description.."> {{ isset($product)? $product->brief_description: old('brief_description'); }} </textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('brief_description') }}
                                                </p>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Product Description (Shows at description section):</label>
                                                <textarea name="main_description" class="form-control" id="summernote">{{ isset($product)? $product->main_description: old('main_description'); }} </textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('main_description') }}
                                                </p>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                        <label for="multiple_images">Select Multiple Images:</label>
                                                        <br>
                                                        <input type="button" Value="Select Multiple Images" class="multiple_images">
                                                </div>
                                            </div>
                                            <div class="field" align="left">
    
                                                <input type="file" id="files" name="multiple_files[]" multiple style="display: none;" />
                                            
                                                @if(isset($product))
                                            
                                                @foreach($product->images as $images)
                                                <span class="pip" id="remove{{$images->id}}">
                                                    <img class="imageThumb" src="{{ Storage::disk('uploads')->url($images->image) }}">
                                                    <br/><span class="remove updateremove" id="{{$images->id}}">Remove</span>
                                                </span>
                                                
                                                
                                                @endforeach
                                                @endif

                                                {{-- <div class="col-md-12 mt-5 mb-5">
                                                    @if (isset($product))
                                                        <div class="row">
                                                            @foreach ($product->images as $image)
                                                                <div class="col-md-3 wrapp">
                                                                    <img src="{{ Storage::disk('uploads')->url($image->image) }}" alt="{{ $product->title }}" style="height: 200px;">
                                                                    <form action="{{ route('deleteproductimage', $image->id) }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" data-id="{{ $image->id }}" class="btn btn-danger py-0 px-1 absolutebtn" class="remove">x</button>
                                                                    </form>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    @else
                                                        <img src="{{ Storage::disk('uploads')->url('noimage.jpg') }}" alt="{{ $product->name }}" style="width:200px; max-height: 200px;">
                                                    @endif
                                                </div> --}}
                                            </div>

                                            {{-- <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="product_images">Select product images (Multiple images can be selected):</label>
                                                    <input type="file" class="form-control" name="product_images[]" id="images" multiple="multiple">
                                                    <p class="text-danger">
                                                        {{ $errors->first('product_images') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12 user-image mb-3 text-center">
                                                <div class="imgPreview"> </div>
                                            </div> --}}


                                            <div class="col-md-12 text-center mt-4">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords for SEO" value="">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta description.."></textarea>
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

                                            <div class="col-md-12 text-center mt-4">
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
    <!-- jQuery -->
    <script>
        $(function() {
        // Multiple images preview with JavaScript
        var multiImgPreview = function(input, imgPreviewPlaceholder) {

            if (input.files) {
                var filesAmount = input.files.length;

                for (i = 0; i < filesAmount; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }

        };

        $('#images').on('change', function() {
            multiImgPreview(this, 'div.imgPreview');
        });
        });
    </script>
    <script>

var loadMemberPhoto = function(event) {
            var output = document.getElementById('member_photo_output');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        
        var loadOg = function(event) {
            var output = document.getElementById('current_og');
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        };
        $('#summernote').summernote({
            height: 300,
            placeholder: "Description.."
        });


        $('.multiple_images').click(function(){
    			$('#files').trigger('click'); 
    		});



    		const dt = new DataTransfer();
    		$(document).ready(function() {
    			if (window.File && window.FileList && window.FileReader) {
    				$("#files").on("change", function(e) {
    					var files = e.target.files,
    					filesLength = files.length;
    					for (var i = 0; i < filesLength; i++) {
    						let fileName = this.files.item(i).name;
    						var f = files[i]
    						var fileReader = new FileReader();
    						fileReader.onload = (function(e) {
    							console.log(e);
    							var file = e.target;
    							$("<span class=\"pip\">" +
    								"<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + fileName + "\"/>" +
    								"<br/><span class=\"remove\" d-name=\"" + fileName + "\" onclick='removeItem(this)' >Remove</span>" +
    								"</span>").insertAfter("#files");          
    						});
    						fileReader.readAsDataURL(f);
    					}

    					for (let file of this.files) {
    						dt.items.add(file);
    					}

    					this.files = dt.files;

    		// $(".remove").click(function(){

      //         });
             });
    			} else {
    				alert("Your browser doesn't support to File API")
    			}
    		});

    		function removeItem(event) {
    			console.log(event);
    			let name = $(event).attr('d-name');
    			
    			$(event).parent(".pip").remove();
    			for(let i = 0; i < dt.items.length; i++){
    				console.log("ius ",dt.items[i].getAsFile().name);
    			// Correspondance du fichier et du nom
    			if(name === dt.items[i].getAsFile().name){
    				// Suppression du fichier dans l'objet DataTransfer
    				dt.items.remove(i);
    				continue;
    			}
    		}
    		document.getElementById('files').files = dt.files;

    	}
    </script>

    <script>
        // $(function() {
        //     $('.brand').change(function() {
        //         var brand_id = $(this).children("option:selected").val();

        //         function fillSeries(series) {
        //             document.getElementById("series_product").innerHTML =
        //             series.reduce((tmp, x) => `${tmp}<option value='${x.id}'>${x.model_name}</option>`, '');
        //         }

        //         function fetchBrands(brand_id) {
        //             var uri = "{{ route('getSeries', ':no') }}";
        //             uri = uri.replace(':no', brand_id);
        //             $.ajax({
        //                 url: uri,
        //                 type: 'get',
        //                 dataType: 'json',
        //                 success: function(response) {
        //                     var series = response;
        //                     console.log(series);
        //                     fillSeries(series);
        //                 }
        //             });
        //         }
        //         fetchBrands(brand_id);
        //     })
        // });
    </script>
@endpush
