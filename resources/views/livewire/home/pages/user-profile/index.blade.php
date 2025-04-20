<div>
    @section('title', 'پروفایل کاربری')


    <!-- ============================ Page Title Start================================== -->
    <div class="page-title" style="background:#f4f4f4 url(/assets/home/img/slider-5.jpg);" data-overlay="5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">

                    <div class="breadcrumbs-wrap">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">پروفایل من</li>
                        </ol>
                        <h2 class="breadcrumb-title">حساب کاربری و پروفایل من</h2>
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

                <div class="col-lg-9 col-md-8 col-sm-12">
                    <div class="dashboard-body">

                        <div class="dashboard-wraper">
                            <form wire:submit="update" enctype="multipart/form-data" novalidate>

                                <!-- Basic Information -->
                                <div class="frm_submit_block">
                                    <h4>حساب کاربری من</h4>
                                    <div class="frm_submit_wrap">

                                        <div class="form-row">


                                            <div class="form-group col-md-12">
                                                <label>نام شما</label>
                                                <input type="text" class="form-control" wire:model.defer='name'>
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('name')
                                                    <div style="color: red ; margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>ایمیل</label>
                                                <input type="email" wire:model.defer='email' class="form-control">
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('email')
                                                    <div style="color: red;margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>تلفن همراه</label>
                                                <input type="text" class="form-control" wire:model.defer='phone'
                                                    placeholder="شماره همراه">
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('phone')
                                                    <div style="color: red;margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>درباره من</label>
                                                <textarea class="form-control" cols="40" rows="3" wire:model.defer='about'></textarea>
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('about')
                                                    <div style="color: red;margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                        </div>
                                    </div>
                                </div>
                                <div class="frm_submit_block">
                                    <h4>آواتار</h4>
                                    <div class="frm_submit_wrap">
                                        <div class="form-row">

                                            <div class="form-group col-md-4">
                                                <label class="form-label" for="exampleFormControlFile1">
                                                    <span wire:loading wire:target="image"
                                                        class="spinner-border spinner-border-sm" role="status"
                                                        aria-hidden="true"></span></label>
                                                <div class="custom-file d-flex flex-row-reverse">
                                                    <input onchange="validateImage(this)" wire:model.live="image"
                                                        type="file" lang="ar" dir="rtl">
                                                    <label class="custom-file-label text-right" for="customFile">
                                                    </label>
                                                </div>
                                            </div>
                                            @if ($this->image)
                                                <img src="{{ $this->image->temporaryUrl() }}" height="300rem">
                                            @else
                                                </hr>
                                                <div class="col-lg-3 col-md-4 col-sm-12">
                                                    <div class="hover">
                                                    </div>
                                                    <a href="{{ asset('storage/preview/' . $user->image) }}"
                                                        class="file" target="_blank">
                                                        <div class="image">
                                                            <img src="{{ asset('storage/profile/' . $user->image) }}"
                                                                alt="img" class="img-fluid">
                                                        </div>
                                                    </a>
                                                </div>
                                            @endif

                                            <div class="form-group col-lg-12 col-md-12 mt-4">
                                                <button class="btn btn-theme btn-lg" type="submit">ذخیره
                                                    تغییرات</button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
