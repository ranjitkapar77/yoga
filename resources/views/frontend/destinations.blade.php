@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!--page-title-area start-->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{asset('frontend/img/banner.jpg')}});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{url()->current()}}">{{$title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <section class="feature-course pb-130 pt-150 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                     <div class="section-title text-center mb-30">
                         <h5 class="bottom-line mb-25">Study In </h5>
                         <h2>Explore our Popular Destinations</h2>
                     </div>
                 </div>
            </div>
            <div class="row">
                <ul class="destination__list">
                    @foreach ($allDestination as $destination)
                    <li class="glide__slide mb-1" style="margin-left: 6px; margin-right: 6px; width: 280.667px;">
                        <a href="{{route('courseDestination', $destination->slug)}}" class="card card--destination">
                            <figure class="card-img-top">
                                <img src="{{Storage::disk('uploads')->url($destination->image); }}">
                            </figure>
                            <h5 class="card-title">
                                {{$destination->title}}
                            </h5>
                            <div class="card-body d-flex justify-content-between">
                                <span class="link">
                                    Learn more
                                </span>
                                <i class="fas fa-chevron-right"></i>
                            </div>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>
    <!-- feature-course end -->
@endsection
