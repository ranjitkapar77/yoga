<section class="course-instructor nav-style-two pos-rel">
    <div class="course-blur-shape"></div>
    <div class="course-bg-space pt-150 pb-120 pt-md-95 pb-md-70 pt-xs-95 pb-xs-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-8 col-lg-9">
                    <div class="section-title text-center text-md-start mb-60">
                        <h5 class="bottom-line mb-25">{{ $globalExtra->firstWhere('key', 'our-team')->value }}
                        </h5>
                        <h2 class="mb-25">{{ $globalExtra->firstWhere('key', 'our-team')->value_1 }}</h2>
                    </div>
                </div>
            </div>
            <div class="instructor-active owl-carousel">
                @foreach ($teams as $team)
                    <div class="item">
                        <div class="z-instructors text-center mb-30">
                            <div class="z-instructors__thumb mb-15">
                                <img class="mb-30"
                                    src="{{ Storage::disk('uploads')->url($team->image) }}" alt="images"
                                    alt="">
                                <div class="social-media">
                                    <a href="{{ $team->facebook }}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{ $team->linkedin }}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{ $team->youtube }}"><i class="fab fa-instagram"></i></a>
                                    <a href="{{ $team->twitter }}"><i class="fab fa-youtube"></i></a>
                                </div>
                            </div>
                            <div class="z-instructors__content">
                                <h4 class="sub-title mb-10"><a
                                        href="{{route('teamdetail', $team->slug)}}">{{ $team->name }}</a></h4>
                                <p>{{ $team->post }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</section>
