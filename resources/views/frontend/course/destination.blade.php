@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!--page-title-area start-->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{Storage::disk('uploads')->url($destination->image); }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$destination->title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{url()->current()}}">{{$destination->title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!--page-title-area end-->
    <!-- feature-course start -->
    <section class="feature-course pb-130 pt-150 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                     <div class="section-title text-center mb-30">
                         <h5 class="bottom-line mb-25">Study In {{$destination->title}}</h5>
                         <h2>Explore our Popular Courses</h2>
                     </div>
                 </div>
             </div>
            <div class="row">
                @foreach($courses as $value)
                <div class="col-lg-4 col-md-6">
                    <div class="z-gallery mb-30">
                        <div class="z-gallery__thumb mb-20">
                            <a href="{{route('courseDetails', $value->slug)}}"><img class="img-fluid" src="{{Storage::disk('uploads')->url($value->image); }}" alt="{{$value->title}}"></a>
                            <div class="feedback-tag">4.8(256)</div>
                            <div class="heart-icon"><i class="fas fa-heart"></i></div>
                        </div>
                        <div class="z-gallery__content">
                            <div class="course__tag mb-15">
                                <span>{{$value->getCategory->title}}</span>
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
@endsection
