{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
            <div>
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html> --}}


<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!--favicon-->
    <link rel="icon" href="{{ asset('admin/assets/images/favicon-32x32.png') }}" type="image/png">
    <!-- loader-->
    <link href="{{ asset('admin/assets/css/pace.min.css') }}" rel="stylesheet">
    <script src="{{ asset('admin/assets/js/pace.min.js') }}"></script>

    <!--plugins-->
    <link href="{{ asset('admin/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/metismenu/metisMenu.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/plugins/metismenu/mm-vertical.css') }}">
    <link href="{{ asset('admin/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/notifications/css/lobibox.min.css') }}">
    {{-- Drag and drop --}}
    <link href="{{ asset('admin/assets/plugins/fancy-file-uploader/fancy_fileupload.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.css') }}" rel="stylesheet">
    <!--bootstrap css-->
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Material+Icons+Outlined" rel="stylesheet">
    <!--main css-->
    <link href="{{ asset('admin/assets/css/bootstrap-extended.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/main.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/dark-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/blue-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/semi-dark.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/bordered-theme.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/sass/responsive.css') }}" rel="stylesheet">
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">

        @yield('content')
    </div>

    <!--bootstrap js-->
    <script src="{{ asset('admin/assets/js/bootstrap.bundle.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <!--plugins-->
    <script src="{{ asset('admin/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/metismenu/metisMenu.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/main.js') }}"></script>

    {{-- notifications js --}}
    <script src="{{ asset('admin/assets/plugins/notifications/js/lobibox.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notifications/js/notifications.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/notifications/js/notification-custom-script.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/fancy-file-uploader/jquery.fileupload.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/fancy-file-uploader/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/fancy-file-uploader/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/Drag-And-Drop/dist/imageuploadify.min.js') }}"></script>

    <script src="{{ asset('admin/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>



    <script>
        document.addEventListener('alert_success', function(e) {
            round_success_noti(e.detail[0]);
        });

        document.addEventListener('alert_warning', function(e) {
            round_warning_noti(e.detail[0]);
        });

        document.addEventListener('alert_error', function(e) {
            round_error_noti(e.detail[0]);
        });

        document.addEventListener('open_edit_brand', function() {
            var modal = new bootstrap.Modal(document.getElementById('EditBrandModal'));
            modal.show();
        });


        document.addEventListener('open_edit_category', function() {
            var modal = new bootstrap.Modal(document.getElementById('EditCategoryModal'));
            modal.show();
        });

        document.addEventListener('open_edit_sub_category', function() {
            var modal = new bootstrap.Modal(document.getElementById('EditSubCategoryModal'));
            modal.show();
        });

        document.addEventListener('open_edit_car_part', function() {
            var modal = new bootstrap.Modal(document.getElementById('EditCarPartModal'));
            modal.show();
        });

        document.addEventListener('print', function(e) {
            console.log(e.detail)
        });
    </script>

    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bi-eye-slash-fill");
                    $('#show_hide_password i').removeClass("bi-eye-fill");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bi-eye-slash-fill");
                    $('#show_hide_password i').addClass("bi-eye-fill");
                }
            });
        });
    </script>


    @livewireScripts

    <div class="lobibox-notify-wrapper top right"></div>

</body>

</html>
