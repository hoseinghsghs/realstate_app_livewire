<div>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>لیست املاک</h2>
                        <br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                    خانه</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">املاک</a></li>
                            <li class="breadcrumb-item active">لیست املاک</li>
                        </ul>
                        </br>
                        <a href="/admin/properties/create" wire:navigate class="btn btn-raised btn-info waves-effect">
                            اضافه کردن ملک </a>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <form wire:submit.prevent="$refresh">
                                <div class="header">
                                    <div class="body">
                                        <div class="row clearfix mx-0">
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="heat">نوع معامله</label>
                                                    <select id="ptype" wire:model.live="tr_type"
                                                        class="form-control " placeholder="نوع معامله">
                                                        <option></option>
                                                        <option>رهن و اجاره</option>
                                                        <option>فروش</option>
                                                        <option>پیش فروش</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="heat">نوع ملک</label>
                                                    <select wire:model.live="type" id="type" class="form-control "
                                                        placeholder="نوع ملک">
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
                                                    <label for="heat">محله</label>

                                                    <select wire:model.live="district" id="district"
                                                        class="form-control " placeholder="محله">
                                                        <option></option>
                                                        @isset($districts)
                                                            @foreach ($districts as $district)
                                                                <option>{{ $district }}</option>
                                                            @endforeach
                                                        @endisset
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="heat">نوع سند</label>
                                                    <select id="docType" wire:model.live="doc" class="form-control "
                                                        placeholder="نوع سند">
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
                                                    <label for="heat">طبقه</label>
                                                    <select wire:model.live="floorsell" id="floor"
                                                        class="form-control " placeholder="طبقه">
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
                                                    <label for="heat">تعداد اتاق خواب</label>
                                                    <select wire:model.live="bedroom" id="bedrooms"
                                                        class="form-control " placeholder="اتاق خواب">
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
                                                    <label for="heat">عنوان ملک،آدرس</label>

                                                    <input type="text" wire:model.live.debounce.500ms="search"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="heat">شناسه ملک</label>
                                                    <input type="text" wire:model.live.debounce.500ms="code"
                                                        class="form-control" />
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12" wire:ignore>
                                                <div class="form-group">
                                                    <p>متراژ(مترمربع)</p>
                                                    <div id="meter-range"></div>
                                                    <div class="m-t-20 font-14"><span
                                                            class="js-nouislider-value"></span></div>
                                                </div>
                                            </div>
                                            <div id="price" class="col-lg-6 col-md-12" wire:ignore>
                                                <div class="form-group">
                                                    <p>قیمت(تومان)</p>
                                                    <div id="price-range"></div>
                                                    <div class="m-t-20 font-14"><span
                                                            class="js-nouislider-value"></span></div>
                                                </div>
                                            </div>
                                            <div id="rahn" class="col-lg-6 col-md-12" wire:ignore>
                                                <div class="form-group">
                                                    <p>رهن(تومان)</p>
                                                    <div id="rahn-range"></div>
                                                    <div class="m-t-20 font-14"><span
                                                            class="js-nouislider-value"></span></div>
                                                </div>
                                            </div>
                                            <div id="rent" class="col-lg-6 col-md-12" wire:ignore>
                                                <div class="form-group">
                                                    <p>اجاره(تومان)</p>
                                                    <div id="rent-range"></div>
                                                    <div class="m-t-20 font-14"><span
                                                            class="js-nouislider-value"></span></div>
                                                </div>
                                            </div>
                                            @if ($featuresco->count() > 0)
                                                <div class="col-12">
                                                    <p class="text-green">ویژگی های پیشرفته</p>
                                                    <hr>
                                                    <div class="row clearfix">
                                                        @foreach ($featuresco as $feature)
                                                            <div class="checkbox col-auto">
                                                                <input id="check-{{ $feature->id }}" type="checkbox"
                                                                    wire:model.live="features"
                                                                    value="{{ $feature->id }}">
                                                                <label for="check-{{ $feature->id }}">
                                                                    {{ $feature->name }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="body">
                                    <div class="row clearfix">
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        wire:model.live.debounce.500ms="ids" placeholder="کد یکتا">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" class="form-control"
                                                        wire:model.live.debounce.500ms="title"
                                                        placeholder="نام شواهد دیجیتال، کد">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select placeholder="وضعیت" wire:model.live="is_active"
                                                        class="form-control ms">
                                                        <option value="">وضعیت</option>
                                                        <option value="1">فعال</option>
                                                        <option value="0">غیرفعال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @hasanyrole(['Super Admin', 'viewer'])
                                            @php($laboratories = \App\Models\Laboratory::all())
                                            <div
                                                class="form-group col-md-3 col-sm-3 @error('laboratory_id') is-invalid @enderror">
                                                <div wire:ignore>
                                                    <select id="laboratorySelect" wire:model.live="laboratory_id_search"
                                                        placeholder="انتخاب آزمایشگاه"
                                                        class="form-control ms search-select">
                                                        <option></option>
                                                        @foreach ($laboratories as $laboratory)
                                                            <option value={{ $laboratory->id }}>
                                                                {{ $laboratory->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            @php($dossiers = \App\Models\Dossier::all())
                                            <div
                                                class="form-group col-md-3 col-sm-3 @error('dossier_id') is-invalid @enderror">
                                                <div wire:ignore>
                                                    <select id="dossierSelect" wire:model.live="dossier_id_search"
                                                        placeholder="انتخاب پرونده"
                                                        class="form-control ms search-select">
                                                        <option></option>
                                                        @foreach ($dossiers as $dossier)
                                                            <option value={{ $dossier->id }}>
                                                                {{ $dossier->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        @endhasanyrole
                                        <div class="col-lg-3 col-md-4 col-sm-6">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <select placeholder="موجودی" wire:model.live="status"
                                                        class="form-control ms">
                                                        <option value="">وضعیت بررسی (همه)</option>
                                                        <option value="0">پذیرش شواهد دیجیتال</option>
                                                        <option value="1">در حال بررسی</option>
                                                        <option value="2"> تکمیل تجزیه و تحلیل
                                                        </option>
                                                        <option value="3">خروج شواهد دیجیتال</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group col-lg-3 col-md-4 col-sm-6">
                                            <div class="input-group" wire:ignore>
                                                <div class="input-group-prepend" onclick="$('#CreateDate').focus();">
                                                    <span class="input-group-text" id="basic-addon1"><i
                                                            class="zmdi zmdi-calendar-alt"></i></span>
                                                </div>
                                                <input type="hidden" id="CreateDate-alt" name="receive_date">
                                                <input type="text" class="form-control" placeholder="تاریخ پذیرش"
                                                    id="CreateDate" value="{{ $Judicial_date ?? null }}"
                                                    autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon1"
                                                        style="cursor: pointer;" onclick="destroyDatePicker()"><i
                                                            class="zmdi zmdi-close"></i></span>
                                                </div>
                                            </div>
                                            @error('receive_date')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div> --}}
                            </form>
                            {{-- <div class="header d-flex align-items-center">
                                <h2><strong>لیست شواهد دیجیتال </strong> ( {{ $devices->total() }} )</h2>
                                <div class="mr-auto">
                                    @can('devices-create')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.devices.create') }}"
                                            class="btn btn-raised btn-info waves-effect mr-auto">
                                            افزودن<i class="zmdi zmdi-plus mr-1"></i></a>
                                    @endcan
                                    @can('devices-export')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.file-device') }}"
                                            class="btn btn-raised btn-warning waves-effect ">
                                            خروجی شواهد دیجیتال<i class="zmdi zmdi-developer-board mr-1"></i></a>
                                    @endcan
                                    @can('actions-export')
                                        <a onclick="loadbtn(event)" href="{{ route('admin.file-action') }}"
                                            class="btn btn-raised btn-warning waves-effect ml-4 ">
                                            خروجی اقدامات <i class="zmdi zmdi-developer-board mr-1"></i></a>
                                    @endcan
                                </div>
                            </div> --}}
                            <div class="body">
                                <div class="loader" wire:loading.flex>
                                    درحال بارگذاری ...
                                </div>
                                @if ($properties->count() === 0)
                                    <p>هیچ رکوردی وجود ندارد</p>
                                @else
                                    <div class="table-responsive">
                                        <table class="table table-hover c_table theme-color">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>کد ملک</th>
                                                    <th>نام ثبت کننده</th>
                                                    <th>عنوان</th>
                                                    <th>نوع معامله</th>
                                                    <th>وضعیت</th>
                                                    <th class="text-center js-sweetalert">عملیات</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($properties as $key => $property)
                                                    <tr wire:key="name_{{ $property->id }}">

                                                        <td scope="row">{{ $key + 1 }}</td>
                                                        <td>{{ $property->code }}</td>
                                                        <td>
                                                            {{ $property->user->name }}
                                                            @if ($property->user->role_id === 1)
                                                                (ادمین)
                                                            @elseif ($property->user->role_id === 2)
                                                                (مشاور)
                                                            @elseif ($property->user->role_id === 3)
                                                                (کاربر)
                                                            @endif
                                                        </td>
                                                        <td>{{ $property->title }}</td>
                                                        <td>{{ $property->tr_type }}</td>
                                                        <td>
                                                            <div class="row clearfix">

                                                                <div class="col-6">
                                                                    @if ($property->isactive)
                                                                        <span class="badge badge-success">منتشر
                                                                            شده</span>
                                                                    @else
                                                                        <span class="badge badge-danger">منتشر
                                                                            نشده</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </td>

                                                        <td class="text-center js-sweetalert">


                                                            <a href="/admin/properties/{{ $property->id }}/edit"
                                                                class="btn btn-raised btn-info waves-effect"
                                                                wire:navigate>

                                                                ویرایش
                                                            </a>
                                                            <a href="/admin/properties/show/{{ $property->id }}"
                                                                wire:navigate
                                                                class="btn btn-raised btn-info waves-effect">
                                                                نمایش
                                                            </a>
                                                            {{-- <button class="btn btn-raised btn-danger waves-effect"
                                                                data-type="confirm"
                                                                data-form-id="del-property-{{ $property->id }}">حذف</button>
                                                            <form
                                                                action="{{ route('admin.properties.destroy', $property->id) }}"
                                                                id="del-property-{{ $property->id }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                            </form> --}}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @endif
                            </div>
                        </div>
                        {{ $properties->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <script>
            ! function(e) {
                "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? module.exports = e() :
                    window.wNumb = e()
            }(function() {
                "use strict";
                var o = ["decimals", "thousand", "mark", "prefix", "suffix", "encoder", "decoder", "negativeBefore",
                    "negative", "edit", "undo"
                ];

                function w(e) {
                    return e.split("").reverse().join("")
                }

                function h(e, t) {
                    return e.substring(0, t.length) === t
                }

                function f(e, t, n) {
                    if ((e[t] || e[n]) && e[t] === e[n]) throw new Error(t)
                }

                function x(e) {
                    return "number" == typeof e && isFinite(e)
                }

                function n(e, t, n, r, i, o, f, u, s, c, a, p) {
                    var d, l, h, g = p,
                        v = "",
                        m = "";
                    return o && (p = o(p)), !!x(p) && (!1 !== e && 0 === parseFloat(p.toFixed(e)) && (p = 0), p < 0 && (
                            d = !0, p = Math.abs(p)), !1 !== e && (p = function(e, t) {
                            return e = e.toString().split("e"), (+((e = (e = Math.round(+(e[0] + "e" + (e[1] ? +e[
                                    1] + t : t)))).toString().split("e"))[0] + "e" + (e[1] ? e[1] - t : -t)))
                                .toFixed(t)
                        }(p, e)), -1 !== (p = p.toString()).indexOf(".") ? (h = (l = p.split("."))[0], n && (v = n + l[
                            1])) : h = p, t && (h = w((h = w(h).match(/.{1,3}/g)).join(w(t)))), d && u && (m += u), r &&
                        (m += r), d && s && (m += s), m += h, m += v, i && (m += i), c && (m = c(m, g)), m)
                }

                function r(e, t, n, r, i, o, f, u, s, c, a, p) {
                    var d, l = "";
                    return a && (p = a(p)), !(!p || "string" != typeof p) && (u && h(p, u) && (p = p.replace(u, ""), d = !
                            0), r && h(p, r) && (p = p.replace(r, "")), s && h(p, s) && (p = p.replace(s, ""), d = !0),
                        i &&
                        function(e, t) {
                            return e.slice(-1 * t.length) === t
                        }(p, i) && (p = p.slice(0, -1 * i.length)), t && (p = p.split(t).join("")), n && (p = p.replace(
                            n, ".")), d && (l += "-"), "" !== (l = (l += p).replace(/[^0-9\.\-.]/g, "")) && (l = Number(
                            l), f && (l = f(l)), !!x(l) && l))
                }

                function i(e, t, n) {
                    var r, i = [];
                    for (r = 0; r < o.length; r += 1) i.push(e[o[r]]);
                    return i.push(n), t.apply("", i)
                }
                return function e(t) {
                    if (!(this instanceof e)) return new e(t);
                    "object" == typeof t && (t = function(e) {
                        var t, n, r, i = {};
                        for (void 0 === e.suffix && (e.suffix = e.postfix), t = 0; t < o.length; t += 1)
                            if (void 0 === (r = e[n = o[t]])) "negative" !== n || i.negativeBefore ? "mark" ===
                                n && "." !== i.thousand ? i[n] = "." : i[n] = !1 : i[n] = "-";
                            else if ("decimals" === n) {
                            if (!(0 <= r && r < 8)) throw new Error(n);
                            i[n] = r
                        } else if ("encoder" === n || "decoder" === n || "edit" === n || "undo" === n) {
                            if ("function" != typeof r) throw new Error(n);
                            i[n] = r
                        } else {
                            if ("string" != typeof r) throw new Error(n);
                            i[n] = r
                        }
                        return f(i, "mark", "thousand"), f(i, "prefix", "negative"), f(i, "prefix",
                            "negativeBefore"), i
                    }(t), this.to = function(e) {
                        return i(t, n, e)
                    }, this.from = function(e) {
                        return i(t, r, e)
                    })
                }
            });
        </script>

        <script>
            $(document).ready(function() {

                var meter, sell_price, rent_price, rahn_price;
                // meter range
                var rangeSlider = document.getElementById('meter-range');
                noUiSlider.create(rangeSlider, {
                    start: [1, 1000],
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
                    slider.noUiSlider.on('change', function(values, handle) {

                        var f1 = values[0]
                        let updatedValue;

                        // انتخاب مقادیر بر اساس نوع
                        switch (type) {
                            case 'meter':
                                updatedValue = removeExtraCharactor(values.join(';'));
                                meter = updatedValue;
                                break;
                            case 'sell_price':
                                updatedValue = removeExtraCharactor(values.join(';'));
                                sell_price = updatedValue;
                                break;
                            case 'rahn_price':
                                updatedValue = removeExtraCharactor(values.join(';'));
                                rahn_price = updatedValue;
                                break;
                            case 'rent_price':
                                updatedValue = removeExtraCharactor(values.join(';'));
                                rent_price = updatedValue;
                                break;
                            default:
                                break;
                        }
                        $(slider).parent().find('span.js-nouislider-value').text(
                            `از ${values[0]} تا ${values[1]}`);

                        console.log(meter, sell_price, rahn_price, rent_price);


                        if (meter === '') {
                            @this.
                            set('meter_range', null);
                        } else {
                            @this.
                            set('meter_range', meter);
                        }

                        if (sell_price === '') {
                            @this.
                            set('price_range', null);
                        } else {
                            @this.
                            set('price_range', sell_price);
                        }

                        if (rahn_price === '') {
                            @this.
                            set('rahn_range', null);
                        } else {
                            @this.
                            set('rahn_range', rahn_price);
                        }

                        if (rent_price === '') {
                            @this.
                            set('rent_range', null);
                        } else {
                            @this.
                            set('rent_range', meter);
                        }
                        // @this.
                        // set('meter_range', meter);
                        // @this.
                        // set('sell_range', sell_price);
                        // @this.
                        // set('rahn_range', rahn_price);
                        // @this.
                        // set('rent_range', rent_price);


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

            });
        </script>

        <script>
            $(document).ready(function() {
                $("#searchInput").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
    @endpush

</div>
