<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Shop :: Administrative Panel</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('ui/backend') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('ui/backend') }}/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ asset('ui/backend') }}/css/custom.css">

    <link rel="stylesheet" href="{{ asset('ui/backend/plugins/select2/css/select2.min.css') }}">

    {{-- DropZone/Image intrgration --}}
    <link rel="stylesheet" href="{{ asset('ui/backend/plugins/dropzone/min/dropzone.min.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @include('admin.layouts.includes.navbar')
        <!-- /.navbar -->
        <!-- Main Sidebar Container -->
        @include('admin.layouts.includes.sidebar')
        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        @include('admin.layouts.includes.footer')

    </div>



    <!-- ./wrapper -->
    <!-- jQuery -->
    <script src="{{ asset('ui/backend') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('ui/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('ui/backend') }}/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('ui/backend') }}/js/demo.js"></script>
    {{-- ckeditor --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js"></script>
    {{-- DropZone/Image intrgration --}}
    <script src="{{ asset('ui/backend/plugins/dropzone/min/dropzone.min.js') }}"></script>
    {{-- Select2 --}}
    <script src="{{ asset('ui/backend/plugins/select2/js/select2.min.js') }}"></script>

    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })
    </script>
    <script>
        // $.ajaxSetup {
        //     (
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         }
        //     )
        // }
        // Example using Axios
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        axios.defaults.headers.common['X-CSRF-TOKEN'] = token;
    </script>
    @yield('customJs')
</body>

</html>
