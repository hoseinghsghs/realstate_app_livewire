<!doctype html>

<html class="no-js " lang="fa">

<head>
    @include('admin.partial.Head')
    @stack('styles')
</head>

<body class="theme-blush" onload="settype()">

    <!-- Page Loader -->
    @include('admin.partial.PageLoader')
    <!-- Overlay For Sidebars -->
    <div class=" overlay">
    </div>

    <!-- Main Search -->
    @include('admin.partial.MainSearch')
    <!-- Right Icon menu Sidebar -->
    @include('admin.partial.RightIconSidebar')

    <!-- Left Sidebar -->
    @include('admin.partial.LeftSidebar')

    <!-- Right Sidebar -->
    @include('admin.partial.RightSidebar')
    <!-- Main Content -->

    @yield('Content')

    <!-- Jquery Core Js -->

    <script src="{{asset('js/admin.js')}}"></script>
    @flasher_render
    @stack('scripts')
    <script>
    function loadbtn(event) {
        $(event.target).html(
            `درحال بارگذاری <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
        );
    };
    </script>
</body>

</html>