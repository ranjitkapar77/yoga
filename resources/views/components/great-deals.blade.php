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
                                <img src="{{ Storage::disk('uploads')->url($service->cover_image) }}" alt="{{ $service->title }}">
                            </div>
                            <div class="service_caption">
                                <p>{{ $service->title }}</p>
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
<!--great-deal-area end-->
