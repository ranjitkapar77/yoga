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
<section id="site_banner" class="wow bounceInDown ">
    <div id="site_slider_o" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach ($sliders as $key => $slider)
            <div class="carousel-item @if ($loop->first) {{ 'active' }} @endif">
                <img src="{{ Storage::disk('uploads')->url($slider->location) }}" class="d-block w-100" alt="{{ $slider->title }}">
                <div class="carousel-caption d-none d-md-block">
                    <h5>{{ $slider->title }}</h5>
                    <a href="#" class="btn btn-secondary">Book an appoinment</a>
                </div>
            </div>
            @endforeach
            <div class="show_down">
                <a href="#about_cover"> <i class="las la-angle-double-down"></i></a>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#site_slider_o" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#site_slider_o" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>
<!--about-area start-->
<x-about />
<!--about-area end-->
<!--Service-area start-->
<x-great-deals />
<!--Service-area end-->

<section id="testimonial_cover" class="o_buttom_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto text-center">
                <div class="site_title wow bounceInDown">
                    <h3><span>Clients Testimonials</span></h3>
                    <p><i>We thrive when you do; we value your experience.</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="owl_slider">
                    <div class="owl-carousel" id="testimonial_carousel">
                        <div>
                            <div class="testimonial_items text-center wow bounceInUp" data-wow-delay="0.5s">
                                <div class="testimonial_images">
                                    <img src="{{asset('frontend/images/t1.jpg') }}" alt="">
                                </div>
                                <h4>Palzom Pradhan</h4>
                                <span>Nepal</span>
                                <p>Hi, I enjoyed the first class today. Looking forward to restoring my flexibility this
                                    month.</p>
                                <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="testimonial_items text-center wow bounceInUp" data-wow-delay="0.7s">
                                <div class="testimonial_images">
                                    <img src="{{asset('frontend/images/t1.jpg') }}" alt="">
                                </div>
                                <h4>Palzom Pradhan</h4>
                                <span>Nepal</span>
                                <p>Hi, I enjoyed the first class today. Looking forward to restoring my flexibility this
                                    month.</p>
                                <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                            </div>
                        </div>
                        <div>
                            <div class="testimonial_items text-center wow bounceInUp" data-wow-delay="0.9s">
                                <div class="testimonial_images">
                                    <img src="{{asset('frontend/images/img_avatar.png') }}" alt="">
                                </div>
                                <h4>Palzom Pradhan</h4>
                                <span>Nepal</span>
                                <p>Hi, I enjoyed the first class today. Looking forward to restoring my flexibility this
                                    month.</p>
                                <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="events_cover" class="o_buttom_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto text-center">
                <div class="site_title wow bounceInDown">
                    <h3><span>Latest News & Events</span></h3>
                    <p><i>Read some of our news and events</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <div class="event_thumbnail wow bounceInUp">
                    <div class="event_thumbnail_images">
                        <img src="{{asset('frontend/images/c1.jpg') }}" alt="">
                    </div>
                    <div class="event_caption">
                        <h4>SOUND BATH - FEBRUARY, 2022</h4>
                        <p>Come lay your mind to rest and find your center again with Ramesh.</p>
                        <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="event_thumbnail wow bounceInUp">
                    <div class="event_thumbnail_images">
                        <img src="{{asset('frontend/images/c2.jpg') }}" alt="">
                    </div>
                    <div class="event_caption">
                        <h4>YOGA HIKE - MARCH, 2022</h4>
                        <p>We are so excited to announce our first Yoga & Hike class happening this March.
                            Take a.</p>
                        <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="event_thumbnail wow bounceInUp">
                    <div class="event_thumbnail_images">
                        <img src="{{asset('frontend/images/c3.jpg') }}" alt="">
                    </div>
                    <div class="event_caption">
                        <h4>TRATAKA MEDITATION - APRIL, 2022</h4>
                        <p>Trataka (or candle gazing) is a powerful and potent tech...</p>
                        <a href="#" class="btn btn-secondary">Read More<i class="las la-angle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
