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
@if (session('success'))
    <div class="col-sm-4 success-message">
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    </div>
@endif
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
        <!--slider-area start-->
        <section class="slider-area  pt-xs-150 pb-xs-35">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    @foreach ($sliders as $key => $slider)
                        <button type="button" data-bs-target="#carouselExampleCaptions"
                            data-bs-slide-to="{{ $key }}"
                            class="@if ($loop->first)
                        {{ 'active' }}
                    @endif"
                            aria-current="true" aria-label="Slide {{ $key + 1 }}"></button>
                    @endforeach
                </div>
                <div class="carousel-inner">
                    {{-- @dd($sliders); --}}
                    @foreach ($sliders as $key => $slider)
                        <div
                            class="carousel-item   @if ($loop->first)
                    {{ 'active' }}
                @endif ">
                            <img src="{{ Storage::disk('uploads')->url($slider->location) }}"
                                alt="{{ $slider->title }}">
                        </div>
                    @endforeach
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!--slider-area end-->
        <!--great-deal-area start-->
        <x-great-deals />
        <!--great-deal-area end-->
        <x-what-looking />
        <x-test-preparation-component />
        <!-- case-gallery start -->
        <section class="feature-course pt-150 pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="section-title text-center mb-50">
                            <h2>{{ $extras->firstWhere('key', 'destination-h2-p')->value }}</h2>
                            <p>{!! $extras->firstWhere('key', 'destination-h2-p')->description !!}</p>
                        </div>
                    </div>
                </div>
                <x-destination-component />
                <div class="row">
                    <div class="col-lg-12 mt-20 text-center mb-20 wow fadeInUp2 animated" data-wow-delay='.3s'>
                        <a href="{{ route('destination') }}" class="theme_btn">All Destination</a>
                    </div>
                </div>
            </div>
        </section>
        <!-- case-gallery end -->
        <!-- why-chose-section-wrapper start -->
        <div class="why-chose-section-wrapper gradient-bg mr-100 ml-100">
            <!-- why-chose-us start -->
            <x-why-choose-us-component />
            <!-- why-chose-us end -->
            <!-- course-instructor start -->
            <x-team-component />
            <!-- course-instructor end -->
        </div>
        <!-- why-chose-section-wrapper start -->
        <!-- testimonial-area start -->
        <section class="testimonial-area testimonial-pad pt-150 pb-120 pt-md-95 pb-md-70 pt-xs-95 pb-xs-70">
            <div class="container custom-container-testimonial">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center text-md-start mb-35">
                            <h5 class="bottom-line mb-25">Our students share their journey</h5>
                            <h2 class="mb-25">Student Stories</h2>
                        </div>
                    </div>
                    <div class="col-lg-4 text-center text-lg-end">
                        <a href="instructor.html" class="theme_btn">Read All Reviews</a>
                    </div>
                </div>
                <div class="row testimonial-active-01">
                    @foreach ($testimonials as $testimonial)
                        <div class="col-xl-3">
                            <div class="item">
                                <div class="testimonial-wrapper mb-30">
                                    <div class="testimonial-authors overflow-hidden mb-15">
                                        <div class="testimonial-authors__avatar">
                                            <img src="{{ Storage::disk('uploads')->url($testimonial->image) }}"
                                                alt="testi-author">
                                        </div>
                                        <div class="testimonial-authors__content mt-10">
                                            <h4 class="sub-title">{{ $testimonial->staff_name }}</h4>
                                            <p>{{ $testimonial->staff_position }}</p>
                                        </div>
                                    </div>
                                    <p>{{ $testimonial->message }}</p>
                                    <div class="quote-icon mt-20">
                                        <img src="{{ asset('frontend/assets/img/icon/quote.svg') }}" alt="quote-icon">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach


                </div>
            </div>
        </section>
        <!-- testimonial-area end -->
        <!-- blog-area start -->
        <section class="blog-area mr-100 ml-100">
            <div class="blog-bg gradient-bg pl-100 pr-100 pt-150 pb-120 pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title text-center mb-60">

                                <h2 class="mb-25">What students are reading</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($news as $value)
                        <div class="col-lg-4 col-md-6">
                            <div class="z-blogs mb-30 wow fadeInUp2 animated" data-wow-delay='.1s'>
                                <div class="z-blogs__thumb mb-30">
                                    <a href="{{route('newsdetail', $value->slug)}}"><img src="{{ Storage::disk('uploads')->url($value->cover_image) }}"
                                            alt="blog-img"></a>
                                </div>
                                <div class="z-blogs__content">
                                    <h5 class="mb-25">{{$value->meta_keywords}}</h5>
                                    <h4 class="sub-title mb-15"><a href="{{route('newsdetail', $value->slug)}}">{{$value->title}}</a></h4>
                                    <div class="z-blogs__meta d-sm-flex justify-content-between pt-20">
                                        <span>Date : {{date('M-d-Y', strtotime($value->created_at));}}</span>
                                        <span>By: {{$value->author}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center mt-20 mb-30 wow fadeInUp2 animated" data-wow-delay='.4s'>
                            <a href="{{route('news')}}" class="theme_btn">Load More</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- blog-area end -->
        <!-- subscribe-area start -->
        <section class="subscribe-area border-bot pt-145 pb-50 pt-md-90 pt-xs-90">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8">
                        <div class="subscribe-wrapper text-center mb-30">
                            <h2>Subscribe our Newsletter & Get every updates.</h2>
                            <div class="subscribe-form-box pos-rel">
                                <form method="POST" action="{{route('subscribefront')}}" class="subscribe-form">
                                    @csrf
                                    <input type="email" name="email" placeholder="Write Your E-mail">
                                    <button type="submit" class="sub_btn">Subscribe Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- subscribe-area end -->
    </main>

@endsection
