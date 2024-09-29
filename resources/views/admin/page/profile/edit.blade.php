@extends('admin.layout.MasterAdmin')

@section('Content')
<section class="content">
    <div class="body_scroll">
        <div class="block-header">
            <div class="row">
                <div class="col-lg-7 col-md-6 col-sm-12">
                    <h2>ویرایش پروفایل</h2>
                    </br>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href={{route('admin.home')}}><i class="zmdi zmdi-home"></i>
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
                    <a href="profile.html" class="btn btn-info btn-icon float-right"><i class="zmdi zmdi-check"></i></a>
                </div>
            </div>
        </div>
        </hr>
        <div class="container-fluid">
            <div class="row clearfix">
                <div class="col-md-12">
                    <div class="header">
                        <h5>تنظیمات حساب</h5>
                    </div>
                    @can('is_admin')
                    <form action="{{route('admin.profile.update',$user->id)}}" method="POST"
                        enctype="multipart/form-data" novalidate>
                        @endcan
                        @can('is_agent')
                        <form action="{{route('agent.profile.update',$user->id)}}" method="POST"
                            enctype="multipart/form-data" novalidate>
                            @endcan

                            @csrf
                            @method('PUT')
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
                                            <input name="name" type="text" class="form-control" value="{{$user->name}}"
                                                placeholder="نام و نام خانوادگی">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <label>شماره تماس</label>
                                        <div class="form-group">
                                            <input name="phone" type="text" maxlength="11" class="form-control"
                                                value="{{$user->phone}}" placeholder="شمار تماس">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <label>ایمیل</label>
                                        <div class="form-group">
                                            <input name="email" type="email" class="form-control"
                                                value="{{$user->email}}" placeholder="ایمیل">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <label>درباره من</label>
                                        <div class="form-group">
                                            <input name="about" type="text" maxlength="120" minlength="50"
                                                class="form-control" value="{{$user->about}}" placeholder="درباره من">
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
                                                    value="{{asset('storage/profile/'.$user->image)}}"
                                                    data-default-file="{{asset('storage/profile/'.$user->image)}}"
                                                    data-allowed-file-extensions="jpg png" required>
                                            </div>
                                        </div>
                                    </div>

                                    <button onclick="loadbtn(event)" type="submit"
                                        class="btn btn-raised btn-primary waves-effect">
                                        بروزرسانی
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