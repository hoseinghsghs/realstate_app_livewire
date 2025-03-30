<!doctype html>
<html class="no-js " lang="fa">

<head>
    @include('livewire.admin.partial.Head')
    @stack('styles')
    @livewireStyles
</head>

<body class="theme-blush">
    @include('sweetalert::alert')
    <!-- Overlay For Sidebars -->
    <div class="overlay">
    </div>
    <!-- Right Icon menu Sidebar -->
    @include('livewire.admin.partial.RightIconSidebar')

    <!-- Left Sidebar -->
    @include('livewire.admin.partial.LeftSidebar')

    <!-- Right Sidebar -->
    @include('livewire.admin.partial.RightSidebar')
    <!-- Main Content -->

    @yield('Content')

    <!-- Jquery Core Js -->

    <script src="{{ asset('js/admin.js') }}"></script>
    {{-- @flasher_render --}}
    <script src="https://unpkg.com/file-upload-with-preview@4.1.0/dist/file-upload-with-preview.min.js"></script>
    <script src="https://unpkg.com/persian-date@1.1.0/dist/persian-date.min.js"></script>
    <script src="https://unpkg.com/persian-datepicker@1.2.0/dist/js/persian-datepicker.min.js"></script>
    @stack('scripts')
    <script>
        function loadbtn(event) {
            $(event.target).html(
                `درحال بارگذاری <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>`
            );
        };
    </script>
    @livewireScripts
</body>

</html>
