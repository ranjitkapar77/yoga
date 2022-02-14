@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@push('styles')
    <style>
        .success-message {
            position: absolute !important;
            right: 0;
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
    <section class="banner"
        style="background-image: url({{ $blog->banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($blog->banner_image) }});">
        <div class="container">
            <div class="banner-wrap">
                <h1>Blog Details</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Blog Page -->
    <section class="blog-details mt mb">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-main">
                        <h2>{{ $blog->descriptive_title }}</h2>
                        <ul class="meta-tag">
                            <li><i class="las la-user-check"></i> {{ $blog->author }}</li>
                            <li><i class="las la-calendar-check"></i> {{ date('F j, Y', strtotime($blog->written_on)) }}
                            </li>
                        </ul>
                        <img src="{{ Storage::disk('uploads')->url($blog->cover_image) }}" alt="images">
                        @php
                            echo $blog->content;
                        @endphp
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="blog-sidebar">
                        <div class="blog-search">
                            <form action="" method="get">
                                <input type="text" name="search" class="form-control" placeholder="Search here....">
                                <button type="submit"><i class="las la-search"></i></button>
                            </form>
                        </div>
                        <div class="blog-sidebar-col">
                            <h3>Features</h3>
                            <ul class="features-point">
                                @foreach ($all_services as $service)
                                    <li><a href="/{{ $service->slug }}">{{ $service->title }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="blog-sidebar-col">
                            <h3>Recent News</h3>
                            <ul class="recent-news">
                                @foreach ($recent_blogs as $recblog)
                                    <li>
                                        <div class="rn-img">
                                            <a href="/{{ $recblog->slug }}"><img
                                                    src="{{ Storage::disk('uploads')->url($recblog->cover_image) }}"
                                                    alt="{{ $recblog->title }}"></a>
                                        </div>
                                        <div class="rn-content">
                                            <h3><a href="#">{{ $recblog->descriptive_title }}</a></h3>
                                            <span><i class="las la-calendar-check"></i>
                                                {{ date('F j, Y', strtotime($recblog->written_on)) }}</span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Page End -->

    <!-- Related Blog -->
    <section class="related-blog pt pb bg-grey">
        <div class="container">
            <div class="main-title">
                <div class="sub-title">
                    <span class="left"></span>
                    <h4>Check our News</h4>
                    <span class="right"></span>
                </div>
                <h3>Related Posts</h3>
            </div>
            <div class="row">
                @foreach ($related_blogs as $relblogs)
                    <div class="col-lg-4 col-md-6">
                        <div class="blog-wrap">
                            <div class="blog-img">
                                <a href="/{{ $relblogs->slug }}"><img
                                        src="{{ Storage::disk('uploads')->url($relblogs->cover_image) }}" alt="images"></a>
                            </div>
                            <div class="blog-content">
                                <h3><a href="/{{ $relblogs->slug }}">{{ $relblogs->descriptive_title }}</a></h3>
                                <div class="blog-btn">
                                    <a href="/{{ $relblogs->slug }}">Read More <i
                                            class="las la-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Related Blog End -->


@endsection
