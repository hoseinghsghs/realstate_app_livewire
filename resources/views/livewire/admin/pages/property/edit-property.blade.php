<div>
    <section class="content">
        <div class="body_scroll">
            <div class="block-header">
                <div class="row">
                    <div class="col-lg-7 col-md-6 col-sm-12">
                        <h2>ویرایش ملک</h2>
                        </br>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><i
                                        class="zmdi zmdi-home"></i>خانه</a></li>
                            <li class="breadcrumb-item active">املاک</li>
                            <li class="breadcrumb-item active">ویرایش ملک</li>
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

            {{-- nav start --}}

            {{-- nav end --}}
            <!-- test -->
            <div class="container-fluid ">
                <div class="row clearfix">
                    <div class="col-12">
                        <div class="container pt-4" id="nav2">
                            <div class="wizard">
                                <div class="wizard-nav">

                                    <div class="step" data-step="1">
                                        <i class="fas fa-home"
                                            style="background-color: {{ $this->form->bcolor_step_1 }}; color:{{ $this->form->color_step_1 }}"></i><br />مشخصات
                                        ملک
                                    </div>
                                    <div class="step" data-step="2">
                                        <i class="fas fa-user"
                                            style="background-color: {{ $this->form->bcolor_step_2 }}; color:{{ $this->form->color_step_2 }}"></i><br />مشخصات
                                        مالک
                                    </div>
                                    <div class="step" data-step="3">
                                        <i class="fas fa-file"
                                            style="background-color: {{ $this->form->bcolor_step_3 }}; color:{{ $this->form->color_step_3 }}"></i><br />سایر
                                        مشخصات
                                    </div>
                                    <div class="step" data-step="4">
                                        <i class="fas fa-image"
                                            style="background-color: {{ $this->form->bcolor_step_4 }}; color:{{ $this->form->color_step_4 }}"></i><br />تصاویر
                                    </div>
                                </div>
                                <div class="progress">
                                    @if ($errors->any())
                                        <div class="progress-bar" role="progressbar"
                                            style="background-color: red; width: {!! ($this->form->currentStep / $this->form->totalSteps) * 100 !!}%"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                        <div class="progress-bar" role="progressbar"
                                            style="width: {!! ($this->form->currentStep / $this->form->totalSteps) * 100 !!}%" aria-valuenow="0" aria-valuemin="0"
                                            aria-valuemax="100"></div>
                                    @endif

                                </div>
                            </div>
                        </div>
                        <hr>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="card">
                            <div class="body">
                                @can('is_admin')
                                    <form wire:submit="update">
                                    @endcan
                                    @can('is_agent')
                                        <form wire:submit="update">
                                        @endcan
                                        <form wire:submit="update">
                                            <form wire:submit.prevent="update">
                                                {{-- STEP 1 --}}
                                                @if ($form->currentStep == 1)
                                                    {{-- <div class="step-one"> --}}
                                                    <section>
                                                        <div class="card">
                                                            <div class="body">
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-lg-4 col-md-4 form-group @error('form.title') is-invalid @enderror">
                                                                        <label for="title">عنوان <abbr title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <input type="text" class="form-control"
                                                                            wire:model.defer='form.title' />
                                                                        @error('form.title')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-4 col-md-4 form-group @error('form.code') is-invalid @enderror">
                                                                        <label for="title">کد ملک <abbr
                                                                                title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <input type="text"
                                                                            wire:model.defer='form.code'
                                                                            class="form-control" />
                                                                        @error('form.code')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-4 col-md-4 mb-4 @error('form.lable') is-invalid @enderror">
                                                                        <div class="form-group mbb" wire:ignore>
                                                                            <label for="lable">لیبل</label>
                                                                            <select wire:model.defer='form.lable'
                                                                                id="lable" class="form-control">
                                                                                <option>
                                                                                </option>
                                                                                <option>
                                                                                    ویژه ها</option>
                                                                                <option>
                                                                                    فروخته شد</option>
                                                                                <option>
                                                                                    اجاره داده شد</option>
                                                                            </select>
                                                                        </div>
                                                                        @error('form.lable')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-lg-4 col-md-6 mb-4 @error('form.tr_type') is-invalid @enderror">
                                                                        <div class="form-group mbb">
                                                                            <label for="tr_type"> نوع معامله
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <select wire:model.defer.live='form.tr_type'
                                                                                id="tr_type" class="form-control">
                                                                                <option>
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
                                                                        </div>
                                                                        @error('form.tr_type')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-4 col-md-6 mb-4 p @error('form.usertype') is-invalid @enderror">
                                                                        <div class="form-group mbb">
                                                                            <label for="usertype"> نوع کاربری
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <select wire:model.defer='form.usertype'
                                                                                id="usertype" class="form-control">
                                                                                <option>
                                                                                </option>
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
                                                                        </div>

                                                                        @error('form.usertype')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-lg-4 col-md-6 mb-4  @error('form.type') is-invalid @enderror">
                                                                        <div class="form-group mbb">
                                                                            <label for="type">نوع ملک
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <select wire:model.defer='form.type'
                                                                                id="type" class="form-control">
                                                                                <option>
                                                                                </option>
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
                                                                        </div>
                                                                        @error('form.type')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-lg-4 col-md-6  form-group @error('form.bedroom') is-invalid @enderror">
                                                                        <label for="bedroom">تعداد خواب
                                                                            <abbr title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <input type="number" id="bedroom"
                                                                            wire:model.defer='form.bedroom'
                                                                            step="1" aria-disabled
                                                                            class="form-control"
                                                                            value="{{ old('bedroom') }}" />
                                                                        @error('form.bedroom')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-lg-4 col-md-6 form-group @error('form.floor') is-invalid @enderror">
                                                                        <label for="floor">تعداد طبقات</label>
                                                                        <input type="number"
                                                                            wire:model.blur="form.floor"
                                                                            id="floor" step="1"
                                                                            class="form-control" />
                                                                        @error('form.floor')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>


                                                                    <div
                                                                        class="col-lg-4 col-md-6 form-group @error('form.floorsell') is-invalid @enderror">
                                                                        <label for="floorsell">طبقه مورد معامله <abbr
                                                                                title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <select wire:model.defer="form.floorsell"
                                                                            id="floorsell" class="form-control"
                                                                            multiple style="height: 64px">
                                                                            @foreach (range(1, max(1, (int) $form->floor)) as $floor)
                                                                                <option value="{{ $floor }}"
                                                                                    {{ in_array($floor, (array) $form->floorsell) ? 'selected' : '' }}>
                                                                                    {{ $floor }}
                                                                                </option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('form.floorsell')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-sm-4 form-group @error('form.year') is-invalid @enderror">
                                                                        <label for="year">قدمت
                                                                            ساخت</label>
                                                                        <input type="number" id="year"
                                                                            wire:model.defer='form.year'
                                                                            class="form-control" placeholder="سال"
                                                                            value="{{ old('year') }}" />
                                                                        @error('form.year')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-4 form-group @error('form.area') is-invalid @enderror">
                                                                        <label for="area">مساحت زمین
                                                                            (برحسب متر
                                                                            مربع)</label>
                                                                        <input type="number" id="area"
                                                                            wire:model.defer='form.area'
                                                                            value="{{ old('area') }}"
                                                                            class="form-control"
                                                                            placeholder="متر مربع" />
                                                                        @error('form.area')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-4 form-group @error('form.meter') is-invalid @enderror">
                                                                        <label for="meter">متراژ زیر بنا
                                                                            <abbr title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <input type="number" id="meter"
                                                                            wire:model.defer='form.meter'
                                                                            value="{{ old('meter') }}"
                                                                            max="10000" class="form-control" />
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
                                                                    <div
                                                                        class="col-sm-4 mb-4 @error('form.province') is-invalid @enderror">
                                                                        <div class="form-group mbb">
                                                                            <label for="province">استان
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <select class="ir-province  form-control"
                                                                                wire:model.defer.live='form.province'>
                                                                                <option value="">انتخاب استان
                                                                                </option>
                                                                                @foreach ($form->states as $stateName => $cities)
                                                                                    <option
                                                                                        value="{{ $stateName }}">
                                                                                        {{ $stateName }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('form.province')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-sm-4 mb-4 @error('form.city') is-invalid @enderror">
                                                                        <div class="form-group mbb">
                                                                            <label for="city">شهر <abbr
                                                                                    title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <select class="ir-city  form-control"
                                                                                wire:model.defer='form.city'>
                                                                                @foreach ($form->states[$form->province] ?? [] as $city)
                                                                                    <option
                                                                                        value="{{ $city }}">
                                                                                        {{ $city }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                        @error('form.city')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>

                                                                    <div
                                                                        class="col-sm-4 form-group @error('form.district') is-invalid @enderror">
                                                                        <label for="district">محله
                                                                            <abbr title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <input type="text" step="any"
                                                                            wire:model.defer='form.district'
                                                                            id="district" class="form-control" />
                                                                        @error('form.district')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <small class="col-12 "> برای پیدا کردن
                                                                        موقعیت روی لینک
                                                                        مقابل کلیک
                                                                        کنید
                                                                        <a href="https://neshan.org/maps"
                                                                            target="_blank">نقشه
                                                                            نشان</a></small>
                                                                    <div
                                                                        class="col-sm-6 form-group @error('form.lon') is-invalid @enderror">
                                                                        <label for="lon">طول
                                                                            جغرافیایی</label>
                                                                        <input type="number" step="any"
                                                                            id="lon" wire:model.defer='form.lon'
                                                                            class="form-control" />
                                                                        @error('form.lon')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                    <div
                                                                        class="col-sm-6 form-group @error('form.lat') is-invalid @enderror">
                                                                        <label for="lat">عرض
                                                                            جغرافیایی</label>
                                                                        <input type="number" step="any"
                                                                            wire:model.defer='form.lat' id="lat"
                                                                            class="form-control" />
                                                                        @error('form.lat')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <div class="row clearfix">
                                                                    <div
                                                                        class="col-sm-12 form-group @error('form.address') is-invalid @enderror">
                                                                        <label for="">آدرس
                                                                            <abbr title="ضروری"
                                                                                style="color:red;">*</abbr></label>
                                                                        <div class="form-line">
                                                                            <textarea rows="3" class="form-control no-resize" id="address" wire:model.defer='form.address'
                                                                                placeholder="آدرس را وارد کنید"></textarea>
                                                                            @error('form.address')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
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
                                                                        <label for="ambed">کد امبد
                                                                            ویدیو</label>
                                                                        <input type="text" id="ambed"
                                                                            wire:model.defer='form.ambed'
                                                                            class="form-control" />
                                                                        @error('form.ambed')
                                                                            <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                @if ($this->form->tr_type == 'فروش' || $this->form->tr_type == 'پیش فروش')
                                                                    <h5 style="color:#04BE5B">اطلاعات مربوط به
                                                                        فروش ملک </h5>
                                                                    <hr>

                                                                    <div class="row clearfix">
                                                                        <div
                                                                            class="col-sm-4 form-group @error('form.loan') is-invalid @enderror">
                                                                            <label for="loan">وام
                                                                                بانکی</label>
                                                                            <input type="text" id="loan"
                                                                                wire:model.defer='form.loan'
                                                                                class="form-control" />
                                                                            @error('form.loan')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div
                                                                            class="col-sm-4 form-group @error('form.loanamount') is-invalid @enderror">
                                                                            <label for="loanamount">مبلغ
                                                                                وام</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="loanamount"
                                                                                    wire:model.defer='form.loanamount'
                                                                                    onkeyup="separateNum(this.value,this);"
                                                                                    aria-label="Amount (to the nearest dollar)">
                                                                            </div>
                                                                            @error('form.loanamount')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div
                                                                            class="col-sm-4 form-group @error('form.meter_price') is-invalid @enderror">
                                                                            <label for="meter_price">قیمت متری
                                                                                (برحسب متر
                                                                                مربع)</label>
                                                                            <div class="input-group mb-3">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="meter_price"
                                                                                    onkeyup="separateNum(this.value,this);"
                                                                                    wire:model.defer='form.meter_price'
                                                                                    aria-label="Amount (to the nearest dollar)">
                                                                            </div>

                                                                            @error('form.meter_price')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    <div class="row clearfix">
                                                                        <div
                                                                            class="col-lg-6 form-group @error('form.bidprice') is-invalid @enderror mb-4">
                                                                            <label for="bidprice">قیمت پیشنهادی
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <div class="input-group mbb">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="bidprice"
                                                                                    wire:model.defer='form.bidprice'
                                                                                    onkeyup="changePrice(this.value,this);"
                                                                                    aria-label="Amount (to the nearest dollar) "
                                                                                    minlength="10" maxlength="15">
                                                                            </div>
                                                                            @error('form.bidprice')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div
                                                                            class="col-lg-6 form-group @error('form.ugprice') is-invalid @enderror">
                                                                            <label for="ugprice">قیمت کارشناسی
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <div class="input-group mbb">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    class="form-control"
                                                                                    id="ugprice"
                                                                                    wire:model.defer='form.ugprice'
                                                                                    aria-label="Amount (to the nearest dollar)"
                                                                                    onkeyup="separateNum(this.value,this);"
                                                                                    minlength="10" maxlength="15">
                                                                            </div>
                                                                            @error('form.ugprice')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <!-- اطلاعات مربوط به خرید اجاره -->
                                                                @if ($this->form->tr_type == 'رهن و اجاره')
                                                                    <h5 style="color:#04BE5B">اطلاعات مربوط به
                                                                        رهن و اجاره
                                                                    </h5>
                                                                    <div class="row clearfix">
                                                                        <div
                                                                            class="col-lg-3 col-md-6 form-group @error('form.people_number') is-invalid @enderror">
                                                                            <label for="people_number">حداکثر
                                                                                تعداد
                                                                                نفرات</label>
                                                                            <input type="number" id="people_number"
                                                                                wire:model.defer='form.people_number'
                                                                                class="form-control" />
                                                                            @error('form.people_number')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div
                                                                            class="col-lg-3  form-group @error('form.rent') is-invalid @enderror">
                                                                            <label for="rent">مبلغ اجاره
                                                                                <abbr title="ضروری"
                                                                                    style="color:red;">*</abbr></label>
                                                                            <div class="input-group mbb">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.rent'
                                                                                    class="form-control"
                                                                                    id="rent"
                                                                                    aria-label="Amount (to the nearest dollar)"
                                                                                    onkeyup="separateNum(this.value,this);"
                                                                                    maxlength="10">
                                                                            </div>
                                                                            @error('form.rent')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div
                                                                            class="col-lg-3 form-group @error('form.rahn') is-invalid @enderror">
                                                                            <label for="rahn">مبلغ رهن <abbr
                                                                                    title="ضروری"
                                                                                    style="color:red;">*</abbr>
                                                                            </label>
                                                                            <div class="input-group mbb">
                                                                                <div class="input-group-prepend">
                                                                                    <span
                                                                                        class="input-group-text">تومان</span>
                                                                                </div>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.rahn'
                                                                                    class="form-control"
                                                                                    id="rahn"
                                                                                    aria-label="Amount (to the nearest dollar)"
                                                                                    onkeyup="separateNum(this.value,this);"
                                                                                    maxlength="11">
                                                                            </div>
                                                                            @error('form.rahn')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                        </div>
                                                                        <div class="col-lg-3 col-md-6 ">
                                                                            <br><br>
                                                                            <div class="checkbox">
                                                                                <input id="ischange"
                                                                                    wire:model.defer='form.ischange'
                                                                                    type="checkbox">
                                                                                @error('form.ischange')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                                <label for="ischange">قابل تغیر
                                                                                    اجاره و
                                                                                    رهن</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                                <!-- امکانات -->
                                                                <br>
                                                                <h5 style="color:#04BE5B">وضعیت </h5>
                                                                <hr>
                                                                <div class="row clearfix">
                                                                    <div class="col-lg-3 col-md-6">
                                                                        <div class="checkbox">
                                                                            <input id="isactive" type="checkbox"
                                                                                wire:model.defer='form.isactive'>
                                                                            @error('form.isactive')
                                                                                <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                            <label for="isactive">انتشار
                                                                                ملک</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                @endif

                                                {{-- STEP 2 --}}

                                                @if ($form->currentStep == 2)
                                                    <div class="step-two">
                                                        <div class="card">
                                                            <section>
                                                                <p>
                                                                <div class="card">
                                                                    <div class="body">
                                                                        <div class="row clearfix">
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.name_family') is-invalid @enderror">
                                                                                <label for="name_family">نام نام
                                                                                    خانوادگی <abbr title="ضروری"
                                                                                        style="color:red;">*</abbr>
                                                                                </label>
                                                                                <input type="text" id="name_family"
                                                                                    wire:model.defer='form.name_family'
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
                                                                                <label for="telephone">شماره
                                                                                    تلفن</label>
                                                                                <input type="text" id="telephone"
                                                                                    wire:model.defer='form.telephone'
                                                                                    class="form-control" />
                                                                                @error('form.telephone')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.phone') is-invalid @enderror">
                                                                                <label for="phone">شماره موبایل
                                                                                    <abbr title="ضروری"
                                                                                        style="color:red;">*</abbr>
                                                                                </label>
                                                                                <input type="text" maxlength="11"
                                                                                    id="phone"
                                                                                    wire:model.defer='form.phone'
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
                                                        </div>
                                                    </div>
                                                @endif
                                                {{-- STEP 3 --}}

                                                @if ($form->currentStep == 3)
                                                    <div class="step-three">
                                                        <div class="card">
                                                            <h2>سایر مشخصات</h2>
                                                            <section>
                                                                <p>
                                                                <div class="card">
                                                                    <div class="body">
                                                                        <div class="row clearfix">
                                                                            <div
                                                                                class="col-lg-3 form-group @error('form.doc') is-invalid @enderror">
                                                                                <label for="doc">نوع
                                                                                    سند</label>
                                                                                <select wire:model.defer='form.doc'
                                                                                    id="doc"
                                                                                    class="form-control show-tick ms select2">
                                                                                    <option>
                                                                                    </option>
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
                                                                                    wire:model.defer='form.dimension'
                                                                                    class="form-control" />
                                                                                @error('form.dimension')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-3 form-group @error('form.view') is-invalid @enderror">
                                                                                <label for="view">نما</label>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.view'
                                                                                    id="view"
                                                                                    class="form-control" />
                                                                                @error('form.view')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-3 form-group @error('form.door') is-invalid @enderror">
                                                                                <label for="door">درب
                                                                                    ورودی</label>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.door'
                                                                                    id="door"
                                                                                    class="form-control" />
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
                                                                                <input type="text"
                                                                                    wire:model.defer='form.screen'
                                                                                    id="screen"
                                                                                    class="form-control" />
                                                                                @error('form.screen')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.cover') is-invalid @enderror">
                                                                                <label for="cover">کفپوش</label>
                                                                                <input type="text" id="cover"
                                                                                    wire:model.defer='form.cover'
                                                                                    class="form-control" />
                                                                                @error('form.cover')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.phone_line') is-invalid @enderror">
                                                                                <label for="phone line">خط
                                                                                    تلفن</label>
                                                                                <input type="text" id="phone_line"
                                                                                    wire:model.defer='form.phone_line'
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
                                                                                <label for="cool">سیستم
                                                                                    برودتی</label>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.cool'
                                                                                    id="cool"
                                                                                    class="form-control" />
                                                                                @error('form.cool')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.heat') is-invalid @enderror">
                                                                                <label for="heat">سیستم
                                                                                    حرارتی</label>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.heat'
                                                                                    id="heat"
                                                                                    class="form-control" />
                                                                                @error('form.heat')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-4 form-group @error('form.cabinet') is-invalid @enderror">
                                                                                <label for="cabinet">کابینت</label>
                                                                                <input type="text"
                                                                                    wire:model.defer='form.cabinet'
                                                                                    id="cabinet"
                                                                                    class="form-control" />
                                                                                @error('form.cabinet')
                                                                                    <small
                                                                                        class="text-danger">{{ $message }}</small>
                                                                                @enderror
                                                                            </div>
                                                                            <div
                                                                                class="col-lg-4 form-group @error('form.collection') is-invalid @enderror">
                                                                                <label for="collection">تعداد واحد
                                                                                    های
                                                                                    مجموعه</label>
                                                                                <input type="number" id="collection"
                                                                                    wire:model.defer='form.collection'
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
                                                                                    <textarea rows="5" class="form-control no-resize" id="description" wire:model.defer='form.description'
                                                                                        placeholder="توضیحات را وارد کنید ...."></textarea>
                                                                                    @error('form.description')
                                                                                        <small
                                                                                            class="text-danger">{{ $message }}</small>
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            <div
                                                                                class="col-sm-12 form-group @error('form.agent_description') is-invalid @enderror">
                                                                                <label for="">توضیحات
                                                                                    مشاور</label>
                                                                                <div class="form-line">
                                                                                    <textarea rows="5" class="form-control no-resize" id="agent_description"
                                                                                        wire:model.defer='form.agent_description' placeholder="توضیحات را وارد کنید ...."></textarea>
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
                                                                        <div class="row clearfix" wire:ignore.self>
                                                                            @foreach ($features as $key => $feature)
                                                                                <div class="col-lg-3 col-md-6"
                                                                                    wire:key="fe-{{ $feature->id }}">
                                                                                    <div class="checkbox">
                                                                                        <input type="checkbox"
                                                                                            @foreach ($this->form->property->features as $propertyfeature)
                                                                                        @checked($feature->id == $propertyfeature->id) @endforeach
                                                                                            id="features-{{ $feature->id }}"
                                                                                            wire:click="userSubscribed($event.target.checked , {{ $feature->id }})"
                                                                                            {{-- wire:model='form.features' --}}
                                                                                            class="filled-in chk-col-indigo"
                                                                                            value="{{ $feature->id }}" />

                                                                                        <label
                                                                                            for="features-{{ $feature->id }}">{{ $feature->name }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                </p>
                                                            </section>
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($form->currentStep == 4)
                                                    <div class="step-three">
                                                        <div class="card">
                                                            <section>
                                                                <div class="card">
                                                                    <div class="body">
                                                                        <div class="row">
                                                                            <div class="form-group col-md-4">
                                                                                <label class="form-label"
                                                                                    for="exampleFormControlFile1">آپلود
                                                                                    تصویر اصلی<span wire:loading
                                                                                        wire:target="form.img"
                                                                                        class="spinner-border spinner-border-sm"
                                                                                        role="status"
                                                                                        aria-hidden="true"></span></label>
                                                                                <div
                                                                                    class="custom-file d-flex flex-row-reverse">
                                                                                    <input
                                                                                        onchange="validateImage(this)"
                                                                                        wire:model.live="form.img"
                                                                                        type="file"
                                                                                        class="custom-file-input"
                                                                                        id="customFile" lang="ar"
                                                                                        dir="rtl">
                                                                                    <label
                                                                                        class="custom-file-label text-right"
                                                                                        for="customFile">
                                                                                    </label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-2">
                                                                            <div class="row">

                                                                                @if ($form->is_edit)
                                                                                    @if ($form->img)
                                                                                        <div class="col-12">
                                                                                            <img src="{{ $form->img->temporaryUrl() }}"
                                                                                                style="border: #00ff40 2px solid ; border-radius: 0.5rem"
                                                                                                height="300rem">
                                                                                        </div>
                                                                                    @else
                                                                                        <div class="col-12">
                                                                                            <div class="hover"></div>
                                                                                            <a href="{{ asset('storage/preview/' . $property->img) }}"
                                                                                                wire:key="{{ $property->img }}"
                                                                                                class="file"
                                                                                                target="_blank">
                                                                                                <div class="image">
                                                                                                    <img src="{{ asset('storage/preview/' . $property->img) }}"
                                                                                                        wire:key="{{ $property->img }}"
                                                                                                        alt="img"
                                                                                                        style="border: #00b7ff 2px solid ; border-radius: 0.5rem"
                                                                                                        height="300rem">
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    @endif
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="row mt-4">
                                                                            <div class="form-group col-md-4">
                                                                                <label class="form-label"
                                                                                    for="exampleFormControlFile1">آپلود
                                                                                    سایر تصاویر<span wire:loading
                                                                                        wire:target="form.otherimg"
                                                                                        class="spinner-border spinner-border-sm"
                                                                                        role="status"
                                                                                        aria-hidden="true"></span></label>
                                                                                <div
                                                                                    class="custom-file d-flex flex-row-reverse">
                                                                                    <input
                                                                                        wire:model.defer.live="form.otherimg"
                                                                                        type="file"
                                                                                        id="imageUpload"
                                                                                        class="custom-file-input"
                                                                                        lang="ar" dir="rtl"
                                                                                        multiple>
                                                                                    <label
                                                                                        class="custom-file-label text-right"
                                                                                        for="customFile">
                                                                                    </label>
                                                                                </div>
                                                                                <small class="text-danger"
                                                                                    id="validation-errors"></small>
                                                                            </div>
                                                                            <div class="form-group col-md-4"
                                                                                style="    margin-top: 1.66rem !important;">
                                                                                <button wire:loading.attr="disabled"
                                                                                    wire:click.prevent="add_image"
                                                                                    class="btn btn-raised btn-info waves-effect">
                                                                                    افزودن
                                                                                    <span
                                                                                        class="spinner-border spinner-border-sm text-light"
                                                                                        wire:loading
                                                                                        wire:target="add_image"></span>

                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @if ($form->otherimg && count($form->otherimg) > 0)
                                                                        <div class="col-12 mb-3">
                                                                            <div
                                                                                class="d-flex flex-wrap rounded border border-secondary shadow-md bg-light p-1">
                                                                                @foreach ($form->otherimg as $key => $image)
                                                                                    <div class="position-relative  mx-2 my-1"
                                                                                        style="width: 150px;">
                                                                                        <img width="100%"
                                                                                            class="rounded border shadow-md"
                                                                                            src="{{ $image->temporaryUrl() }}">
                                                                                        <a wire:click="delete_temp_image({{ $key }})"
                                                                                            class="position-absolute text-danger text-md"
                                                                                            style="top: 5px;right: 10px;cursor:pointer;"><i
                                                                                                class="zmdi zmdi-close"></i></a>
                                                                                    </div>
                                                                                @endforeach
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    <div class="container-fluid">
                                                                        <div class="row clearfix">
                                                                            <div class="col-lg-12">
                                                                                <div class="card">
                                                                                    <div class="tab-content">
                                                                                        <div class="tab-pane active"
                                                                                            id="a2018">
                                                                                            <div class="row clearfix">
                                                                                                @foreach ($property->images as $images)
                                                                                                    <div wire:key="{{ $images->id }}"
                                                                                                        class="col-lg-3 col-md-4 col-sm-12">
                                                                                                        <div
                                                                                                            class="card">
                                                                                                            <div
                                                                                                                class="hover">

                                                                                                                <button
                                                                                                                    wire:loading.attr="disabled"
                                                                                                                    wire:click.prevent="delete({{ $images }})"
                                                                                                                    class="btn btn-icon btn-icon-mini btn-round btn-danger">
                                                                                                                    <i
                                                                                                                        class="zmdi zmdi-delete"></i>
                                                                                                                </button>

                                                                                                                <span
                                                                                                                    class="file-name">
                                                                                                                    <small
                                                                                                                        class="mr-2">
                                                                                                                        تاریخ
                                                                                                                        آپلود
                                                                                                                        <span
                                                                                                                            class="date">{{ Hekmatinasser\Verta\Verta::instance($images->created_at)->format('Y/n/j') }}</span></small>
                                                                                                                </span>
                                                                                                            </div>
                                                                                                            <a href="{{ asset('storage/otherpreview/' . $images->name) }}"
                                                                                                                class="file"
                                                                                                                target="_blank">
                                                                                                                <div
                                                                                                                    class="image">
                                                                                                                    <img src="{{ asset('storage/otherpreview/' . $images->name) }}"
                                                                                                                        alt="img"
                                                                                                                        class="img-fluid">
                                                                                                                </div>
                                                                                                            </a>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                @endforeach
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            </section>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div
                                                    class="action-buttons d-flex justify-content-between bg-white pt-2 pb-2">
                                                    @if ($form->currentStep == 1)
                                                        <div></div>
                                                    @endif
                                                    @if ($form->currentStep == 2 || $form->currentStep == 3 || $form->currentStep == 4)
                                                        <button type="button" class="btn btn-md btn-secondary"
                                                            wire:click.prevent="decStep()">
                                                            قبلی
                                                        </button>
                                                    @endif

                                                    <button type="submit" class="btn btn-md btn-primary"
                                                        wire:loading.attr="disabled">ویرایش
                                                        اطلاعات
                                                        <span class="spinner-border spinner-border-sm text-light"
                                                            wire:loading wire:target="add_image"></span>
                                                    </button>
                                                    @if ($form->currentStep == 1 || $form->currentStep == 2 || $form->currentStep == 3)
                                                        <button type="button" class="btn btn-md btn-success"
                                                            wire:click.prevent="incStep()">
                                                            بعدی
                                                        </button>
                                                    @endif


                                                </div>
                                            </form>
                                        </form>
                                    </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@push('styles')
    <style>
        .mbb {
            margin-bottom: 0.1rem;
        }

        .fixed {
            position: fixed;
            background: #fff;
            z-index: 10000;
            top: 0px;
            left: auto;
            right: auto;
            max-width: -webkit-fill-available;

        }

        body {
            background-color: #f8f9fa;
        }

        .wizard {
            background-color: #f8f9fa;
        }

        .wizard-step {
            display: none;
        }

        .wizard-step.active {
            display: block;
        }

        .progress {
            height: 5px;
        }

        .progress-bar {
            background-color: #28a745;
            /* سبز */
        }

        .wizard-nav {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .step {
            flex: 1;
            text-align: center;
            position: relative;
        }

        .step.completed {
            color: #28a745;
        }

        .step i {
            font-size: 18px;
            margin-bottom: 5px;
            border-radius: 50%;
            background-color: #e9ecef;
            /* پس‌زمینه آیکن‌ها */
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: background-color 0.3s;
        }

        .step.active i {
            background-color: #007bff;
            color: white;
        }

        .step.completed i {
            background-color: #28a745;
            /* پس‌زمینه سبز */
            color: white;
            /* رنگ آیکن سفید */
        }

        .step::after {
            content: "";
            position: absolute;
            bottom: 10px;
            left: 50%;
            width: 100%;
            height: 2px;
            background: #dee2e6;
            z-index: -1;
            transform: translateX(-50%);
        }

        .step.active::after {
            background: #007bff;
        }

        .step.completed::after {
            background: #28a745;
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const nav2 = document.getElementById("nav2");
            const placeholder = document.createElement('div'); // Placeholder to maintain height
            placeholder.style.height = `${nav2.offsetHeight}px`; // Set height equal to header
            placeholder.style.display = 'none'; // Initially hidden

            nav2.parentNode.insertBefore(placeholder, nav2); // Add placeholder above header

            let prevScrollPos = window.pageYOffset;

            window.addEventListener('scroll', () => {
                let currentScrollPos = window.pageYOffset;

                if (prevScrollPos > currentScrollPos) {
                    // Scrolling up
                    nav2.classList.remove('fixed');
                    placeholder.style.display = 'none';
                } else if (currentScrollPos > nav2.offsetHeight) {
                    // Scrolling down and past the header
                    nav2.classList.add('fixed');
                    placeholder.style.display = 'block'; // Show placeholder
                }

                prevScrollPos = currentScrollPos;
            });
        });


        function changePrice(value, input) {
            var meter = $("#area").val();
            if (meter) {
                value = value.replace(/,/g, '');
                var meterprice = value / meter;
                $("#meter_price").val(meterprice);
            }
            separateNum(value, input);
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
    @if ($form->currentStep == 4)
        <script>
            function validateImage(input) {
                const file = input.files[0];
                if (!file) {
                    alert('لطفا یک فایل انتخاب کنید.');
                    input.value = ''
                    return false;
                }

                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                if (!allowedTypes.includes(file.type)) {
                    alert('فرمت فایل مجاز نیست. لطفا فایل با فرمت jpg، png یا gif انتخاب کنید.');
                    input.value = '';
                    return false;
                }

                const maxSize = 2097152; // 2MB
                if (file.size > maxSize) {
                    alert('حجم فایل نباید از 2 مگابایت بیشتر باشد.');
                    input.value = '';
                    return false;
                }

                // اگر همه بررسی‌ها موفقیت‌آمیز بود، می‌توانید فایل را آپلود کنید
                return true;
            }

            const imageUpload = document.getElementById('imageUpload');
            const validationErrors = document.getElementById('validation-errors');

            imageUpload.addEventListener('change', () => {
                const files = imageUpload.files;
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
                let errors = [];

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];

                    if (!allowedTypes.includes(file.type)) {
                        errors.push(`فرمت فایل ${file.name} مجاز نیست.`);
                    } else if (file.size > 2097152) { // محدودیت اندازه 2MB
                        errors.push(`حجم فایل ${file.name} بیش از حد مجاز است.`);
                    } else {
                        // سایر بررسی‌ها مانند ابعاد، نسبت تصویر و ...
                    }
                }

                if (errors.length > 0) {
                    validationErrors.textContent = errors.join('\n');
                    imageUpload.value = '';
                }
            });
        </script>
    @endif
@endpush
