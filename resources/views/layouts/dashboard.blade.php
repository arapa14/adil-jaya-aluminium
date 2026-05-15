<!Doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ config('app.name') }} - @yield('title')</title>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('assets/backend/dist/css/tabler.min.css') }}" rel="stylesheet" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- BEGIN PLUGINS STYLES -->
    <link href="{{ asset('assets/backend/dist/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-socials.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-payments.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('assets/backend/dist/css/tabler-marketing.min.css') }}" rel="stylesheet" />
    <!-- END PLUGINS STYLES -->
    <!-- BEGIN DEMO STYLES -->
    <link href="{{ asset('assets/backend/preview/css/demo.min.css') }}" rel="stylesheet" />
    <!-- END DEMO STYLES -->
    <!-- END CUSTOM FONT -->
</head>

<body class="layout-fluid">
    <!-- BEGIN DEMO THEME SCRIPT -->
    <script src="{{ asset('assets/backend/preview/js/demo-theme.min.js') }}"></script>
    <!-- END DEMO THEME SCRIPT -->
    @yield('content')
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('assets/backend/dist/js/tabler.min.js') }}" defer></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- BEGIN DEMO SCRIPTS -->
    <script src="{{ asset('assets/backend/preview/js/demo.min.js') }}" defer></script>
    <!-- END DEMO SCRIPTS -->
</body>

</html>
