@extends('livewire.home.layout.HomeLayout')
@section('title', 'پروفایل کاربری')
@section('content')
    @push('styles')
        <link type="text/css" rel="stylesheet" href="/assets/home/css/dashboard-style.css">
    @endpush


    <!-- ============================ Page Title Start================================== -->
    <div class="page-title" style="background:#f4f4f4 url(assets/home/img/slider-5.jpg);" data-overlay="5">
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
                            <form action="{{ route('user.profile.update', Auth::user()->id) }}" method="POST"
                                enctype="multipart/form-data" novalidate>
                                @csrf
                                @method('PUT')
                                <!-- Basic Information -->
                                <div class="frm_submit_block">
                                    <h4>حساب کاربری من</h4>
                                    <div class="frm_submit_wrap">

                                        <div class="form-row">


                                            <div class="form-group col-md-12">
                                                <label>نام شما</label>
                                                <input type="text" name="name" class="form-control"
                                                    value="{{ Auth::user()->name }}">
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('name')
                                                    <div style="color: red ; margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>ایمیل</label>
                                                <input type="email" name="email" class="form-control"
                                                    value="{{ Auth::user()->email }}">
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('email')
                                                    <div style="color: red;margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>تلفن همراه</label>
                                                <input type="text" class="form-control" name="phone"
                                                    value="{{ Auth::user()->phone }}" placeholder="شماره همراه">
                                            </div>

                                            <label class="mt-3 mr-3">
                                                @error('phone')
                                                    <div style="color: red;margin-top: -18px;">{{ $message }}</div>
                                                @enderror
                                            </label>

                                            <div class="form-group col-md-12">
                                                <label>درباره من</label>
                                                <textarea class="form-control" cols="40" rows="3" name="about">{{ Auth::user()->about }}</textarea>
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
                                            <div class="form-group col-md-12">
                                                <label>تغییر تصویر</label>
                                                <input name="image" type="file"
                                                    class="dropzone dz-clickable primary-dropzone">
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12 mt-4">
                                                <button class="btn btn-theme btn-lg" type="submit">ذخیره تغییرات
                                                </button>
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
    <!-- ============================ User Dashboard End ================================== -->
@endsection
@push('scripts')
    <script src="/assets/home/js/dashboard.js"></script>
    @endpushsrc="/assets/home/js/dashboard.js"></script>
@endpush
