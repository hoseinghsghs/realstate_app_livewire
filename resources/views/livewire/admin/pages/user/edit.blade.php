@section('title', 'وایرایش کاربران')
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
                    <hr>
                    </br>
                    <form wire:submit.prevent="update" enctype="multipart/form-data">
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
                                <div class="col-lg-4 col-md-4">
                                    <label>نام و نام خانوادگی</label>
                                    <div class="form-group">
                                        <input wire:model="name" type="text" class="form-control"
                                            placeholder="نام و نام خانوادگی">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>شماره همراه</label>
                                    <div class="form-group">
                                        <input wire:model="phone" type="text" maxlength="11" class="form-control"
                                            placeholder="شماره همراه">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4">
                                    <label>ایمیل</label>
                                    <div class="form-group">
                                        <input wire:model="email" type="email" class="form-control"
                                            placeholder="ایمیل">
                                    </div>
                                </div>


                                <div class="form-group col-6 @error('image') is-invalid @enderror">
                                    <label class="form-label" for="exampleFormControlFile1">آپلود
                                        تصویر <span wire:loading wire:target="image"
                                            class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span></label>
                                    <div class="custom-file d-flex flex-row-reverse">
                                        <input onchange="validateImage(this)" wire:model.defer.live="image"
                                            type="file" class="custom-file-input" id="customFile" lang="ar"
                                            dir="rtl">
                                        <label class="custom-file-label text-right" for="customFile">
                                        </label>
                                    </div>
                                    @error('image')
                                        <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>
                                @if ($this->image)
                                    <img src="{{ $this->image->temporaryUrl() }}"
                                        style="border: #00ff40 2px solid ; border-radius: 0.5rem" height="300rem">
                                @else
                                    @isset($user->image)
                                        </hr>
                                        <div class="col-lg-12">
                                            <a href="{{ asset('storage/profile/' . $user->image) }}" class="file"
                                                target="_blank">
                                                <div class="image">
                                                    <img src="{{ asset('storage/profile/' . $user->image) }}" alt="img"
                                                        style="border: #0077ff 2px solid ; border-radius: 0.5rem"
                                                        height="300rem" class="mb-3">
                                                </div>
                                            </a>
                                        </div>
                                    @endisset
                                @endif
                                <div class="col-lg-12 col-md-12">
                                    <div class="checkbox">
                                        <input id="isactive" type="checkbox" wire:model='isactive'
                                            @checked($this->user->isactive)>
                                        @error('isactive')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                        <label for="isactive">وضعیت
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                    ویرایش حساب
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
