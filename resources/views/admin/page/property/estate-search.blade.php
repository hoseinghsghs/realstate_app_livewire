@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>لیست املاک</h2>
                    <br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">املاک</a></li>
                        <li class="breadcrumb-item active">لیست املاک</li>
                    </ul>
                    <button class="btn btn-primary btn-icon mobile_menu" type="button"><i class="zmdi zmdi-sort-amount-desc"></i></button>
                </div>
                <div class="col-lg-5 col-md-6 col-sm-12">
                    <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i class="zmdi zmdi-arrow-right"></i></button>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <!-- Hover Rows -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="card">
                        <div class="body">
                            <form id="filterProperty" method="GET" action="{{route('admin.properties.search')}}">
                                @csrf
                                <div class="row clearfix mx-0">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select id="ptype" name="tr_type" class="form-control show-tick ms select2" data-placeholder="نوع معامله">
                                                <option></option>
                                                <option>رهن و اجاره</option>
                                                <option>فروش</option>
                                                <option>پیش فروش</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="type" id="type" class="form-control show-tick ms select2" data-placeholder="نوع ملک">
                                                <option></option>
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="district" id="district" class="form-control show-tick ms select2" data-placeholder="محله">
                                                <option></option>
                                                @isset($districts)
                                                @foreach($districts as $district)
                                                <option>{{$district}}</option>
                                                @endforeach
                                                @endisset
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select id="docType" name="doc" class="form-control show-tick ms select2" data-placeholder="نوع سند">
                                                <option></option>
                                                <option>سند دار</option>
                                                <option>قولنامه ای</option>
                                                <option>در دست اقدام</option>
                                                <option>مشاع</option>
                                                <option>دیگر</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="floorsell" id="floor" class="form-control show-tick ms select2" data-placeholder="طبقه">
                                                <option></option>
                                                <option>1</option>
                                                <option>2</option>
                                                <option>3</option>
                                                <option>4</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <select name="bedroom" id="bedrooms" class="form-control show-tick ms select2" data-placeholder="اتاق خواب">
                                                <option></option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="search" class="form-control" placeholder="عنوان ملک،آدرس" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <input type="text" name="code" class="form-control" placeholder="شناسه ملک" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <p>متراژ(مترمربع)</p>
                                            <div id="meter-range"></div>
                                            <div class="m-t-20 font-14"><span class="js-nouislider-value"></span></div>
                                        </div>
                                    </div>
                                    <div id="price" class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <p>قیمت(تومان)</p>
                                            <div id="price-range"></div>
                                            <div class="m-t-20 font-14"><span class="js-nouislider-value"></span></div>
                                        </div>
                                    </div>
                                    <div id="rahn" class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <p>رهن(تومان)</p>
                                            <div id="rahn-range"></div>
                                            <div class="m-t-20 font-14"><span class="js-nouislider-value"></span></div>
                                        </div>
                                    </div>
                                    <div id="rent" class="col-lg-6 col-md-12">
                                        <div class="form-group">
                                            <p>اجاره(تومان)</p>
                                            <div id="rent-range"></div>
                                            <div class="m-t-20 font-14"><span class="js-nouislider-value"></span></div>
                                        </div>
                                    </div>
                                    @if(count($features)>0)
                                    <div class="col-12">
                                        <p class="text-green">ویژگی های پیشرفته</p>
                                        <hr>
                                        <div class="row clearfix">
                                            @foreach($features as $feature)
                                            <div class="checkbox col-auto">
                                                <input id="check-{{$feature->id}}" type="checkbox" name="features[]" value="{{$feature->id}}">
                                                <label for="check-{{$feature->id}}">
                                                    {{$feature->name}}
                                                </label>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                <div class="form-group text-left">
                                    <button type="submit" class="btn btn-raised btn-primary btn-round waves-effect">جستحو</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="propertyList">
            @include('admin.partial.search-results')
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/wnumb/1.2.0/wNumb.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        var meter, sell_price, rent_price, rahn_price;
        // meter range
        var rangeSlider = document.getElementById('meter-range');
        noUiSlider.create(rangeSlider, {
            start: [50, 1000],
            connect: true,
            format: wNumb({
                decimals: 0,
                thousand: ',',
                suffix: ' مترمربع'
            }),
            range: {
                'min': 1,
                'max': 5000
            }
        });
        getNoUISliderValue(rangeSlider, 'meter');
        // sell price range
        var rangeSlider = document.getElementById('price-range');
        noUiSlider.create(rangeSlider, {
            start: [100000000, 9000000000],
            connect: true,
            step: 10000000,
            format: wNumb({
                decimals: 0,
                thousand: ',',
                suffix: ' تومان'
            }),
            range: {
                'min': 100000000,
                'max': 99000000000
            }
        });
        getNoUISliderValue(rangeSlider, 'sell_price');
        // rahn range price
        var rangeSlider = document.getElementById('rahn-range');
        noUiSlider.create(rangeSlider, {
            start: [10000000, 500000000],
            connect: true,
            step: 1000000,
            format: wNumb({
                decimals: 0,
                thousand: ',',
                suffix: ' تومان'
            }),
            range: {
                'min': 10000000,
                'max': 1000000000
            }
        });
        getNoUISliderValue(rangeSlider, 'rahn_price');
        // rent range price
        var rangeSlider = document.getElementById('rent-range');
        noUiSlider.create(rangeSlider, {
            start: [0, 100000000],
            connect: true,
            step: 1000000,
            format: wNumb({
                decimals: 0,
                thousand: ',',
                suffix: ' تومان'
            }),
            range: {
                'min': 0,
                'max': 500000000
            }
        });
        getNoUISliderValue(rangeSlider, 'rent_price');


        function getNoUISliderValue(slider, type) {
            slider.noUiSlider.on('update', function(values, handle) {
                var f1 = values[0]
                switch (type) {
                    case 'meter':
                        meter = removeExtraCharactor(values.join(';'));
                        break;
                    case 'sell_price':
                        sell_price = removeExtraCharactor(values.join(';'));
                        break;
                    case 'rahn_price':
                        rahn_price = removeExtraCharactor(values.join(';'));
                        break;
                    case 'rent_price':
                        rent_price = removeExtraCharactor(values.join(';'));
                        break;
                    default:
                        break;
                }
                $(slider).parent().find('span.js-nouislider-value').text(`از ${values[0]} تا ${values[1]}`);
            });
        }

        function removeExtraCharactor(text) {
            return text.replace(/,|تومان|مترمربع|\s/g, '')
        }

        // show and hide rent and sell price base on estate type
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
        // pagination
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
        // search submit
        $(document).on('submit', '#filterProperty', function(e) {
            e.preventDefault();

            $(this).find('button[type=submit]').append(
                '<i class="zmdi zmdi-hc-fw zmdi-hc-spin"></i>');
            var url = $(this).attr('action')
            var data = $(this).serialize();
            if ($('#ptype').val() == 'فروش') {
                data = data + `&meter-range=${meter}&price-range=${sell_price}`;
            } else if ($('#ptype').val() == 'رهن و اجاره') {
                data = data + `&meter-range=${meter}&rahn-range=${rahn_price}&rent-range=${rent_price}`;
            }
            $.ajax({
                url: url + '?' + data,
                type: 'GET',
                dataType: 'json',
            }).done(function(data) {
                $('#propertyList').html(data);
            }).fail(function() {
                alert('خطا در دریافت اطلاعات از سرور !!!');
            }).always(function() {
                $('#filterProperty button[type=submit]').find('i').remove();
            });
        })

    });

    function showDetail(event,id) {
        var btn = $(event.target);

        btn.attr('disabled', true).append(
            '<i class="zmdi zmdi-hc-fw zmdi-hc-spin"></i>');
        let url = "{{ route('admin.properties.show', ':id') }}";
        url = url.replace(':id', id);
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
        }).done(function(data) {
            Swal.fire({
                title: '<strong>مشخصات</strong>',
                html: data,
                grow: 'row',
                showCloseButton:true,
                confirmButtonText: "تایید",
            });
        }).fail(function() {
            alert('خطا در دریافت اطلاعات از سرور !!!');
        }).always(function() {
            btn.attr('disabled', false).find('i').remove();
        });
    }
</script>
@endpush
