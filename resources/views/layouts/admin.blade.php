<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>TUGAS HOLISTIK | @yield('title')</title>
        <meta name="description" content="Responsive, Bootstrap, BS4" />
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
        <link rel="icon" href="{{ asset('logo.png') }}">
        <!-- style -->
        @stack('styles')
        <!-- build:css ../dashboard/css/site.min.css -->
        <link rel="shortcut icon" type="image/png" href="../template/images/logos/favicon.png" />
        <link rel="stylesheet" href="{{ asset('template/libs/bootstrap/dist/css/bootstrap.css') }}" type="text/css" />
        <link rel="stylesheet" href="{{ asset('template/libs/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css" />
       
        <link rel="stylesheet" href="../template/css/styles.min.css" />
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css"/>
        <meta name="csrf-token" content="{{ csrf_token() }}">
     <!-- endbuild -->
    </head>
    <body class="layout-row">
        {{-- <!-- ############ Aside START--> --}}
        @include('includes.sidebar')
        <div id="main" class="layout-column flex">
            {{-- <!-- ############ Header START--> --}}
            {{-- @include('includes.header') --}}
            {{-- content --}}
            @yield('content')
            <!-- ############ Footer START-->
            <div id="footer" class="page-footer hide">
                {{-- <div class="d-flex p-3">
                    <span class="text-sm text-muted flex">&copy; Copyright. flatfull.com</span>
                    <div class="text-sm text-muted">Version 1.0.0</div>
                </div> --}}
            </div>
            <!-- ############ Footer END-->
        </div>
        <!-- build:js ../dashboard/js/site.min.js -->
        <!-- jQuery -->
       

        <script src="{{ asset('template/libs/jquery/dist/jquery.min.js') }}"></script>
        <script src="{{ asset('template/libs/jquery/dist/jquery.js') }}"></script>

        {{-- <script src="{{ asset('template/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('template/libs/bootstrap/dist/js/bootstrap.js') }}"></script> --}}
        <script src="{{ asset('template/js/bootstrap.min.js') }}"></script>

        <script src="{{ asset('template/js/sidebarmenu.js') }}"></script>
        <script src="{{ asset('template/js/app.min.js') }}"></script>
        <script src="{{ asset('template/libs/apexcharts/dist/apexcharts.min.js') }}"></script>
        <script src="{{ asset('template/libs/simplebar/dist/simplebar.js') }}"></script>
         <script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
             @stack('prepend-script')

        {{-- @include('includes.script-layanan') --}}
        @stack('addon-script')
        <!-- endbuild -->
    </body>
</html>
