<!--what-loking-for start-->
<section class="what-looking-for pos-rel">
    <div class="what-blur-shape-one"></div>
    <div class="what-blur-shape-two"></div>
    <div class="what-look-bg gradient-bg pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title text-center mb-55">

                        <h2>{{ $globalExtra->firstWhere('key', 'what-you-looking')->value }}</h2>
                    </div>
                </div>
            </div>
            <div class="row mb-85">
                @foreach ($content as $value)
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="what-box text-center mb-35 wow fadeInUp2 animated" data-wow-delay='.3s'>
                            <div class="what-box__icon mb-30">
                                <img src="{{ Storage::disk('uploads')->url($value->featured_img) }}" alt="images">
                            </div>
                            <h3>{{ $value->content_title }}</h3>
                            <p>{!! $value->content_body !!}</p>
                            <a href="{{$value->external_link}}" class="theme_btn border_btn">Register Now</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</section>
<!--what-loking-for end-->
