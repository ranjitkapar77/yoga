@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
<section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-12">
                <div class="page-title-wrapper mb-50">
                   <h1 class="page-title mb-25">All Courses</h1>
                   <div class="breadcrumb-list">
                      <ul class="breadcrumb">
                          <li><a href="{{route('index')}}">Home - Pages -</a></li>
                          <li><a href="{{ url()->current() }}">All Courses</a></li>
                      </ul>
                   </div>
              </div>
            </div>
        </div>
    </div>
</section>
<!-- feature-course start -->
<section class="feature-course pb-130 pt-md-95 pb-md-80 pt-xs-95 pb-xs-80">
    <div class="container">
        <h2 class="courses-title mb-35">All Courses</h2>
        <div class="row">
            @foreach($courses as $value)
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
            <div class="col-md-4">
                <span class="pagination-sm m-0 float-right">{{ $courses->links() }}</span>
            </div>
        </div>
    </div>
</section>
<!-- feature-course end -->
@endsection
