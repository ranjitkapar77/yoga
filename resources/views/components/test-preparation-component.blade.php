<section class="what-looking-for pos-rel">
    <div class="what-blur-shape-one"></div>
    <div class="what-blur-shape-two"></div>
    <div class="what-look-bg gradient-bg pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
        <div class="container">
            <div class="categoris-container">
                <div class="col-xl-12">
                    <div class="section-title text-center mb-55">
                        {{-- <h2>{{ $globalExtra->firstWhere('key', 'test-preparation')->value }}</h2> --}}
                        {{-- <p>{!! $globalExtra->firstWhere('key', 'test-preparation')->description !!}</p> --}}
                    </div>
                </div>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-3 row-cols-xl-5">
                    @foreach ($test as $course)
                        <div class="col">
                            <div class="single-category text-center mb-30 wow fadeInUp2 animated" data-wow-delay='.1s'>
                                <img class="mb-30"
                                    src="{{ Storage::disk('uploads')->url($course->icon) }}" alt="images"
                                    alt="">
                                <h4 class="sub-title mb-10"><a href="{{route('testpreprationsdetails', $course->slug)}}">{{ $course->title }}</a></h4>
                                {{-- @if ($count > '0')
                                    <p>{{ $count }}+ Courses Available</p>
                                @endif --}}
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-12 mt-20 text-center mb-20 wow fadeInUp2 animated" data-wow-delay='.6s'>
                        <a href="@php echo url('/testprepration'); @endphp" class="theme_btn">All Categories</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
