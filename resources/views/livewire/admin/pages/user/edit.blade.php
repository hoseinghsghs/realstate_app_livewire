@section('title', 'ویرایش کاربر')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش کاربر</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{ route('admin.home') }}><i class="zmdi zmdi-home"></i>
                                خانه</a></li>
                        <li class="breadcrumb-item">تنظیمات</li>
                        <li class="breadcrumb-item active">ویرایش کاربر</li>
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
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="card">
                        <form wire:submit.prevent="update">
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
                                    <div class="col-md-4 col-sm-6">
                                        <label>نام و نام خانوادگی</label>
                                        <div class="form-group">
                                            <input wire:model="name" type="text" class="form-control"
                                                   placeholder="نام و نام خانوادگی">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label>شماره همراه</label>
                                        <div class="form-group">
                                            <input wire:model="phone" type="text" maxlength="11" class="form-control"
                                                   placeholder="شماره همراه">
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-sm-6">
                                        <label>ایمیل</label>
                                        <div class="form-group">
                                            <input wire:model="email" type="email" class="form-control"
                                                   placeholder="ایمیل">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4 col-sm-6">
                                        <label>نقش</label>
                                        <select wire:model="role_id"
                                                class="form-control @error('role_id') is-invalid @enderror"
                                        >
                                            @foreach($roles as $role)
                                                <option value={{$role->id}}>{{$role->display_name}}</option>
                                            @endforeach
                                        </select>
                                        @error('role_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex align-items-center col-md-4 col-sm-6">
                                        <div class="checkbox">
                                            <input id="isactive" type="checkbox" wire:model='isactive'
                                                    @checked($this->user->isactive)>
                                            <label for="isactive">وضعیت
                                            </label>
                                            @error('isactive')
                                            <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="form-group col-md-6 col-lg-4 @error('image') is-invalid @enderror">
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
                                        <div class="col-lg-12">
                                            <img src="{{ $this->image->temporaryUrl() }}"
                                                 style="border: #00ff40 2px solid ; border-radius: 0.5rem"
                                                 height="300rem">
                                        </div>
                                    @elseif ($user->image)
                                        <div class="col-lg-12">
                                            <a href="{{ asset('storage/' . $user->image) }}" class="file"
                                               target="_blank">
                                                <div class="image">
                                                    <img src="{{ asset('storage/' . $user->image) }}"
                                                         alt="img"
                                                         style="border: #0077ff 2px solid ; border-radius: 0.5rem"
                                                         height="200rem" class="mb-3">
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
                                    <div class="mt-3 col-12">
                                        <button type="submit" class="btn btn-raised btn-primary waves-effect">
                                            ذخیره
                                        </button>
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
