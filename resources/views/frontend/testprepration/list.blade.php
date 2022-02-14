@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')

<main>

    <section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">Test Prepration</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="{{route('index')}}">Home - Pages -</a></li>
                              <li><a href="{{ url()->current() }}">Test Prepration</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->
    <section class="what-looking-for pos-rel">
        <div class="what-blur-shape-one"></div>
        <div class="what-blur-shape-two"></div>
        <div class="what-look-bg gradient-bg pt-40 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
            <div class="container">
                <div class="categoris-container">
                    <div class="col-xl-12">
                        <div class="section-title text-center mb-55">
                            <h2>{{ $globalExtra->firstWhere('key', 'test-preparation')->value }}</h2>
                            <p>{!! $globalExtra->firstWhere('key', 'test-preparation')->description !!}</p>
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
                </div>
            </div>
        </div>
    </section>

    @endsection
