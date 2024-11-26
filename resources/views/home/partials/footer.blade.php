<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-5">
                    <div class="footer_widget">
                        <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                            class="img-footer small mb-2" alt="" />
                        <p>{{ $setting->description }}</p>
                        <p>ساعات کاری:<strong> {{ $setting->workday }}</strong></p>
                    </div>
                </div>

                <div class="col-lg-6 col-md-7 mr-auto">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="footer_widget">
                                <h4 class="widget_title">لینک های مفید</h4>
                                {{-- @dd(json_decode($setting->links, true))
                                @if (!empty(json_decode($setting->links, true)))
                                    <div class="col-lg-9 col-md-8 d-block pr">
                                        <div class="footer-links">
                                            @foreach (json_decode($setting->links, true) as $pLink)
                                                <div class="col-lg-3 col-md-3 col-xs-12 pr">
                                                    <div class="row">
                                                        <section class="footer-links-col">
                                                            <div class="headline-links">
                                                                <a href="#">
                                                                    {{ $pLink['name'] }}
                                                                </a>
                                                            </div>
                                                            @isset($pLink['children'])
                                                                <ul class="footer-menu-ul mr-2">
                                                                    @foreach ($pLink['children'] as $link)
                                                                        <li class="menu-item-type-custom">
                                                                            <a href="{{ $link['url'] }}">
                                                                                {{ $link['title'] }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endisset
                                                        </section>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif --}}
                            </div>
                        </div>

                        <div class="col-lg-7 col-md-7">
                            <div class="footer_widget">
                                <h4 class="widget_title">اطلاعات تماس</h4>
                                <p><i class="ti-location-pin"></i> آدرس: {{ $setting->address }}</p>
                                <p><i class="ti-mobile"></i> تلفن:</p>
                                @isset($setting->phone)
                                    @foreach ($setting->phone as $phone)
                                        <a class="mx-1" href="tel:{{ $phone }}">{{ $phone }}</a>
                                    @endforeach
                                @endisset
                                <p><i class="ti-email"></i> ایمیل: </p>
                                @isset($setting->email)
                                    @foreach ($setting->email as $email)
                                        <span class="mx-1">{{ $email }}</span>
                                    @endforeach
                                @endisset
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12 col-md-12 text-center">
                    <p class="mb-0">© تمامی حقوق محفوظ است </p>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- ============================ Footer End ================================== -->
