<div class="col-lg-6 col-md-6 col-sm-12">
    <div class="property-listing property-2">

        <div class="listing-img-wrapper">
            @isset($property->lable)
                <div class="_exlio_125" style="background-color:#ff2f2f;">{{ $property->lable }}</div>
            @endisset
            <div class="list-img-slide">
                <div class="click">
                    <div><a href={{ route('properties.show', [$property->id]) }}><img
                                src="{{ asset('storage/preview/' . $property->img) }}" class="img-fluid mx-auto"
                                alt="" /></a></div>
                    <!-- اسلاید -->
                    <!-- <div><a href="single-property-1.html"><img src="/assets/home/img/p-2.png"
                                            class="img-fluid mx-auto" alt="" /></a></div>
                                <div><a href="single-property-1.html"><img src="/assets/home/img/p-3.png"
                                            class="img-fluid mx-auto" alt="" /></a></div> -->
                </div>
            </div>
        </div>

        <div class="listing-detail-wrapper">
            <div class="listing-short-detail-wrap">
                <div class="_card_list_flex mb-2">
                    <div class="_card_flex_01">
                        <span class="_list_blickes _netork">برای {{ $property->tr_type }}</span>
                        <span class="_list_blickes types">{{ $property->type }}</span>
                    </div>
                    @can('is_user')
                        @auth
                            @if ($property->checkUserWishlist(auth()->id()))
                                <a id="{{ $property->id }}" onclick="return send('{{ $property->id }}')"
                                    style="color:red;font-size: 24px;" class="geodir_save-btn tolt"
                                    data-microtip-position="left" data-tooltip="ذخیره"><span><i class="ti-heart"></i></span></a>
                            @elseif ($property->checkUserWishlist(auth()->id()))
                                <a id="{{ $property->id }}" onclick="return send('{{ $property->id }}')"
                                    style="color:blue ;font-size: 24px;" class="geodir_save-btn tolt"
                                    data-microtip-position="left" data-tooltip="ذخیره"><span><i class="ti-heart"></i></span></a>
                            @else
                                <a id="{{ $property->id }}" onclick="return send('{{ $property->id }}')"
                                    style="color:blue ;font-size: 24px;" class="geodir_save-btn tolt"
                                    data-microtip-position="left" data-tooltip="ذخیره"><span><i class="ti-heart"></i></span></a>
                            @endif
                        @endauth
                    @endcan
                </div>
                <div class="_card_list_flex">
                    <div class="_card_flex_01">
                        <h4 class="listing-name verified">
                            <a href="{{ route('properties.show', [$property->id]) }}" class="prt-link-detail">
                                <h6 class=" mb-2 mt-2 numbers" style="font-size: 15px;">
                                    {{ $property->title }}
                                </h6>
                            </a>
                        </h4>
                        @if ($property->tr_type === 'رهن و اجاره')
                            <h4 class="listing-name verified">
                                <a href="{{ route('properties.show', [$property->id]) }}" class="prt-link-detail">
                                    <h6 class="listing-card-info-price mb-2 mt-2 numbers" style="font-size: 15px;">مبلغ
                                        اجاره
                                        :
                                        {{ $property->rent == null ? '' : number_format($property->rent) }}
                                        تومان
                                    </h6>
                                </a>
                            </h4>
                            <h4 class="listing-name verified">
                                <a href="{{ route('properties.show', [$property->id]) }}" class="prt-link-detail">
                                    <h6 class="listing-card-info-price mb-2 numbers" style="font-size: 15px;">
                                        مبلغ رهن
                                        :
                                        {{ $property->rahn == null ? '' : number_format($property->rahn) }}
                                        تومان
                                    </h6>
                                </a>
                            </h4>
                        @else
                            <h4 class="listing-name verified">
                                <a href="{{ route('properties.show', [$property->id]) }}" class="prt-link-detail">
                                    <h6 class="listing-card-info-price mb-2 numbers" style="font-size: 15px;">
                                        مبلغ
                                        :
                                        {{ $property->bidprice == null ? '' : number_format($property->bidprice) }}
                                        تومان
                                    </h6>
                                </a>
                            </h4>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="price-features-wrapper">
            <div class="list-fx-features">
                <div class="listing-card-info-icon">
                    <div class="inc-fleat-icon"><img src="/assets/home/img/bed.svg" width="13" alt="" />
                    </div>{{ $property->bedroom }} خوابه
                </div>
                <div class="listing-card-info-icon">
                    <div class="inc-fleat-icon"><img src="/assets/home/img/01.png" width="13" alt="" />
                    </div>{{ $property->usertype }}
                </div>
                <div class="listing-card-info-icon">
                    <div class="inc-fleat-icon"><img src="/assets/home/img/move.svg" width="13" alt="" />
                    </div>{{ $property->meter }} متر مربع
                </div>
            </div>
        </div>

        <div class="listing-detail-footer">
            <div class="footer-first">
                <div class="foot-location"><img src="/assets/home/img/pin.svg" width="18" alt="" />
                    {{ $property->city }},
                    {{ $property->district }}
                </div>
            </div>
            <div class="footer-flex">
                <a href={{ route('properties.show', [$property->id]) }} class="prt-view">مشاهده جزئیات</a>
            </div>

        </div>

    </div>
</div>
