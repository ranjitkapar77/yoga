<section id="service_cover" class="o_buttom_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-5 m-auto text-center">
                <div class="site_title wow bounceInDown">
                    <h3><span>Our Services</span></h3>
                    <p><i>Take a deep breath, relax and let us take care of you. Join us for a complete mindful
                            experience.</i></p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="owl-carousel" id="services_os_slider">
                    @foreach ($services as $service)
                    <div>
                        <div class="service_thumbnail wow bounceInUp">
                            <div class="service_images">
                                <img src="{{asset('frontend/images/a1.jpg') }}" alt="">
                            </div>
                            <div class="service_caption">
                                <p>Yoga</p>
                                <a href="#" class="btn btn-secondary">Details<i class="las la-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>
<section class="great-deal-area pt-150 pt-md-100 pt-xs-100 pb-xs-40">
    <div class="container">
        <div class="row justify-content-lg-center justify-content-start">
            <div class="col-xl-3 col-lg-8">
                <div class="deal-box mb-30 text-center text-xl-start">
                    {{-- <h2 class="mb-20"><b>{{ $globalExtra->firstWhere('key', 'services-1')->value }} </b> --}}
                        {{-- {{ $globalExtra->firstWhere('key', 'services-1')->value_1 }}</h2> --}}
                    {{-- <p>{!! $globalExtra->firstWhere('key', 'services-1')->description !!}</p> --}}
                </div>
            </div>
            <div class="col-xl-8">
                <div class="deal-active owl-carousel mb-30">
                    @foreach ($services as $service)
                        <div class="single-item">
                            <div class="single-box mb-30">
                                <div class="single-box__icon mb-25">
                                    <img src="{{ Storage::disk('uploads')->url($service->icon) }}" alt="images">
                                </div>
                                <h4 class="sub-title mb-20">{{ $service->title }}</h4>
                                <p>{!! strlen($service->content) > 200 ? substr($service->content, 0, 50) : $service->content !!}</p>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
</section>
<!--great-deal-area end-->
