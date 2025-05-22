@section('title', 'خانه')
<div>
    <!-- ============================ Hero Banner  Start================================== -->
    <div class="image-cover hero_banner"
         style="background:url(storage/slider/{{ $slider->first()->image ?? 'slider-default.png' }}) no-repeat;"
         data-overlay="0">
        <div class="container">
            <h1 class="big-header-capt mb-0">خانه جدید خود را پیدا کنید</h1>
            <p class="text-center mb-4">با پلتفرم جست و جو ما سریع تر خانه خود را پیدا کنید</p>
            <!-- Type -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-11 col-md-12">
                    <div class="full_search_box nexio_search lightanic_search hero_search-radius modern">
                        <div class="search_hero_wrapping">
                            <form wire:submit="searchProperty">
                                <div class="row">
                                    <div class="col-lg-4 col-md-3 col-sm-12">
                                        <div class="form-group" wire:ignore>
                                            <label>نوع معامله</label>
                                            <div class="input-with-icon">
                                                <select id="deal_type" name="tr_type" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <option>رهن و اجاره</option>
                                                    <option>فروش</option>
                                                    <option>پیش فروش</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-3 col-sm-12">
                                        <div class="form-group" wire:ignore>
                                            <label>نوع ملک</label>
                                            <div class="input-with-icon">
                                                <select name="type" id="type" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <option>آپارتمان</option>
                                                    <option>خانه
                                                        ویلایی
                                                    </option>
                                                    <option>زمین و
                                                        کلنگی
                                                    </option>
                                                    <option>مغازه</option>
                                                    <option>دفتر کار</option>
                                                    <option>باغ</option>
                                                    <option>انبار</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-12">
                                        <div class="form-group none" wire:ignore>
                                            <label>محله ها</label>
                                            <div class="input-with-icon">
                                                <select name="district" id="district" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    @isset($districts)
                                                        @foreach ($districts as $district)
                                                            <option>{{ $district }}</option>
                                                        @endforeach
                                                    @endisset
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-1 col-md-2 col-sm-12 small-padd">
                                        <div class="form-group none">
                                            <button class="btn search-btn"><i class="fa fa-search"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Hero Banner End ================================== -->

    <!-- ============================ Property Category Start ================================== -->
    <section class="min">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center">
                        <h2>چه نوع خونه ای را در نظر دارید</h2>

                    </div>
                </div>
            </div>

            <div class="row justify-content-center mt-4">
                <!-- Single Category -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="_category_box">
                        <a href="{{ route('properties.list', ['property_type' => 'آپارتمان']) }}" wire:navigate>
                            <div class="_category_elio">
                                <div class="_category_thumb">
                                    <img src="assets/home/img/f-1.png" class="img-fluid hover" alt=""/>
                                    <img src="assets/home/img/f-11.png" class="img-fluid simple" alt=""/>
                                </div>
                                <div class="_category_caption">
                                    <h5>آپارتمان</h5>
                                    <span style="color: black;">{{ $apartment_properties_count }} ملک</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Single Category -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="_category_box">
                        <a href="{{ route('properties.list', ['property_type' => 'خانه ویلایی']) }}" wire:navigate>
                            <div class="_category_elio">
                                <div class="_category_thumb">
                                    <img src="assets/home/img/f-2.png" class="img-fluid hover" alt=""/>
                                    <img src="assets/home/img/f-22.png" class="img-fluid simple" alt=""/>
                                </div>
                                <div class="_category_caption">
                                    <h5>خانه ویلایی</h5>
                                    <span style="color: black;">{{ $villa_properties_count }} ملک</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Single Category -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="_category_box">
                        <a href="{{ route('properties.list', ['property_type' => 'مغازه']) }}" wire:navigate>
                            <div class="_category_elio">
                                <div class="_category_thumb">
                                    <img src="assets/home/img/f-5.png" class="img-fluid hover" alt=""/>
                                    <img src="assets/home/img/f-55.png" class="img-fluid simple" alt=""/>
                                </div>
                                <div class="_category_caption">
                                    <h5>مغازه</h5>
                                    <span style="color: black;">{{ $shop_properties_count }} ملک</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <!-- Single Category -->
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="_category_box">
                        <a href="{{ route('properties.list', ['property_type' => 'زمین و کلنگی']) }}" wire:navigate>
                            <div class="_category_elio">
                                <div class="_category_thumb">
                                    <img src="assets/home/img/f-4.png" class="img-fluid hover" alt=""/>
                                    <img src="assets/home/img/f-44.png" class="img-fluid simple" alt=""/>
                                </div>
                                <div class="_category_caption">
                                    <h5>زمین</h5>
                                    <span style="color: black;">{{ $land_properties_count }} ملک</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Property Category End ================================== -->

    <!-- ============================ Properties Start ================================== -->
    @if ($rent_properties->count() > 0)
        <section class="pt-0 min">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="sec-heading center">
                            <h2>آخرین املاک برای رهن و اجاره</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    @foreach ($rent_properties as $rent_property)
                        <!-- Single Property -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="property-listing property-2">

                                <div class="listing-img-wrapper">
                                    @isset($rent_property->lable)
                                        <div class="_exlio_125" style="background-color:#ff2f2f;">
                                            {{ $rent_property->lable }}</div>
                                    @endisset
                                    <div class="list-img-slide">
                                        <div class="click">
                                            <div><a href="/properties/{{ $rent_property->id }}" wire:navigate><img
                                                            src="{{ asset('storage/preview/' . $rent_property->img) }}"
                                                            class="img-fluid mx-auto" alt=""/></a></div>
                                            <!-- اسلاید -->
                                            <!-- <div><a href="single-property-1.html"><img src="assets/home/img/p-2.png"
                                                            class="img-fluid mx-auto" alt="" /></a></div>
                                                <div><a href="single-property-1.html"><img src="assets/home/img/p-3.png"
                                                            class="img-fluid mx-auto" alt="" /></a></div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-detail-wrapper">
                                    <div class="listing-short-detail-wrap">
                                        <div class="_card_list_flex mb-2">
                                            <div class="_card_flex_01">
                                                <span class="_list_blickes _netork">برای
                                                    {{ $rent_property->tr_type }}</span>
                                                <span class="_list_blickes types">{{ $rent_property->type }}</span>
                                            </div>
                                            @can('is_user')
                                                @auth
                                                    @if ($rent_property->checkUserWishlist(auth()->id()))
                                                        <a id="{{ $rent_property->id }}"
                                                           onclick="return send('{{ $rent_property->id }}')"
                                                           style="color:red;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @elseif ($rent_property->checkUserWishlist(auth()->id()))
                                                        <a id="{{ $rent_property->id }}"
                                                           onclick="return send('{{ $rent_property->id }}')"
                                                           style="color:blue ;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @else
                                                        <a id="{{ $rent_property->id }}"
                                                           onclick="return send('{{ $rent_property->id }}')"
                                                           style="color:blue ;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @endif
                                                @endauth
                                            @endcan
                                        </div>
                                        <div class="_card_list_flex">
                                            <div class="_card_flex_01">
                                                <h4 class="listing-name verified">
                                                    <a href={{ route('properties.show', $rent_property->id) }}
                                                        wire:navigate class="prt-link-detail">
                                                        <h6 class=" mb-2 mt-2 numbers" style="font-size: 15px;">
                                                            {{ $rent_property->title }}
                                                        </h6>
                                                    </a>
                                                </h4>
                                                <h4 class="listing-name verified">
                                                    <h6 class="listing-card-info-price mb-2 mt-2 numbers"
                                                        style="font-size: 15px;">مبلغ
                                                        اجاره
                                                        :
                                                        {{ $rent_property->rent }}
                                                        تومان
                                                    </h6>
                                                </h4>
                                                <h4 class="listing-name verified">
                                                    <h6 class="listing-card-info-price mb-2 numbers"
                                                        style="font-size: 15px;">
                                                        مبلغ رهن
                                                        :
                                                        {{ $rent_property->rahn }}
                                                        تومان
                                                    </h6>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="price-features-wrapper">
                                    <div class="list-fx-features">
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/bed.svg"
                                                                             width="13" alt=""/>
                                            </div>{{ $rent_property->bedroom }} خوابه
                                        </div>
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/01.png"
                                                                             width="13" alt=""/>
                                            </div>{{ $rent_property->usertype }}
                                        </div>
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/move.svg"
                                                                             width="13" alt=""/>
                                            </div>{{ $rent_property->meter }} متر مربع
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-detail-footer">
                                    <div class="footer-first">
                                        <div class="foot-location"><img src="assets/home/img/pin.svg" width="18"
                                                                        alt=""/>
                                            {{ $rent_property->city }},
                                            {{ $rent_property->district }}
                                        </div>
                                    </div>
                                    <div class="footer-flex">
                                        <a href={{ route('properties.show', $rent_property->id) }} wire:navigate
                                           class="prt-view">مشاهده
                                            جزئیات</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- End Single Property -->
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    @if ($sell_properties->count() > 0)
        <!-- برای فروش -->
        <section class="pt-0 min">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7 col-md-8">
                        <div class="sec-heading center">
                            <h2>آخرین املاک برای فروش</h2>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <!-- برای فروش -->
                    @foreach ($sell_properties as $property_sell)
                        <!-- Single Property -->
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="property-listing property-2">

                                <div class="listing-img-wrapper">
                                    @isset($property_sell->lable)
                                        <div class="_exlio_125" style="background-color:#ff2f2f;">
                                            {{ $property_sell->lable }}</div>
                                    @endisset
                                    <div class="list-img-slide">
                                        <div class="click">
                                            <div><a href="/properties/{{ $property_sell->id }}" wire:navigate><img
                                                            src="{{ asset('storage/preview/' . $property_sell->img) }}"
                                                            class="img-fluid mx-auto" alt=""/></a></div>
                                            <!-- اسلاید -->
                                            <!-- <div><a href="single-property-1.html"><img src="assets/home/img/p-2.png"
                                                          class="img-fluid mx-auto" alt="" /></a></div>
                                              <div><a href="single-property-1.html"><img src="assets/home/img/p-3.png"
                                                          class="img-fluid mx-auto" alt="" /></a></div> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-detail-wrapper">
                                    <div class="listing-short-detail-wrap">
                                        <div class="_card_list_flex mb-2">
                                            <div class="_card_flex_01">
                                                <span class="_list_blickes _netork">برای
                                                    {{ $property_sell->tr_type }}</span>
                                                <span class="_list_blickes types">{{ $property_sell->type }}</span>
                                            </div>
                                            <!-- <div class="_card_flex_last">
                                                    <div class="prt_saveed_12lk">
                                                        <label class="toggler toggler-danger"><input type="checkbox"><i
                                                                class="ti-heart"></i></label>
                                                    </div>
                                                </div> -->
                                            @can('is_user')
                                                @auth
                                                    @if ($property_sell->checkUserWishlist(auth()->id()))
                                                        <a id="{{ $property_sell->id }}"
                                                           onclick="return send('{{ $property_sell->id }}')"
                                                           style="color:red;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @elseif ($property_sell->checkUserWishlist(auth()->id()))
                                                        <a id="{{ $property_sell->id }}"
                                                           onclick="return send('{{ $property_sell->id }}')"
                                                           style="color:blue ;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @else
                                                        <a id="{{ $property_sell->id }}"
                                                           onclick="return send('{{ $property_sell->id }}')"
                                                           style="color:blue ;font-size: 24px;"
                                                           class="geodir_save-btn tolt"
                                                           data-microtip-position="left" data-tooltip="ذخیره"><span><i
                                                                        class="ti-heart"></i></span></a>
                                                    @endif
                                                @endauth
                                            @endcan
                                        </div>
                                        <div class="_card_list_flex">
                                            <div class="_card_flex_01">
                                                <h4 class="listing-name verified"><a
                                                            href={{ route('properties.show', $property_sell->id) }}
                                                        wire:navigate class="prt-link-detail">
                                                        <h6 class=" mb-2 mt-2 numbers" style="font-size: 15px;">
                                                            {{ $property_sell->title }}
                                                        </h6>
                                                    </a></h4>
                                                <h4 class="listing-name verified">
                                                    <h6 class="listing-card-info-price mb-2 mt-2 numbers"
                                                        style="font-size: 15px;">
                                                        قیمت پیشنهادی
                                                        :
                                                        {{ $property_sell->bidprice }}
                                                        تومان
                                                    </h6>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="price-features-wrapper">
                                    <div class="list-fx-features">
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/bed.svg"
                                                                             width="13" alt=""/>
                                            </div>{{ $property_sell->bedroom }} خوابه
                                        </div>
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/01.png"
                                                                             width="13" alt=""/>
                                            </div>{{ $property_sell->usertype }}
                                        </div>
                                        <div class="listing-card-info-icon">
                                            <div class="inc-fleat-icon"><img src="assets/home/img/move.svg"
                                                                             width="13" alt=""/>
                                            </div>{{ $property_sell->meter }} متر مربع
                                        </div>
                                    </div>
                                </div>

                                <div class="listing-detail-footer">
                                    <div class="footer-first">
                                        <div class="foot-location"><img src="assets/home/img/pin.svg" width="18"
                                                                        alt=""/>
                                            {{ $property_sell->city }},
                                            {{ $property_sell->district }}
                                        </div>
                                    </div>
                                    <div class="footer-flex">
                                        <a href={{ route('properties.show', $property_sell->id) }} wire:navigate
                                           class="prt-view">مشاهده
                                            جزئیات</a>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <!-- End Single Property -->
                    @endforeach
                    <!-- پایان بریا فروش -->
                </div>
            </div>
        </section>
        <!-- برای فروش پایان-->
    @endif
    <!-- ============================ Properties End ================================== -->

    <!-- ============================ Top Agents ================================== -->
    <section class="image-cover min" style="background:#122947 url(assets/home/img/pattern.png) no-repeat;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center light">
                        <h2>مشاوران برجسته ما</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="item-slide space">
                        @foreach ($user_agent as $user_agent)
                            <!-- Single Item -->
                            <div class="single_items">
                                <div class="grid_agents">
                                    <div class="elio_mx_list theme-bg-2">{{ $user_agent->properties->count() }} ملک
                                    </div>
                                    <div class="grid_agents-wrap">

                                        <div class="fr-grid-thumb">
                                            <a>
                                                <span class="verified"><img src="assets/home/img/verified.svg"
                                                                            class="verify mx-auto" alt=""></span>
                                                <img src="{{$user_agent->image? asset('storage/' . $user_agent->image):asset('/pictures/user-default.png') }}"
                                                     class="img-fluid mx-auto" alt="">
                                            </a>
                                        </div>

                                        <div class="fr-grid-deatil">
                                            <span><i class="ti-phone ml-1"></i>{{ $user_agent->phone }}</span>
                                            <h5 class="fr-can-name"><a
                                                        href="{{ route('properties.list', ['user_id' => $user_agent->id]) }}">{{ $user_agent->name }}</a>
                                            </h5>
                                            <!-- <ul class="inline_social">
                                                    <li><a href="#" class="fb"><i class="ti-facebook"></i></a></li>
                                                    <li><a href="#" class="ln"><i class="ti-linkedin"></i></a></li>
                                                    <li><a href="#" class="ins"><i class="ti-instagram"></i></a></li>
                                                    <li><a href="#" class="tw"><i class="ti-twitter"></i></a></li>
                                                </ul> -->
                                        </div>

                                        <div class="fr-infos-deatil">
                                            <a href="tel:{{ $user_agent->phone }}"
                                               class="btn agent-btn theme-black"><i
                                                        class="fa fa-phone ml-2"></i>گرفتن
                                                تماس</a>
                                            <!-- <a href="#" class="btn agent-btn theme-black"><i class="fa fa-phone"></i></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Top Agents End ================================== -->

    <!-- ============================ Property By Location ================================== -->
    <!-- <section class="min">
                <div class="container">
        
                    <div class="row justify-content-center">
                        <div class="col-lg-7 col-md-8">
                            <div class="sec-heading center">
                                <h2>برترین مکان های ملکی</h2>
                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.
                                    چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان.</p>
                            </div>
                        </div>
                    </div>
        
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="grid-layout-with-sidebar.html" class="img-wrap">
                                <div class="location_wrap_content visible">
                                    <div class="location_wrap_content_first">
                                        <h4>رشت</h4>
                                        <span>48 ملک</span>
                                    </div>
                                    <div class="location_btn"><i class="fa fa-arrow-left"></i></div>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/home/img/city-6.png);"></div>
                            </a>
                        </div>
        
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="grid-layout-with-sidebar.html" class="img-wrap">
                                <div class="location_wrap_content visible">
                                    <div class="location_wrap_content_first">
                                        <h4>ایران , تهران</h4>
                                        <span>73 ملک</span>
                                    </div>
                                    <div class="location_btn"><i class="fa fa-arrow-left"></i></div>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/home/img/city-7.png);"></div>
                            </a>
                        </div>
        
                        <div class="col-lg-4 col-md-4 col-sm-6">
                            <a href="grid-layout-with-sidebar.html" class="img-wrap">
                                <div class="location_wrap_content visible">
                                    <div class="location_wrap_content_first">
                                        <h4>ایران , کرج</h4>
                                        <span>40 ملک</span>
                                    </div>
                                    <div class="location_btn"><i class="fa fa-arrow-left"></i></div>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/home/img/city-3.png);"></div>
                            </a>
                        </div>
        
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a href="grid-layout-with-sidebar.html" class="img-wrap">
                                <div class="location_wrap_content visible">
                                    <div class="location_wrap_content_first">
                                        <h4>تبریز</h4>
                                        <span>35 ملک</span>
                                    </div>
                                    <div class="location_btn"><i class="fa fa-arrow-left"></i></div>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/home/img/city-4.png);"></div>
                            </a>
                        </div>
        
                        <div class="col-lg-6 col-md-6 col-sm-6">
                            <a href="grid-layout-with-sidebar.html" class="img-wrap">
                                <div class="location_wrap_content visible">
                                    <div class="location_wrap_content_first">
                                        <h4>تهران, کرج</h4>
                                        <span>10 ملک</span>
                                    </div>
                                    <div class="location_btn"><i class="fa fa-arrow-left"></i></div>
                                </div>
                                <div class="img-wrap-background" style="background-image: url(assets/home/img/city-5.png);"></div>
                            </a>
                        </div>
        
                    </div>
        
                </div>
            </section> -->
    <!-- ============================ Property By Location End ================================== -->
    <!-- ============================ article Start ================================== -->
    <section class="min">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-lg-7 col-md-8">
                    <div class="sec-heading center">
                        <h2>آخرین اخبار و مقالات</h2>
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                @foreach ($posts as $post)
                    <!-- Single blog Grid -->
                    <div class="col-lg-4 col-md-6">
                        <div class="grid_blog_box">
                            <div class="gtid_blog_thumb">
                                <a href="/blog/{{ $post->id }}" wire:navigate><img
                                            src="{{ asset('storage/' . $post->image->url) }}" class="img-fluid"
                                            alt="{{ $post->slug }}"/></a>
                                <div class="gtid_blog_info">
                                    <span>تاریخ</span>{{ Hekmatinasser\Verta\Verta::instance($post->created_at)->format('Y/n/j') }}
                                </div>
                            </div>

                            <div class="blog-body">
                                <h4 class="bl-title"><a href="/blog/{{ $post->id }}"
                                                        wire:navigate>{{ $post->title }}</a><span
                                            class="latest_new_post">خبر</span>
                                </h4>
                                <div class="text-overflow">
                                    <p>{!! $post->body !!}</p>
                                </div>
                            </div>

                            <div class="modern_property_footer">
                                <div class="property-author">
                                    <div class="path-img"><a tabindex="-1"><img
                                                    src="{{ asset('storage/profile/' . $post->user->image) }}"
                                                    class="img-fluid" alt=""></a>
                                    </div>
                                    <h5><a tabindex="-1">{{ $post->user->name }}</a></h5>
                                </div>
                                <span class="article-pulish-date">
                                    <div class="footer-flex">
                                        <a href="/blog/{{ $post->id }}" wire:navigate class="prt-view">مشاهده</a>
                                    </div>
                                </span>
                            </div>

                        </div>
                    </div>
                @endforeach

                @foreach ($articles as $article)
                    <!-- Single blog Grid -->
                    <div class="col-lg-4 col-md-6">
                        <div class="grid_blog_box">
                            <div class="gtid_blog_thumb">
                                <a href="/article/{{ $article->id }}" wire:navigate><img
                                            src="{{ asset('storage/' . $article->image->url) }}" class="img-fluid"
                                            alt="{{ $article->slug }}"/></a>
                                <div class="gtid_blog_info">
                                    <span>تاریخ</span>{{ Hekmatinasser\Verta\Verta::instance($article->created_at)->format('Y/n/j') }}

                                </div>
                            </div>

                            <div class="blog-body">
                                <h4 class="bl-title"><a href="/article/{{ $article->id }}"
                                                        wire:navigate>{{ $article->title }}</a><span
                                            class="latest_new_post">مقاله</span></h4>
                                <div class="text-overflow">
                                    <p>{!! $article->body !!}</p>
                                </div>
                            </div>

                            <div class="modern_property_footer">
                                <div class="property-author">
                                    <div class="path-img"><a tabindex="-1"><img
                                                    src="{{ asset('storage/profile/' . $article->user->image) }}"
                                                    class="img-fluid" alt=""></a>
                                    </div>
                                    <h5><a href=tabindex="-1">{{ $article->user->name }}</a></h5>
                                </div>
                                <span class="article-pulish-date">
                                    <div class="footer-flex">
                                        <a href="/article/{{ $article->id }}" wire:navigate
                                           class="prt-view">مشاهده</a>
                                    </div>
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <div class="clearfix"></div>
    <!-- ============================ article End ================================== -->

    <!-- ============================ Call To Action ================================== -->
    <section class="theme-bg call_action_wrap-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="call_action_wrap">
                        <div class="call_action_wrap-head">
                            <h3>آیا سوالی دارید؟</h3>
                            <span>ما به شما کمک میکنیم تا بهترین خانه را انتخاب کنید</span>
                        </div>
                        <a href='/contact-us' wire:navigate class="btn btn-call_action_wrap">امروز با ما تماس
                            بگیرید</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ============================ Call To Action End ================================== -->
    @include('livewire.home.partials.send-message')
