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

    <!-- Scripts -->
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        @include('admin.layouts.navigation')


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

    {{-- <script>
        $('#fancy-file-upload').FancyFileUpload({
            params: {
                action: 'fileuploader'
            },
            maxfilesize: 1000000
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#image-uploadify').imageuploadify();
        })
    </script> --}}



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

        // window.livewire.on('close_edit_brand', (postId) => {
        //     $('#EditBrandModal').modal('hide');
        // })

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


    @livewireScripts

    <div class="lobibox-notify-wrapper top right"></div>

</body>

</html>
