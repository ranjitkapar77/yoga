@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')

<main>
    <!--page-title-area start-->
     <section class="page-title-area d-flex align-items-end" style="background-image: url({{Storage::disk('uploads')->url($category->banner_image); }});">
         <div class="container">
             <div class="row align-items-end">
                 <div class="col-lg-12">
                     <div class="page-title-wrapper mb-50">
                        <h1 class="page-title mb-25">{{$category->name}}</h1>
                        <div class="breadcrumb-list">
                           <ul class="breadcrumb">
                               <li><a href="index.html">Home - Pages -</a></li>
                               <li><a href="#">{{$category->name}}</a></li>
                           </ul>
                        </div>
                   </div>
                 </div>
             </div>
         </div>
     </section>
     <!--page-title-area end-->
      <!--great-deal-area start-->
      <x-great-deals />
      <!--great-deal-area end-->
     <!--about-us-area start-->
     <section class="about-us-area pt-150 pb-120 pt-md-100 pb-md-70 pt-xs-100 pb-xs-70">
         <div class="container">
             <div class="row align-items-center mb-120">
                <div class="col-lg-7">
                    <div class="about__img__box mb-60">
                       <img class="about-main-thumb pl-110" src="{{Storage::disk('uploads')->url($category->image); }}" alt="about-img">
                       {{-- <img class="about-img about_01" src="assets/img/about/01.png" alt="about-img">
                       <img class="about-img about_02" src="assets/img/about/02.png" alt="about-img"> --}}
                       <img class="about-img about_03" src="{{ asset('frontend/assets/img/slider/earth-bg.svg')}}" alt="about-img">
                   </div>
                </div>
                <div class="col-lg-5">
                    <div class="about-wrapper">
                        <div class="section-title section-title-4 mb-60">
                           <h5 class="bottom-line mb-25">{{$category->name}}</h5>
                           <h2 class="mb-20">{{$category->page_title}}</h2>
                           <p class="mb-20">{!! $category->content !!}</p>

                       </div>
                    </div>
                </div>
            </div>
        </div>
     </section>
     <!--about-us-area end-->
   </main>


@endsection
