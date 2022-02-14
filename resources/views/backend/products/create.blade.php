@extends('backend.layouts.app')
@push('styles')
    <style>
        .imgPreview img {
            padding: 8px;
            max-width: 150px;
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
                                    <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("POST")
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Product Name">Product Name :</label>
                                                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name">
                                                    <p class="text-danger">
                                                        {{ $errors->first('product_name') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6"></div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Brand">Related Brand :</label>
                                                    <select name="brand" class="form-control brand">
                                                        <option value="">--Select a Brand--</option>
                                                        @foreach ($brands as $brand)
                                                            <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('product_name') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="series">Related Model<i class="text-danger">*</i> :</label>
                                                    <select name="series" class="form-control series" id="series_product">
                                                        <option value="">--Select a Brand first--</option>
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('series') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
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
                                                    <label for="Price (In Rs.)">Price (In Rs.) :</label>
                                                    <input type="text" class="form-control" name="price" placeholder="Enter Price (In Rs.)">
                                                    <p class="text-danger">
                                                        {{ $errors->first('price') }}
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
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Brief Description (Shows at the side of product):</label>
                                                <textarea name="brief_description" class="form-control" cols="30" rows="5" placeholder="Brief Description.."></textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('brief_description') }}
                                                </p>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Product Description (Shows at description section):</label>
                                                <textarea name="product_description" class="form-control" id="summernote"></textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('product_description') }}
                                                </p>
                                            </div>

                                            <div class="col-md-6">
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
                                            </div>


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
    </script>

    <script>
        $(function() {
            $('.brand').change(function() {
                var brand_id = $(this).children("option:selected").val();

                function fillSeries(series) {
                    document.getElementById("series_product").innerHTML =
                    series.reduce((tmp, x) => `${tmp}<option value='${x.id}'>${x.model_name}</option>`, '');
                }

                function fetchBrands(brand_id) {
                    var uri = "{{ route('getSeries', ':no') }}";
                    uri = uri.replace(':no', brand_id);
                    $.ajax({
                        url: uri,
                        type: 'get',
                        dataType: 'json',
                        success: function(response) {
                            var series = response;
                            console.log(series);
                            fillSeries(series);
                        }
                    });
                }
                fetchBrands(brand_id);
            })
        });
    </script>
@endpush
