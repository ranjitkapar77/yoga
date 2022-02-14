@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
    <section class="page-title-area d-flex align-items-end" style="background-image: url({{ $news->banner_image == null ? asset('frontend/img/banner.jpg') : Storage::disk('uploads')->url($news->banner_image) }});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-lg-12">
                    <div class="page-title-wrapper mb-50">
                       <h1 class="page-title mb-25">{{$news->title}}</h1>
                       <div class="breadcrumb-list">
                          <ul class="breadcrumb">
                              <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                              <li><a href="{{url()->current()}}">{{$news->title}}</a></li>
                          </ul>
                       </div>
                  </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner End -->
    <!-- blog-details-area start -->
    <section class="blog-details-area pt-150 pb-105 pt-md-100 pb-md-55 pt-xs-100 pb-xs-55">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="blog-details-box mb-45">
                        <h2>{{$news->title}}</h2>
                        <ul class="blogs__meta mb-30">
                           <li><span class="blog-author">By {{$news->author}}</span></li>
                           <li><span><img src="{{asset('frontend/assets/img/icon/material-date-range.svg')}}" alt="mate-date"> {{date('M-d-Y', strtotime($news->created_at));}}</span></li>
                           <li>
                               <div class="social-media blog-details-social">
                                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                                    <a href="#"><i class="fab fa-instagram"></i></a>
                                    <a href="#"><i class="fab fa-youtube"></i></a>
                                    <a href="#"><i class="fab fa-twitter"></i></a>
                                </div>
                            </li>
                        </ul>
                        <img class="img-fluid blog-details-img mb-35" src="{{Storage::disk('uploads')->url($news->cover_image)}}" alt="blog-details-img">
                        <h3 class="blog-details-title mb-30">{{$news->descriptive_title}}</h3>
                        <p>{!!$news->content!!}</p>
                    </div>
                    <div class="comments-form-area mb-45">
                        <h2>Leave a comment</h2>
                        <form action="#" class="row comments-form">
                            <div class="col-lg-6 mb-20">
                                <input type="text" placeholder="Full Name">
                            </div>
                            <div class="col-lg-6 mb-20">
                                <input type="text" placeholder="Email Name">
                            </div>
                            <div class="col-lg-12 mb-20">
                                <textarea name="commnent" id="commnent" cols="30" rows="10" placeholder="Write Your Comments"></textarea>
                            </div>
                        </form>
                        <button class="theme_btn comment_btn">Submit Comment</button>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="blog-widget-area">
                        <div class="widget mb-50">
                            <div class="blog-categories-widget">
                                <h4 class="sub-title pb-20 mb-25 pt-25">Recent Post</h4>
                                <ul class="blog-recent-post">
                                    @foreach ($recentPost as $post)
                                        <li>
                                            <div class="posts mb-20">
                                                <img src="{{Storage::disk('uploads')->url($post->cover_image)}}" alt="" class="posts__thumb mb-15">
                                                <p>{{date('M-d-Y', strtotime($post->created_at));}}</p>
                                                <h6><a href="{{route('newsdetail', $post->slug)}}">{{$post->title}}</a></h6>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                        <div class="widget mb-50">
                            <h4 class="sub-title pb-20 mb-25 pt-25">Social Media</h4>
                            <div class="blog-social-widget">
                                 <div class="social-media mb-30">
                                    <a href="{{$setting->facebook}}"><i class="fab fa-facebook-f"></i></a>
                                    <a href="{{$setting->twitter}}"><i class="fab fa-twitter"></i></a>
                                    <a href="{{$setting->youtube}}"><i class="fab fa-youtube"></i></a>
                                    <a href="{{$setting->instagram}}"><i class="fab fa-instagram"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="widget mb-50">
                            <div class="blog-categories-widget">
                                <h4 class="sub-title pb-20 mb-25 pt-25">Popular Post</h4>
                                <ul class="blog-recent-post">
                                    @foreach ($popularPost as $popular)
                                    <li>
                                        <div class="posts mb-20">
                                            <img src="{{Storage::disk('uploads')->url($popular->cover_image)}}" alt="" class="posts__thumb mb-15">
                                            <p>{{date('M-d-Y', strtotime($popular->created_at));}}</p>
                                            <h6><a href="{{route('newsdetail', $popular->slug)}}">{{$popular->title}}</a></h6>
                                        </div>
                                   </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- blog-details-area end -->

    @endsection
