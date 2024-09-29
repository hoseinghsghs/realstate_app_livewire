<!-- Log In Modal -->
<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="registermodal" aria-hidden="true">
    <div class="modal-dialog modal-xl login-pop-form" role="document">
        <div class="modal-content overli" id="registermodal">
            <div class="modal-body p-0">
                <div class="resp_log_wrap">
                    <div class="resp_log_thumb" style="background:url(assets/home/img/log.jpg)no-repeat;"></div>
                    <div class="resp_log_caption">
                        <span class="mod-close" data-dismiss="modal" aria-hidden="true"><i class="ti-close"></i></span>
                        <div class="edlio_152">
                            <ul class="nav nav-pills tabs_system center" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-login-tab" data-toggle="pill"
                                        href="#pills-login" role="tab" aria-controls="pills-login"
                                        aria-selected="true"><i class="fas fa-sign-in-alt ml-2"></i>ورود</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-signup-tab" data-toggle="pill" href="#pills-signup"
                                        role="tab" aria-controls="pills-signup" aria-selected="false"><i
                                            class="fas fa-user-plus ml-2"></i>ثبت نام</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-login" role="tabpanel"
                                aria-labelledby="pills-login-tab">
                                <div class="login-form">
                                    <form id="loginform">

                                        <div class="form-group">
                                            <label>نام کاربری یا آدرس ایمیل *</label>
                                            <div class="input-with-icon">
                                                <input name="email" id="email" type="text" onClick="this.select()"
                                                    style="margin-bottom: 6px" value="{{old('email')}}"
                                                    class="form-control">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red" id="erroremail"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>کلمه عبور * </label>
                                            <div class="input-with-icon">
                                                <input name="password" type="password" style="margin-bottom: 6px"
                                                    id="password" autocomplete="off" onClick="this.select()" value=""
                                                    class="form-control">
                                                <i class="ti-unlock"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red;" id="errorpassword"></p>
                                        </div>
                                        <div class="form-group">
                                            <div class="eltio_ol9">
                                                <div class="eltio_k1">
                                                    <input id="dd" class="checkbox-custom" name="dd" type="checkbox">
                                                    <label for="dd" class="checkbox-custom-label">مرا به خاطر
                                                        بسپار</label>
                                                </div>
                                                <div class="eltio_k2">
                                                    <a href="{{route('forget_password')}}">کلمه عبور خود را فراموش کرده
                                                        اید؟</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button class="btn btn-md full-width pop-login">ورود به
                                                سیستم
                                                <i class="fas fa-spinner fa-pulse" id="loading1"></i>
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pills-signup" role="tabpanel"
                                aria-labelledby="pills-signup-tab">
                                <div class="login-form">
                                    <form id="main-register-form2">

                                        <div class="form-group">
                                            <label>نام و نام خانوادگی</label>
                                            <div class="input-with-icon">
                                                <input name="name" type="text" id="name" onClick="this.select()"
                                                    value="" class="form-control">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red;" id="errorname"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>آدرس ایمیل</label>
                                            <div class="input-with-icon">
                                                <input name="email" id="email2" type="text" onClick="this.select()"
                                                    value="" class="form-control">
                                                <i class="ti-user"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red;" id="erroremail2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>کلمه عبور</label>
                                            <div class="input-with-icon">
                                                <input name="password" id="password2" type="password" autocomplete="off"
                                                    onClick="this.select()" class="form-control">
                                                <i class="ti-unlock"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red;" id="errorpassword2"></p>
                                        </div>
                                        <div class="form-group">
                                            <label>تکرار کلمه عبور</label>
                                            <div class="input-with-icon">
                                                <input name="password_confirmation" type="password" autocomplete="off"
                                                    id="password_confirmation" onClick="this.select()"
                                                    class="form-control">
                                                <i class="ti-unlock"></i>
                                            </div>
                                        </div>
                                        <div>
                                            <p style="color:red;" id="errorpasswordc2"></p>
                                        </div>
                                        <div class="form-group">
                                            <div class="eltio_ol9">
                                                <div class="eltio_k1">
                                                    <input id="dds" class="checkbox-custom" name="dds" type="checkbox">
                                                    <label for="dds" class="checkbox-custom-label">با استفاده از وب سایت
                                                        ، شرایط و ضوابط را می پذیرید</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-md full-width pop-login">ثبت
                                                نام
                                                <i class="fas fa-spinner fa-pulse" id="loading"></i>

                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Modal -->

@push('scripts')
<script>
$(document).ready(function() {
    $("#loading").hide();
    $(document).ajaxStart(function() {
        $("#loading").show();
    }).ajaxStop(function() {
        $("#loading").hide();
    });
});
$(document).ready(function() {
    $("#load").hide();
    $(document).ajaxStart(function() {
        $("#load").show();
    }).ajaxStop(function() {
        $("#load").hide();
    });
});
</script>

<script>
$('#loginform').submit(function(event) {
    event.preventDefault();
    $.post("{{route('login')}}", {

            '_token': "{{csrf_token()}}",
            'email': $('#email').val(),
            'password': $('#password').val(),
            'check': $('#check-a3').val()

        },

        function(response, status) {}

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

<!-- sign oute -->

<script>
$('#main-register-form2').submit(function(event) {
    event.preventDefault();
    $.post("{{route('register')}}", {

            '_token': "{{csrf_token()}}",
            'name': $('#name').val(),
            'email': $('#email2').val(),
            'password': $('#password2').val(),
            "password_confirmation": $('#password_confirmation').val(),
        },

        function(response, status) {


            // swal({
            //     icon: 'success',
            //     text: 'ثبت نام اجام گردید',
            //     timer: 2000
            // });
            // timer();
            window.location.replace("{{route('home')}}");
        }

    ).fail(function(response) {


        if (response.responseJSON.errors.name) {
            $('#errorname').html(response.responseJSON.errors.name);
        } else {
            $('#errorname').html("");
        }

        if (response.responseJSON.errors.email) {
            $('#erroremail2').html(response.responseJSON.errors.email);
        } else {
            $('#erroremail2').html("");
        }

        if (response.responseJSON.errors.password) {
            $('#errorpassword2').html(response.responseJSON.errors.password[0]);
        } else {
            $('#errorpassword2').html("");
        }

        if (response.responseJSON.errors.password_confirmation) {
            $('#errorpasswordc2').html(response.responseJSON.errors
                .password_confirmation);
        } else {
            $('#errorpasswordc2').html("");
        }
        console.log(response.responseJSON.errors);

    })


});
</script>
<script>
$(document).ready(function() {
    $("#loading").hide();
    $("#loading1").hide();
    $(document).ajaxStart(function() {
        $("#loading").show();
        $("#loading1").show();
    }).ajaxStop(function() {
        $("#loading").hide();
        $("#loading1").hide();
    });
});
</script>
@endpush