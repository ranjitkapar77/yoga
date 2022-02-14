@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!--page-title-area start-->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{Storage::disk('uploads')->url($banner_image); }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$details->title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{url()->current()}}">{{$details->title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--page-title-area end-->
    <!--course-details-area start-->
    <section class="course-details-area pt-150 pb-120 pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
        <div class="container">
                <div class="row">
                    <div class="col-xxl-8 col-xl-7">
                        <div class="courses-details-wrapper mb-30">
                            <h2 class="courses-title mb-30">{{$details->title}}</h2>
                            <h5>{{$details->sub_title}}</h5>
                            <div class="course-details-img mb-30" style="background-image: url({{Storage::disk('uploads')->url($details->image); }});">
                                <div class="video-wrapper">
                                    @if($details->youtube_link != 'Null')
                                    <a href="{{$details->youtube_link}}" class="popup-video"><i class="fas fa-play"></i></a>
                                    @endif
                                </div>
                            </div>
                            <div class="courses-tag-btn">
                                @foreach ($destination as $dest )
                                <a href="{{route('courseDestination', $dest->slug)}}" target="_blank">{{$dest->title}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-4 col-xl-5">
                        <div class="learn-area mb-30">
                            <ul class="cart-list-tag d-sm-inline-flex align-items-center mb-50">
                                <li>
                                    <div class="price-list">
                                        <h5><b class="sub-title">{{$details->course_fee	}}</b> </h5>
                                    </div>
                                </li>
                                {{-- <li>
                                    <div class="cart-btn">
                                        <a class="theme_btn" href="#">Add To Cart</a>
                                    </div>
                                </li> --}}
                                @if($details->youtube_link != 'Null')
                                <li>
                                <div class="video-wrapper courses-cart-video">
                                    <a href="{{$details->youtube_link}}" class="popup-video"><i class="fas fa-play"></i></a>
                                </div>
                                </li>
                                @endif
                            </ul>
                            <div class="learn-box">
                                <h5>ACADEMIC ENTRY REQUIREMENTS </h5>
                                <div class="learn-list">
                                    <p>{!! $details->requirements !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-7">
                        <div class="project-details mb-65">
                            <h2 class="courses-title mb-30">{{$details->title}}</h2>
                            <p>{!! $details->content !!}</p>
                            <ul class="seller-rating d-md-inline-flex align-items-center mt-20 mb-10">
                                <li>
                                <div class="star-icon mb-10">
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#"><i class="fas fa-star"></i></a>
                                    <a href="#">4.8 ( 256,384)</a>
                                </div>
                                </li>
                            </ul>
                        </div>
                        {{-- <div class="skill-area">
                            <h2 class="courses-title mb-35">Related Skills</h2>
                            <div class="courses-tag-btn">
                                <a href="#">Photography</a>
                                <a href="#">Outdoor</a>
                                <a href="#">Indoor Photography</a>
                                <a href="#">DSLR</a>
                                <a href="#">Creative</a>
                                <a href="#">Camera</a>
                                <a href="#">Professional</a>
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-xl-6 col-lg-5">
                        <div class="courses-ingredients">
                            <h2 class="corses-title mb-30">Course Includes</h2>
                            <p></p>
                            <ul class="courses-item mt-25">
                                <li><img src="{{ asset('frontend/assets/img/icon/mobile.svg') }}" alt=""> <span><b>Intake Month :</b> {{$details->month_intake}}</span></li>
                                <li><img src="{{ asset('frontend/assets/img/icon/video.svg') }}" alt=""> <span><b>Qualification :</b> {{$details->qualification}}</span></li>
                                <li><img src="{{ asset('frontend/assets/img/icon/newspaper.svg') }}" alt=""> <span><b>Annual course fee :</b> {{$details->course_fee}}</span></li>
                                <li><img src="{{ asset('frontend/assets/img/icon/time.svg') }}" alt=""> <span><b>Course Duration :</b> {{$details->course_duration}}</span></li>
                                <li><img src="{{ asset('frontend/assets/img/icon/bar-chart.svg') }}" alt=""> <span><b>Visa Duration :</b> {{$details->visa_duration}}</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
    </section>
    <!--course-details-area end-->
    <!-- feature-course start -->
    <section class="feature-course pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
        <div class="container">
            <h2 class="courses-title mb-35">Recent Courses</h2>
            <div class="row">
                @foreach($recentCourse as $value)
                @php
                    $currentDestination = $destinations->whereIn('id',is_array($value->destination) ? $value->destination : [$value->destination]);
                @endphp
                <div class="col-lg-4 col-md-6">
                    <div class="z-gallery mb-30">
                        <div class="z-gallery__thumb mb-20">
                            <a href="{{route('courseDetails', $value->slug)}}"><img class="img-fluid" src="{{Storage::disk('uploads')->url($value->image); }}" alt="{{$value->title}}"></a>
                            <div class="feedback-tag">4.8(256)</div>
                            <div class="heart-icon"><i class="fas fa-heart"></i></div>
                        </div>
                        <div class="z-gallery__content">
                            <div class="course__tag mb-15">
                                <span><a href="{{route('coursecategory',$value->getCategory->slug)}}">{{$value->getCategory->title}}</a></span>
                                @foreach ($currentDestination as $item)
                                <span><a href="{{route('courseDestination',$item->slug)}}">{{$item->title}}</a></span>
                                @endforeach
                            </div>
                            <h4 class="sub-title mb-20"><a href="{{route('courseDetails', $value->slug)}}">{{$value->title}}</a></h4>
                            <div class="course__meta">
                                <span><img class="icon" src="{{ asset('frontend/assets/img/icon/time.svg') }}" alt="course-meta" title="month intake"> {{$value->month_intake}}</span>
                                <span><img class="icon" src="{{ asset('frontend/assets/img/icon/bar-chart.svg') }}" alt="course-meta" title="course duration"> {{$value->course_duration}}</span>
                                <span><img class="icon" src="{{ asset('frontend/assets/img/icon/user.svg') }}" alt="course-meta" title="visa duration"> {{$value->visa_duration}}</span>
                                <span>{{$value->course_fee}}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- feature-course end -->
    <!--what-loking-for start-->

    <!--what-loking-for end-->
@endsection
