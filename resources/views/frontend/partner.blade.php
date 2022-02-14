@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
    @push('styles')
        <link rel="stylesheet" href="{{asset('frontend/css/hover-min.css')}}">
        <style>
            .success-message{
                position: absolute !important;
                right:0;
                z-index: 1;
            }
            .portfolio-img{
                background-color: #fff;
            }
            .portfolio-wrap{
                box-shadow: 0px 30px 62px 0px rgb(0 0 0 / 15%);
                margin-bottom: 30px;
            }
            .portfolio-content {
                background: #fff;
                padding: 15px;
                text-align: center;
                position: relative;
                box-shadow: 0px -1px 7px rgb(0 0 0 / 10%);
            }
        </style>
    @endpush
@endsection
@section('content')

    <!-- Banner -->
    <section class="banner" style="background-image: url({{$banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($banner_image)}});">
        <div class="container">
            <div class="banner-wrap">
                <h1>Our Partners</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Our Partners</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <!-- Banner End -->

    <!-- Team Page -->
    <section class="team-page pt pb">
        <div class="container">
            <div class="row">
                @foreach ($partners as $partner)
                <div class="col-lg-3 col-md-4 col-sm-12">
                    <div class="portfolio-wrap hvr-wobble-bottom">
                        <div class="portfolio-img p-2">
                            <img src="{{Storage::disk('uploads')->url($partner->partner_logo)}}" alt="{{$partner->partner_name}}">
                        </div>
                        <div class="portfolio-content">
                            <span>{{$partner->partner_name}}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            {{ $partners->links() }}
        </div>
    </section>

@endsection
