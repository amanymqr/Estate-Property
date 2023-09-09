<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="Responsive HTML Admin Dashboard Template based on Bootstrap 5">
    <meta name="author" content="NobleUI">
    <meta name="keywords"
        content="nobleui, bootstrap, bootstrap 5, bootstrap5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('../adminassets/vendors/core/core.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('../adminassets/vendors/flatpickr/flatpickr.min.css') }}">
    <!-- End plugin css for this page -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('../adminassets/fonts/feather-font/css/iconfont.css') }}">
    <link rel="stylesheet" href="{{ asset('../adminassets/vendors/flag-icon-css/css/flag-icon.min.css') }}">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('../adminassets/css/demo2/style.css') }}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('../adminassets/images/favicon.png') }}" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    @yield('styles')
</head>

<body>
    <div class="main-wrapper">
        @include('body.sidebar')
        <div class="page-wrapper">

            @include('body.header')

                @yield('content')

                @include('body.footer')


        </div>
    </div>

    <script src="{{ asset('../adminassets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../adminassets/js/template.js') }}"></script>
    <script src="{{ asset('../adminassets/js/dashboard-dark.js') }}"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>
    @yield('scripts')
</body>

</html>
