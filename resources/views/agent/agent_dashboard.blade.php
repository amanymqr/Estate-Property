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

    <link rel="stylesheet" href="{{ asset('adminassets/vendors/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminassets/vendors/jquery-tags-input/jquery.tagsinput.min.css') }}">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">
    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('adminassets/vendors/datatables.net-bs5/dataTables.bootstrap5.css') }}">
    <!-- End plugin css for this page -->

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
        @include('agent.body.sidebar')
        <div class="page-wrapper">

            @include('agent.body.header')

            @yield('content')

            @include('agent.body.footer')


        </div>
    </div>

    <script src="{{ asset('../adminassets/vendors/core/core.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('../adminassets/vendors/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('../adminassets/js/template.js') }}"></script>
    <script src="{{ asset('../adminassets/js/dashboard-dark.js') }}"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        $(function() {
            $(document).on('submit', '#deleteForm', function(e) {
                e.preventDefault();
                var form = this;
                var link = $(form).attr("action");
                Swal.fire({
                    title: 'Are you sure?',
                    text: "Delete this Data!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form when confirmed
                        form.submit();
                    }
                });
            })
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    @yield('scripts')

    <!-- Plugin js for this page -->
    <script src="{{ asset('adminassets/vendors/datatables.net/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/datatables.net-bs5/dataTables.bootstrap5.js') }}"></script>
    <!-- End plugin js for this page -->
    <script src="{{ asset('adminassets/js/data-table.js') }}"></script>

    <script src="{{ asset('adminassets/vendors/inputmask/jquery.inputmask.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/select2/select2.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/typeahead.js/typeahead.bundle.min.js') }}"></script>
    <script src="{{ asset('adminassets/vendors/jquery-tags-input/jquery.tagsinput.min.js') }}"></script>
    <script src="{{ asset('adminassets/js/inputmask.js') }}"></script>
    <script src="{{ asset('adminassets/js/select2.js') }}"></script>
    <script src="{{ asset('adminassets/js/typeahead.js') }}"></script>
    <script src="{{ asset('adminassets/js/tags-input.js') }}"></script>

    <script src="{{ asset('adminassets/vendors/tinymce/tinymce.min.js ') }}"></script>
    <script src="{{ asset('adminassets/js/tinymce.js ') }}"></script>

</body>

</html>
