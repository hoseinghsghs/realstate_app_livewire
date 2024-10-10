<div>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>افزودن ملک</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                        class="zmdi zmdi-home"></i>خانه</a></li>
                            <li class="breadcrumb-item active">املاک</li>
                            <li class="breadcrumb-item active">اضافه کردن ملک</li>
                        </ul>
                        <button class="btn btn-primary btn-icon mobile_menu" type="button"><i
                                class="zmdi zmdi-sort-amount-desc"></i></button>
                    </div>
                    <div class="col-lg-5 col-md-6 col-sm-12">
                        <button class="btn btn-primary btn-icon float-right right_icon_toggle_btn" type="button"><i
                                class="zmdi zmdi-arrow-right"></i></button>
                    </div>
                </div>
            </div>

            <div class="body">
                <!-- test -->
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="header">
                                <h2><strong>مثال پایه</strong> - طرح بندی افقی</h2>
                                <ul class="header-dropdown">
                                    <li class="remove">
                                        <a role="button" class="boxs-close"><i class="zmdi zmdi-close"></i></a>
                                    </li>
                                </ul>
                            </div>
                            <div class="body">
                                @can('is_admin')
                                    <form wire:submit="save">
                                    @endcan
                                    @can('is_agent')
                                        <form wire:submit="saveForAgent">
                                        @endcan
                                        <form wire:submit="save">
                                            <div id="wizard-horizontal">
                                                <h2>مشخصات ملک</h2>
                                                <section>
                                                    <p>
                                                    <div class="card">
                                                        <br>
                                                        <div class="body">
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-lg-4 col-md-4 form-group @error('form.title') is-invalid @enderror">
                                                                    <label for="title">عنوان <abbr title="ضروری"
                                                                            style="color:red;">*</abbr></label>
                                                                    <input type="text" class="form-control"
                                                                        wire:model='form.title' />
                                                                    @error('form.title')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div
                                                                    class="col-lg-4 col-md-4 form-group @error('form.code') is-invalid @enderror">
                                                                    <label for="title">کد ملک <abbr title="ضروری"
                                                                            style="color:red;">*</abbr></label>
                                                                    <input type="text" wire:model='form.code'
                                                                        class="form-control" />
                                                                    @error('form.code')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-4 col-md-4 form-group @error('form.lable') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="lable">لیبل</label>
                                                                    <select wire:model='form.lable' id="lable"
                                                                        class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden></option>
                                                                        <option></option>
                                                                        <option>
                                                                            ویژه ها</option>
                                                                        <option>
                                                                            فروخته شد</option>
                                                                        <option>
                                                                            اجاره داده شد</option>
                                                                    </select>
                                                                    @error('form.lable')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div class="col-lg-4 col-md-6 form-group @error('form.tr_type') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="tr_type"> نوع معامله *</label>
                                                                    <select wire:model='form.tr_type'
                                                                        onchange="settype()" id="tr_type"
                                                                        class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden>
                                                                        </option>
                                                                        <option
                                                                            {{ old('tr_type') == 'رهن و اجاره' ? 'selected' : '' }}>
                                                                            رهن و
                                                                            اجاره
                                                                        </option>
                                                                        <option
                                                                            {{ old('tr_type') == 'فروش' ? 'selected' : '' }}>
                                                                            فروش
                                                                        </option>
                                                                        <option
                                                                            {{ old('tr_type') == 'پیش فروش' ? 'selected' : '' }}>
                                                                            پیش
                                                                            فروش
                                                                        </option>
                                                                    </select>
                                                                    @error('form.tr_type')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 form-group @error('form.usertype') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="usertype"> نوع کاربری *</label>
                                                                    <select wire:model='form.usertype' id="usertype"
                                                                        class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden></option>
                                                                        <option
                                                                            {{ old('usertype') == 'مسکونی' ? 'selected' : '' }}>
                                                                            مسکونی
                                                                        </option>
                                                                        <option
                                                                            {{ old('usertype') == 'تجاری' ? 'selected' : '' }}>
                                                                            تجاری
                                                                        </option>
                                                                        <option
                                                                            {{ old('usertype') == 'آموزشی' ? 'selected' : '' }}>
                                                                            آموزشی
                                                                        </option>
                                                                        <option
                                                                            {{ old('usertype') == 'اداری' ? 'selected' : '' }}>
                                                                            اداری
                                                                        </option>
                                                                        <option
                                                                            {{ old('usertype') == 'باغ ویلا' ? 'selected' : '' }}>
                                                                            باغ ویلا
                                                                        </option>
                                                                        <option
                                                                            {{ old('usertype') == 'دیگر' ? 'selected' : '' }}>
                                                                            دیگر
                                                                        </option>
                                                                    </select>
                                                                    @error('form.usertype')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-lg-4 col-md-6 form-group @error('form.type') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="type">نوع ملک *</label>
                                                                    <select wire:model='form.type' id="type"
                                                                        class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden></option>
                                                                        <option
                                                                            {{ old('type') == 'آپارتمان' ? 'selected' : '' }}>
                                                                            آپارتمان
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'خانه ویلایی' ? 'selected' : '' }}>
                                                                            خانه
                                                                            ویلایی
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'زمین و کلنگی' ? 'selected' : '' }}>
                                                                            زمین
                                                                            و
                                                                            کلنگی
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'مغازه' ? 'selected' : '' }}>
                                                                            مغازه
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'دفتر کار' ? 'selected' : '' }}>
                                                                            دفتر کار
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'باغ' ? 'selected' : '' }}>
                                                                            باغ
                                                                        </option>
                                                                        <option
                                                                            {{ old('type') == 'انبار' ? 'selected' : '' }}>
                                                                            انبار
                                                                        </option>
                                                                    </select>
                                                                    @error('form.type')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-lg-4 form-group @error('form.bedroom') is-invalid @enderror">
                                                                    <label for="bedroom">تعداد خواب *</label>
                                                                    <input type="number" id="bedroom"
                                                                        wire:model='form.bedroom' step="1"
                                                                        aria-disabled class="form-control"
                                                                        value="{{ old('bedroom') }}" />
                                                                    @error('form.bedroom')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>

                                                                <div
                                                                    class="col-lg-4 form-group @error('form.floorsell') is-invalid @enderror">
                                                                    <label for="floorsell"> طبقه مورد معامله *</label>
                                                                    <input type="text" wire:model='form.floorsell'
                                                                        id="floorsell" aria-disabled
                                                                        class="form-control"
                                                                        value="{{ old('floorsell') }}" />
                                                                    @error('form.floorsell')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-4 form-group @error('form.floor') is-invalid @enderror">
                                                                    <label for="floor">تعداد طبقات</label>
                                                                    <input type="number" wire:model='form.floor'
                                                                        id="floor" step="1" aria-disabled
                                                                        class="form-control"
                                                                        value="{{ old('floor') }}" />
                                                                    @error('form.floor')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.year') is-invalid @enderror">
                                                                    <label for="year">قدمت ساخت</label>
                                                                    <input type="number" id="year"
                                                                        wire:model='form.year' class="form-control"
                                                                        placeholder="سال"
                                                                        value="{{ old('year') }}" />
                                                                    @error('form.year')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.area') is-invalid @enderror">
                                                                    <label for="area">مساحت زمین (برحسب متر
                                                                        مربع)</label>
                                                                    <input type="number" id="area"
                                                                        wire:model='form.area'
                                                                        value="{{ old('area') }}"
                                                                        class="form-control" placeholder="متر مربع" />
                                                                    @error('form.area')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.meter') is-invalid @enderror">
                                                                    <label for="meter">متراژ زیر بنا *</label>
                                                                    <input type="number" id="meter"
                                                                        wire:model='form.meter'
                                                                        value="{{ old('meter') }}" max="10000"
                                                                        class="form-control" />
                                                                    @error('form.meter')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <!-- موقعیت مکانی -->
                                                            <br>
                                                            <h5 style="color:#04BE5B">موقعیت مکانی</h5>
                                                            <hr>
                                                            <div class="row clearfix ir-select">
                                                                <div class="col-sm-4 form-group @error('form.province') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="province">استان *</label>
                                                                    <select
                                                                        class="ir-province  form-control show-tick ms select2"
                                                                        id="province" wire:model='form.province'>
                                                                        <option></option>
                                                                    </select>
                                                                    @error('form.province')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div class="col-sm-4 form-group @error('form.city') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="city">شهر *</label>
                                                                    <select
                                                                        class="ir-city  form-control show-tick ms select2"
                                                                        wire:model='form.city' id="city"
                                                                        value="{{ old('city') }}">
                                                                        <option></option>
                                                                    </select>
                                                                    @error('form.city')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.district') is-invalid @enderror">
                                                                    <label for="district">محله *</label>
                                                                    <input type="text" step="any"
                                                                        wire:model='form.district' id="district"
                                                                        class="form-control" />
                                                                    @error('form.district')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <small class="col-12 "> برای پیدا کردن موقعیت روی لینک
                                                                    مقابل کلیک
                                                                    کنید
                                                                    <a href="https://neshan.org/maps"
                                                                        target="_blank">نقشه
                                                                        نشان</a></small>
                                                                <div
                                                                    class="col-sm-6 form-group @error('form.lon') is-invalid @enderror">
                                                                    <label for="lon">طول جغرافیایی</label>
                                                                    <input type="number" step="any"
                                                                        id="lon" wire:model='form.lon'
                                                                        class="form-control" />
                                                                    @error('form.lon')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-6 form-group @error('form.lon') is-invalid @enderror">
                                                                    <label for="lat">عرض جغرافیایی</label>
                                                                    <input type="number" step="any"
                                                                        wire:model='form.lat' id="lat"
                                                                        class="form-control" />
                                                                    @error('form.lon')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-12 form-group @error('form.address') is-invalid @enderror">
                                                                    <label for="">آدرس *</label>
                                                                    <div class="form-line">
                                                                        <textarea rows="3" class="form-control no-resize" id="address" wire:model='form.address'
                                                                            placeholder="آدرس را وارد کنید"></textarea>
                                                                        @error('form.address')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- مدیا -->
                                                            <br>
                                                            <h5 style="color:#04BE5B">مدیا</h5>
                                                            <hr>

                                                            <div class="container-fluid">
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-lg-12 col-md-12 form-group @error('form.img') is-invalid @enderror">
                                                                        <div class="card">
                                                                            <div class="header">
                                                                                <h2><strong>تصویر اصلی *</strong></h2>
                                                                            </div>
                                                                            <div class="body">
                                                                                <p>عکس را فقط با فرمت jpg و png آپلود
                                                                                    نمایید. </p>
                                                                                <input type="file" class="dropify"
                                                                                    wire:model='form.img'
                                                                                    data-allowed-file-extensions="jpg png">
                                                                                @error('form.img')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="header">
                                                                <h2><strong>سایر تصاویر</strong></h2>
                                                            </div>
                                                            <div class="container my-4">
                                                                <div class="form-group">
                                                                    <div class="form-group">
                                                                        <div class="file-loading">
                                                                            <input id="input-21"
                                                                                data-overwrite-initial="true"
                                                                                wire:model='form.file' multiple
                                                                                type="file" data-theme="fas">
                                                                            @error('form.file')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- اطلاعات مربوط به خرید -->
                                                            <br>
                                                            <div class="header">
                                                                <h2><strong>ویدیو</strong></h2>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-12 form-group @error('form.ambed') is-invalid @enderror">
                                                                    <label for="loan">کد امبد ویدیو</label>
                                                                    <input type="text" id="ambed"
                                                                        wire:model='form.ambed'
                                                                        class="form-control" />
                                                                    @error('form.ambed')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <br>

                                                            <h5 style="color:#04BE5B">اطلاعات مربوط به فروش ملک </h5>
                                                            <hr>

                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.loan') is-invalid @enderror">
                                                                    <label for="loan">وام بانکی</label>
                                                                    <input type="text" id="loan"
                                                                        wire:model='form.ccccccloan'
                                                                        class="form-control" />
                                                                    @error('form.loan')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.loanamount') is-invalid @enderror">
                                                                    <label for="loanamount">مبلغ وام</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            id="loanamount"
                                                                            wire:model='form.loanamount'
                                                                            onkeyup="
                                                                         (this.value,this);"
                                                                            aria-label="Amount (to the nearest dollar)">
                                                                        @error('form.loanamount')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.meter_price') is-invalid @enderror">
                                                                    <label for="meter_price">قیمت متری (برحسب متر
                                                                        مربع)</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            id="meter_price"
                                                                            onkeyup="separateNum(this.value,this);"
                                                                            wire:model='form.meter_price'
                                                                            aria-label="Amount (to the nearest dollar)">
                                                                        @error('form.meter_price')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-lg-6 form-group @error('form.bidprice') is-invalid @enderror">
                                                                    <label for="bidprice">قیمت پیشنهادی *</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            id="bidprice" wire:model='form.bidprice'
                                                                            onkeyup="changePrice(this.value,this);"
                                                                            aria-label="Amount (to the nearest dollar) "
                                                                            minlength="10" maxlength="15">
                                                                        @error('form.bidprice')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-lg-6 form-group @error('form.ugprice') is-invalid @enderror">
                                                                    <label for="ugprice">قیمت کارشناسی *</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" class="form-control"
                                                                            id="ugprice" wire:model='form.ugprice'
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            onkeyup="separateNum(this.value,this);"
                                                                            minlength="10" maxlength="15">
                                                                        @error('form.ugprice')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- اطلاعات مربوط به خرید اجاره -->
                                                            <br>
                                                            <h5 style="color:#04BE5B">اطلاعات مربوط به رهن و اجاره
                                                            </h5>
                                                            <hr>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-lg-3 col-md-6 form-group @error('form.people_number') is-invalid @enderror">
                                                                    <label for="people_number">حداکثر تعداد
                                                                        نفرات</label>
                                                                    <input type="number" id="people_number"
                                                                        wire:model='form.people_number'
                                                                        class="form-control" />
                                                                    @error('form.people_number')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-3 col-md-6 form-group @error('form.rent') is-invalid @enderror">
                                                                    <label for="rent">مبلغ اجاره *</label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" wire:model='form.rent'
                                                                            class="form-control" id="rent"
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            onkeyup="separateNum(this.value,this);"
                                                                            maxlength="10">
                                                                        @error('form.rent')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-lg-3 col-md-6 form-group @error('form.rahn') is-invalid @enderror">
                                                                    <label for="rahn">مبلغ رهن * </label>
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">تومان</span>
                                                                        </div>
                                                                        <input type="text" wire:model='form.rahn'
                                                                            class="form-control" id="rahn"
                                                                            aria-label="Amount (to the nearest dollar)"
                                                                            onkeyup="separateNum(this.value,this);"
                                                                            maxlength="11">
                                                                        @error('form.rahn')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <div class="input-group-append">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6 ">
                                                                    <br><br>
                                                                    <div class="checkbox">
                                                                        <input id="cheng" wire:model='form.cheng'
                                                                            type="checkbox">
                                                                        @error('form.cheng')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <label for="cheng">قابل تغیر اجاره و
                                                                            رهن</label>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <!-- امکانات -->
                                                            <br>
                                                            <h5 style="color:#04BE5B">وضعیت </h5>
                                                            <hr>
                                                            <div class="row clearfix">
                                                                <div class="col-lg-3 col-md-6">
                                                                    <div class="checkbox">
                                                                        <input id="chec" type="checkbox"
                                                                            wire:model='form.chec' checked>
                                                                        @error('form.chec')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                        <label for="chec">انتشار ملک</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </p>
                                                </section>
                                                <h2>مشخصات مالک</h2>
                                                <section>
                                                    <p>
                                                    <div class="card">
                                                        <div class="body">
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.name_family') is-invalid @enderror">
                                                                    <label for="name_family">نام نام خانوادگی *
                                                                    </label>
                                                                    <input type="text" id="name_family"
                                                                        wire:model='form.name_family'
                                                                        class="form-control" />
                                                                    @error('form.name_family')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                    <div class="valid-feedback">
                                                                        حله
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        این فیلد مورد نیاز است
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.telephone') is-invalid @enderror">
                                                                    <label for="telephone">شماره تلفن</label>
                                                                    <input type="text" id="telephone"
                                                                        wire:model='form.telephone'
                                                                        class="form-control" />
                                                                    @error('form.telephone')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.phone') is-invalid @enderror">
                                                                    <label for="phone">شماره موبایل * </label>
                                                                    <input type="text" maxlength="11"
                                                                        id="phone" wire:model='form.phone'
                                                                        class="form-control" />
                                                                    @error('form.phone')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                    <div class="valid-feedback">
                                                                        حله
                                                                    </div>
                                                                    <div class="invalid-feedback">
                                                                        این فیلد مورد نیاز است
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </p>
                                                </section>
                                                <h2>سایر مشخصات</h2>
                                                <section>
                                                    <p>
                                                    <div class="card">
                                                        <div class="body">
                                                            <div class="row clearfix">
                                                                <div class="col-lg-3 form-group @error('form.doc') is-invalid @enderror"
                                                                    wire:ignore>
                                                                    <label for="doc">نوع سند</label>
                                                                    <select wire:model='form.doc' id="doc"
                                                                        class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden></option>
                                                                        <option>سند
                                                                            دار
                                                                        </option>
                                                                        <option>
                                                                            قولنامه ای
                                                                        </option>
                                                                        <option>در
                                                                            دست اقدام
                                                                        </option>
                                                                        <option>مشاع
                                                                        </option>
                                                                        <option>دیگر
                                                                        </option>
                                                                    </select>
                                                                    @error('form.doc')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-3 form-group @error('form.dimension') is-invalid @enderror">
                                                                    <label for="dimension">ابعاد</label>
                                                                    <input type="text" id="dimension"
                                                                        wire:model='form.dimension'
                                                                        class="form-control" />
                                                                    @error('form.dimension')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-3 form-group @error('form.view') is-invalid @enderror">
                                                                    <label for="view">نما</label>
                                                                    <input type="text" wire:model='form.view'
                                                                        id="view" class="form-control" />
                                                                    @error('form.view')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-3 form-group @error('form.door') is-invalid @enderror">
                                                                    <label for="door">درب ورودی</label>
                                                                    <input type="text" wire:model='form.door'
                                                                        id="door" class="form-control" />
                                                                    @error('form.door')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.screen') is-invalid @enderror">
                                                                    <label for="screen">پرده</label>
                                                                    <input type="text" wire:model='form.screen'
                                                                        id="screen" class="form-control" />
                                                                    @error('form.screen')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.cover') is-invalid @enderror">
                                                                    <label for="cover">کفپوش</label>
                                                                    <input type="text" id="cover"
                                                                        wire:model='form.cover'
                                                                        class="form-control" />
                                                                    @error('form.cover')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.phone_line') is-invalid @enderror">
                                                                    <label for="phone line">خط تلفن</label>
                                                                    <input type="text" id="phone_line"
                                                                        wire:model='form.phone_line'
                                                                        class="form-control" />
                                                                    @error('form.phone_line')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.cool') is-invalid @enderror">
                                                                    <label for="cool">سیستم برودتی</label>
                                                                    <input type="text" wire:model='form.cool'
                                                                        id="cool" class="form-control" />
                                                                    @error('form.cool')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.heat') is-invalid @enderror">
                                                                    <label for="heat">سیستم حرارتی</label>
                                                                    <input type="text" wire:model='form.heat'
                                                                        id="heat" class="form-control" />
                                                                    @error('form.heat')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-sm-4 form-group @error('form.cabinet') is-invalid @enderror">
                                                                    <label for="cabinet">کابینت</label>
                                                                    <input type="text" wire:model='form.cabinet'
                                                                        id="cabinet" class="form-control" />
                                                                    @error('form.cabinet')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                                <div
                                                                    class="col-lg-4 form-group @error('form.collection') is-invalid @enderror">
                                                                    <label for="collection">تعداد واحد های
                                                                        مجموعه</label>
                                                                    <input type="number" id="collection"
                                                                        wire:model='form.collection'
                                                                        class="form-control" />
                                                                    @error('form.collection')
                                                                        <small
                                                                            class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row clearfix">
                                                                <div
                                                                    class="col-sm-12 form-group @error('form.description') is-invalid @enderror">
                                                                    <label for="">توضیحات</label>
                                                                    <div class="form-line">
                                                                        <textarea rows="5" class="form-control no-resize" id="description" wire:model='form.description'
                                                                            placeholder="توضیحات را وارد کنید ...."></textarea>
                                                                        @error('form.description')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div
                                                                    class="col-sm-12 form-group @error('form.agent_description') is-invalid @enderror">
                                                                    <label for="">توضیحات مشاور</label>
                                                                    <div class="form-line">
                                                                        <textarea rows="5" class="form-control no-resize" id="agent_description" wire:model='form.agent_description'
                                                                            placeholder="توضیحات را وارد کنید ...."></textarea>
                                                                        @error('form.agent_description')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <h5 style="color:#04BE5B">امکانات </h5>
                                                            <hr>
                                                            <div class="row clearfix">
                                                                @foreach ($features as $key => $feature)
                                                                    <div class="col-lg-3 col-md-6">
                                                                        <div class="checkbox">
                                                                            <input type="checkbox"
                                                                                id="features-{{ $feature->id }}"
                                                                                wire:model='form.features'
                                                                                class="filled-in chk-col-indigo"
                                                                                value="{{ $feature->id }}"
                                                                                {{ (is_array(old('features')) and in_array($feature->id, old('features'))) ? ' checked' : '' }} />
                                                                            @error('form.features')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                            <label
                                                                                for="features-{{ $feature->id }}">{{ $feature->name }}</label>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>

                                                        </div>
                                                        <br><br>
                                                        <div class="row clearfix">
                                                            <div class="col-lg-5 ">
                                                            </div>
                                                            <div class="col-lg-4 ">
                                                                <button type="submit"
                                                                    style="padding: 12px 40px 12px 40px"
                                                                    class="btn btn-raised btn-primary waves-effect">
                                                                    ثبت اطلاعات
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </p>
                                                </section>
                                            </div>
                                        </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @push('scripts')
        <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script> -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
        </script>
        <script src="{{ asset('assets/file/js/plugins/piexif.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/file/js/plugins/sortable.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/file/js/fileinput.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/file/js/locales/fa.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets/file/themes/fas/theme.js') }}" type="text/javascript"></script>
        <script src="{{asset('assets/file/themes/explorer-fas/theme.css')}}" type=" text/javascript"></script>
        <script src="{{ asset('assets/js/ir-city-select.min.js') }}"></script>


        <script>
            $(document).ready(function() {
                $('.class').select2();
                $('#province').on('change', function(e) {
                    let data = $('#province').select2("val");
                    if (data === '') {
                        @this.set('form.province', null);
                    } else {
                        @this.set('form.province', data);
                    }
                });

                $('#lable').on('change', function(e) {
                    let data = $('#lable').select2("val");
                    if (data === '') {
                        @this.set('form.lable', null);
                    } else {
                        @this.set('form.lable', data);
                    }
                });


                $('#city').on('change', function(e) {
                    let data = $('#city').select2("val");
                    if (data === '') {
                        @this.set('form.city', null);
                    } else {
                        @this.set('form.city', data);
                    }
                });

                $('#doc').on('change', function(e) {
                    let data = $('#doc').select2("val");
                    if (data === '') {
                        @this.set('form.doc', null);
                    } else {
                        @this.set('form.doc', data);
                    }
                });

                $('#usertype').on('change', function(e) {
                    let data = $('#usertype').select2("val");
                    if (data === '') {
                        @this.set('form.usertype', null);
                    } else {
                        @this.set('form.usertype', data);
                    }
                });

                $('#tr_type').on('change', function(e) {
                    let data = $('#tr_type').select2("val");
                    if (data === '') {
                        @this.set('form.tr_type', null);
                    } else {
                        @this.set('form.tr_type', data);
                    }
                });
                $('#type').on('change', function(e) {
                    let data = $('#type').select2("val");
                    if (data === '') {
                        @this.set('form.type', null);
                    } else {
                        @this.set('form.type', data);
                    }
                });

                $("#input-21").fileinput({
                    previewFileType: "image",
                    browseClass: "btn btn-success",
                    browseLabel: "انتخاب تصویر",
                    browseIcon: "<i class=\"bi-file-image\"></i> ",
                    removeClass: "btn btn-danger",
                    removeLabel: "حذف",
                    removeIcon: "<i class=\"bi-trash\"></i> ",
                    uploadClass: "btn btn-info",
                    uploadLabel: "آپلود",
                    uploadIcon: "<i class=\"bi-upload\"></i> ",
                    allowedFileExtensions: ['jpg', 'png'],
                    maxFileSize: 10240,
                    removeIcon: "<i class=\"bi-trash\"></i> ",
                    initialPreviewAsData: true,
                    overwriteInitial: true,
                    // uploadUrl: "{{ url('admin/delete-image/1') }}",
                    // deleteUrl: "{{ route('admin.home') }}",
                    // maxFilePreviewSize: 10240,
                    layoutTemplates: {
                        main1: "{preview}\n" +
                            "<div class=\'input-group {class}\'>\n" +
                            "   {browse}\n" +

                            "   {remove}\n" +

                            "</div>"
                    },
                });

                $("#wizard-horizontal").steps({


                    headerTag: 'h2',
                    bodyTag: 'section',
                    transitionEffect: 'slideLeft',
                    onInit: function(event, currentIndex) {

                    },
                    onStepChanged: function(event, currentIndex, priorIndex) {

                    },

                    /* Events */
                    onStepChanging: function(event, currentIndex, newIndex) {
                        return true;
                    },

                    onCanceled: function(event) {},
                    onFinishing: function(event, currentIndex) {
                        return true;
                    },
                    onFinished: function(event, currentIndex) {},

                    /* Labels */
                    labels: {
                        cancel: "Cancel",
                        current: "current step:",
                        pagination: "Pagination",
                        finish: "Finish",
                        next: "Next",
                        previous: "Previous",
                        loading: "Loading ..."
                    }
                });



            });
        </script>
    @endpush
    <script>
        function changePrice(value, input) {
            var meter = $("#area").val();
            if (meter) {
                value = value.replace(/,/g, '');
                var meterprice = value / meter;
                $("#meter_price").val(meterprice);
            }
            separateNum(value, input);
        }

        function settype() {
            if (document.getElementById("tr_type").value === "رهن و اجاره") {
                document.getElementById("loanamount").disabled = true;
                document.getElementById("loan").disabled = true;
                document.getElementById("bidprice").disabled = true;
                document.getElementById("ugprice").disabled = true;
                document.getElementById("meter_price").disabled = true;
                document.getElementById("cheng").disabled = false;
                document.getElementById("rent").disabled = false;
                document.getElementById("rahn").disabled = false;
                document.getElementById("people_number").disabled = false;
            } else if (document.getElementById("tr_type").value === "فروش") {
                document.getElementById("cheng").disabled = true;
                document.getElementById("rent").disabled = true;
                document.getElementById("rahn").disabled = true;
                document.getElementById("people_number").disabled = true;
                document.getElementById("loanamount").disabled = false;
                document.getElementById("loan").disabled = false;
                document.getElementById("meter_price").disabled = false;
                document.getElementById("bidprice").disabled = false;
                document.getElementById("ugprice").disabled = false;
            } else if (document.getElementById("tr_type").value === "پیش فروش") {
                document.getElementById("cheng").disabled = true;
                document.getElementById("rent").disabled = true;
                document.getElementById("rahn").disabled = true;
                document.getElementById("people_number").disabled = true;
                document.getElementById("loanamount").disabled = false;
                document.getElementById("loan").disabled = false;
                document.getElementById("meter_price").disabled = false;
                document.getElementById("bidprice").disabled = false;
                document.getElementById("ugprice").disabled = false;
            } else {
                document.getElementById("cheng").disabled = false;
                document.getElementById("rent").disabled = false;
                document.getElementById("rahn").disabled = false;
                document.getElementById("people_number").disabled = false;
                document.getElementById("loanamount").disabled = false;
                document.getElementById("loan").disabled = false;
                document.getElementById("meter_price").disabled = false;
                document.getElementById("bidprice").disabled = false;
                document.getElementById("ugprice").disabled = false;
            }
        }

        function baractive() {
            document.getElementById("step2_t").className = "nav-link active show";
            document.getElementById("step3_t").className = "nav-link";
        }


        function separateNum(value, input) {
            /* seprate number input 3 number */
            var nStr = value + '';
            nStr = nStr.replace(/\,/g, "");
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            if (input !== undefined) {

                input.value = x1 + x2;
            } else {
                return x1 + x2;
            }
        }
    </script>

</div>
