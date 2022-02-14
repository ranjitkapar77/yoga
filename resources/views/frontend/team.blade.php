@extends('frontend.layouts.app')
@section('meta')
    @include('frontend.includes.meta')
@endsection
@section('content')
    <!-- Banner -->
        <section class="page-title-area d-flex align-items-end" style="background-image: url({{ asset('frontend/img/banner.jpg') }});">
            <div class="container">
                <div class="row align-items-end">
                    <div class="col-lg-12">
                        <div class="page-title-wrapper mb-50">
                            <h1 class="page-title mb-25">Team</h1>
                            <div class="breadcrumb-list">
                                <ul class="breadcrumb">
                                    <li><a href="@php echo url('/'); @endphp">Home - Pages -</a></li>
                                    <li><a href="{{url()->current()}}">Team</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- Banner End -->

    <!-- Team Page -->
    <x-team-component />
    <!-- Team Page End -->

@endsection
