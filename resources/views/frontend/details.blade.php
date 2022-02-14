@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@push('styles')
    <style>
        .success-message{
            position: absolute !important;
            right:0;
            z-index: 1;
        }
    </style>
@endpush
@section('content')
    @if (session('success'))
        <div class="col-sm-4 success-message">
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        </div>
    @endif

        <!-- Banner -->
        <section class="banner" style="background-image: url({{$service->banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($service->banner_image)}});">
            <div class="container">
                <div class="banner-wrap">
                    <h1>{{$service->title}}</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{$service->title}}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </section>
        <!-- Banner End -->

        <!-- Details Page -->
        <section class="details-page mt mb">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-12">
                        <div class="details-sidebar">
                            <div class="details-list">
                                <h3>All Services List</h3>
                                <ul>
                                    @foreach ($all_services as $services)
                                    <li><a href="{{route('pageSlug', $services->slug)}}">{{$services->title}}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="details-list">
                                <h3>Get in Touch</h3>
                                <form action="{{route('message.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="name" class="form-control" placeholder="Name*">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control" placeholder="Email*" required="">
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="phone" placeholder="Phone Number" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" name="subject" placeholder="Subject" class="form-control">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                    </div>
                                    <div class="main-btn">
                                        <button type="submit" class="btn btn-danger">Send Message <i class="las la-angle-double-right"></i></button>
                                    </div>
                                </form>
                            </div>
                            {{-- <div class="details-list">
                                <h3>Get in Touch</h3>
                                <div class="download">
                                    <a href="#">Download Docs <i class="las la-file-medical-alt"></i></a>
                                    <a href="#">Download Pdf <i class="las la-file-pdf"></i></a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-12">
                        <div class="details-main">
                            <h2>{{$service->title}}</h2>
                            <img src="{{Storage::disk('uploads')->url($service->cover_image)}}" alt="images">
                            {!! $service->content !!}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Details Page End -->


@endsection
