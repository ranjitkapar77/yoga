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
        .field_wrapper div {
            position: relative;
            display: flex;
            margin-bottom: 10px;
        }

        .field_wrapper a {
            float: right;
            margin-left: 10px;
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
                    <h1 class="m-0">Edit Plan Price <a href="{{ route('pricing.index') }}" class="btn btn-primary">View Plan Price</a></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Plan Price</li>
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
                                    <form action="{{ route('pricing.update', $price->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method("PUT")
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Title</label>
                                                    <input type="text" name="title" class="form-control" placeholder="Enter title" value="{{ $price->title }}">
                                                    <p class="text-danger">
                                                        {{$errors->first('title')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="plantype_id">Plan Type</label>
                                                    <select class="form-control" name="plantype_id" id="">
                                                        @foreach ($plantype as $plan)
                                                            <option value="{{$plan->id}}"{{ $plan->id == $price->plantype_id ? 'selected' : ''}}>{{$plan->title}}</option>
                                                        @endforeach
                                                    </select>
                                                    <p class="text-danger">
                                                        {{$errors->first('plantype_id')}}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="regular_price">Regular Price</label>
                                                    <input type="text" value="{{ $price->regular_price }}" name="regular_price" placeholder="Enter regular_price Url" class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('regular_price') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="offer_price">Offer Price</label>
                                                    <input type="text" value="{{ $price->offer_price }}" name="offer_price" placeholder="Enter offer_price Url " class="form-control">
                                                    <p class="text-danger">
                                                        {{ $errors->first('offer_price') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <div class="form-group">
                                                    <label for="offer_price">Features</label>
                                                    <div class="field_wrapper new_field">
                                                        <div>

                                                            <a href="javascript:void(0);" class="add_button" title="Add field"><img src="{{asset('frontend/img/add-icon.png')}}"/></a>
                                                        </div>
                                                    </div>
                                                    @foreach ($features as $value)
                                                    <div class="field_wrapper">
                                                        <div>
                                                            <input type="text" name="features[]" value="{{ $value->features }}" placeholder="Enter features " class="form-control">
                                                            <a href="javascript:void(0);" class="remove_button" title="Add field"><img src="{{asset('frontend/img/remove-icon.png')}}"/></a>
                                                        </div>
                                                    </div>
                                                    @endforeach

                                                    <p class="text-danger">
                                                        {{ $errors->first('features') }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="Active">Active: </label>
                                                    <label class="switch pt-0">
                                                        <input type="checkbox" name="active" value="1" value="1"{{ $price->status == 1 ? 'checked' : '' }}>
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
    <script type="text/javascript">
        $(document).ready(function(){
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.new_field'); //Input field wrapper
            var fieldHTML = '<div><input type="text" placeholder="Enter features " class="form-control" name="features[]" value="{{ @old('features') }}"/><a href="javascript:void(0);" class="remove_button"><img src="{{asset('frontend/img/remove-icon.png')}}"/></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function(){
                //Check maximum number of input fields
                if(x < maxField){
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e){
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script>
@endpush
