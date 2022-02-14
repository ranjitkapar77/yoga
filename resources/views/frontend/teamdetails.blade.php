@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')

<!--page-title-area start-->
<section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-lg-12">
                <div class="page-title-wrapper mb-50">
                   <h1 class="page-title mb-25">{{$team->name}}</h1>
                   <div class="breadcrumb-list">
                      <ul class="breadcrumb">
                          <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                          <li><a href="{{url()->current()}}">{{$team->name}}</a></li>
                      </ul>
                   </div>
              </div>
            </div>
        </div>
    </div>
</section>
<!--page-title-area end-->
 <!--instructor-details-area start-->
 <section class="instructor-details-area pt-145 pb-110 pt-md-95 pb-md-60 pt-xs-95 pb-xs-60">
     <div class="container">
         <div class="row">
             <div class="col-xl-12 col-lg-12">
                 <div class="instructor-profile-img mb-30" style="background-image: url({{ Storage::disk('uploads')->url($team->image) }});"></div>
             </div>
             <div class="col-xl-6 col-lg-12">
                 <div class="instructor-profile">
                    <h2>{{$team->name}}</h2>
                    <ul class="profile-list mb-50">
                        <li>Name : <span>{{$team->name}}</span></li>
                        <li>Mobile Num: <span>{{$team->phone}}</span></li>
                        <li>Address : <span>{{$team->address}}</span></li>
                        <li>Email : <span>{{$team->email}}</span></li>
                        <li>Website : <span>{{$team->website}}</span></li>
                        <li>
                            <div class="social-media">
                                <a href="{{$team->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                <a href="{{$team->twitter}}"><i class="fab fa-twitter"></i></a>
                                <a href="{{$team->instagram}}"><i class="fab fa-instagram"></i></a>
                                <a href="{{$team->youtube}}"><i class="fab fa-youtube"></i></a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
             <div class="col-xl-6 col-lg-12">
                 <div class="instructor-profile">
                     <h2>Information</h2>
                     <div class="star-icon mb-20">
                          <a href="#"><i class="fas fa-star"></i></a>
                          <a href="#"><i class="fas fa-star"></i></a>
                          <a href="#"><i class="fas fa-star"></i></a>
                          <a href="#"><i class="fas fa-star"></i></a>
                          <a href="#"><i class="fas fa-star"></i></a>
                      </div>
                      <p class="mb-25">{!! $team->content !!}</p>
                 </div>
             </div>
         </div>
     </div>
 </section>
 <!--instructor-details-area end-->
@endsection
