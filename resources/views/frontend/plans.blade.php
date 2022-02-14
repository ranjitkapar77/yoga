@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
    @push('styles')
        <style>
            .success-message{
                position: absolute !important;
                right:0;
                z-index: 1;
            }
        </style>
    @endpush
@endsection
@section('content')
@if (session('success'))
<div class="col-sm-4 success-message">
    <div class="alert alert-success" role="alert">
        {{ session('success') }}
    </div>
</div>
@endif

        <!-- Banner -->
        <section class="banner" style="background-image: url({{$banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($banner_image)}});">
            <div class="container">
                <div class="banner-wrap">
                    <h1>Our Pricing and Plans</h1>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Our Pricings and Plans</li>
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
                    @foreach ($plans as $pricing)
                    <div class="col-lg-3 col-md-6">
                        <div class="pricing-wrap">
                            <div class="pricing-head">
                                <div class="pricing-bg"></div>
                                <span>{{$pricing->title}}</span>
                                <h3>{{$pricing->plantype->title}}</h3>
                                <b>{!! $pricing->regular_price == $pricing->offer_price ? 'Rs.'.$pricing->regular_price : '<del style="font-size:16px;">Rs.'.$pricing->regular_price.'</del></br>'.'Rs.'.$pricing->offer_price !!}</b>
                            </div>
                            <div class="pricing-content">
                                <ul>
                                    @foreach ($pricing->planfeatures as $feature)
                                    <li>{{$feature->features}}</li>
                                    @endforeach
                                </ul>
                                <div class="main-btn white">
                                    <a href="javascript:void(0)"  data-bs-toggle="modal" data-bs-target="#plans{{$pricing->id}}">Select Plan <i class="las la-angle-double-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>
        @foreach ($plans as $pricing)
        <!-- Modal -->
        <div class="modal fade" id="plans{{$pricing->id}}" tabindex="-1" aria-labelledby="plans{{$pricing->id}}Label" aria-hidden="true">
            <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="plans{{$pricing->id}}Label">{{$pricing->title}} {{$pricing->plantype->title}} -> <b>{!! $pricing->regular_price == $pricing->offer_price ? 'Rs.'.$pricing->regular_price : '<del style="font-size:16px;">Rs.'.$pricing->regular_price.'</del>'.' Rs.'.$pricing->offer_price !!}</b> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('message.store')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <input type="text" name="name" placeholder="Your Name" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <input type="email" name="email" placeholder="Email Address" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <input type="text" name="phone" placeholder="Phone Number" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group my-2">
                                    <input type="text" name="subject" placeholder="Subject" class="form-control" value="{{$pricing->title}} {{$pricing->plantype->title}} {{$pricing->regular_price == $pricing->offer_price ? $pricing->regular_price : $pricing->offer_price}}" readonly="readonly">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group my-2">
                                    <textarea name="message" class="form-control" placeholder="Message"></textarea>
                                </div>
                            </div>
                            <div class="col-ma-12">
                                <div class="main-btn">
                                    <button type="submit" class="btn btn-danger">Send <i class="las la-angle-double-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
            </div>
        </div>
    @endforeach
        <!-- Team Page End -->

@endsection