</div>
@script
    <script>
        $body = $("body");
        $(document).on({
            ajaxStart: function() {
                $body.addClass("loading");
            },
            ajaxStop: function() {
                $body.removeClass("loading");
            }
        });
        $(document).ready(function() {
            $("#price,#rahn,#rent").hide();
            $(document).on('change', '#tr_type', function(e) {
                if (this.value === 'فروش') {
                    $('#price').show();
                    $('#rahn,#rent').hide();
                } else if (this.value === 'رهن و اجاره') {
                    $('#price').hide();
                    $('#rahn,#rent').show();
                } else {
                    $("#price,#rahn,#rent").hide();
                }
            })
        });

        $.fn.digits = function() {
            return this.each(function() {
                $(this).text($(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,"));
            })
        }
        $("h6.numbers").digits();

        $('#deal_type').select2({
            dir: "rtl",
            placeholder: "انتخاب",
            allowClear: true,
        }).on('change', function() {
            $wire.$set('deal_type', $(this).val());
        });

        $('#type').select2({
            dir: "rtl",
            placeholder: "انتخاب",
            allowClear: true,
        }).on('change', function() {
            $wire.$set('property_type', $(this).val());
        });

        $('#district').select2({
            dir: "rtl",
            placeholder: "انتخاب",
            allowClear: true,
        }).on('change', function() {
            $wire.$set('district', $(this).val());
        });
    </script>
@endscript
