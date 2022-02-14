@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">Services</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="{{route('index')}}">Home - Pages -</a></li>
                              <li><a href="{{ url()->current() }}">Services</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Blog Page -->
    <section class="blog-area">
        <div class="blog-bg pt-150 pb-120 pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="section-title text-center mb-60">
                            <h2 class="mb-25">Our Services</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($services as $blog)
                    <div class="col-lg-3 col-md-6">
                        <div class="z-blogs mb-30">
                            <div class="z-blogs__thumb mb-30">
                            <a href="{{route('servicedetail', $blog->slug)}}"><img src="{{ Storage::disk('uploads')->url($blog->cover_image) }}" alt="blog-img"></a>
                            </div>
                            <div class="z-blogs__content">
                                <h5 class="mb-25">{{ $blog->meta_keyword }}</h5>
                                <h4 class="sub-title mb-15"><a href="{{route('servicedetail', $blog->slug)}}">{{ $blog->title }}</a></h4>
                                <div class="z-blogs__meta d-sm-flex justify-content-between pt-20">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                {{ $services->links() }}
            </div>
        </div>
    </section>
    <!-- Blog Page End -->

@endsection
