<!doctype html>
<html class="no-js " lang="en">
@php
    use App\Models\Setting;
    $setting = Setting::firstOrNew();
@endphp

<head>
    @include('admin.partial.Head')
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form id="loginformadmin" class="card auth_form">
                        <div class="header">


                            <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                width="70px" class="logo" alt="" />

                            <h5>ورود</h5>
                        </div>
                        <div class="body">
                            <div class="input-group ">
                                <input type="text" name="email" id="email" class="form-control"
                                    placeholder="ایمیل">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="zmdi zmdi-account-circle"></i></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="erroremail"></p>
                            </div>
                            <div class="input-group ">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="رمزعبور">
                                <div class="input-group-append">
                                    <span class="input-group-text"><a href="forgot-password.html" class="forgot"
                                            title="فراموشی رمز عبور"><i class="zmdi zmdi-lock"></i></a></span>
                                </div>
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="errorpassword"></p>
                            </div>
                            <div class="checkbox">
                                <input id="remember" type="checkbox">
                                <label for="remember">مرا به خاطر بسپار</label>
                            </div>
                            <button class="btn btn-raised btn-primary waves-effect btn-lg btn-block">ورود
                                <span id="loading">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <div class="card">
                        <img src="assets/images/signin.svg" alt="Sign In" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/admin.js') }}"></script>
@flasher_render


<script>
    $('#loginformadmin').submit(function(event) {
        event.preventDefault();
        $.post("{{ route('login') }}",

            {
                '_token': "{{ csrf_token() }}",
                'email': $('#email').val(),
                'password': $('#password').val(),
                'check': $('#check-a3').val(),

            },
            function(response, status) {
                window.location.replace("{{ route('setroute') }}");
            }

        ).fail(function(response) {
            console.log(response.responseJSON.errors);

            if (response.responseJSON.errors.email) {
                $('#erroremail').html(response.responseJSON.errors.email);
            } else {
                $('#erroremail').html("");
            }

            if (response.responseJSON.errors.password) {
                $('#errorpassword').html(response.responseJSON.errors.password[0]);
            } else {
                $('#errorpassword').html("");
            }

        })


    });
</script>
<script>
    $(document).ready(function() {
        $("#loading").hide();
        $(document).ajaxStart(function() {
            $("#loading").show();
        }).ajaxStop(function() {
            $("#loading").hide();
        });
    });
</script>

</html>
