@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@push('styles')
    <style>
        .success-message {
            position: absolute !important;
            right: 0;
            z-index: 1;
        }

    </style>
@endpush
@section('content')
<div class="container">
    @if (session('success'))
        <div class="col-sm-12">
            <div class="alert  alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
    @if (session('error'))
        <div class="col-sm-12">
            <div class="alert  alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endif
</div>
    <!--page-title-area start-->
    <section class="page-title-area d-flex align-items-end"
        style="background-image: url({{ $category->banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($category->banner_image) }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                        <h1 class="page-title mb-25">{{ $category->page_title }}</h1>
                        <div class="breadcrumb-list">
                            <ul class="breadcrumb">
                                <li><a href="@php echo url('/'); @endphp">Home -</a></li>
                                <li><a href="{{ url()->current() }}">{{ $category->name }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--page-title-area end-->
    <!--contact-us-area start-->
    <section class="contact-us-area pt-150 pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-6 col-lg-6">
                    <div class="contact-img mb-30">
                        <img class="img-fluid" src="{{Storage::disk('uploads')->url($category->image) }}" alt="">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="contact-wrapper pl-75 mb-30">
                        <div class="section-title mb-30">
                            <h2>Get In Touch With Us</h2>
                            <p>Contact Us for More inquery. We are always here to help you.</p>
                        </div>
                        <div class="single-contact-box mb-30">
                            <div class="contact__iocn">
                                <img src="{{asset('frontend/assets/img/icon/material-location-on.svg')}}" alt="">
                            </div>
                            <div class="contact__text">
                                <h5>{{ $setting->local_address }}, {{ $setting->district->dist_name }},
                                    {{ $setting->province->eng_name }} </h5>
                            </div>
                        </div>
                        <div class="single-contact-box cb-2 mb-30">
                            <div class="contact__iocn">
                                <img src="{{asset('frontend/assets/img/icon/phone-alt.svg')}}" alt="">
                            </div>
                            <div class="contact__text">
                                <h5>{{ $setting->contact_no }}</h5>
                                <h5>{{ $setting->contact_no }}</h5>
                            </div>
                        </div>
                        <div class="single-contact-box cb-3 mb-30">
                            <div class="contact__iocn">
                                <img src="{{asset('frontend/assets/img/icon/feather-mail.svg')}}" alt="">
                            </div>
                            <div class="contact__text">
                                <h5>{{ $setting->email }}</h5>
                                <h5>{{ $setting->email }}</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact-us-area end-->
    <!--contact-map-area start-->
    <section class="contact-map-area">
        <div class="container-fluid px-0">
            <div class="row gx-0">
                <div class="col-lg-12">
                    <div class="conatct-map">
                        <iframe src="{{ $setting->map_url }}" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact-map-area end-->
    <!--contact-form-area start-->
    <section class="contact-form-area pt-150 pb-120 pt-md-100 pt-xs-100 pb-md-70 pb-xs-70">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-form-wrapper mb-30">
                        <h2 class="mb-45">Contact Us</h2>
                        <form action="{{ route('messagestore') }}" method="post"
                            class="row gx-3 comments-form contact-form">
                            @csrf
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="name" placeholder="Full Name">
                            </div>
                            <div class="col-lg-6 mb-30">
                                <input type="email" name="email" placeholder="Email Name">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="phone" placeholder="Phone Number">
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <input type="text" name="subject" placeholder="subject">
                            </div>
                            <div class="col-lg-12 mb-30">
                                <textarea name="message" id="commnent" cols="30" rows="10"
                                    placeholder="Write a Message"></textarea>
                            </div>
                            <button class="theme_btn message_btn mt-20">Send Message</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-img contact-img-02 mb-30">
                        <img class="img-fluid" src="{{Storage::disk('uploads')->url($category->image) }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--contact-form-area end-->
    <!-- Contact Page -->

@endsection
@push('scripts')
    <script type="text/javascript">
        $('#reload').click(function() {
            $.ajax({
                type: 'GET',
                url: route('reloadCaptcha'),
                success: function(data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });
    </script>
@endpush
