@extends('home.layout.HomeLayout')

@push("styles")
<link href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css" rel="stylesheet" type="text/css">
@endpush

@section('title',$property->title)
@section('content')

<!-- ============================ Hero Banner  Start================================== -->
<!-- Gallery Part Start -->
<section class="gallery_parts pt-2 pb-2 d-none d-sm-none d-md-none d-lg-none d-xl-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-7 col-sm-12 pl-1">
                <div class="gg_single_part left"><a href="{{asset('storage/preview/'.$property->img)}}"
                        class="mfp-gallery"><img src="{{asset('storage/preview/'.$property->img)}}"
                            class="img-fluid mx-auto" alt="" /></a></div>
            </div>
            @if(count($property->images) > 0)
            <div class="col-lg-4 col-md-5 col-sm-12 pr-1">
                @foreach($property->images->take(3) as $sImage)
                <div class="{{$loop->index == 1 ?'gg_single_part-right min mt-2 mb-2':'gg_single_part-right min'}}">
                    <a href="{{asset('storage/otherpreview/'.$sImage->name)}}" class="mfp-gallery"><img
                            src="{{asset('storage/otherpreview/'.$sImage->name)}}" class="img-fluid mx-auto"
                            alt="" /></a>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
</section>
@if(count($property->images) > 0)
<div class="featured_slick_gallery gray d-block d-md-block d-lg-block d-xl-none">
    <div class="featured_slick_gallery-slide">
        <div class="featured_slick_padd"><a href="{{asset('storage/preview/'.$property->img)}}" class="mfp-gallery"><img
                    src="{{asset('storage/preview/'.$property->img)}}" class="img-fluid mx-auto" alt="" /></a></div>
        @foreach($property->images as $aImage)
        <div class="featured_slick_padd"><a href="{{asset('storage/otherpreview/'.$aImage->name)}}"
                class="mfp-gallery"><img src="{{asset('storage/otherpreview/'.$aImage->name)}}"
                    class="img-fluid mx-auto" alt="" /></a></div>
        @endforeach
    </div>
</div>
@endif
<!-- ============================ Hero Banner End ================================== -->

