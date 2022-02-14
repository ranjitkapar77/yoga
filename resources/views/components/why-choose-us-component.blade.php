<section class="why-chose-us">
    <div class="why-chose-us-bg pt-md-95 pb-md-90 pt-xs-95 pb-xs-90">
        <div class="container">
            @foreach ($why as $choose)
                <div class="row align-items-center">
                    <div class="col-xl-7 col-lg-7">
                        <div class="chose-img-wrapper mb-50 pos-rel">
                            <div class="coures-member">
                                <h5>Total Students</h5>
                                <span>25k+</span>
                            </div>
                            <div class="feature tag_01"><span><img
                                        src="{{asset('frontend/assets/img/icon/shield-check.svg')}}"
                                        alt="choose_title_1"></span> Safe &secure </div>
                            <div class="feature tag_02"><span><img
                                        src="{{asset('frontend/assets/img/icon/catalog.svg')}}"
                                        alt="choose_title_2"></span> 120+ Catalog </div>
                            <div class="feature tag_03"><span><i class="fal fa-check"></i></span>
                                Quality Education</div>
                            <div class="video-wrapper">
                                <a href="#" class="popup-video"><i
                                        class="fas fa-play"></i></a>
                            </div>
                            <div class="img-bg pos-rel">
                                <img class="chose_05 pl-70 pl-lg-0 pl-md-0 pl-xs-0"
                                    src="{{ Storage::disk('uploads')->url($choose->featured_img) }}" alt="">
                            </div>
                            <img class="chose chose_06"
                                src="{{ asset('frontend/assets/img/shape/dot-box3.svg') }}" alt="Chose-img">
                        </div>
                    </div>
                    <div class="col-xl-5 col-lg-5">
                        <div class="chose-wrapper pl-25 pl-lg-0 pl-md-0 pl-xs-0">
                            <div class="section-title mb-30 wow fadeInUp2 animated" data-wow-delay='.1s'>
                                <h5 class="bottom-line mb-25">{{ $choose->page_title }}</h5>
                                <h2 class="mb-25">{{ $choose->content_title }}</h2>
                                <P>{!! $choose->content_body !!}</P>
                            </div>
                            <ul class="text-list mb-40 wow fadeInUp2 animated" data-wow-delay='.2s'>
                                @foreach ($faqs as $faq)
                                <li>{{$faq->content_title}}</li>
                                @endforeach

                            </ul>
                            <a href="{{route('contentdetail', $choose->content_url)}}" class="theme_btn wow fadeInUp2 animated"
                                data-wow-delay='.3s'>More Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
