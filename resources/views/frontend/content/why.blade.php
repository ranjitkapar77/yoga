
@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')

<!--page-title-area start-->
<section class="page-title-area d-flex align-items-end" style="background-image: url({{Storage::disk('uploads')->url($content->freezone_img); }})">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-12">
                <div class="page-title-wrapper mb-50">
                   <h1 class="page-title mb-25">{{$content->content_title}}</h1>
                   <div class="breadcrumb-list">
                      <ul class="breadcrumb">
                          <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                          <li><a href="{{url()->current()}}">{{$content->content_title}}</a></li>
                      </ul>
                   </div>
              </div>
            </div>
        </div>
    </div>
</section>
<!--page-title-area end-->
<!-- faq-area start -->
 <section class="faq-area pt-150 pb-120 pt-xs-95 pb-xs-90">
  <div class="container">
      <div class="row align-items-center">
          <div class="col-lg-12">
              <div class="faq-que-list mb-30">
                  <div class="section-title text-center mb-45">
                      <h2 class="mb-25">Frequently Asked Question</h2>
                  </div>
                  <div class="accordion accordion-two" id="accoedion-ex-two">
                      @foreach ($faq as $value )
                      <div class="accordion-item mb-30">
                          <h2 class="accordion-header" id="heading{{$value->id}}">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{$value->id}}" aria-expanded="true" aria-controls="collapse{{$value->id}}">
                                  {{$value->content_title}}
                              </button>
                          </h2>
                          <div id="collapse{{$value->id}}" class="accordion-collapse collapse @if ($loop->first) {{ 'show' }} @endif" aria-labelledby="heading{{$value->id}}" data-bs-parent="#accoedion-ex-two">
                              <div class="accordion-body">
                                 <p>{!! $value->content_body !!}</p>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>
              </div>
              <div class="faq-btn text-center mt-50">
                  <a href="@php echo url('/contact'); @endphp" class="theme_btn faq_btn">Add Your Questions</a>
              </div>
          </div>
      </div>
  </div>
 </section>
 <!-- faq-area end -->
 @endsection
