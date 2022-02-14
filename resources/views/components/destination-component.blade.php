<div class="row justify-content-center">
    <div class="col-xl-12 text-center">
        <div class="portfolio-menu mb-30">
            <button class="gf_btn active" data-filter='*'>All</button>
            @foreach ($destinations as $destination)
                <button class="gf_btn"
                    data-filter='.cat{{ $destination['id'] }}'>{{ $destination['title'] }}</button>
            @endforeach
        </div>
    </div>
</div>
<div class="grid row">
    @foreach ($courses as $course)
        <div
            class="col-lg-4 col-md-6 grid-item       @foreach ($course->destination as $item)
            cat{{ $item }}
        @endforeach">

            <div class="z-gallery mb-30">
                <div class="z-gallery__thumb mb-20">
                    <a href="{{route('courseDetails', $course->slug)}}">
                        <img class="img-fluid" src="{{ image($course->image) }}" alt="images" alt=""></a>
                </div>
                <div class="z-gallery__content">
                    <h4 class="sub-title mb-20"><a href="{{route('courseDetails', $course->slug)}}">{{ $course->title }}</a></h4>
                </div>
            </div>
        </div>
    @endforeach
</div>
