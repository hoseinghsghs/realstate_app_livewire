@section('title', 'ویرایش پروفایل')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش پروفایل</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item">تنظیمات</li>
                        <li class="breadcrumb-item active">ویرایش پروفایل</li>
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
                <div class="card">
                    <div class="body">
                        <div class="col-md-12">
                            <div>
                                <h5>تنظیمات حساب</h5>
                            </div>
                            <form wire:submit.prevent="updateProfile" enctype="multipart/form-data" novalidate>
                                <div class="body">
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
                                                <input wire:model.defer="name" type="text" class="form-control"
                                                       placeholder="نام و نام خانوادگی">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label>شماره تماس</label>
                                            <div class="form-group">
                                                <input wire:model.defer="phone" type="text" maxlength="11"
                                                       class="form-control" placeholder="شماره تماس">
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6">
                                            <label>ایمیل</label>
                                            <div class="form-group">
                                                <input wire:model.defer="email" type="email" class="form-control"
                                                       placeholder="ایمیل">
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label>درباره من</label>
                                            <div class="form-group">
                                                <input wire:model.defer="about" type="text" maxlength="120"
                                                       minlength="50" class="form-control" placeholder="درباره من">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row clearfix">
                                        <div class="col-lg-4 col-md-6">
                                            <div class="form-group @error('image') is-invalid @enderror">
                                                <label class="form-label" for="exampleFormControlFile1">آپلود
                                                    تصویر پروفایل <span wire:loading wire:target="image"
                                                                        class="spinner-border spinner-border-sm"
                                                                        role="status"
                                                                        aria-hidden="true"></span></label>
                                                <div class="custom-file d-flex flex-row-reverse">
                                                    <input onchange="validateImage(this)" wire:model.defer.live="image"
                                                           type="file" class="custom-file-input" id="customFile"
                                                           lang="ar" dir="rtl">
                                                    <label class="custom-file-label text-right" for="customFile">
                                                    </label>
                                                </div>
                                                @error('image')
                                                <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </div>
                                        </div>
                                        @if ($this->image)
                                            <div class="col-lg-12">
                                                <img src="{{ $this->image->temporaryUrl() }}"
                                                     style="border: #00ff40 2px solid ; border-radius: 0.5rem"
                                                     height="300rem">
                                            </div>
                                        @elseif ($user->image)
                                            <div class="col-lg-12">
                                                <a href="{{ asset('storage/' . $user->image) }}"
                                                   class="file" target="_blank">
                                                    <div class="image">
                                                        <img src="{{ asset('storage/' . $user->image) }}"
                                                             alt="img"
                                                             style="border: #0077ff 2px solid ; border-radius: 0.5rem"
                                                             height="300rem" class="mb-3">
                                                    </div>
                                                </a>
                                            </div>
                                        @else
                                            <div class="col-lg-12">
                                                <a href="{{ asset('/pictures/user-default.png') }}" class="file"
                                                   target="_blank">
                                                    <div class="image">
                                                        <img src="{{ asset('/pictures/user-default.png') }}"
                                                             alt="img"
                                                             style="border: #0077ff 2px solid ; border-radius: 0.5rem"
                                                             height="200rem" class="mb-3">
                                                    </div>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn mt-3 btn-raised btn-primary waves-effect">
                                        بروزرسانی
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
