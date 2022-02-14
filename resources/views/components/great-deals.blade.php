<section class="great-deal-area pt-150 pt-md-100 pt-xs-100 pb-xs-40">
    <div class="container">
        <div class="row justify-content-lg-center justify-content-start">
            <div class="col-xl-3 col-lg-8">
                <div class="deal-box mb-30 text-center text-xl-start">
                    <h2 class="mb-20"><b>{{ $globalExtra->firstWhere('key', 'services-1')->value }} </b>
                        {{ $globalExtra->firstWhere('key', 'services-1')->value_1 }}</h2>
                    <p>{!! $globalExtra->firstWhere('key', 'services-1')->description !!}</p>
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
