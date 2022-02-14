@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{ $services->banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($services->banner_image) }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$services->title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{url()->current()}}">{{$services->title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->
    <section class="blog-details-area pt-150 pb-105 pt-md-100 pb-md-55 pt-xs-100 pb-xs-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="blog-details-box mb-45">
                                <h2>{{$services->title}}</h2>
                                <ul class="blogs__meta mb-30">
                                <li><span class="blog-author">By {{$services->author}}</span></li>
                                <li><span><img src="{{asset('frontend/assets/img/icon/material-date-range.svg')}}" alt="mate-date"> {{date('M-d-Y', strtotime($services->created_at));}}</span></li>
                                <li>
                                    <div class="social-media blog-details-social">
                                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                                            <a href="#"><i class="fab fa-instagram"></i></a>
                                            <a href="#"><i class="fab fa-youtube"></i></a>
                                            <a href="#"><i class="fab fa-twitter"></i></a>
                                        </div>
                                    </li>
                                </ul>
                                <h3 class="blog-details-title mb-30">{{$services->descriptive_title}}</h3>
                                <p>{!!$services->content!!}</p>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="blog-details-box">
                                <img class="img-fluid blog-details-img mb-35" src="{{Storage::disk('uploads')->url($services->cover_image)}}" alt="blog-details-img">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
