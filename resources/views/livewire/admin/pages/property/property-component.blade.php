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
                                            <option>دفتر کار</option>
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
                                            @foreach ($all_districts as $district)
                                                <option>{{ $district }}</option>
                                            @endforeach
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
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="heat">شناسه ملک</label>
                                        <input type="text" wire:model.live.debounce.500ms="code"
                                               class="form-control"/>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12" wire:ignore>
                                    <label>تعداد طبقه</label>
                                    <div class="px-lg-5">
                                        <div id="floor-range"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mt-5 mt-lg-0" wire:ignore>
                                    <label>طبقه مورد معامله</label>
                                    <div class="px-lg-5">
                                        <div id="deal-floor-range"></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-12 mt-5" wire:ignore>
                                    <div class="form-group ">
                                        <p>متراژ(مترمربع)</p>
                                        <div class="px-lg-5">
                                            <div id="meter-range"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="price" class="col-lg-6 col-12 mt-5" wire:ignore>
                                    <div class="form-group">
                                        <p>قیمت(تومان)</p>
                                        <div class="px-lg-5">
                                            <div id="price-range"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="rahn" class="col-lg-6 col-12 mt-5" wire:ignore>
                                    <div class="form-group">
                                        <p>رهن(تومان)</p>
                                        <div class="px-lg-5">
                                            <div id="rahn-range"></div>
                                        </div>
                                    </div>
                                </div>
                                <div id="rent" class="col-lg-6 col-12 mt-5" wire:ignore>
                                    <div class="form-group">
                                        <p>اجاره(تومان)</p>
                                        <div class="px-lg-5">
                                            <div id="rent-range"></div>
                                        </div>
                                    </div>
                                </div>
                                @if ($all_features->count() > 0)
                                    <div class="col-12 mt-5">
                                        <p class="text-green">ویژگی های پیشرفته</p>
                                        <hr>
                                        <div class="row clearfix">
                                            @foreach ($all_features as $feature)
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
                        <div class="body">
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
                                    @forelse($properties as $key => $property)
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
                                                   class="btn btn-raised btn-warning waves-effect"
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
                                    @empty
                                        <tr>
                                            <td colspan="7">
                                                <p class="text-center" wire:loading>
                                                    <span class="spinner-border spinner-border-sm"></span>
                                                    درحال بارگذاری ...
                                                </p>
                                                <p class="text-center" wire:loading.remove>هیچ ملکی یافت نشد</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
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
        !function (e) {
            "function" == typeof define && define.amd ? define([], e) : "object" == typeof exports ? module.exports = e() :
                window.wNumb = e()
        }(function () {
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
                    d = !0, p = Math.abs(p)), !1 !== e && (p = function (e, t) {
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
                function (e, t) {
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
                "object" == typeof t && (t = function (e) {
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
                }(t), this.to = function (e) {
                    return i(t, n, e)
                }, this.from = function (e) {
                    return i(t, r, e)
                })
            }
        });
    </script>
@endpush
@script
<script>
    $(document).ready(function () {
        // deal-floor range
        let dealFloorSlider = document.getElementById('deal-floor-range');
        noUiSlider.create(dealFloorSlider, {
            start: $wire.deal_floor_range,
            connect: true,
            step: 1,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.deal_floor_range[0],
                'max': $wire.deal_floor_range[1]
            }
        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('deal_floor_range', values);
        });
        // floor range
        let floorSlider = document.getElementById('floor-range');
        noUiSlider.create(floorSlider, {
            start: $wire.floor_range,
            connect: true,
            step: 1,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.floor_range[0],
                'max': $wire.floor_range[1]
            }
        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('floor_range', values);
            @this.
            set('deal_floor_range', values)
            dealFloorSlider.noUiSlider.updateOptions({
                start: values,
                range: {
                    'min': values[0],
                    'max': values[1]
                }
            })
        });
        // meter range
        let meterSlider = document.getElementById('meter-range');
        noUiSlider.create(meterSlider, {
            start: $wire.meter_range,
            connect: true,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.meter_range[0],
                'max': $wire.meter_range[1]
            }
        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('meter_range', values);
        });
        // sell price range
        let priceSlider = document.getElementById('price-range');
        noUiSlider.create(priceSlider, {
            start: $wire.price_range,
            connect: true,
            step: 10000000,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.price_range[0],
                'max': $wire.price_range[1]
            }
        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('price_range', values);
        });
        // rahn range price
        let rahnSlider = document.getElementById('rahn-range');
        noUiSlider.create(rahnSlider, {
            start: $wire.rahn_range,
            connect: true,
            step: 1000000,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.rahn_range[0],
                'max': $wire.rahn_range[1]
            }
        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('rahn_range', values);
        });
        // rent range price
        let rentSlider = document.getElementById('rent-range');
        noUiSlider.create(rentSlider, {
            start: $wire.rent_range,
            connect: true,
            step: 1000000,
            tooltips: [wNumb({
                decimals: 0,
                thousand: ',',
            }), wNumb({
                decimals: 0,
                thousand: ',',
            })],
            format: wNumb({
                decimals: 0,
            }),
            range: {
                'min': $wire.rent_range[0],
                'max': $wire.rent_range[1]
            }

        }).on('change', function (values) {
            values = values.map(Number)
            @this.set('rent_range', values);
        });

        // show and hide rent and sell price base on estate type
        $("#price,#rahn,#rent").hide();
        $(document).on('change', '#ptype', function (e) {
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
@endscript