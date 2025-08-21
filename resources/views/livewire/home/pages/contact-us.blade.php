@section('title', 'تماس با ما')
<div>
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title" style="background:#f4f4f4 url(assets/home/img/slider-3.jpg);" data-overlay="5">
        <div class="ht-80"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="_page_tetio">
                        <div class="pledtio_wrap"><span>تماس با ما</span></div>
                        <h2 class="text-light mb-0">دریافت راهنمایی و مشاوره</h2>
                        <p>{{ $setting->description }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="ht-120"></div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ Agency List Start ================================== -->
    <section class="pt-0">
        <div class="container">
            <div class="row align-items-center pretio_top">
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="contact-box">
                        <i class="ti-location-pin theme-cl"></i>
                        <h4>آدرس</h4>
                        <span class="live-chat">
                            <a>
                                <p>{{ $setting->address }}</p>
                            </a>
                        </span>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="contact-box">
                        <i class="ti-user theme-cl"></i>
                        <h4>تماس با ما</h4>
                        @isset($setting->phones)
                            @foreach ($setting->phones as $phone)
                                <span class="live-chat"> <a href="tel:{{ $phone }}">{{ $phone }}</a></span>
                            @endforeach
                        @endisset
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-12">
                    <div class="contact-box">
                        <i class="ti-comment-alt theme-cl"></i>
                        <h4>پست الکترونیک</h4>
                        @isset($setting->emails)
                            @foreach ($setting->emails as $email)
                                <!-- <span> {{ $email }}</span> -->
                                <span class="live-chat"> <a href="mailto:{{ $email }}">{{ $email }}</a></span>
                            @endforeach
                        @endisset
                    </div>
                </div>
            </div>
            @isset($setting->latitude)
                <!-- row Start -->
                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div id="smap" class="full-width" style="background: #eee; border: 2px solid #aaa;"></div>
                    </div>
                </div>
                <!-- /row -->
            @endisset
        </div>
    </section>

    <!-- ============================ Agency List End ================================== -->
    @if ($setting->instagram || $setting->telegram || $setting->whatsapp)
        <!-- ============================ Our Partner Start ================================== -->
        <section class="gray-simple">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-md-10 col-sm-12">
                        <div class="reio_o9i text-center mb-5">
                            <h2>ارتباط با ما از طریق شبکه های اجتماعی</h2>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center">
                    <div class="col-lg-9 col-md-10 col-sm-12 flex-wrap justify-content-center text-center">
                        @isset($setting->whatsapp)
                            <div class="pertner_flexio">
                                <img src="assets/home/img/c-1.png" class="img-fluid" alt="" />
                                <a href="{{ $setting->whatsapp }}">
                                    <h5>واتس آپ</h5>
                                </a>
                            </div>
                        @endisset
                        @isset($setting->telegram)
                            <div class="pertner_flexio">
                                <img src="assets/home/img/c-2.png" class="img-fluid" alt="" />
                                <a href="{{ $setting->telegram }}">
                                    <h5>تلگرام</h5>
                                </a>
                            </div>
                        @endisset
                        @isset($setting->instagram)
                            <div class="pertner_flexio">
                                <img src="/assets/home/img/c-3.png" class="img-fluid" alt="" />
                                <a href="{{ $setting->instagram }}">
                                    <h5>اینستاگرام</h5>
                                </a>
                            </div>
                        @endisset
                    </div>
                </div>
            </div>
        </section>
    @endif
</div>
@push('styles')
    <!-- neshan style  -->
    <link href="https://static.neshan.org/sdk/openlayers/5.3.0/ol.css" rel="stylesheet" type="text/css">
@endpush
@pushif( $setting->apiKey,'scripts')
<!-- neshan map  -->
<script src="https://cdn.polyfill.io/v2/polyfill.min.js?features=requestAnimationFrame,Element.prototype.classList,URL">
</script>
<script src="https://static.neshan.org/sdk/openlayers/5.3.0/ol.js" type="text/javascript"></script>
<script>
    var iconFeature = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.transform([<?php echo $setting->longitude; ?>,
            <?php echo $setting->latitude; ?>
        ], 'EPSG:4326', 'EPSG:3857')),
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
            src: '/pictures/icons8-home-address-48.png'
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
        key: <?php echo "'" . $setting->apiKey . "'"; ?>,
        maptype: 'dreamy',
        poi: true,
        traffic: false,
        view: new ol.View({
            center: ol.proj.fromLonLat([<?php echo $setting->longitude; ?>,
                <?php echo $setting->latitude; ?>
            ]),
            zoom: 16,
        })
    });
</script>
<!-- end neshan map -->
@endpushif
