@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>اضافه کردن مشاور</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
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
                    <form action="{{route('admin.users.store')}}" method="POST" enctype="multipart/form-data"
                        novalidate>
                        @csrf
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
                                <div class="col-lg-12 col-md-12">
                                    <label>نام و نام خانوادگی</label>
                                    <div class="form-group">
                                        <input name="name" value="{{old('name')}}" type="text" class="form-control"
                                            placeholder="نام و نام خانوادگی">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label>شماره همراه</label>
                                    <div class="form-group">
                                        <input name="phone" value="{{old('phone')}}" type="text" maxlength="11"
                                            class="form-control" placeholder="شماره همراه">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label>ایمیل</label>
                                    <div class="form-group">
                                        <input name="email" value="{{old('email')}}" type="email" class="form-control"
                                            placeholder="ایمیل">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label>پسورد</label>
                                    <div class="form-group">
                                        <input name="password" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <label>پسورد را دباره وارد کنید</label>
                                    <div class="form-group">
                                        <input name="password_confirmation" type="password" class="form-control">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="card">
                                        <div class="header">
                                            <h2><strong>آواتار</strong></h2>
                                        </div>
                                        <div class="body">
                                            <p>سعی کنید فقط png یا jpg را آپلود کنید</p>
                                            <input type="file" class="dropify" name="image" id="dropifyt"
                                                data-allowed-file-extensions="jpg png" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12">
                                    <div class="checkbox">
                                        <input id="isactive" type="checkbox" name="isactive"
                                            {{old('isactive')==='on' ? 'checked' : ""}} />
                                        <label for="isactive">فعال</label>
                                    </div>
                                </div>

                                <button onclick="loadbtn(event)" type="submit"
                                    class="btn btn-raised btn-primary waves-effect">
                                    ایجاد حساب
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection