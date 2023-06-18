<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ $title }}</title>
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/main/app-dark.css') }}">

    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('mazer/assets/images/logo/favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="{{ asset('mazer/assets/css/shared/iconly.css') }}">

    @stack("scripts")
</head>

<body>
    <script src="{{ asset('mazer/assets/js/initTheme.js') }}"></script>
    @include('sweetalert::alert')
    <div id="app">
        <x-dashboard.sidebar></x-dashboard.sidebar>
        <div id="main" class="layout-navbar navbar-fixed">
            <x-dashboard.header></x-dashboard.header>
            <div id="main-content">
                <div class="page-heading">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-12 col-md-6 order-md-1 order-last">
                                <h3>{{ $title }}</h3>
                                <p class="text-subtitle text-muted">
                                    {{$subTitle}}
                                </p>
                            </div>
                            <div class="col-12 col-md-6 order-md-2 order-first">
                                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item">
                                            <a href="index.html">Dashboard</a>
                                        </li>
                                        <li class="breadcrumb-item active" aria-current="page">
                                            Layout Vertical Navbar
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>

                    <x-alert></x-alert>
                    <section class="section">
                        {{ $slot }}
                    </section>
                </div>
                <x-dashboard.footer></x-dashboard.footer>
            </div>
        </div>
    </div>


    <script src="{{ asset('mazer/assets/js/bootstrap.js') }}"></script>
    <script src="{{ asset('mazer/assets/js/app.js') }}"></script>
    @vite(['resources/js/app.js'])
    @stack("scripts")
</body>

</html>
