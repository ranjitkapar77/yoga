@foreach ($about as $value)
<section id="about_cover" class="o_padding">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="about_thumbnail wow bounceInUp center">
                    <img src="{{asset('uploads/'.$value->featured_img) }}" alt="">
                </div>
            </div>
            <div class="col-lg-5 ms-auto">
                <div class="about_content wow bounceInUp center" data-wow-delay="0.5s">
                    <h4><span>{{$value->content_title}}</span> </h4>
                    {!! str_limit($value->content_body, 450) !!}
                    <a href="{{route('contentdetail',$value->content_url)}}" class="btn btn-link">Read More<i class="las la-angle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
@endforeach
