@extends('home.layout.HomeLayout')
@section('title','لیست املاک')
@section('content')
<!-- ============================ All Property ================================== -->
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
                            <form id="filterProperty" method="GET" action="{{route('properties.list')}}">
                                <div class="form-group">
                                    <div class="simple-input">
                                        <select id="ptype" name="tr_type" class="form-control">
                                            <option value="">&nbsp;</option>
                                            <option>رهن و اجاره</option>
                                            <option>فروش</option>
                                          <option>پیش فروش</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="simple-input">
                                        <select name="type" id="type" class="form-control">
                                            <option value="">&nbsp;</option>
                                            <option>آپارتمان</option>
                                            <option>خانه ویلایی</option>
                                            <option>زمین و کلنگی</option>
                                            <option>مغازه</option>
                                            <option>دفتر کار </option>
                                            <option>باغ</option>
                                            <option>انبار</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="simple-input">
                                        <select name="district" id="district" class="form-control">
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
                                        <input name="search" type="text" class="form-control" placeholder="عنوان،آدرس">
                                        <i class="ti-search"></i>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        <div class="form-group">
                                            <div class="simple-input">
                                                <select name="floorsell" id="floor" class="form-control">
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
                                            <div class="simple-input">
                                                <select name="bedroom" id="bedrooms" class="form-control">
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
                                            <div class="simple-input">
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
                                                <input name="code" type="text" class="form-control"
                                                    placeholder="شناسه ملک">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
                                        <h6>متراژ(مترمربع)</h6>
                                        <div class="rg-slider">
                                            <input type="text" class="meter-range-slider" name="meter-range" value="" />
                                        </div>
                                    </div>
                                    <div id="price" class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
                                        <h6>قیمت(تومان)</h6>
                                        <div class="rg-slider">
                                            <input type="text" class="price-range-slider" name="price-range" value="" />
                                        </div>
                                    </div>
                                    <div id="rahn" class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
                                        <h6>رهن(تومان)</h6>
                                        <div class="rg-slider">
                                            <input type="text" class="rahn-range-slider" name="rahn-range" value="" />
                                        </div>
                                    </div>
                                    <div id="rent" class="col-lg-12 col-md-12 col-sm-12 pt-4 pb-4">
                                        <h6>اجاره(تومان)</h6>
                                        <div class="rg-slider">
                                            <input type="text" class="rent-range-slider" name="rent-range" value="" />
                                        </div>
                                    </div>
                                </div>
                                @if(count($features)>0)
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 pt-4">
                                        <h6>ویژگی های پیشرفته</h6>
                                        <ul class="row p-0 m-0">
                                            @foreach($features as $feature)
                                            <li class="col-lg-6 col-md-6 p-0">
                                                <input id="check-{{$feature->id}}" class="checkbox-custom"
                                                    value="{{$feature->id}}" name="features[]" type="checkbox">
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
                                        <button class="btn theme-bg-2 rounded full-width">جستجو</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Sidebar End -->
            </div>

            <div id="propertyList" class="col-lg-8 col-md-12 col-sm-12">
                @include('home.partials.listing')
            </div>


        </div>
    </div>
</section>
<!-- ============================ All Property ================================== -->
@endsection
@push('scripts')
<script>
$(document).ready(function() {
    $("#price,#rahn,#rent").hide();
    $(document).on('change', '#ptype', function(e) {
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
    $(document).on('click', '.pagination a', function(e) {
        var url = $(this).attr('href')
        $.ajax({
            url: url,
            dataType: 'json',
        }).done(function(data) {
            $('#propertyList').html(data);
        }).fail(function() {
            alert('خطا در دریافت اطلاعات از سرور !!!');
        });
        window.history.pushState("", "", url);
        e.preventDefault();
    });

    $(document).on('submit', '#filterProperty', function(e) {
        e.preventDefault();
        var url = $(this).attr('action')
        var data = $(this).serialize();
        $.ajax({
            url: url + '?' + data,
            type: 'GET',
            dataType: 'json',
        }).done(function(data) {
            $('#propertyList').html(data);
        }).fail(function() {
            alert('خطا در دریافت اطلاعات از سرور !!!');
        });
    })
});
</script>
@endpush