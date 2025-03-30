<!doctype html>
@php
    use App\Models\Setting;
    $setting = Setting::firstOrNew();
@endphp
<html class="no-js " lang="en">

<head>
    @include('livewire.admin.partial.Head')
</head>

<body class="theme-blush">
    <div class="authentication">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <form id="ForgetPassword" class="card auth_form">
                        <div style="text-align: center;">
                            <img src="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}"
                                width="70px" class="logo" alt="" />
                            <h5>فراموشی رمز عبور</h5>
                        </div>
                        <div class="body">
                            <div class="input-group ">
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="ایمیل خود را برای بازیابی وارد کنید">
                                <div class="input-group">
                                    <p style="color:red;" id="erroremail"></p>
                                </div>
                                <button class="btn btn-raised btn-primary waves-effect btn-lg btn-block">ارسال ایمیل
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
    $('#ForgetPassword').submit(function(event) {
        event.preventDefault();
        $.post("{{ route('password.email') }}",

            {
                '_token': "{{ csrf_token() }}",
                'email': $('#email').val(),
            },
            function(response, status) {
                // console.log(response, status);
                window.location.replace("{{ route('admin.home') }}");
                alert("لینک باز یابی رمز عبور ارسال گردید لطفا ایمیل خود را بررسی کنید ");

            }

        ).fail(function(response) {
            console.log(response.responseJSON.errors);
            if (response.responseJSON.errors.email) {
                $('#erroremail').html(response.responseJSON.errors.email[0]);
            } else {
                $('#erroremail').html("");
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