<!-- ============================ Property Detail Start ================================== -->
<section class="gray">
    <div class="container">
        <div class="row">

            <!-- property main detail -->
            <div class="col-lg-8 col-md-12 col-sm-12">

                <div class="property_info_detail_wrap exlio_wrap mb-4">
                    <div class="property_info_detail_wrap_first">
                        <div class="pr-price-into">
                            <div class="_card_list_flex mb-2">
                                <div class="_card_flex_01">
                                    <span
                                        class="_list_blickes types">{{Hekmatinasser\Verta\Verta::instance($property->created_at)->format('%d %B، %Y')}}</span>
                                    @if(isset($property->lable))
                                    <span class="_list_blickes _netork">{{$property->lable}}</span>
                                    @endif
                                    <span class="_list_blickes types">{{$property->tr_type}}</span>
                                    <span class="_list_blickes types">{{$property->usertype}}</span>
                                    <span class="_list_blickes types">{{$property->type}}</span>
                                    <ul class="_share_lists light d-inline">

                                        @can('is_user')
                                        <li>
                                            <a> <i id='wished' onclick="sender('{{$property->id}}')"
                                                    class=" fa fa-bookmark"
                                                    style="{{ $wishlist ?  "font-size:30px;color:green" : "font-size:20px;color:gray" }}">
                                                </i>
                                            </a>
                                        </li>
                                        @endcan

                                    </ul>
                                </div>
                            </div>
                            <h2>{{$property->title}}</h2>
                            <span><i class="lni-map-marker"></i> {{$property->province.' ، '.$property->city.' ، '.$property->district}}</span>
                        </div>
                    </div>

                    <div class="property_detail_section">
                        <div class="prt-sect-pric">
                            @if($property->tr_type==='رهن و اجاره')
                            <p>مبلغ رهن:<span class="pr-2 text-muted">{{number_format($property->rahn)}} تومان</span></p>
                            <p>مبلغ اجاره:<span class="pr-2 text-muted">{{number_format($property->rent)}} تومان</span></p>
                            @else
                            <p>قیمت:<span class="pr-2 text-muted">{{number_format($property->bidprice)}} تومان</span></p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Single Block Wrap -->
                <div class="_prtis_list mb-4">
                    <div class="_prtis_list_header">
                        <ul>
                            <li>
                                <div class="content_thumb"><img src="/assets/home/img/bed.svg" alt="" /></div>
                                <div class="content">
                                    <span class="dark">{{$property->bedroom}}</span>
                                    <span class="title">اتاق خواب</span>
                                </div>
                            </li>
                            <li>
                                <div class="content_thumb"><i class="fa fa-building ml-1"></i></div>
                                <div class="content">
                                    <span class="dark">{{$property->floorsell}}</span>
                                    <span class="title">طبقه مورد معامله</span>
                                </div>
                            </li>
                            <li>
                                <div class="content_thumb"><img src="/assets/home/img/area.svg" alt="" /></div>
                                <div class="content">
                                    <span class="dark">{{$property->meter}} مترمربع</span>
                                    <span class="title">متراژ زیربنا</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="_prtis_list_body">
                        <ul class="deatil_features">
                            @isset($property->code)<li><strong>{{$property->code}}</strong>شناسه ملک</li>@endisset
                            @isset($property->floor)<li><strong>{{$property->floor}}</strong>تعداد طبقات</li>@endisset
                            @isset($property->year)<li><strong>{{$property->year}}</strong>مدت ساخت</li>@endisset
                            @isset($property->area)<li><strong>{{$property->area}}</strong>مساحت زمین ملک</li>@endisset
                            @if($property->tr_type==='رهن و اجاره')
                            @isset($property->people_number)<li><strong>{{$property->people_number}}</strong>تعداد نفرات
                            </li>@endisset
                            @else
                            @isset($property->loan)<li><strong>{{$property->loan}}</strong>وام بانکی</li>@endisset
                            @if($property->loanamount)<li><strong>{{number_format($property->loanamount)}} تومان</strong>مبلغ وام</li>
                            @endif
                            @if($property->meter_price)<li><strong>{{number_format($property->meter_price)}} تومان</strong>قیمت هر متر
                                مربع</li>@endisset
                            @endif
                            @isset($property->doc)<li><strong>{{$property->doc}}</strong>نوع سند</li>@endisset
                            @isset($property->dimension)<li><strong>{{$property->dimension}}</strong>ابعاد</li>@endisset
                            @isset($property->view)<li><strong>{{$property->view}}</strong>نما</li>@endisset
                            @isset($property->door)<li><strong>{{$property->door}}</strong>درب ورودی</li>@endisset
                            @isset($property->screen)<li><strong>{{$property->screen}}</strong>پرده</li>@endisset
                            @isset($property->cover)<li><strong>{{$property->cover}}</strong>کفپوش</li>@endisset
                            @isset($property->phone_line)<li><strong>{{$property->phone_line}}</strong>خط تلفن</li>
                            @endisset
                            @isset($property->cool)<li><strong>{{$property->cool}}</strong>سیستم برودتی</li>@endisset
                            @isset($property->heat)<li><strong>{{$property->heat}}</strong>سیستم حرارتی</li>@endisset
                            @isset($property->cabinet)<li><strong>{{$property->cabinet}}</strong>کابینت</li>@endisset
                            @isset($property->collection)<li><strong>{{$property->collection}}</strong>تعداد واحدهای
                                مجموعه</li>@endisset
                        </ul>
                    </div>
                </div>
                @isset($property->description)
                <!-- Single Block Wrap -->
                <div class="_prtis_list mb-4">
                    <div class="_prtis_list_header min">
                        <h4 class="m-0">درباره <span class="theme-cl">ملک</span></h4>
                    </div>
                    <div class="_prtis_list_body">
                        <p>{{$property->description}}</p>
                    </div>
                </div>
                @endisset

                @if(count($property->features)>0)
                <!-- Single Block Wrap -->
                <div class="_prtis_list mb-4">

                    <div class="_prtis_list_header min">
                        <h4 class="m-0">همه <span class="theme-cl">امکانات رفاهی</span></h4>
                    </div>

                    <div class="_prtis_list_body">
                        <ul class="avl-features third">
                            @foreach($property->features as $feature)
                            <li class="active">{{$feature->name}}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
              
               @if($property->ambed)
                <!-- Single Block Wrap -->
                <div class="_prtis_list mb-4">

                    <div class="_prtis_list_header min">
                        <h4 class="m-0"> <span class="theme-cl">ویدیو</span></h4>
                    </div>

                    <div class="_prtis_list_body">
                      @php
    echo $property->ambed;
    @endphp:
                        
                    </div>
                </div>
                @endif

                @isset($property->lon)
                <div class="_prtis_list mb-4">
                    <div class="_prtis_list_header min">
                        <h4 class="m-0">موقعیت <span class="theme-cl">ملک</span></h4>
                    </div>
                    <div class="_prtis_list_body">
                        <div class="map-container">
                            <div id="smap" class="full-width" style="height: 450px; background: #eee; border: 2px solid #aaa;"></div>
                        </div>
                    </div>
                </div>
                @endisset
                <!-- Single Reviews Block -->
                <div class="_prtis_list mb-4">

                    <div class="_prtis_list_header min">
                        <h4 class="m-0">{{$property->comments_count}} نظر <span class="theme-cl">ارسال شده</span></h4>
                    </div>
                    @if($property->comments_count > 0)
                    <div class="_prtis_list_body">
                        <div class="author-review">
                            <div class="comment-list">
                                <ul>
                                    @foreach($property->comments as $comment)
                                    <li class="article_comments_wrap">
                                        <article>
                                            <div class="article_comments_thumb">
                                                <img src="{{asset('storage/profile/'.$comment->user->image)}}" alt="">
                                            </div>
                                            <div class="comment-details">
                                                <div class="comment-meta">
                                                    <div class="comment-left-meta">
                                                        <h4 class="author-name">{{$comment->user->name}}</h4>
                                                        <div class="comment-date">
                                                            {{Hekmatinasser\Verta\Verta::instance($comment->created_at)->format('%d %B، %Y')}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="comment-text">
                                                    <p>{{$comment->body}}</p>
                                                </div>
                                            </div>
                                        </article>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <a href="#" class="reviews-checked">نظرات بیشتر</a>
                    </div>
                    @endif
                </div>

                <!-- Single Write a Review -->
                <div class="_prtis_list mb-4">

                    <div class="_prtis_list_header min">
                        <h4 class="m-0">ارسال <span class="theme-cl">نظرات</span></h4>
                    </div>

                    <div class="_prtis_list_body">
                        @guest
                        <p>برای ثبت نظر ابتدا وارد حساب کاربری خود شوید</p>
                        @endguest
                        @auth
                        <div class="row">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form id="comment" action="{{route('comments.register',$property->id)}}"
                                    class="add-comment custom-form" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label>پیام</label>
                                        <textarea class="form-control ht-80"
                                        name="body"
                                            oninvalid="this.setCustomValidity('لطفا متن نظر خود را وارد کنید')"
                                            oninput="setCustomValidity('')" required></textarea>
                                    </div>
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="form-group">
                                    <button class="btn theme-bg-2 rounded" type="submit">ارسال نظر</button>
                                </div>
                            </div>
                            </form>
                        </div>
                        @endauth
                    </div>

                </div>

            </div>

            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="property-sidebar">

                    <!-- Agent Detail -->
                    <div class="sider_blocks_wrap">
                        <div class="side-booking-body">
                            <div class="agent-_blocks_title">

                                <div class="agent-_blocks_thumb"><img src="{{asset('storage/profile/'.$user->image)}}"
                                        alt="{{$user->name}}"></div>
                                <div class="agent-_blocks_caption">
                                    <h4><a href="{{route('properties.list',['user_id'=>$user->id])}}">{{$user->name}}</a></h4>
                                    <span class="approved-agent"><i class="ti-check"></i>تعداد ملک ثبت شده: {{$user->properties_count}}</span>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                            <a href="tel:{{$user->phone}}" class="agent-btn-contact"><i class="ti-mobile"></i>تماس</a>

                            <span id="number" data-last="{{$user->phone}}">
                                <span><i class="ti-headphone-alt"></i><a class="see">نمایش شماره...</a></span>
                            </span>
                        </div>
                    </div>
                    @if(count($similar_properties) > 0)
                    <!-- Featured Property -->
                    <div class="sidebar-widgets">
                        <h4>املاک مشابه</h4>
                        <div class="sidebar_featured_property">
                            <!-- List Sibar Property -->
                            @foreach($similar_properties as $sProperty)

                            <div class="sides_list_property">
                                <div class="sides_list_property_thumb">
                                    <img src="{{asset('storage/preview/'.$sProperty->img)}}" class="img-fluid" alt="{{$sProperty->title}}" />
                                </div>
                                <div class="sides_list_property_detail">
                                    <h4><a href="{{route('properties.show',$sProperty->id)}}">{{$sProperty->title}}</a>
                                    </h4>
                                    <span><i class="ti-location-pin"></i> {{$sProperty->province}} ،
                                        {{$sProperty->city}} ، {{$sProperty->district}} </span>
                                    <div class="lists_property_price">
                                        @if($sProperty->tr_type==='رهن و اجاره')
                                        <div class="lists_property_types">
                                            <div class="property_types_vlix">برای اجاره</div>
                                        </div>
                                        <div class="lists_property_price_value">
                                            <strong>رهن:</strong>
                                            <h4>{{number_format($sProperty->rahn)}} تومان</h4>
                                            <strong>اجاره:</strong>
                                            <h4>{{number_format($sProperty->rent)}} تومان</h4>
                                        </div>
                                        @else
                                        <div class="lists_property_types">
                                            <div class="property_types_vlix sale">برای فروش</div>
                                        </div>
                                        <div class="lists_property_price_value">
                                            <h4>{{number_format($sProperty->bidprice)}} تومان</h4>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
<!-- ============================ Property Detail End ================================== -->

@endsection
@push('scripts')
<!-- neshan map -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL">
</script>
<script src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js" type="text/javascript"></script>
<script>
var iconFeature = new ol.Feature({
    geometry: new ol.geom.Point(ol.proj.transform([<?php echo $property->lon ?>, <?php echo $property->lat ?>],
        'EPSG:4326', 'EPSG:3857')),
    name: 'Null Island',
    population: 4000,
    rainfall: 500
});
var iconStyle = new ol.style.Style({
    image: new ol.style.Icon( /** @type {olx.style.IconOptions} */ ({
        anchor: [0.5, 46],
        anchorXUnits: 'fraction',
        anchorYUnits: 'pixels',
        opacity: 0.75,
        src: '/images/icons8-home-address-48.png'
    }))
});

iconFeature.setStyle(iconStyle);

var vectorSource = new ol.source.Vector({
    features: [iconFeature]
});
var vectorLayer = new ol.layer.Vector({
    source: vectorSource
});
var myMap = new ol.Map({
    layers: [new ol.layer.Tile({
        source: new ol.source.OSM()
    }), vectorLayer],
    target: 'smap',
    key: <?php echo "'" . $setting->apiKey . "'" ?>,
    maptype: 'dreamy',
    poi: true,
    traffic: false,
    view: new ol.View({
        center: ol.proj.fromLonLat([<?php echo $property->lon ?>, <?php echo $property->lat ?>]),
        zoom: 16,
    })
});
</script>
<!-- ----------- end neshan map -->
@endpush