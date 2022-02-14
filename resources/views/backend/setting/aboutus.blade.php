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
                    <h1 class="m-0">About Us</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">About Us</li>
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
                                    <form action="{{ route('setting.update', $setting->id) }}" method="POST">
                                        @csrf
                                        @method("PUT")
                                            <div class="row">
                                                <div class="col-md-12 text-center">
                                                    <h3>About Us</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="About Us">Fill the Details :</label>
                                                        <textarea name="aboutUs" id="summernote" class="form-control">{!! $setting->aboutus !!}</textarea>
                                                        <p class="text-danger">
                                                            {{ $errors->first('aboutUs') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center mt-4">
                                                    <h3>Mission, Vision and Values</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="mission">Mission :</label>
                                                        <textarea name="mission" cols="20" rows="5" class="form-control" id="summernote1">{{ $mission->mission }}</textarea>
                                                        <p class="text-danger">
                                                            {{ $errors->first('mission') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="vision">Vision :</label>
                                                        <textarea name="vision" cols="20" rows="5" class="form-control" id="summernote2">{{ $mission->vision }}</textarea>
                                                        <p class="text-danger">
                                                            {{ $errors->first('vision') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="company_values">Our Values :</label>
                                                        <textarea name="company_values" cols="20" rows="5" class="form-control" id="summernote3">{{ $mission->company_values }}</textarea>
                                                        <p class="text-danger">
                                                            {{ $errors->first('company_values') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 text-center">
                                                    <h3>Welcome Message</h3>
                                                    <hr>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="welcome_title">Welcome Message Title :</label>
                                                        <input type="text" class="form-control" placeholder="Welcome Title" name="welcome_title" value="{{ $mission->welcome_title }}">
                                                        <p class="text-danger">
                                                            {{ $errors->first('welcome_title') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="welcome_sub_title">Welcome Sub Title :</label>
                                                        <input type="text" class="form-control" placeholder="Sub Title" name="welcome_sub_title" value="{{ $mission->welcome_sub_title }}">
                                                        <p class="text-danger">
                                                            {{ $errors->first('welcome_sub_title') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="Youtube">Give Your Youtube Link:</label>
                                                        <input type="text" name="youtube_link" class="form-control" placeholder="Give your youtube channel link.." value="{{ $mission->youtube_link }}">
                                                        <p class="text-danger">
                                                            {{ $errors->first('youtube_link') }}
                                                        </p>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="welcome_message">Welcome Message :</label>
                                                        <textarea name="welcome_message" cols="30" rows="5" class="form-control" placeholder="Welcome message for visitors.." id="summernote4">{{ $mission->welcome_message }}</textarea>
                                                        <p class="text-danger">
                                                            {{ $errors->first('welcome_message') }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" class="btn btn-success" name="about_us">Submit</button>
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
<!-- summernote js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

<script type="text/javascript">
    $('#summernote').summernote({
        height: 300,
        placeholder: "About Us Details.."
    });
    $('#summernote1').summernote({
        height: 200,
        placeholder: "Company Mission.."
    });

    $('#summernote2').summernote({
        height: 200,
        placeholder: "Company Vision.."
    });

    $('#summernote3').summernote({
        height: 200,
        placeholder: "Company Values.."
    });

    $('#summernote4').summernote({
        height: 200,
        placeholder: "Message in details.."
    });
</script>
@endpush
