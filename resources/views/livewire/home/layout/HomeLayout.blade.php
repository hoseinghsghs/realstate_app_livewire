<!DOCTYPE HTML>
<html lang="en">

<head>
    <!--=============== basic  ===============-->
    <meta charset="UTF-8">
    <title>{{ $setting->title }} @yield('title')</title>

    <meta name="robots" content="index, follow" />
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--=============== css  ===============-->
    {{-- <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css"> --}}
    <link type="text/css" rel="stylesheet" href="/assets/home/css/jquery-ui.css">
    <link href="/assets/home/css/styles.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="/assets/home/css/modal.css">
    <!--=============== favicons ===============-->

    <link rel="shortcut icon"
        href="{{ $setting->logo ? asset('storage/logo/' . $setting->logo) : '/images/logo.png' }}">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1">

    <meta name="description" content="{{ $setting->seo_description }}" />
    <meta name="subject" content="real_state" />
    <meta name="copyright" content="amlack_abdiyan" />
    <meta name="designer" content="hosein ghasemi, amir rajabi" />
    <meta name="apple-mobile-web-app-title" content={{ $setting->title }}>
    <meta name="application-name" content={{ $setting->title }}>
    <meta property="og:title" content={{ $setting->title }} />
    <meta name="robots" content="index, follow" />
    <!-- -----------------  </- OG TAGs -> ----------------- -->
    <meta property="place:location:latitude" content={{ $setting->latitude }}>
    <meta property="place:location:longitude" content={{ $setting->longitude }}>
    <meta property="business:contact_data:street_address" content={{ $setting->address }}>
    <meta property="business:contact_data:country_name" content="ایران">
    <meta property="business:contact_data:phone_number" content={{ $setting->phones[0] }}>
    <meta property="business:contact_data:website" content={{ env('APP_URL') }}>
    <!-- -----------------  twitter ----------------- -->
    <meta name="twitter:title" content={{ $setting->title }}>
    <meta name="twitter:description" content={{ $setting->description }}>
    <meta name="twitter:image" content="https://abdiyan.com/storage/preview/default.png">
    <meta name="twitter:card" content="summary">
    <!--og card tags-->
    <meta property="og:type" content="website">
    <meta property="og:image" content="https://abdiyan.com/storage/preview/default.png" alt={{ $setting->title }}>
    <meta property="og:image:width" content="200">
    <meta property="og:image:height" content="200">
    <meta property="og:description" content={{ $setting->description }}>
    <meta property="og:url" content={{ env('APP_URL') }}>
    <meta property="og:site_name" content="{{ $setting->title }} | سریع تر به ملک دلخواهت برس">


    @stack('styles')
    @livewireStyles

</head>
<div class="overlay"></div>

<body class="yellow-skin">
    @include('sweetalert::alert')


    @include('livewire.home.partials.loader')
    <div id="main-wrapper">
        @include('livewire.home.partials.header')

        @yield('content')

        @include('livewire.home.partials.footer')
        @include('livewire.home.partials.registered')
        <a id="back2Top" class="top-scroll" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>

    </div>
    <!-- Main end -->

    <!--=============== scripts  ===============
-->
    <script src="{{ asset('js/home.js') }}"></script>


    <script>
        $('#loginform').submit(function(event) {
            event.preventDefault();
            $.post("{{ route('login') }}", {

                    '_token': "{{ csrf_token() }}",
                    'email': $('#email').val(),
                    'password': $('#password').val(),
                    'check': $('#check-a3').val()

                },

                function(response, status) {

                    window.location.replace("{{ route('home') }}");
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


    <!-- sign oute -->
    <script>
        $('#main-register-form2').submit(function(event) {
            event.preventDefault();
            $.post("{{ route('register') }}", {

                    '_token': "{{ csrf_token() }}",
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
                    window.location.replace("{{ route('home') }}");
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
    {{-- <script src="/assets/home/notify/notify.js"></script> --}}
    @if (session('msg'))
        <script>
            $(document).ready(function() {
                $.notify("{{ session('msg') }}", "success", {
                    position: "top",
                });
            })
        </script>
    @endif
    <!-- علاقه مندی ها -->
    <script>
        function send(property) {
            console.log(property);

            $.get('/user/add-to-wishlist/' + [property],


                function(response, status) {
                    if (response.errors == 'deleted') {
                        $('#count').html(parseInt($('#count').html(), 10) - 1)
                        $('#count1').html(parseInt($('#count1').html(), 10) - 1)
                        $('#count2').html(parseInt($('#count2').html(), 10) - 1)

                        $("#" + property).css({
                            "color": "blue"
                        });

                        $.notify("از لیست علاقه مندی ها حذف شد", "info", {
                            position: "tap",
                        });

                    } else if ((response.errors == 'saved')) {
                        $('#count').html(parseInt($('#count').html(), 10) + 1)
                        $('#count1').html(parseInt($('#count1').html(), 10) + 1)
                        $('#count2').html(parseInt($('#count2').html(), 10) + 1)


                        $("#" + property).css({

                            "color": "red"
                        });

                        $.notify("به لیست علاقه مندی ها اضافه شد", "success", {
                            position: "tap",
                        });

                    } else if (response.errors == 'sign') {
                        $.notify("کاربر گرامی ابتدا باید وارد شوید.", "warn", {
                            position: "tap",
                        });
                    }
                }).fail(function() {

            })


        }
    </script>
    <script>
        function sender(property) {
            $.get("{{ url('user/add-to-wishlist') }}" + "/" + [property],
                function(response, status) {
                    console.log(response);
                    if (response.errors == 'deleted') {
                        $('#count').html(parseInt($('#count').html(), 10) - 1)
                        $('#wished').css({
                            'color': 'gray',

                        });
                        $.notify("ملک از لیست علاقه مندی ها حذف شد", "info", {
                            position: "tap",
                        });
                    } else if ((response.errors == 'saved')) {
                        $('#count').html(parseInt($('#count').html(), 10) + 1)
                        $('#wished').css({
                            'color': 'red',

                        });

                        $.notify("ملک به لیست علاقه مندی ها اضافه شد", "success", {
                            position: "tap",
                        });
                    } else if (response.errors == 'sign') {
                        $.notify("کاربر گرامی ابتدا باید وارد شوید.", "warn", {
                            position: "tap",
                        });

                    }

                }
            ).fail(function() {

            })
        }
    </script>
    <!-- علاقه مندی ها -->

    <script>
        $(document).on({
            ajaxStart: function() {
                $("body").addClass("loading");
            },
            ajaxStop: function() {
                $("body").removeClass("loading");
            }
        });
    </script>
    @stack('scripts')
    @livewireScripts
</body>

</html>
