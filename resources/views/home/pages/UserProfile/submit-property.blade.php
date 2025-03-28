@extends('livewire.home.layout.HomeLayout')
@section('title', 'ثبت آگهی')
@section('content')
    @push('styles')
        <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.min.css"
              crossorigin="anonymous">
        <link href="{{ asset('assets/file/css/fileinput.css') }}" media="all" rel="stylesheet" type="text/css"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous">
        <link href="{{ asset('assets/file/themes/explorer-fas/theme.css') }}" media="all" rel="stylesheet"
              type="text/css"/>
    @endpush
    <!-- ============================ Page Title Start================================== -->
    <div class="page-title" style="background:#f4f4f4 url(/assets/home/img/slider-5.jpg);" data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">ثبت ملک</li>
                        </ol>
                        <h2 class="breadcrumb-title">ملک خود را ارسال کنید</h2>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- ============================ Page Title End ================================== -->

    <!-- ============================ User Dashboard ================================== -->
    <section class="gray pt-5 pb-5">
        <div class="container-fluid">

            <div class="row">

                @include('home.pages.UserProfile.right')

                <div class="col-lg-9 col-md-8">
                    <div class="dashboard-body">

                        <div class="dashboard-wraper">
                            <div class="row">

                                <!-- Submit Form -->

                                <div class="col-lg-12 col-md-12">
                                    <div class="row clearfix">
                                        @foreach ($errors->all() as $error)
                                            <!-- <li class="alert alert-danger alert-sm">{{ $error }}</li> -->

                                            <div class="col-sm-4">
                                                <div class="alert alert-danger alert-dismissible fade show"
                                                     role="alert">
                                                    {{ $error }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <form action="{{ route('user.properties.store') }}" class="needs-validation"
                                          method="POST" id="form_advanced_validation" enctype="multipart/form-data"
                                          novalidate>
                                        @csrf
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane in active" id="home_with_icon_title">
                                                <b>مشخصات ملک</b>
                                                <div>
                                                    <br>
                                                    <div class="body">
                                                        <div class="row clearfix">
                                                            <div class="col-lg-4 col-md-12">
                                                                <label for="title">عنوان *</label>
                                                                <div class="form-group">
                                                                    <input type="text" wire:model='form.title'
                                                                           value="{{ old('title') }}" id="title"
                                                                           class="form-control" required/>
                                                                    @error('form.title')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-12">
                                                                <label for="title">نام *</label>
                                                                <div class="form-group">
                                                                    <input type="text" wire:model='form.name_family'
                                                                           value="{{ old('name_family') }}" id="title"
                                                                           class="form-control" required/>

                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-12">
                                                                <label for="title">شماره تماس *</label>
                                                                <div class="form-group">
                                                                    <input type="text" maxlength="11"
                                                                           wire:model='form.telephone'
                                                                           value="{{ old('phone') }}" id="title"
                                                                           class="form-control" required/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-lg-4 col-md-6">
                                                                <label for="tr_type"> نوع معامله *</label>
                                                                <div class="form-group">
                                                                    <select wire:model.live='form.tr_type'
                                                                            onchange="settype()" id="tr_type" required
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
                                                                    </select>
                                                                    @error('form.tr_type')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <label for="usertype"> نوع کاربری *</label>
                                                                <div class="form-group">
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
                                                                                {{ old('usertype') == 'دیگر' ? 'selected' : '' }}>
                                                                            دیگر
                                                                        </option>
                                                                    </select>
                                                                    @error('form.usertype')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 col-md-6">
                                                                <label for="type">نوع ملک *</label>
                                                                <div class="form-group">
                                                                    <select wire:model='form.type' id="type" required
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
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-lg-4">
                                                                <label for="bedroom">تعداد خواب *</label>
                                                                <div class="form-group">
                                                                    <input type="number" id="bedroom"
                                                                           wire:model='form.bedroom' step="1"
                                                                           aria-disabled class="form-control"
                                                                           value="{{ old('bedroom') }}" required/>
                                                                    @error('form.bedroom')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-4">
                                                                <label for="floorsell"> طبقه مورد معامله *</label>
                                                                <div class="form-group">
                                                                    <input type="number" wire:model='form.floorsell'
                                                                           id="floorsell" step="1" aria-disabled
                                                                           class="form-control" required
                                                                           value="{{ old('floorsell') }}"/>
                                                                    @error('form.floorsell')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <label for="floor">تعداد طبقات</label>
                                                                <div class="form-group">
                                                                    <input type="number" wire:model='form.floor'
                                                                           step="1" aria-disabled class="form-control"
                                                                           value="{{ old('floor') }}"/>
                                                                    @error('form.floor')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-4">
                                                                <label for="year">قدمت ساخت</label>
                                                                <div class="form-group">
                                                                    <input type="number" id="year"
                                                                           wire:model='form.year' class="form-control"
                                                                           placeholder="سال" value="{{ old('year') }}"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="area">مساحت زمین (برحسب متر مربع)</label>
                                                                <div class="form-group">
                                                                    <input type="number" id="area"
                                                                           wire:model='form.area'
                                                                           value="{{ old('area') }}"
                                                                           class="form-control"
                                                                           placeholder="متر مربع"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="meter">متراژ زیر بنا *</label>
                                                                <div class="form-group">
                                                                    <input type="number" id="meter"
                                                                           wire:model='form.meter'
                                                                           value="{{ old('meter') }}" max="10000"
                                                                           class="form-control" required/>
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
                                                                    <select class="ir-province  form-control"
                                                                            wire:model.live='form.province'>
                                                                        <option value="">انتخاب استان
                                                                        </option>
                                                                        @foreach ($form->states as $stateName => $cities)
                                                                            <option value="{{ $stateName }}">
                                                                                {{ $stateName }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('form.province')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="city">شهر *</label>
                                                                <div class="form-group">
                                                                    <select class="ir-city  form-control"
                                                                            wire:model='form.city'>
                                                                        @foreach ($form->states[$form->province] ?? [] as $city)
                                                                            <option value="{{ $city }}">
                                                                                {{ $city }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                    @error('form.city')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="col-sm-4">
                                                                <label for="district">محله *</label>
                                                                <div class="form-group">
                                                                    <input type="text" step="any"
                                                                           wire:model='form.district'
                                                                           class="form-control"
                                                                           value="{{ old('district') }}" required/>
                                                                    @error('form.district')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-12">
                                                                <label for="">آدرس *</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <textarea rows="3"
                                                                                  class="form-control no-resize"
                                                                                  id="address" wire:model='form.address'
                                                                                  placeholder="آدرس را وارد کنید"
                                                                                  required>{{ old('address') }}</textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- مدیا -->
                                                        <br>
                                                        <h5 style="color:#04BE5B">تصاویر ملک</h5>
                                                        <hr>

                                                        <div class="header">

                                                        </div>
                                                        <div class="container my-4">
                                                            <div class="form-group">
                                                                <div class="form-group">
                                                                    <div class="file-loading">
                                                                        <input id="input-21"
                                                                               data-overwrite-initial="true"
                                                                               name="otherimg[]" multiple type="file"
                                                                               data-theme="fas">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- اطلاعات مربوط به خرید -->
                                                        <br>
                                                        @if ($this->form->tr_type == 'فروش' || $this->form->tr_type == 'پیش فروش')
                                                            <h5 style="color:#04BE5B">اطلاعات مربوط به فروش ملک </h5>
                                                            <hr>

                                                            <div class="row clearfix">


                                                            </div>
                                                            <div class="row clearfix" id="price">
                                                                <div class="col-lg-6">
                                                                    <label for="bidprice">قیمت پیشنهادی (تومان)*</label>
                                                                    <div class="form-group">
                                                                        <div class="input-group mb-3">

                                                                            <input type="text"
                                                                                   value="{{ old('bidprice') }}"
                                                                                   class="form-control" id="bidprice"
                                                                                   wire:model='form.bidprice'
                                                                                   aria-label="Amount (to the nearest dollar) "
                                                                                   onkeyup="separateNum(this.value,this);"
                                                                                   minlength="10" maxlength="13"
                                                                                   required>
                                                                            <div class="input-group-append">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        @endif

                                                        @if ($this->form->tr_type == 'رهن و اجاره')
                                                            <!-- اطلاعات مربوط به خرید اجاره -->
                                                            <br>
                                                            <h5 style="color:#04BE5B">اطلاعات مربوط به رهن و اجاره </h5>
                                                            <hr>
                                                            <div class="row clearfix" id="rahn">
                                                                <div class="col-lg-3 col-md-6">
                                                                    <label for="rent">مبلغ اجاره (تومان) * </label>
                                                                    <div class="form-group">
                                                                        <div class="input-group mb-3">

                                                                            <input type="text"
                                                                                   value="{{ old('rent') }}"
                                                                                   class="form-control" id="rent"
                                                                                   wire:model='form.rent'
                                                                                   aria-label="Amount (to the nearest dollar)"
                                                                                   onkeyup="separateNum(this.value,this);"
                                                                                   maxlength="10" required>
                                                                            @error('form.rent')
                                                                            <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                            <div class="input-group-append">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6">
                                                                    <label for="rahn"> مبلغ رهن (تومان) * </label>
                                                                    <div class="form-group">
                                                                        <div class="input-group mb-3">
                                                                            <input type="text"
                                                                                   value="{{ old('rahn') }}"
                                                                                   class="form-control"
                                                                                   wire:model='form.rahn'
                                                                                   aria-label="Amount (to the nearest dollar)"
                                                                                   onkeyup="separateNum(this.value,this);"
                                                                                   maxlength="11" required>
                                                                            @error('form.rahn')
                                                                            <small
                                                                                    class="text-danger">{{ $message }}</small>
                                                                            @enderror
                                                                            <div class="input-group-append">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-3 col-md-6">
                                                                    <br><br>
                                                                    <div class="checkbox">
                                                                        <input id="ischange" wire:model='form.ischange'
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


                                                        <div class="row clearfix">
                                                            <div class="col-sm-12">
                                                                <label for="doc">نوع سند</label>
                                                                <div class="form-group">
                                                                    <select wire:model='form.doc' id="doc"
                                                                            class="form-control show-tick ms select2">
                                                                        <option disabled selected hidden>
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
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row clearfix">
                                                            <div class="col-sm-12">
                                                                <label for="">توضیحات</label>
                                                                <div class="form-group">
                                                                    <div class="form-line">
                                                                        <textarea rows="5"
                                                                                  class="form-control no-resize"
                                                                                  id="description"
                                                                                  wire:model='form.description'
                                                                                  placeholder="توضیحات را وارد کنید ...."></textarea>
                                                                        @error('form.description')
                                                                        <small
                                                                                class="text-danger">{{ $message }}</small>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="body">
                                                        <div class="col-lg-5 ">
                                                        </div>
                                                        <div class="col-lg-4 ">
                                                            <button style="padding: 12px 40px 12px 40px" type="submit"
                                                                    class="btn btn-raised btn-primary waves-effect"
                                                                    onclick="">
                                                                ثبت اطلاعات
                                                            </button>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- row -->
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="/assets/js/jquery.validate.js"></script>
    <script src="/assets/js/form-validation.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="{{ asset('assets/file/js/plugins/piexif.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/file/js/plugins/sortable.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/file/js/fileinput.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/file/js/locales/fa.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/file/themes/fas/theme.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/js/ir-city-select.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>




    <script>
        $(document).ready(function () {
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

    <script>
        $(document).ready(function () {
            $("#price,#rahn").hide();
            $(document).on('change', '#tr_type', function (e) {
                if (this.value === 'فروش') {
                    $('#price').show();
                    $('#rahn input').attr('disabled', 'disabled');
                    $('#price input').removeAttr('disabled');
                    $('#rahn').hide();
                } else if (this.value === 'رهن و اجاره') {
                    $('#price').hide();
                    $('#price input').attr('disabled', 'disabled');
                    $('#rahn input').removeAttr('disabled');
                    $('#rahn').show();
                } else {
                    $("#price,#rent").hide();
                }
            })
        })


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
        (function () {
            'use strict';
            window.addEventListener('load', function () {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                //         // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function (form) {
                    form.addEventListener('submit', function (event) {
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
@endpush
