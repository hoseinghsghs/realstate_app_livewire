<!-- ============================ Footer Start ================================== -->
<footer class="dark-footer skin-dark-footer style-2">
    <div class="footer-middle">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <div class="footer_widget">
                        <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                             class="img-footer small mb-2" alt=""/>
                        <p>{{ $setting->description }}</p>
                        <p style="color:#8bdeff">ساعات کاری:<strong> {{ $setting->work_days }}</strong></p>
                    </div>
                </div>
                <div class="col-lg-7 col-md-8 ">
                    <div class="row">
                        <div class="col-lg-5 col-md-5">
                            <div class="footer_widget">
                                <h4 class="widget_title">لینک های مفید</h4>
                                <div class="col-lg-11 col-md-10 d-block pr">
                                    <div class="footer-links">
                                        @if ($setting->links)
                                            @foreach ($setting->links as $pLink)
                                                <div class="col-xs-12 pr">
                                                    <div class="row mt-1">
                                                        <section class="p-1">
                                                            <div class="headline-links">
                                                                <a href="#" style="color:#8bdeff">
                                                                    {{ $pLink->name }}
                                                                </a>
                                                            </div>
                                                            @isset($pLink->children)
                                                                <ul class="footer-menu-ul mr-2">
                                                                    @foreach ($pLink->children as $link)
                                                                        <li class="menu-item-type-custom mt-1">
                                                                            <a href="{{ $link->url }}" wire:navigate
                                                                               style="color:#8bdeff">
                                                                                {{ $link->title }}
                                                                            </a>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endisset
                                                        </section>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7 col-md-7">
                            <div class="footer_widget">
                                <h4 class="widget_title">اطلاعات تماس</h4>
                                <p style="color:#8bdeff"><i class="ti-location-pin"></i> آدرس: {{ $setting->address }}
                                </p>
                                <p style="color:#8bdeff">
                                    <i class="ti-mobile"></i><span>تلفن:</span>
                                    @isset($setting->phones)
                                        @foreach (json_decode($setting->phones, true) as $phone)
                                            <a class="mx-1" href="tel:{{ $phone }}">{{ $phone }}</a>
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @endisset
                                </p>
                                <p style="color:#8bdeff"><i class="ti-email"></i><span>ایمیل:</span>
                                    @isset($setting->emails)
                                        @foreach (json_decode($setting->emails, true) as $email)
                                            <a href="mailto:{{$email}}" class="mx-1">{{ $email }}</a>
                                            @if(!$loop->last)
                                                ,
                                            @endif
                                        @endforeach
                                    @endisset
                                </p>
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
