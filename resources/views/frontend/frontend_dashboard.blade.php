<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">

    <title>@yield('title')</title>

    <!-- Fav Icon -->
    <link rel="icon" href="{{ asset('frontendassets/images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Stylesheets -->
    <link href="{{ asset('frontendassets/css/font-awesome-all.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/flaticon.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/owl.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/jquery.fancybox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/color/theme-color.css') }}" id="jssDefault" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/switcher-style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontendassets/css/responsive.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
</head>


<!-- page wrapper -->

<body>

    <div class="boxed_wrapper">


        <!-- preloader -->
        {{--  @include('frontend.home.preloader')  --}}
        <!-- preloader end -->


        <!-- switcher menu -->

        <!-- end switcher menu -->


        <!-- main header -->
        @include('frontend.home.header')
        <!-- main-header end -->

        <!-- Mobile Menu  -->

        @include('frontend.home.mobile_menu')
        <!-- End Mobile Menu -->

        @yield('content')



        <!-- main-footer -->
        @include('frontend.home.footer')
        <!-- main-footer end -->



        <!--Scroll to top-->
        <button class="scroll-top scroll-to-target" data-target="html">
            <span class="fal fa-angle-up"></span>
        </button>
    </div>


    <!-- jequery plugins -->
    <script src="{{ asset('frontendassets/js/jquery.js') }}"></script>
    <script src="{{ asset('frontendassets/js/popper.min.js') }}"></script>
    <script src="{{ asset('frontendassets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontendassets/js/owl.js') }}"></script>
    <script src="{{ asset('frontendassets/js/wow.js') }}"></script>
    <script src="{{ asset('frontendassets/js/validation.js') }}"></script>
    <script src="{{ asset('frontendassets/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontendassets/js/appear.js') }}"></script>
    <script src="{{ asset('frontendassets/js/scrollbar.js') }}"></script>
    <script src="{{ asset('frontendassets/js/isotope.js') }}"></script>
    <script src="{{ asset('frontendassets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('frontendassets/js/jQuery.style.switcher.min.js') }}"></script>
    <script src="{{ asset('frontendassets/js/jquery-ui.js') }}"></script>
    <script src="{{ asset('frontendassets/js/nav-tool.js') }}"></script>

    <!-- main-js -->
    <script src="{{ asset('frontendassets/js/script.js') }}"></script>
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
</body><!-- End of .page_wrapper -->

</html>
