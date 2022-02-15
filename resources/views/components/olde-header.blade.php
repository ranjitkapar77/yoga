<header>
    <div id="theme-menu-one" class="main-header-area pl-100 pr-100 pt-20 pb-15">
        <div class="container-fluid">
            <div class="row align-items-center">
                <div class="col-xl-2 col-lg-2 col-5">
                    <div class="logo"><a href="{{ route('index') }}"><img
                                src="{{ image(config('settings.company_logo')) }}" alt=""></a></div>
                </div>
                <div class="col-xl-8 col-lg-8 d-none d-lg-block">
                    <nav class="main-menu navbar navbar-expand-lg justify-content-center">
                        <div class="nav-container">
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav">
                                    @foreach ($headerMenu as $key => $menu)
                                        @if ($menu->category_slug == 'courses')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown{{ $key.$menu->id }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $menu->name }}
                                                </a>
                                                <ul class="dropdown-menu courses"
                                                    aria-labelledby="navbarDropdown{{$key.$menu->id }}">
                                                    @foreach ($courses as $course)
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('courseDetails', $course->slug) }}">{{ $course->title }}</a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @continue
                                        @endif
                                        @if ($menu->category_slug == 'destination')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown{{ $key.$menu->id }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $menu->name }}
                                                </a>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="navbarDropdown{{$key.$menu->id }}">
                                                    @foreach ($destination as $dest)
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('courseDestination', $dest->slug) }}">{{ $dest->title }}</a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @continue
                                        @endif
                                        @if ($menu->category_slug == 'test-preparation')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown{{ $key.$menu->id }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $menu->name }}
                                                </a>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="navbarDropdown{{$key.$menu->id }}">
                                                    @foreach ($testPreparation as $test)
                                                        <li><a class="dropdown-item"
                                                                href="{{ route('testpreprationsdetails', $test->slug) }}">{{ $test->title }}</a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @continue
                                        @endif
                                        @if ($menu->category_slug == 'level')
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown{{ $key.$menu->id }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $menu->name }}
                                                </a>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="navbarDropdown{{$key.$menu->id }}">
                                                    @foreach ($level as $lev)
                                                        <li><a class="dropdown-item"
                                                                href="{{route('courselevel', $lev->slug)}}">{{ $lev->title }}</a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @continue
                                        @endif
                                        @if (count($menu->children))
                                            <li class="nav-item dropdown">
                                                <a class="nav-link dropdown-toggle" href="#"
                                                    id="navbarDropdown{{ $key }}" role="button"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    {{ $menu->name }}
                                                </a>
                                                <ul class="dropdown-menu"
                                                    aria-labelledby="navbarDropdown{{ $key }}">
                                                    @foreach ($menu->children as $child)
                                                        <li><a class="dropdown-item"
                                                                href="{{ $child->external_link ?? route('category', $menu->slug) }}">{{ $child->name }}</a>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            @continue
                                        @endif
                                        <li class="nav-item">
                                            <a class="nav-link"
                                                href="{{ $menu->external_link ?? route('category', $menu->slug) }}"
                                                id="navbarDropdown5" role="button"
                                                aria-expanded="false">{{ $menu->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
                <div class="col-xl-2 col-lg-2 col-7">
                    <div class="right-nav d-flex align-items-center justify-content-end">
                        <div class="right-btn mr-25 mr-xs-15">
                            <ul class="d-flex align-items-center">
                                <li><a href="@php echo url('/contact'); @endphp" class="theme_btn free_btn">Speak to us</a></li>
                                {{-- <li><a class="sign-in ml-20" href="login.html"><img src="assets/img/icon/user.svg"
                                            alt=""></a></li> --}}
                            </ul>
                        </div>
                        <div class="hamburger-menu d-md-inline-block d-lg-none text-right">
                            <a href="javascript:void(0);">
                                <i class="far fa-bars"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>


<!-- slide-bar start -->
<aside class="slide-bar">
    <div class="close-mobile-menu">
        <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
    </div>

    <!-- offset-sidebar start -->
    <div class="offset-sidebar">
        <div class="offset-widget offset-logo mb-30">
            <a href="index.html">
                <img src="{{ image(config('settings.company_favicon')) }}" alt="logo">
            </a>
        </div>
        <div class="offset-widget mb-40">
            <div class="info-widget">
                <h4 class="offset-title mb-20">About Us</h4>
                <p class="mb-30">
                    But I must explain to you how all this mistaken idea of denouncing pleasure and praising pain
                    was born and will give you a complete account of the system and expound the actual teachings of
                    the great explore
                </p>
                <a class="theme_btn theme_btn_bg" href="contact.html">Contact Us</a>
            </div>
        </div>
        <div class="offset-widget mb-30 pr-10">
            <div class="info-widget info-widget2">
                <h4 class="offset-title mb-20">Contact Info</h4>
                <p> <i class="fal fa-address-book"></i>{{ config('settings.local_address') }}</p>
                <p> <i class="fal fa-phone"></i> {{ config('settings.contact_no') }}</p>
                <p> <i class="fal fa-envelope-open"></i> {{ config('settings.email') }} </p>
            </div>
        </div>
    </div>
    <!-- offset-sidebar end -->

    <!-- side-mobile-menu start -->
    <nav class="side-mobile-menu">
        <ul id="mobile-menu-active">
            @foreach ($headerMenu as $menu)
                @if (count($menu->children))
                    <li class="has-dropdown">
                        <a href="{{ route('category', $menu->slug) }}">{{ $menu->name }}</a>
                        <ul class="sub-menu">
                            @foreach ($menu->children as $child)
                                <li>
                                    <a href="{{ $child->external_link ?? route('category', $child->slug) }}"
                                        target="{{ $child->external_link ? '_blank' : '_self' }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach

                        </ul>
                    </li>
                    @continue

                @endif
                <li><a
                        href="{{ $menu->external_link ?? route('category', $menu->slug) }}">{{ $menu->name }}</a>
                </li>

            @endforeach
        </ul>
    </nav>
    <!-- side-mobile-menu end -->
</aside>
<div class="body-overlay"></div>
<!-- slide-bar end -->
