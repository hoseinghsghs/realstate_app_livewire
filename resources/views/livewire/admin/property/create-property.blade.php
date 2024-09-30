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

                <!-- endtest -->
                <!-- Nav tabs -->
                <ul class="nav nav-tabs p-0 mb-3 nav-tabs-success" role="tablist">
                    <li class="nav-item"><a class="nav-link active" onclick="setStep1_t()" data-toggle="tab"
                            id="step1_t" href="#home_with_icon_title"> <i class="zmdi zmdi-home"></i> مشخصات ملک
                        </a></li>

                    <li class="nav-item"><a class="nav-link" onclick="setStep2_t()" data-toggle="tab" id="step2_t"
                            href="#profile_with_icon_title"><i class="zmdi zmdi-account"></i> مشخصات مالک </a></li>

                    <li class="nav-item"><a class="nav-link" onclick="setStep3_t()" data-toggle="tab" id="step3_t"
                            href="#messages_with_icon_title"><i class="zmdi zmdi-file-plus"></i> سایر مشخصات</a></li>
                </ul>

                <!-- Tab panes -->
                <div class="row clearfix">
                    @foreach ($errors->all() as $error)
                        <!-- <li class="alert alert-danger alert-sm">{{ $error }}</li> -->

                        <div class="col-sm-4">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ $error }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
                @can('is_admin')
                    <form action="{{ route('admin.properties.store') }}" class="needs-validation" method="POST"
                        id="form_advanced_validation" enctype="multipart/form-data" novalidate>
                    @endcan


                    @can('is_agent')
                        <form action="{{ route('agent.properties.store') }}" class="needs-validation" method="POST"
                            id="form_advanced_validation" enctype="multipart/form-data" novalidate>
                        @endcan

                        <form action="{{ route('admin.properties.store') }}" class="needs-validation" method="POST"
                            id="form_advanced_validation" enctype="multipart/form-data" novalidate>
                            @csrf
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane in active" id="home_with_icon_title"> <b>مشخصات
                                        ملک</b>
                                    <div class="card">
                                        <br>
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div class="col-lg-6 col-md-12">
                                                    <label for="title">عنوان *</label>
                                                    <div class="form-group">
                                                        <input type="text" name="title" value="{{ old('title') }}"
                                                            id="title" class="form-control" required />

                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-12">
                                                    <label for="title">کد ملک *</label>
                                                    <div class="form-group">
                                                        <input type="text" name="code" value="{{ old('code') }}"
                                                            id="code" class="form-control" required />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label for="lable">لیبل</label>
                                                    <div class="form-group">
                                                        <select name="lable" id="lable"
                                                            class="form-control show-tick ms select2">
                                                            <option disabled selected hidden></option>
                                                            <option></option>
                                                            <option {{ old('lable') == 'ویژه ها' ? 'selected' : '' }}>
                                                                ویژه ها</option>
                                                            <option {{ old('lable') == 'فروخته شد' ? 'selected' : '' }}>
                                                                فروخته شد</option>
                                                            <option
                                                                {{ old('lable') == 'اجاره داده شد' ? 'selected' : '' }}>
                                                                اجاره داده شد</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-4 col-md-6">
                                                    <label for="tr_type"> نوع معامله *</label>
                                                    <div class="form-group">
                                                        <select name="tr_type" onchange="settype()" id="tr_type"
                                                            required class="form-control show-tick ms select2">
                                                            <option disabled selected hidden>
                                                            </option>
                                                            <option
                                                                {{ old('tr_type') == 'رهن و اجاره' ? 'selected' : '' }}>
                                                                رهن و
                                                                اجاره
                                                            </option>
                                                            <option {{ old('tr_type') == 'فروش' ? 'selected' : '' }}>
                                                                فروش
                                                            </option>
                                                            <option
                                                                {{ old('tr_type') == 'پیش فروش' ? 'selected' : '' }}>
                                                                پیش
                                                                فروش
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <label for="usertype"> نوع کاربری *</label>
                                                    <div class="form-group">
                                                        <select name="usertype" id="usertype"
                                                            class="form-control show-tick ms select2">
                                                            <option disabled selected hidden></option>
                                                            <option
                                                                {{ old('usertype') == 'مسکونی' ? 'selected' : '' }}>
                                                                مسکونی
                                                            </option>
                                                            <option {{ old('usertype') == 'تجاری' ? 'selected' : '' }}>
                                                                تجاری
                                                            </option>
                                                            <option
                                                                {{ old('usertype') == 'آموزشی' ? 'selected' : '' }}>
                                                                آموزشی
                                                            </option>
                                                            <option {{ old('usertype') == 'اداری' ? 'selected' : '' }}>
                                                                اداری
                                                            </option>
                                                            <option
                                                                {{ old('usertype') == 'باغ ویلا' ? 'selected' : '' }}>
                                                                باغ ویلا
                                                            </option>
                                                            <option {{ old('usertype') == 'دیگر' ? 'selected' : '' }}>
                                                                دیگر
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-6">
                                                    <label for="type">نوع ملک *</label>
                                                    <div class="form-group">
                                                        <select name="type" id="type" required
                                                            class="form-control show-tick ms select2">
                                                            <option disabled selected hidden></option>
                                                            <option {{ old('type') == 'آپارتمان' ? 'selected' : '' }}>
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
                                                            <option {{ old('type') == 'مغازه' ? 'selected' : '' }}>
                                                                مغازه
                                                            </option>
                                                            <option {{ old('type') == 'دفتر کار' ? 'selected' : '' }}>
                                                                دفتر کار
                                                            </option>
                                                            <option {{ old('type') == 'باغ' ? 'selected' : '' }}>باغ
                                                            </option>
                                                            <option {{ old('type') == 'انبار' ? 'selected' : '' }}>
                                                                انبار
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-4">
                                                    <label for="bedroom">تعداد خواب *</label>
                                                    <div class="form-group">
                                                        <input type="number" id="bedroom" name="bedroom"
                                                            step="1" aria-disabled class="form-control"
                                                            value="{{ old('bedroom') }}" required />
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <label for="floorsell"> طبقه مورد معامله *</label>
                                                    <div class="form-group">
                                                        <input type="text" name="floorsell" id="floorsell"
                                                            aria-disabled class="form-control" required
                                                            value="{{ old('floorsell') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="floor">تعداد طبقات</label>
                                                    <div class="form-group">
                                                        <input type="number" name="floor" id="floor"
                                                            step="1" aria-disabled class="form-control"
                                                            value="{{ old('floor') }}" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <label for="year">قدمت ساخت</label>
                                                    <div class="form-group">
                                                        <input type="number" id="year" name="year"
                                                            class="form-control" placeholder="سال"
                                                            value="{{ old('year') }}" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="area">مساحت زمین (برحسب متر مربع)</label>
                                                    <div class="form-group">
                                                        <input type="number" id="area" name="area"
                                                            value="{{ old('area') }}" class="form-control"
                                                            placeholder="متر مربع" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="meter">متراژ زیر بنا *</label>
                                                    <div class="form-group">
                                                        <input type="number" id="meter" name="meter"
                                                            value="{{ old('meter') }}" max="10000"
                                                            class="form-control" required />
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- موقعیت مکانی -->
                                            <br>
                                            <h5 style="color:#04BE5B">موقعیت مکانی</h5>
                                            <hr>
                                            <div class="row clearfix ir-select">
                                                <div class="col-sm-4">
                                                    <label for="province">استان *</label>
                                                    <div class="form-group">
                                                        <select value="{{ old('province') }}"
                                                            class="ir-province  form-control show-tick ms select2"
                                                            id="province" name="province" required>
                                                            <option></option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="city">شهر *</label>
                                                    <div class="form-group">
                                                        <select value="{{ old('city') }}"
                                                            class="ir-city  form-control show-tick ms select2"
                                                            name="city" id="city"
                                                            value="{{ old('city') }}" required>
                                                            <option></option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="district">محله *</label>
                                                    <div class="form-group">
                                                        <input type="text" step="any" name="district"
                                                            id="district" class="form-control"
                                                            value="{{ old('district') }}" required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <small class="col-12"> برای پیدا کردن موقعیت روی لینک مقابل کلیک کنید
                                                    <a href="https://neshan.org/maps" target="_blank">نقشه
                                                        نشان</a></small>
                                                <div class="col-sm-6">
                                                    <label for="lon">طول جغرافیایی</label>

                                                    <div class="form-group">
                                                        <input type="number" value="{{ old('lon') }}"
                                                            step="any" id="lon" name="lon"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="lat">عرض جغرافیایی</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{ old('lon') }}"
                                                            step="any" name="lat" id="lat"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <label for="">آدرس *</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea rows="3" class="form-control no-resize" id="address" name="address"
                                                                placeholder="آدرس را وارد کنید" required>{{ old('address') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- مدیا -->
                                            <br>
                                            <h5 style="color:#04BE5B">مدیا</h5>
                                            <hr>

                                            <div class="container-fluid">
                                                <div class="row clearfix">
                                                    <div class="col-lg-12 col-md-12">
                                                        <div class="card">
                                                            <div class="header">
                                                                <h2><strong>تصویر اصلی *</strong></h2>
                                                            </div>
                                                            <div class="body">
                                                                <p>عکس را فقط با فرمت jpg و png آپلود نمایید. </p>
                                                                <div class="form-group">
                                                                    <input type="file" class="dropify"
                                                                        value="{{ old('img') }}" name="img"
                                                                        data-allowed-file-extensions="jpg png">
                                                                </div>
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
                                                            <input id="input-21" data-overwrite-initial="true"
                                                                name="otherimg[]" multiple type="file"
                                                                data-theme="fas">
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
                                                <div class="col-sm-12">
                                                    <label for="loan">کد امبد ویدیو</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('ambed') }}"
                                                            id="ambed" name="ambed" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br>

                                            <h5 style="color:#04BE5B">اطلاعات مربوط به فروش ملک </h5>
                                            <hr>

                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <label for="loan">وام بانکی</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('loan') }}"
                                                            id="loan" name="loan" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="loanamount">مبلغ وام</label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('loanamount') }}"
                                                                class="form-control" id="loanamount"
                                                                name="loanamount"
                                                                onkeyup="
                                                                     (this.value,this);"
                                                                aria-label="Amount (to the nearest dollar)">
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="meter_price">قیمت متری (برحسب متر مربع)</label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('meter_price') }}"
                                                                class="form-control" id="meter_price"
                                                                onkeyup="separateNum(this.value,this);"
                                                                name="meter_price"
                                                                aria-label="Amount (to the nearest dollar)">
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-lg-6">
                                                    <label for="bidprice">قیمت پیشنهادی *</label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('bidprice') }}"
                                                                class="form-control" id="bidprice" name="bidprice"
                                                                onkeyup="changePrice(this.value,this);"
                                                                aria-label="Amount (to the nearest dollar) "
                                                                minlength="10" maxlength="15" required>
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <label for="ugprice">قیمت کارشناسی *</label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('ugprice') }}"
                                                                class="form-control" id="ugprice" name="ugprice"
                                                                aria-label="Amount (to the nearest dollar)"
                                                                onkeyup="separateNum(this.value,this);" minlength="10"
                                                                maxlength="15" required>
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- اطلاعات مربوط به خرید اجاره -->
                                            <br>
                                            <h5 style="color:#04BE5B">اطلاعات مربوط به رهن و اجاره </h5>
                                            <hr>
                                            <div class="row clearfix">
                                                <div class="col-lg-3 col-md-6">
                                                    <label for="people_number">حداکثر تعداد نفرات</label>
                                                    <div class="form-group">
                                                        <input type="number" id="people_number" name="people_number"
                                                            value="{{ old('people_number') }}"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label for="rent">مبلغ اجاره *</label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('rent') }}"
                                                                class="form-control" id="rent" name="rent"
                                                                aria-label="Amount (to the nearest dollar)"
                                                                onkeyup="separateNum(this.value,this);" maxlength="10"
                                                                required>
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <label for="rahn">مبلغ رهن * </label>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">تومان</span>
                                                            </div>
                                                            <input type="text" value="{{ old('rahn') }}"
                                                                class="form-control" id="rahn" name="rahn"
                                                                aria-label="Amount (to the nearest dollar)"
                                                                onkeyup="separateNum(this.value,this);" maxlength="11"
                                                                required>
                                                            <div class="input-group-append">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3 col-md-6">
                                                    <br><br>
                                                    <div class="checkbox">
                                                        <input id="cheng"
                                                            {{ old('ischenge') === 'on' ? 'checked' : '' }}
                                                            type="checkbox" name="ischenge">
                                                        <label for="cheng">قابل تغیر اجاره و رهن</label>
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
                                                        <input id="chec"
                                                            {{ old('isactive') === 'on' ? 'checked' : '' }}
                                                            type="checkbox" name="isactive" checked>
                                                        <label for="chec">انتشار ملک</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- مشخصات مالک -->
                                <div role="tabpanel" class="tab-pane" id="profile_with_icon_title"> <b>مشخصات
                                        مالک</b>
                                    <div class="card">
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <label for="name_family">نام نام خانوادگی * </label>
                                                    <div class="form-group">
                                                        <input type="text" id="name_family" name="name_family"
                                                            required class="form-control" />
                                                        <div class="valid-feedback">
                                                            حله
                                                        </div>
                                                        <div class="invalid-feedback">
                                                            این فیلد مورد نیاز است
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="telephone">شماره تلفن</label>
                                                    <div class="form-group">
                                                        <input type="text" id="telephone" name="telephone"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="phone">شماره موبایل * </label>
                                                    <div class="form-group">
                                                        <input type="text" maxlength="11" id="phone"
                                                            name="phone" class="form-control" required />
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
                                    </div>
                                </div>

                                <!-- سایر مشخصات -->
                                <div role="tabpanel" class="tab-pane" id="messages_with_icon_title">
                                    <b>سایر مشخصات</b>
                                    <div class="card">
                                        <div class="body">
                                            <div class="row clearfix">
                                                <div class="col-lg-3">
                                                    <label for="doc">نوع سند</label>
                                                    <div class="form-group">
                                                        <select name="doc" id="doc"
                                                            class="form-control show-tick ms select2">
                                                            <option disabled selected hidden></option>
                                                            <option {{ old('doc') == 'سند دار' ? 'selected' : '' }}>سند
                                                                دار
                                                            </option>
                                                            <option {{ old('doc') == 'قولنامه ای' ? 'selected' : '' }}>
                                                                قولنامه ای
                                                            </option>
                                                            <option
                                                                {{ old('doc') == 'در دست اقدام' ? 'selected' : '' }}>در
                                                                دست اقدام
                                                            </option>
                                                            <option {{ old('doc') == 'مشاع' ? 'selected' : '' }}>مشاع
                                                            </option>
                                                            <option {{ old('doc') == 'دیگر' ? 'selected' : '' }}>دیگر
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="dimension">ابعاد</label>
                                                    <div class="form-group">
                                                        <input type="text" id="dimension"
                                                            value="{{ old('dimension') }}" name="dimension"
                                                            class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="view">نما</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('view') }}"
                                                            id="view" name="view" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-3">
                                                    <label for="door">درب ورودی</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('door') }}"
                                                            id="door" name="door" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <label for="screen">پرده</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('screen') }}"
                                                            id="screen" name="screen" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="cover">کفپوش</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('cover') }}"
                                                            id="cover" name="cover" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="phone line">خط تلفن</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('phone_line') }}"
                                                            id="phone_line" name="phone_line" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-4">
                                                    <label for="cool">سیستم برودتی</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('cool') }}"
                                                            id="cool" name="cool" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="heat">سیستم حرارتی</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('heat') }}"
                                                            id="heat" name="heat" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <label for="cabinet">کابینت</label>
                                                    <div class="form-group">
                                                        <input type="text" value="{{ old('cabinet') }}"
                                                            id="cabinet" name="cabinet" class="form-control" />
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <label for="collection">تعداد واحد های مجموعه</label>
                                                    <div class="form-group">
                                                        <input type="number" value="{{ old('collection') }}"
                                                            id="collection" name="collection" class="form-control" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row clearfix">
                                                <div class="col-sm-12">
                                                    <label for="">توضیحات</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea rows="5" class="form-control no-resize" id="description" name="description"
                                                                placeholder="توضیحات را وارد کنید ....">{{ old('description') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <label for="">توضیحات مشاور</label>
                                                    <div class="form-group">
                                                        <div class="form-line">
                                                            <textarea rows="5" class="form-control no-resize" id="agent_description" name="agent_description"
                                                                placeholder="توضیحات را وارد کنید ....">{{ old('agent_description') }}</textarea>
                                                        </div>
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
                                                            <input type="checkbox" id="features-{{ $feature->id }}"
                                                                name="features[]" class="filled-in chk-col-indigo"
                                                                value="{{ $feature->id }}"
                                                                {{ (is_array(old('features')) and in_array($feature->id, old('features'))) ? ' checked' : '' }} />
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
                                                <button style="padding: 12px 40px 12px 40px" type="submit"
                                                    class="btn btn-raised btn-primary waves-effect" onclick="">
                                                    ثبت اطلاعات
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
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
    <script>
        (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                //         // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                    form.addEventListener('submit', function(event) {
                        if (form.checkValidity() === false) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
            }, false);
        })();
    </script>

</div>
