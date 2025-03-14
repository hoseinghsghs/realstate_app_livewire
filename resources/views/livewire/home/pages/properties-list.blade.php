@section('title','لیست املاک')

<section class="gray pt-4">
    <div class="container">

        <!-- <div class="row m-0">
            <div class="short_wraping">
                <div class="row align-items-center">

                    <div class="col-lg-3 col-md-6 col-sm-12  col-sm-6">
                        <ul class="shorting_grid">
                            <li class="list-inline-item"><a href="grid-layout-with-sidebar.html" class="active"><span class="ti-layout-grid2"></span>شبکه ای</a></li>
                            <li class="list-inline-item"><a href="list-layout-with-sidebar.html"><span class="ti-view-list"></span>لیستی</a></li>
                            <li class="list-inline-item"><a href="#"><span class="ti-map-alt"></span>نقشه</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-6 col-md-12 col-sm-12 order-lg-2 order-md-3 elco_bor col-sm-12">
                        <div class="shorting_pagination">
                            <div class="shorting_pagination_laft">
                                <h5>نمایش 1-25 از 72 نتیجه</h5>
                            </div>
                            <div class="shorting_pagination_right">
                                <ul>
                                    <li><a href="javascript:void(0);" class="active">1</a></li>
                                    <li><a href="javascript:void(0);">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li><a href="javascript:void(0);">4</a></li>
                                    <li><a href="javascript:void(0);">5</a></li>
                                    <li><a href="javascript:void(0);">6</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 order-lg-3 order-md-2 col-sm-6">
                        <div class="shorting-right">
                            <label>مرتب سازی بر اساس:</label>
                            <div class="dropdown show">
                                <a class="btn btn-filter dropdown-toggle" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="selection">بیشترین امتیاز</span>
                                </a>
                                <div class="drp-select dropdown-menu">
                                    <a class="dropdown-item" href="JavaScript:Void(0);">بیشترین امتیاز</a>
                                    <a class="dropdown-item" href="JavaScript:Void(0);">بیشترین بازدید</a>
                                    <a class="dropdown-item" href="JavaScript:Void(0);">جدیدترین</a>
                                    <a class="dropdown-item" href="JavaScript:Void(0);">کمتریت امتیاز</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div> -->

        <div class="row">
            <!-- property Sidebar -->
            <div class="col-lg-4 col-md-12 col-sm-12">
                <div class="page-sidebar p-0">
                    <a class="filter_links" data-toggle="collapse" href="#fltbox" role="button" aria-expanded="false"
                       aria-controls="fltbox">فیلتر پیشرفته<i class="fa fa-sliders-h mr-2"></i></a>
                    <div class="collapse" id="fltbox">
                        <!-- Find New Property -->
                        <div class="sidebar-widgets p-4">
                            <form wire:submit="search_properties">
                                <div @class(["form-group","d-none"=>count(request()->query())===1 && request()->query('deal_type')])>
                                    <div class="simple-input" wire:ignore wire:key={{request()->query('deal_type')}}>
                                        <select id="deal_type" class="form-control">
                                            <option value="">&nbsp;</option>
                                            <option>رهن و اجاره</option>
                                            <option>فروش</option>
                                            <option>پیش فروش</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="simple-input" wire:ignore>
                                        <select id="property_type" class="form-control">
                                            <option value="">&nbsp;</option>
                                            <option>آپارتمان</option>
                                            <option>خانه ویلایی</option>
                                            <option>زمین و کلنگی</option>
                                            <option>مغازه</option>
                                            <option>دفتر کار</option>
                                            <option>باغ</option>
                                            <option>انبار</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="simple-input" wire:ignore>
                                        <select id="district" class="form-control">
                                            <option value="">&nbsp;</option>
                                            @isset($districts)
                                                @foreach($districts as $district)
                                                    <option>{{$district}}</option>
                                                @endforeach
                                            @endisset
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-with-icon">
                                        <input wire:model.live.debounce.600="filter.search" type="text"
                                               class="form-control"
                                               placeholder="عنوان، آدرس">
                                        <i class="ti-search"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="simple-input" wire:ignore>
                                                <select id="floor" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="simple-input" wire:ignore>
                                                <select id="bedroom" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="simple-input" wire:ignore>
                                                <select id="docType" name="doc" class="form-control">
                                                    <option value="">&nbsp;</option>
                                                    <option>سند دار</option>
                                                    <option>قولنامه ای</option>
                                                    <option>در دست اقدام</option>
                                                    <option>مشاع</option>
                                                    <option>دیگر</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="simple-input">
                                                <input wire:model.live.debounce.600="filter.code" type="text"
                                                       class="form-control"
                                                       placeholder="شناسه ملک">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
                                        <h6>متراژ(مترمربع)</h6>
                                        <div class="rg-slider" wire:ignore>
                                            <input type="text" class="meter-range-slider" name="meter-range" value=""/>
                                        </div>
                                    </div>
                                    <div id="price" @class(["col-lg-12 col-md-12 col-sm-12 pt-4 pb-4","d-none"=>$filter['deal_type'] === 'رهن و اجاره' || !$filter['deal_type']])>
                                        <h6>قیمت(تومان)</h6>
                                        <div class="rg-slider" wire:ignore>
                                            <input type="text" class="price-range-slider" name="price-range"
                                                   value=""/>
                                        </div>
                                    </div>
                                    <div id="rahn" @class(["col-lg-12 col-md-12 col-sm-12 pt-4 pb-4","d-none"=>$filter['deal_type'] === 'فروش' || !$filter['deal_type']])>
                                        <h6>رهن(تومان)</h6>
                                        <div class="rg-slider" wire:ignore>
                                            <input type="text" class="rahn-range-slider" name="rahn-range"
                                                   value=""/>
                                        </div>
                                    </div>
                                    <div id="rent" @class(["col-lg-12 col-md-12 col-sm-12 pt-4 pb-4","d-none"=>$filter['deal_type'] === 'فروش' || !$filter['deal_type']])>
                                        <h6>اجاره(تومان)</h6>
                                        <div class="rg-slider" wire:ignore>
                                            <input type="text" class="rent-range-slider" name="rent-range"
                                                   value=""/>
                                        </div>
                                    </div>
                                </div>
                                @if(count($all_features)>0)
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                            <h6>ویژگی های پیشرفته</h6>
                                            <ul class="row p-0 m-0">
                                                @foreach($all_features as $feature)
                                                    <li class="col-lg-6 col-md-6 p-0">
                                                        <input id="check-{{$feature->id}}" class="checkbox-custom"
                                                               value="{{$feature->id}}"
                                                               wire:model.live="filter.features"
                                                               type="checkbox">
                                                        <label for="check-{{$feature->id}}"
                                                               class="checkbox-custom-label">{{$feature->name}}</label>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                        <button type="submit" class="btn theme-bg-2 rounded full-width">جستجو</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->
            </div>

            <div class="col-lg-8 col-md-12 col-sm-12">
                @if($properties->total() > 0)
                    <div class="short_wraping">
                        <strong>تعداد نتایج:<span class="mx-1">{{$properties->total()}}</span></strong>
                    </div>
                    <div class="row justify-content-center">
                        @each('home.partials.single-property', $properties, 'property')

                    </div>
                    {{ $properties->links('home.partials.pagination') }}
                @else
                    <div class="short_wraping">
                        <strong>هیچ ملکی یافت نشد</strong>
                    </div>
                @endif
            </div>
        </div>
    </div>
