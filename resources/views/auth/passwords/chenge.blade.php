<!doctype html>
<html class="no-js " lang="en">
@php
    use App\Models\Setting;
    $setting = Setting::firstOrNew();
@endphp

<head>
    @include('livewire.admin-layout.partial.Head')
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form id="UpdatePassword" class="card auth_form">
                        <div style="text-align: center;">

                            <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                width="70px" class="logo" alt="" />
                            <h5>تغییر کلمه عبور</h5>
                        </div>
                        <div class="body">
                            <div class="input-group ">
                                <input type="text" name="current_password" id="current_password" class="form-control"
                                    placeholder="پسورد قبلی">
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="errorcurrent_password"></p>
                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="erroremail"></p>
                            </div>
                            <div class="input-group ">
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="پسورد جدید">

                            </div>
                            <div class="input-group">
                                <p style="color:red;" id="errorpassword"></p>
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
                                    <span id="loading">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                    </span>
                                </button>
                            </div>
                        </div>
                    </form>
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
<script>
    $('#UpdatePassword').submit(function(event) {
        event.preventDefault();
        $.post("{{ route('user-password.update') }}",

            {
                "_method": "PUT",
                '_token': "{{ csrf_token() }}",
                'current_password': $('#current_password').val(),
                'password': $('#password').val(),
                'password_confirmation': $('#password_confirmation').val(),

            },
            function(response, status) {
                console.log(response, status);
                window.location.replace("{{ route('setroute') }}");
                alert("پسورد با موفقیت تغییر کرد");
            }

        ).fail(function(response) {
            console.log(response.responseJSON.errors);
            if (response.responseJSON.errors.password) {
                $('#errorpassword').html(response.responseJSON.errors.password[0]);
            } else {
                $('#errorpassword').html("");
            }
            if (response.responseJSON.errors.current_password) {
                $('#errorcurrent_password').html('رمز عبور قبلی اشتباه است');
            } else {
                $('#errorcurrent_password').html("");
            }

            errorcurrent_password

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
