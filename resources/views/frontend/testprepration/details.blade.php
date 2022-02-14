@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@push('styles')
<style>
    span.select2-selection.select2-selection--single {
        display: none;
    }
    span.select2.select2-container {
        width: 100% !important;
    }
    span.select2-selection.select2-selection--multiple {
    border-color: #ddd;
    padding-top: 10px;
    padding-bottom: 10px;
}
label.front-sel-leb {
    font-weight: 600;
    color: #000;
    font-size: 16px;
    padding-left: 30px;
}
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')

<main>
    <div class="container">
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
    </div>
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$details->title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{ url()->current() }}">{{$details->title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <section class="mt-40">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="test-details">
                        <h3>{{$details->title}}</h3>
                        <h4>{{$details->page_title}}</h4>
                        <p>{{$details->description}}</p>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="contact-form-wrapper  mb-30">
                        <form action="{{route('testpreprationbooking')}}" method="post" class="row gx-3 comments-form contact-form">
                            @csrf
                            <div class="col-lg-12 col-md-12 mb-30">
                                <input type="text" name="name" required placeholder="Full Name">
                            </div>
                            <div class="col-lg-12 mb-30">
                                <input type="email" name="email" required placeholder="Email Name">
                            </div>
                            <div class="col-lg-12 col-md-12 mb-30">
                                <input type="text" name="phone" required placeholder="Phone Number">
                            </div>
                            <div class="col-lg-12 col-md-12 ">
                                <label class="front-sel-leb">Select Test Prepration Classes</label><br>
                                <select class="testprp-multy" name="testprepration_id[]" multiple="multiple">
                                    @foreach ($test as $tst)
                                    <option value="{{$tst->id}}">{{$tst->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12">
                                <label class="front-sel-leb">Select Destination</label><br>
                                <select class="form-group dest-multiple" name="destination_id[]" multiple="multiple">
                                    @foreach ($destination as $tst)
                                    <option  class="form-control" value="{{$tst->id}}">{{$tst->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 mb-30 text-center">
                                <button class="theme_btn book-btn ml-20 mt-20">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    $('.dest-multiple').select2();
});

$(document).ready(function() {
    $('.testprp-multy').select2();
});
</script>
@endpush