</section>

@script
<script>
    // range sliders
    $(".price-range-slider").ionRangeSlider({
        rtl: true,
        type: "double",
        prettify_enabled: true,
        prettify_separator: ",",
        min: $wire.price_range[0],
        max: $wire.price_range[1],
        from: $wire.price_range[0],
        to: $wire.price_range[1],
        grid: true,
        onFinish: function (data) {
            @this.
            set('filter.price_range', [data.from, data.to])
        }
    });

    $(".meter-range-slider").ionRangeSlider({
        rtl: true,
        type: "double",
        prettify_enabled: true,
        prettify_separator: ",",
        min: $wire.meter_range[0],
        max: $wire.meter_range[1],
        from: $wire.meter_range[0],
        to: $wire.meter_range[1],
        grid: true,
        onFinish: function (data) {
            @this.
            set('filter.meter_range', [data.from, data.to])
        }
    });
    $(".rahn-range-slider").ionRangeSlider({
        rtl: true,
        type: "double",
        prettify_enabled: true,
        prettify_separator: ",",
        min: $wire.rahn_range[0],
        max: $wire.rahn_range[1],
        from: $wire.rahn_range[0],
        to: $wire.rahn_range[1],
        grid: true,
        onFinish: function (data) {
            @this.
            set('filter.rahn_range', [data.from, data.to])
        }
    });
    $(".rent-range-slider").ionRangeSlider({
        rtl: true,
        type: "double",
        prettify_enabled: true,
        prettify_separator: ",",
        min: $wire.rent_range[0],
        max: $wire.rent_range[1],
        from: $wire.rent_range[0],
        to: $wire.rent_range[1],
        grid: true,
        onFinish: function (data) {
            @this.
            set('filter.rent_range', [data.from, data.to])
        }
    });
    $(document).ready(async function () {
        $('#deal_type').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.deal_type', null);
            } else {
                console.log(data);
                @this.
                set('filter.deal_type', data);
            }
        });

        $('#property_type').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.property_type', null);
            } else {
                @this.
                set('filter.property_type', data);
            }
        });

        $('#district').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.district', null);
            } else {
                @this.
                set('filter.district', data);
            }
        });

        $('#floor').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.floor', null);
            } else {
                @this.
                set('filter.floor', data);
            }
        });

        $('#bedroom').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.bedroom', null);
            } else {
                @this.
                set('filter.bedroom', data);
            }
        });

        $('#docType').on('change', function (e) {
            let data = $(this).select2("val");
            if (data === null) {
                @this.
                set('filter.docType', null);
            } else {
                @this.
                set('filter.docType', data);
            }
        });
    });

    // Select Bedrooms
    $("#bedroom").select2({
        dir: "rtl",
        placeholder: "اتاق خواب",
        allowClear: true,
    });

    // Select Bedrooms
    $("#district").select2({
        dir: "rtl",
        placeholder: "محله",
        allowClear: true,
    });

    // Select Property floor
    $("#floor").select2({
        dir: "rtl",
        placeholder: "طبقه",
        allowClear: true,
    });

    // Select docType
    $("#docType").select2({
        dir: "rtl",
        placeholder: "نوع سند",
        allowClear: true,
    });

    // Select Property Types
    $("#property_type").select2({
        dir: "rtl",
        placeholder: "نوع ملک",
        allowClear: true,
    });

    // Select Property Types
    $("#deal_type").select2({
        dir: "rtl",
        placeholder: "نوع معامله",
        allowClear: true,
    });
</script>
@endscript