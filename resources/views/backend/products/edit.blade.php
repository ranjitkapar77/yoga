@extends('backend.layouts.app')
@push('styles')
    <style>
        .imgPreview img {
            padding: 8px;
            max-width: 150px;
        }
    </style>
    <style>
        .wrapp {
            position: relative;
        }

        .absolutebtn {
            position: absolute;
            top: 0;
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
                    <h1 class="m-0">Update Product <a href="{{ route('products.index') }}" class="btn btn-primary">View Products</a></h1>
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
                                    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Product Name">Product Name :</label>
                                                    <input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="{{ $product->name }}">
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
                                                            <option value="{{ $brand->id }}"{{ $brand->id == $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name }}</option>
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
                                                        @foreach ($related_series as $series)
                                                            <option value="{{ $series->id }}"{{ $series->id == $product->series_id ? 'selected' : '' }}>{{ $series->model_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{ $errors->first('series') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Color">Color :</label>
                                                    <input type="text" class="form-control" name="color" placeholder="Eg: Red, Green" value="{{ $product->color }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('color') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Size">Size :</label>
                                                    <input type="text" class="form-control" name="size" placeholder="Eg: Medium" value="{{ $product->size }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('size') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Price (In Rs.)">Price (In Rs.) :</label>
                                                    <input type="text" class="form-control" name="price" placeholder="Enter Price (In Rs.)" value="{{ $product->price }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('price') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="">Warranty / Guarantee Time:</label>
                                                    <input type="text" class="form-control" name="guarantee_time" placeholder="Eg: 3 months" value="{{ $product->guarantee_time }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('guarantee_time') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Brief Description (Shows at the side of product):</label>
                                                <textarea name="brief_description" class="form-control" cols="30" rows="5" placeholder="Brief Description..">{{ $product->brief_description }}</textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('brief_description') }}
                                                </p>
                                            </div>

                                            <div class="col-md-12">
                                                <label for="">Product Description (Shows at description section):</label>
                                                <textarea name="product_description" class="form-control" id="summernote">{{ $product->main_description }}</textarea>
                                                <p class="text-danger">
                                                    {{ $errors->first('product_description') }}
                                                </p>
                                            </div>


                                            <div class="col-md-12 text-center mt-4">
                                                <hr>
                                                <h3>Meta Information</h3>
                                                <hr>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_title">Meta Title(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_title" placeholder="Meta Title for SEO" value="{{ $product->meta_title }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_title') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="meta_keywords">Meta Keywords(Optional): </label>
                                                    <input type="text" class="form-control" name="meta_keywords" placeholder="Meta Keywords for SEO" value="{{ $product->meta_keywords }}">
                                                    <p class="text-danger">
                                                        {{ $errors->first('meta_keywords') }}
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="meta-description">Meta Description (optional):</label>
                                                    <textarea name="meta_description" cols="30" rows="5" class="form-control" placeholder="Meta description..">{{ $product->meta_description }}</textarea>
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
                                                <img id="current_og" style="height: 100px;" src="{{ Storage::disk('uploads')->url($product->og_image ? $product->og_image : 'noimage.jpg') }}">
                                            </div>

                                            <div class="col-md-12 text-center mt-4">
                                                <button type="submit" class="btn btn-success" name="update">Submit</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>


                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <form action="{{ route('products.update', $product->id) }}"
                                                id="validate" enctype="multipart/form-data" method="POST">
                                                @csrf
                                                @method("PUT")

                                                <div class="form-group">
                                                    <label for="product_image">Attach file (Bills, etc.)<i class="text-danger">*</i></label>
                                                    <input type="file" name="product_images[]" id="product_image" class="form-control" multiple>
                                                </div>

                                                <input type="submit" id="add_receive" class="btn btn-success btn-large" name="update_images" value="Save" tabindex="9"/>
                                            </form>
                                        </div>
                                        <hr>

                                        <div class="col-md-12 mt-5 mb-5">
                                            @if (count($product_images) > 0)
                                                <div class="row">
                                                    @foreach ($product_images as $image)
                                                        <div class="col-md-3 wrapp">
                                                            <img src="{{ Storage::disk('uploads')->url($image->location) }}" alt="{{ $product->name }}" style="height: 200px;">
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
                                        </div>
                                    </div>
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
