<!doctype html>
@php
    use App\Models\Setting;
    $setting = Setting::firstOrNew();
@endphp
<html class="no-js " lang="en">

<head>
    @include('admin.partial.Head')
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    <form action="{{ route('password.update') }}" method="POST" id="forgetUpdatePassword"
                        class="card auth_form">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div class="header">

                            <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                width="70px" class="logo" alt="" />
                            <h5>تغییر کلمه عبور</h5>
                        </div>
                        <div class="body">
                            <div class="input-group ">
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="{{ $request->email }}">
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="errorcurrent_password">

                                    @error('email')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="erroremail"></p>
                            </div>
                            <div class="input-group ">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="پسورد جدید">
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="errorpassword">
                                    @error('password')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="erroremail"></p>
                            </div>
                            <div class="input-group ">
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="تکرار پسورد جدید">
                                <div class="input-group-append">
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect btn-lg btn-block">تغییر
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="col-lg-11 col-sm-12 m-3">
                            <button class="btn btn-raised btn-danger waves-effect  btn-block">
                                فراموشی رمز عبور
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="{{ asset('assets/images/signin.svg') }}" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/admin.js') }}"></script>
@flasher_render

</html>
