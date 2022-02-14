<footer class="footer-area pt-70 pb-40">
    <div class="container">
        <div class="row mb-15">
            <div class="col-xl-3 col-lg-3 col-md-6  wow fadeInUp2 animated" data-wow-delay='.1s'>
                <div class="footer__widget mb-30">
                    <div class="footer-log mb-20">
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ image(config('settings.footer_logo')) }}" alt="">
                        </a>
                    </div>
                    <p>{{ config('settings.footer_text') }}</p>
                    <div class="social-media footer__social mt-30">

                    <a href="{{ $setting->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                        <a href="{{ $setting->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                        <a href="{{ $setting->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="{{ $setting->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 wow fadeInUp2 animated" data-wow-delay='.3s'>
                <div class="footer__widget mb-30 pl-40 pl-md-0 pl-xs-0">
                    <h6 class="widget-title mb-35">Contact us</h6>
                    <ul class="fot-list">
                        <li><a href="mailto:{{ config('settings.email') }}">{{ config('settings.email') }}</a></li>
                        <li><a
                                href="tel:{{ config('settings.contact_no') }}">{{ config('settings.contact_no') }}</a>
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-md-6  wow fadeInUp2 animated" data-wow-delay='.5s'>
                <div class="footer__widget mb-25  pl-md-0 pl-xs-0">
                    <h6 class="widget-title mb-35">Quick Links</h6>
                    <ul class="fot-list">
                        @if (cache('footerMenu'))
                            @foreach (cache('footerMenu') as $footerItem)
                                <li><a href="{{ $footerItem->external_link ?? route('category', $footerItem->slug) }}">{{$footerItem->name}}</a></li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6  wow fadeInUp2 animated" data-wow-delay='.7s'>
                <div class="footer__widget mb-30 pl-150 pl-lg-0 pl-md-0 pl-xs-0">
                    <h6 class="widget-title mb-35">Course Category</h6>
                    <ul class="fot-list mb-30">
                        @foreach ($category as $cat)
                            <li><a href="{{route('coursecategory', $cat->slug)}}">{{$cat->title}}</a> </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="copy-right-area border-bot pt-40">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="copyright text-center">
                        <h5> ©{{ now()->format('Y') }} {{ config('settings.company_name') }}.
                            Designed and Developed By: <a href="https://www.nectardigit.com/" target="__blank"
                                class="text-bold">Nectar
                                digit</a>.</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--footer-area end-->
