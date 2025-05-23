@section('title', 'مشاور جدید')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>اضافه کردن مشاور</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item">تنظیمات</li>
                        <li class="breadcrumb-item active">اضافه کردن مشاور</li>
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
        </hr>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <div class="body">
                            <form wire:submit.prevent="submit" enctype="multipart/form-data">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="row clearfix">
                                    <div class="col-lg-4 col-md-6">
                                        <label>نام و نام خانوادگی</label>
                                        <div class="form-group">
                                            <input wire:model="name" type="text" class="form-control"
                                                placeholder="نام و نام خانوادگی">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label>شماره همراه</label>
                                        <div class="form-group">
                                            <input wire:model="phone" type="text" maxlength="11" class="form-control"
                                                placeholder="شماره همراه">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label>ایمیل</label>
                                        <div class="form-group">
                                            <input wire:model="email" type="email" class="form-control"
                                                placeholder="ایمیل">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label>رمزعبور</label>
                                        <div class="form-group">
                                            <input wire:model="password" type="password" class="form-control"
                                                autocomplete="new-password">
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6">
                                        <label>تکرار رمز عبور</label>
                                        <div class="form-group">
                                            <input wire:model="password_confirmation" type="password"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center col-lg-4 col-md-6">
                                        <div class="checkbox">
                                            <input wire:model="isactive" type="checkbox" id="isactive" />
                                            <label for="isactive">وضعیت</label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="exampleFormControlFile1">آپلود
                                                    تصویر پروفایل<span wire:loading wire:target="image"
                                                        class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span></label>
                                                <div class="custom-file d-flex flex-row-reverse">
                                                    <input onchange="validateImage(this)" wire:model.live="image"
                                                        type="file" class="custom-file-input" id="customFile"
                                                        lang="ar" dir="rtl">
                                                    <label class="custom-file-label text-right" for="customFile">
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($this->image)
                                            <img src="{{ $this->image->temporaryUrl() }}"
                                                style="border: #00ff4c 2px solid ; border-radius: 0.5rem ;width: 25%;"
                                                class="mb-3">
                                        @endif
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                    ایجاد حساب
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
